import React from 'react';

const Dashboard = () => {
  return (
    <div style={styles.dashboard}>
      <h1>Dashboard</h1>
      <p>Bienvenido al sistema de inventario</p>
      
      <div style={styles.grid}>
        <div style={styles.card}>
          <h3>Productos</h3>
          <p style={styles.number}>0</p>
        </div>
        <div style={styles.card}>
          <h3>CategorÃ­as</h3>
          <p style={styles.number}>0</p>
        </div>
        <div style={styles.card}>
          <h3>Usuarios</h3>
          <p style={styles.number}>0</p>
        </div>
      </div>
    </div>
  );
};

const styles = {
  dashboard: {
    padding: '20px'
  },
  grid: {
    display: 'grid',
    gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))',
    gap: '20px',
    marginTop: '20px'
  },
  card: {
    background: 'white',
    padding: '20px',
    borderRadius: '10px',
    boxShadow: '0 2px 5px rgba(0,0,0,0.1)',
    textAlign: 'center'
  },
  number: {
    fontSize: '2rem',
    fontWeight: 'bold',
    margin: '10px 0',
    color: '#333'
  }
};

export default Dashboard;