import './bootstrap';

import Alpine from 'alpinejs';

// Dark Mode Store
Alpine.store('darkMode', {
    on: localStorage.getItem('darkMode') === 'true',
    toggle() {
        this.on = !this.on;
        localStorage.setItem('darkMode', this.on);

        // Add smooth transition class briefly
        document.documentElement.classList.add('theme-transition');
        setTimeout(() => {
            document.documentElement.classList.remove('theme-transition');
        }, 350);
    }
});

window.Alpine = Alpine;

Alpine.start();
