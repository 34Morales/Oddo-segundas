import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    try {
      // Simular login
      await new Promise(resolve => setTimeout(resolve, 1000));
      
      if (email === 'admin@example.com' && password === 'password') {
        localStorage.setItem('token', 'fake-jwt-token');
        navigate('/dashboard');
      } else {
        setError('Credenciales incorrectas');
      }
    } catch (err) {
      setError('Error al iniciar sesiÃ³n');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={styles.container}>
      <div style={styles.box}>
        <h2> Iniciar Sesión</h2>
        
        {error && <div style={styles.error}>{error}</div>}
        
        <form onSubmit={handleSubmit} style={styles.form}>
          <div style={styles.formGroup}>
            <label>Email</label>
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
              placeholder="admin@example.com"
              style={styles.input}
            />
          </div>
          
          <div style={styles.formGroup}>
            <label>Contraseña</label>
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
              placeholder="password"
              style={styles.input}
            />
          </div>
          
          <button 
            type="submit" 
            style={styles.button}
            disabled={loading}
          >
            {loading ? 'Iniciando sesiÃ³n...' : 'Ingresar'}
          </button>
        </form>
        
        <div style={styles.info}>
          <h4>Credenciales de prueba:</h4>
          <ul>
            <li><strong>Admin:</strong> admin@example.com / password</li>
          </ul>
        </div>
      </div>
    </div>
  );
};

const styles = {
  container: {
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
    minHeight: '100vh',
    backgroundColor: '#f5f7fa'
  },
  box: {
    background: 'white',
    padding: '40px',
    borderRadius: '10px',
    boxShadow: '0 2px 10px rgba(0,0,0,0.1)',
    width: '100%',
    maxWidth: '400px'
  },
  form: {
    marginTop: '20px'
  },
  formGroup: {
    marginBottom: '20px'
  },
  input: {
    width: '100%',
    padding: '10px',
    border: '1px solid #ddd',
    borderRadius: '5px',
    fontSize: '16px',
    marginTop: '5px'
  },
  button: {
    background: '#4CAF50',
    color: 'white',
    border: 'none',
    padding: '12px 20px',
    borderRadius: '5px',
    cursor: 'pointer',
    fontSize: '16px',
    width: '100%'
  },
  error: {
    background: '#f8d7da',
    color: '#721c24',
    padding: '10px',
    borderRadius: '5px',
    marginBottom: '20px'
  },
  info: {
    marginTop: '20px',
    padding: '15px',
    background: '#e8f5e9',
    borderRadius: '5px',
    fontSize: '14px'
  }
};

export default Login;