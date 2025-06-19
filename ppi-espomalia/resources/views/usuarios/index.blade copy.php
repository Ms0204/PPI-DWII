<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Gestión</title>
  <!-- Fuente Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- Estilo CSS local (coloca styles.css en public/css) -->
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
  <!-- Botón para abrir la barra lateral en móviles -->
  <button class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>

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

  <div class="main-content">
    <header>
      <h1>Gestión de Usuarios</h1>
    </header>

    <main class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" id="search" class="form-control" placeholder="Buscar Usuarios">
        <a href="{{ route('usuarios.store') }}" class="btn btn-success">
          <i class="fas fa-user-plus"></i> Agregar Usuario
        </a>
      </div>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Cédula</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Nombres</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($usuarios as $index => $usuario)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $usuario->cedula }}</td>
            <td>{{ $usuario->usuario }}</td>
            <td>{{ $usuario->contraseña }}</td>
            <td>{{ $usuario->nombres }}</td>
            <td>{{ $usuario->correo }}</td>
            <td>{{ $usuario->direccion }}</td>
            <td>{{ $usuario->telefono }}</td>
            <td>
              <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar este usuario?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center">No hay usuarios registrados.</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <div class="d-flex justify-content-center mt-4">
        {{ $usuarios->links() }}
      </div>
    </main>
  </div>

  <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
