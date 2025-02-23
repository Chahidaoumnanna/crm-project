import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App.jsx";

const rootElement = document.getElementById("react-root");
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(<App />);
}
