<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Usuario</title>
  <!-- Fuente Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilo CSS -->
  <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>

<!-- Botón para abrir la barra lateral en móviles -->
<button class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>

<!-- Barra lateral -->
<div class="sidebar">
  <div class="logo">
    <img src="{{ asset('Static/Img/marine_16484329.png') }}" alt="Logo del Sistema">
  </div>
  <ul>
    <li><a href="{{ url('usuarios') }}">Gestión de Usuarios</a></li>
    <li><a href="{{ url('inventarios') }}">Gestión de Inventarios</a></li>
    <li><a href="{{ url('pagos') }}">Gestión de Pagos</a></li>
    <li><a href="{{ url('reportes') }}">Gestión de Reportes</a></li>
    <li><a href="{{ url('ingresos') }}">Gestión de Ingresos</a></li>
    <li><a href="{{ url('egresos') }}">Gestión de Egresos</a></li>
    <li><a href="{{ url('productos') }}">Gestión de Productos</a></li>
    <li><a href="{{ url('categorias') }}">Gestión de Categorías</a></li>
    <li><a href="{{ url('roles') }}">Gestión de Roles</a></li>
    <li><a href="{{ url('permisos') }}">Gestión de Permisos</a></li>
    <li><a href="{{ route('login') }}" class="btn-danger" onclick="return confirmarCerrarSesion()">
      <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a></li>
  </ul>
</div>

<!-- Contenido principal -->
<div class="main-content">
  <header>
    <h1>Registrar Usuario</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">
      <i class="fas fa-user-plus"></i> Nuevo Usuario
    </button>
  </header>

  <!-- Modal Crear Usuario -->
  <div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('usuarios.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="crearUsuarioModalLabel">Nuevo Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body row g-3 px-4">
            <div class="col-md-6">
              <label class="form-label">Cédula</label>
              <input type="text" name="cedula" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Usuario</label>
              <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input type="password" name="contrasena" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nombres</label>
              <input type="text" name="nombres" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Apellidos</label>
              <input type="text" name="apellidos" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo Electrónico</label>
              <input type="email" name="correo" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Dirección</label>
              <input type="text" name="direccion" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Teléfono</label>
              <input type="text" name="telefono" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/home.js') }}"></script>
</body>
</html>

