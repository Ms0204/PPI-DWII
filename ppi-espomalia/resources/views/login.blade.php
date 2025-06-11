<?php
// Procesamiento en PHP para redirigir al home después de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['contraseña'])) {
  $usuario = $_POST['usuario'];
  $contraseña = $_POST['contraseña'];

  // Aquí puedes validar contra una base de datos
  // Este ejemplo redirige directamente al home
  header('Location: ./Paginas/PgHome/home.html');
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión</title>
  <!-- Incluir Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Incluir Font Awesome para los íconos -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Incluir Google Fonts (Poppins) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
      overflow: hidden;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.85);
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 310px;
      padding: 50px;
      opacity: 0;
      transform: translateY(50px);
      animation: fadeInUp 0.8s forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-container img {
      max-width: 150px;
      margin-bottom: 20px;
      animation: slideIn 1s ease-out;
    }

    @keyframes slideIn {
      0% {
        transform: translateX(-100%);
      }
      100% {
        transform: translateX(0);
      }
    }

    .form-control {
      border-radius: 10px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
      border-color: #000000; 
      box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
    }

    .btn-danger {
      background-color: #004d80; 
      color: rgb(255, 255, 255);
      border-radius: 10px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-danger:hover {
      background-color: #004d80; 
      transform: translateY(-2px);
    }

    .footer a {
      color: #050505; 
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer a:hover {
      text-decoration: underline;
      color: #5871a4; 
    }

    .modal-content {
      border-radius: 15px;
      animation: fadeInModal 0.5s ease-out;
    }

    @keyframes fadeInModal {
      0% {
        transform: translateY(-50%);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .modal-header {
      background-color: #004d80; 
      color: rgb(255, 255, 255);
      border-radius: 15px 15px 0 0;
    }

    .modal-footer button {
      background-color: #42a42f; 
      color: rgb(0, 0, 0);
      border-radius: 10px;
      transition: background-color 0.3s ease;
    }

    .modal-footer button:hover {
      background-color: #000000; 
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-container p-4 shadow rounded-3">
      <!-- Logo de la empresa arriba -->
      <div class="text-center mb-4">
        <img src="./Static/Img/marine_16484329.png" alt="Logo ESPOMALIA" class="img-fluid">
      </div>
      <h2 class="text-center mb-4">
        Iniciar Sesión
      </h2>
      <form id="loginForm" action="index.php" method="POST">
        <div class="mb-3">
          <input type="email" name="usuario" class="form-control" placeholder="Correo Electronico" required>
        </div>
        <div class="mb-3 position-relative">
          <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="Contraseña" required>
          <span id="toggle-password" class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor: pointer;">
            <i class="fas fa-eye-slash"></i>
          </span>
        </div>
        <button type="submit" class="btn btn-danger w-100">Iniciar sesión</button>
      </form>
      <div class="footer text-center mt-3">
        <p><a href="#" data-bs-toggle="modal" data-bs-target="#recoverPasswordModal">¿Olvidaste tu contraseña?</a></p>
      </div>
    </div>
  </div>

  <!-- Modal de recuperación de contraseña -->
  <div class="modal fade" id="recoverPasswordModal" tabindex="-1" aria-labelledby="recoverPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="recoverPasswordModalLabel">Recuperar Contraseña</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form action="#" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Ingresa tu correo" required>
            </div>
            <button type="submit" class="btn btn-danger w-100">Recuperar contraseña</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Script para mostrar/ocultar la contraseña -->

<script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordField = document.getElementById('contraseña');

    togglePassword.addEventListener('click', function() {
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;

      this.innerHTML = type === 'password'
        ? '<i class="fas fa-eye-slash"></i>'
        : '<i class="fas fa-eye"></i>';
    });
  </script>
</body>
</html>
