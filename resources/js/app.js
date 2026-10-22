require('./bootstrap');

// Chart.js v4: the default entry is the "core" build (no auto-registration).
// Use the official "auto" entry, which registers all controllers/elements/
// scales and exports the Chart class.
const chartjs = require('chart.js/auto');
window.Chart = chartjs.default || chartjs;
