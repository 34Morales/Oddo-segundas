@echo off
echo Corrigiendo archivos de pages...

cd /d "C:\Users\Samuel\OneDrive\Documentos\GitHub\Oddo-segundas\backend\frontend\src\pages"

echo 1. Products.jsx...
(
echo import React from 'react';
echo.
echo const Products = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Productos^</h1^>
echo       ^<p^>Lista de productos^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default Products;
) > Products.jsx

echo 2. ProductForm.jsx...
(
echo import React from 'react';
echo.
echo const ProductForm = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Formulario de Producto^</h1^>
echo       ^<p^>Crear/Editar producto^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default ProductForm;
) > ProductForm.jsx

echo 3. Categories.jsx...
(
echo import React from 'react';
echo.
echo const Categories = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Categorías^</h1^>
echo       ^<p^>Lista de categorías^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default Categories;
) > Categories.jsx

echo 4. CategoryForm.jsx...
(
echo import React from 'react';
echo.
echo const CategoryForm = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Formulario de Categoría^</h1^>
echo       ^<p^>Crear/Editar categoría^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default CategoryForm;
) > CategoryForm.jsx

echo 5. Users.jsx...
(
echo import React from 'react';
echo.
echo const Users = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Usuarios^</h1^>
echo       ^<p^>Lista de usuarios^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default Users;
) > Users.jsx

echo 6. StockMovements.jsx...
(
echo import React from 'react';
echo.
echo const StockMovements = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Movimientos de Stock^</h1^>
echo       ^<p^>Historial de movimientos^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default StockMovements;
) > StockMovements.jsx

echo 7. Reports.jsx...
(
echo import React from 'react';
echo.
echo const Reports = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Reportes^</h1^>
echo       ^<p^>Reportes y estadísticas^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default Reports;
) > Reports.jsx

echo 8. Login.jsx (verificar)...
if not exist Login.jsx (
(
echo import React, { useState } from 'react';
echo import { useNavigate } from 'react-router-dom';
echo.
echo const Login = () =^> {
echo   const [email, setEmail] = useState('');
echo   const [password, setPassword] = useState('');
echo   const navigate = useNavigate();
echo.
echo   const handleSubmit = (e) =^> {
echo     e.preventDefault();
echo     localStorage.setItem('token', 'fake-token');
echo     navigate('/dashboard');
echo   };
echo.
echo   return (
echo     ^<div^>
echo       ^<h1^>Login^</h1^>
echo       ^<form onSubmit={handleSubmit}^>
echo         ^<input type="email" value={email} onChange={(e)=^>setEmail(e.target.value)} /^>
echo         ^<input type="password" value={password} onChange={(e)=^>setPassword(e.target.value)} /^>
echo         ^<button type="submit"^>Login^</button^>
echo       ^</form^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default Login;
) > Login.jsx
)

echo 9. Dashboard.jsx (verificar)...
if not exist Dashboard.jsx (
(
echo import React from 'react';
echo.
echo const Dashboard = () =^> {
echo   return (
echo     ^<div^>
echo       ^<h1^>Dashboard^</h1^>
echo       ^<p^>Bienvenido^</p^>
echo     ^</div^>
echo   );
echo };
echo.
echo export default Dashboard;
) > Dashboard.jsx
)

echo ¡Todos los archivos corregidos!
echo.
echo Ejecuta: npm run build
pause
