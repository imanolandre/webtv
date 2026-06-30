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

        // Cabeceras simuladas para engañar al servidor de origen
        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Referer' => $this->getReferer($url),
            'Origin' => $this->getOrigin($url),
        ];

        // 1. Descargar el archivo (ya sea m3u8 o ts)
        // 1. Descargar el archivo (ya sea m3u8 o ts)
        $response = Http::withoutVerifying()
            ->withHeaders($headers)
            ->timeout(5) // <-- AQUÍ SE AGREGA EL TIMEOUT
            ->get($url);

        if ($response->failed()) {
            return response('Error origin: ' . $response->status(), $response->status());
        }

        // 2. Si el archivo solicitado es un video (.ts o .aac), lo devolvemos directamente como video
        if (str_ends_with(parse_url($url, PHP_URL_PATH), '.ts')) {
            return response($response->body())
                ->header('Content-Type', 'video/mp2t')
                ->header('Access-Control-Allow-Origin', '*');
        }

        // 3. Si es un archivo .m3u8, procesamos su contenido
        $content = $response->body();

        $parsedUrl = parse_url($url);
        $host = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        $path = dirname($parsedUrl['path'] ?? '');
        if ($path === '\\' || $path === '/') $path = '';

        $lines = explode("\n", $content);
        $newContent = "";
        $proxyBase = route('stream.proxy') . '?url=';

        foreach ($lines as $line) {
            $line = trim($line);
            // Si es una línea vacía o un comentario (etiquetas #EXT), la dejamos igual
            if (empty($line) || str_starts_with($line, '#')) {
                $newContent .= $line . "\n";
                continue;
            }

            // Si es un enlace de otro archivo, calculamos su URL real
            $absoluteUrl = "";
            if (str_starts_with($line, 'http')) {
                $absoluteUrl = $line; // Ya es absoluta
            } elseif (str_starts_with($line, '/')) {
                $absoluteUrl = $host . $line; // Ruta absoluta desde la raíz del dominio
            } else {
                $absoluteUrl = $host . $path . '/' . $line; // Ruta relativa a la carpeta actual
            }

            // Envolvemos la URL real en nuestro Proxy
            $newContent .= $proxyBase . urlencode($absoluteUrl) . "\n";
        }

        // 4. Devolver el texto modificado con permisos CORS
        return response($newContent)
            ->header('Content-Type', 'application/vnd.apple.mpegurl')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept');
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
        // Engaño para los servidores del Estado (TV Perú / iBlups)
        if (str_contains($url, 'cloudfront.net') || str_contains($url, 'iblups.com')) {
            return 'https://www.tvperu.gob.pe/';
        }

        // Engaño para América TV (Si en algún momento retomas su token)
        if (str_contains($url, 'america')) {
            return 'https://tvgo.americatv.com.pe/';
        }

        // Engaño para Bitel / TV360
        if (str_contains($url, 'tv360.bitel.com.pe')) {
            return 'https://live-evg17.tv360.bitel.com.pe/';
        }

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
    public function autoFetchChannel(Request $request)
    {
        $sourceUrl = $request->query('source'); // Ej: http://la-pagina-donde-viste-el-canal.com

        if (!$sourceUrl) return response('No source URL', 400);

        // 1. Nuestro backend simula ser un navegador visitando la página origen
        $response = Http::withoutVerifying()
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ])->get($sourceUrl);

        if ($response->failed()) return response('Error extrayendo token', 500);

        $html = $response->body();

        // 2. Buscamos el enlace m3u8 que contiene el token encriptado dentro del código HTML
        // Esta Regex busca cualquier URL que empiece con http, contenga la IP o dominio, y termine en .m3u8
        preg_match('/(http:\/\/[0-9\.]+:\d+\/.*?\.m3u8.*?)(?:\"|\'|\s)/i', $html, $matches);

        // Si la página usa un dominio en vez de IP, puedes usar una regex más general:
        // preg_match('/(https?:\/\/.*?\.m3u8.*?)(?:\"|\'|\s)/i', $html, $matches);

        if (!empty($matches[1])) {
            $freshM3u8Url = $matches[1];

            // Opcional: Limpiar caracteres de escape JSON si el link estaba dentro de un script
            $freshM3u8Url = str_replace('\/', '/', $freshM3u8Url);

            // 3. Enviamos el enlace recién horneado a nuestra función Proxy existente
            // Creamos un Request falso para reutilizar tu lógica de CORS
            $proxyRequest = new Request(['url' => $freshM3u8Url]);
            return $this->play($proxyRequest);
        }

        return response('No se pudo encontrar el enlace m3u8 en la fuente', 404);
    }
}
