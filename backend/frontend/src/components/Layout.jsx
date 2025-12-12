import React from 'react';
import { Outlet, Link, useNavigate } from 'react-router-dom';
import { authService } from '../services/api';

const Layout = () => {
  const navigate = useNavigate();
  const user = authService.getCurrentUser();

  const handleLogout = () => {
    authService.logout();
    navigate('/login');
  };

  return (
    <div className="app-layout">
      <header className="header">
        <div className="container">
          <div className="header-content">
            <div className="logo">
              <h1>ðŸ“¦ Inventory Pro</h1>
              <span className="user-role">Rol: {user?.role?.name || 'Usuario'}</span>
            </div>
            <div className="user-info">
              <span className="user-name">ðŸ‘¤ {user?.name}</span>
              <button onClick={handleLogout} className="btn-logout">
                Cerrar SesiÃ³n
              </button>
            </div>
          </div>
        </div>
      </header>

      <div className="main-container">
        <aside className="sidebar">
          <nav className="nav-menu">
            <ul>
              <li>
                <Link to="/dashboard" className="nav-link">
                  ðŸ“Š Dashboard
                </Link>
              </li>
              <li>
                <Link to="/products" className="nav-link">
                  ðŸ·ï¸ Productos
                </Link>
              </li>
              <li>
                <Link to="/categories" className="nav-link">
                  ðŸ“‚ CategorÃ­as
                </Link>
              </li>
              <li>
                <Link to="/stock-movements" className="nav-link">
                  ðŸ“ˆ Movimientos
                </Link>
              </li>
              <li>
                <Link to="/users" className="nav-link">
                  ðŸ‘¥ Usuarios
                </Link>
              </li>
              <li>
                <Link to="/reports" className="nav-link">
                  ðŸ“Š Reportes
                </Link>
              </li>
            </ul>
            
            <div className="sidebar-footer">
              <div className="system-status">
                <div className="status-indicator active"></div>
                <span>Sistema en lÃ­nea</span>
              </div>
            </div>
          </nav>
        </aside>

        <main className="main-content">
          <div className="container">
            <Outlet />
          </div>
        </main>
      </div>
    </div>
  );
};

export default Layout;