import "./bootstrap";
import { createApp } from "vue";
import ExportPdf from "./ExportPdf.vue";
import "bootstrap/dist/css/bootstrap.min.css";

const app = createApp({});
app.component("export-pdf", ExportPdf);
app.mount("#app");
