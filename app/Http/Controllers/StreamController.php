<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class StreamController extends Controller
{
    // Función de proxy existente (INTACTA)
    public function play(Request $request)
    {
        $url = $request->query('url');
        if (!$url) return response('No URL', 400);

        // 1. Petición al origen simulando ser el sitio oficial
        $response = Http::withoutVerifying()
        ->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36...',
            'Referer' => $this->getReferer($url),
            'Origin' => $this->getOrigin($url),
        ])->get($url);

        if ($response->failed()) return response('Error de conexión', 500);

        $content = $response->body();
        $baseUrl = substr($url, 0, strrpos($url, '/') + 1);

        // REESCRITURA TÉCNICA (INTACTA)
        $content = preg_replace('/^(?!http)(.*\.ts)/m', $baseUrl . '$1', $content);
        $proxyBase = route('stream.proxy') . '?url=';
        $content = preg_replace('/^(?!http)(.*\.m3u8)/m', $proxyBase . $baseUrl . '$1', $content);

        return response($content)
            ->header('Content-Type', 'application/vnd.apple.mpegurl')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Cache-Control', 'no-cache');
    }

    // --- NUEVO: Función para extraer la URL dinámica de América TV ---
    public function getAmericaTvUrl()
    {
        // Guardamos en caché por 10 minutos (600 seg) para no saturar su servidor y que cargue rápido
        return Cache::remember('url_america_tv_live', 600, function () {
            try {
                // Visitamos la página oficial de América TV en vivo
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
                ])->get('https://tvgo.americatv.com.pe/en-vivo/directo');

                $html = $response->body();

                // Regex técnica para buscar la URL cruda del .m3u8 que el navegador Fetch/Network solicita
                // Buscamos un patrón que empiece con "https://" y termine en ".m3u8"
                if (preg_match('/https?:\/\/[^"\']+\.m3u8[^"\']*/', $html, $matches)) {
                    // Limpiamos las barras escapadas si existen
                    return str_replace('\\/', '/', $matches[0]);
                }

                return response('No se encontró el .m3u8 dinámico en el HTML crudo', 404);
            } catch (\Exception $e) {
                return response('Error extrayendo URL dinámica', 500);
            }
        });
    }

    // Funciones getReferer y getOrigin (INTACTAS)
    private function getReferer($url) {
        if (str_contains($url, 'iblups')) return 'https://www.tvperu.gob.pe/';
        if (str_contains($url, 'america')) return 'https://tvgo.americatv.com.pe/';
        return 'https://google.com';
    }

    private function getOrigin($url) {
        $parsed = parse_url($url);
        return ($parsed['scheme'] ?? 'https') . '://' . ($parsed['host'] ?? '');
    }

    public function streamMovie($filename)
    {
        // Ruta a la carpeta donde están tus videos
        $path = public_path("assets/movies/videos/{$filename}");

        if (!file_exists($path)) {
            abort(404);
        }

        $size = filesize($path);
        $start = 0;
        $length = $size;
        $status = 200;

        $headers = [
            'Content-Type' => 'video/mp4',
            'Accept-Ranges' => 'bytes',
        ];

        if (request()->header('Range')) {
            $range = explode('=', request()->header('Range'))[1];
            $range = explode('-', $range);
            $start = intval($range[0]);
            $end = (isset($range[1]) && is_numeric($range[1])) ? intval($range[1]) : $size - 1;
            $length = $end - $start + 1;
            $status = 206;
            $headers['Content-Range'] = "bytes $start-$end/$size";
        }


        $headers['Content-Length'] = $length;

        return response()->stream(function () use ($path, $start, $length) {
            $stream = fopen($path, 'rb');
            fseek($stream, $start);
            echo fread($stream, $length);
            fclose($stream);
        }, $status, $headers);
    }
}
