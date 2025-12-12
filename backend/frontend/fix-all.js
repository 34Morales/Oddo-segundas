const fs = require('fs');
const path = require('path');

console.log('Creando estructura completa...');

const baseDir = path.join(__dirname, 'src');

// Estructura de carpetas
const folders = ['components', 'pages', 'services', 'styles'];
folders.forEach(folder => {
  const dir = path.join(baseDir, folder);
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
    console.log(`✅ Carpeta creada: ${folder}`);
  }
});

// Archivos mínimos
const files = {
  'components/Layout.jsx': `import React from 'react';\nexport default function Layout() { return <div>Layout</div>; }`,
  'components/ProtectedRoute.jsx': `import React from 'react';\nexport default function ProtectedRoute() { return <div>Protected</div>; }`,
  'pages/Login.jsx': `import React from 'react';\nexport default function Login() { return <div>Login</div>; }`,
  'pages/Dashboard.jsx': `import React from 'react';\nexport default function Dashboard() { return <div>Dashboard</div>; }`,
  'pages/Products.jsx': `import React from 'react';\nexport default function Products() { return <div>Products</div>; }`,
  'pages/ProductForm.jsx': `import React from 'react';\nexport default function ProductForm() { return <div>ProductForm</div>; }`,
  'pages/Categories.jsx': `import React from 'react';\nexport default function Categories() { return <div>Categories</div>; }`,
  'pages/CategoryForm.jsx': `import React from 'react';\nexport default function CategoryForm() { return <div>CategoryForm</div>; }`,
  'pages/Users.jsx': `import React from 'react';\nexport default function Users() { return <div>Users</div>; }`,
  'pages/StockMovements.jsx': `import React from 'react';\nexport default function StockMovements() { return <div>StockMovements</div>; }`,
  'pages/Reports.jsx': `import React from 'react';\nexport default function Reports() { return <div>Reports</div>; }`,
  'services/api.js': `import axios from 'axios';\nexport default axios.create({ baseURL: '/' });`,
  'styles/App.css': `body { margin: 0; padding: 0; }`,
  'styles/Dashboard.css': `.dashboard { padding: 20px; }`,
  'styles/Layout.css': `.layout { display: flex; }`,
  'App.jsx': `import React from 'react';\nexport default function App() { return <h1>App</h1>; }`,
  'main.jsx': `import React from 'react';\nimport ReactDOM from 'react-dom/client';\nimport App from './App.jsx';\nReactDOM.createRoot(document.getElementById('root')).render(<App />);`
};

Object.entries(files).forEach(([filePath, content]) => {
  const fullPath = path.join(baseDir, filePath);
  const dir = path.dirname(fullPath);
  
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
  }
  
  fs.writeFileSync(fullPath, content);
  console.log(`✅ Archivo creado: ${filePath}`);
});

console.log('\n🎉 Estructura creada. Ejecuta: npm run build');