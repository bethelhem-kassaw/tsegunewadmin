let colors = require("tailwindcss/colors");
colors.primary = {
    default: "#002234",
    50: "#eefaff",
    100: "#dcf5ff",
    200: "#b2edff",
    300: "#6de1ff",
    400: "#20d2ff",
    500: "#00bdff",
    600: "#0098df",
    700: "#0079b4",
    800: "#006695",
    900: "#00547a",
    950: "#002234",
};
colors.secondary = {
    default: "#cd9971",
    50: "#faf6f2",
    100: "#f4ebe0",
    200: "#e9d4bf",
    300: "#dbb896",
    400: "#cd9971",
    500: "#c07b4f",
    600: "#b26844",
    700: "#94533a",
    800: "#784434",
    900: "#61392d",
    950: "#341d16",
};
module.exports = {
    content: ["./resources/**/*.blade.php", "./vendor/filament/**/*.blade.php"],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
                prociono: ["Prociono", "serif"],
            },
            colors: {
                danger: colors.green,
                primary: colors.primary,
                secondary: colors.secondary,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
