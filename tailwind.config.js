const colors = require("tailwindcss/colors");

module.exports = {
    content: require("fast-glob").sync(
        [
            "*.php",
            "./*.php",
            "./**/*.php",
            "./template-parts/**/*.php"
        ],
        { dot: true }
    ),
    theme: {
        fontFamily: {
            body: ["Poppins", "Inter", "sans-serif"],
            inter: "Inter",
            default: "Poppins",
            poppins: "Poppins",
            darkerGrotesque: ['Darker Grotesque', 'Poppins', 'Inter'],
            roboto: "Roboto",
            PlusJakartaSans: ['Plus Jakarta Sans', 'Poppins', 'san-serif']
        },
        container: {
            center: true,
            padding: {
                DEFAULT: "24px",
                md: "30px",
            //     lg: "3.25rem",
                xl: "120px",
            },
        },
        screens: {
            'md': '768px',
            'lg': '1024px',
            'xl': '1440px',
            // '2xl': '1440px'
        },
        extend: {
            colors: {
                primary: "#0EC5D7",
                secondary: "#FEC33C"
            }
        },
    },
    variants: {},
    plugins: [
        require("@tailwindcss/line-clamp"),
        require("@tailwindcss/forms")
    ],
};
