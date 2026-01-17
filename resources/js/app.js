// resources/js/app.js - COMPLETE FIX

import './bootstrap';
import Alpine from 'alpinejs';

// CRITICAL: Set Alpine BEFORE start
window.Alpine = Alpine;

// Optional: Add Alpine plugins here if needed
// import focus from '@alpinejs/focus'
// Alpine.plugin(focus)

// Start Alpine
Alpine.start();

// Debug log untuk memastikan Alpine loaded
console.log('✅ Alpine.js version:', Alpine.version);
console.log('✅ Alpine loaded at:', new Date().toISOString());