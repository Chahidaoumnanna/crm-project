import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
// import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/react/index.jsx"], // Vérifie bien ce chemin
            refresh: true,
        }),
        react(),
    ],
});


// import { defineConfig } from 'vite';
// import react from '@vitejs/plugin-react';
//
// export default defineConfig({
//     plugins: [react()],
// });
