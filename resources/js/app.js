import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('mainApp', () => ({
        mobileMenu: false,
        typewriterText: '',
        typeIndex: 0,
        charIndex: 0,
        isDeleting: false,
        hero_skills: [
            'Desarrollo Web',
            'Streaming TV',
            'Apps Móviles'
        ],
        init() {
            this.typeRoutine();
        },
        typeRoutine() {
            // ... (el código de la función que pusimos antes)
        }
    }));
});

Alpine.start();
