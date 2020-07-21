let defaultConfig = require('tailwindcss/defaultConfig')

module.exports = {
    purge: [
        './resources/**/*.php',
        './resources/**/*.css',
        './resources/**/*.js',
    ],
    theme: {
        container: {
            center: true,
        },
        colors: {
            ...defaultConfig.theme.colors,
            primary: defaultConfig.theme.colors.teal,
        },
        extend: {
            spacing: {
                px: '1px',
            },
        },
    },
}
