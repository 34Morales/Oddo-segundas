import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Layout from './components/Layout';
import ProtectedRoute from './components/ProtectedRoute';
import Login from './pages/Login';
import Dashboard from './pages/Dashboard';
import Products from './pages/Products';
import ProductForm from './pages/ProductForm';
import Categories from './pages/Categories';
import CategoryForm from './pages/CategoryForm';
import Users from './pages/Users';
import StockMovements from './pages/StockMovements';
import Reports from './pages/Reports';

function App() {
  return (
    <Router>
      <Routes>
        {/* Ruta pÃºblica */}
        <Route path="/login" element={<Login />} />
        
        {/* Rutas protegidas */}
        <Route path="/" element={
          <ProtectedRoute>
            <Layout />
          </ProtectedRoute>
        }>
          <Route index element={<Navigate to="/dashboard" replace />} />
          <Route path="dashboard" element={<Dashboard />} />
          
          {/* Productos */}
          <Route path="products" element={<Products />} />
          <Route path="products/new" element={<ProductForm />} />
          <Route path="products/:id/edit" element={<ProductForm />} />
          
          {/* CategorÃ­as */}
          <Route path="categories" element={<Categories />} />
          <Route path="categories/new" element={<CategoryForm />} />
          <Route path="categories/:id/edit" element={<CategoryForm />} />
          
          {/* Usuarios */}
          <Route path="users" element={<Users />} />
          
          {/* Movimientos */}
          <Route path="stock-movements" element={<StockMovements />} />
          
          {/* Reportes */}
          <Route path="reports" element={<Reports />} />
        </Route>
        
        {/* Ruta por defecto */}
        <Route path="*" element={<Navigate to="/dashboard" replace />} />
      </Routes>
    </Router>
  );
}

export default App;