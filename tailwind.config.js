/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
      theme: {
          extend: {
              dropShadow: {
                  glow: [
                      "0 0px 20px rgba(255,255, 255, 0.35)",
                      "0 0px 65px rgba(255, 255,255, 0.2)"
                  ]
              }
          },
      },
      plugins: [],
}

