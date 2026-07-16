/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./modules/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        // Deep slate text + near-black chrome
        ink: "#1b2733",
        "ink-soft": "#586675",
        deep: "#0f1b27",
        // Cool porcelain surfaces
        paper: "#eceff2",
        mist: "#dee4ea",
        line: "#d2dae1",
        // Denim — the cool voice: trust, primary actions, the low end of certainty.
        // (token name kept as "harbor" so every existing module class re-skins for free)
        harbor: "#35618c",
        "harbor-deep": "#26496c",
        "harbor-tint": "#dde7f1",
        // Honey/amber — the warm voice: certainty, human emphasis.
        // (token name kept as "ember" for the same re-skin reason)
        ember: "#c9801e",
        "ember-tint": "#f5e7ce",
        // Haze — the cool, uncertain end of the Certainty Factor scale
        haze: "#93a7b9",
      },
      fontFamily: {
        // The system's voice: a clean grotesque for headings, nav, and actions
        display: ['"Space Grotesk"', '"Helvetica Neue"', "Arial", "sans-serif"],
        // The human/knowledge voice: a warm literary serif for reading
        body: ["Newsreader", "Georgia", "serif"],
        // Measurements: certainty-factor values, eyebrows, tabular data
        mono: ['"IBM Plex Mono"', "monospace"],
      },
      borderRadius: {
        DEFAULT: "14px",
        sm: "8px",
      },
    },
  },
  plugins: [],
  corePlugins: {
    // Bootstrap's ".collapse" component (accordion/collapse panels) shares the
    // exact class name with Tailwind's ".collapse" (visibility:collapse) utility.
    // Tailwind's utilities layer loads after bootstrap.min.css and wins the tie,
    // silently making collapsed panels invisible-but-space-taking. Not used
    // elsewhere in this project, so disable it outright rather than patch per-page.
    visibility: false,
  },
};
