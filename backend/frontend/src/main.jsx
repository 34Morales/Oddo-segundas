import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import './styless/Dashboard.css';
import './styless/App.css'; // Estilos globales
import './styless/Layout.css'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);