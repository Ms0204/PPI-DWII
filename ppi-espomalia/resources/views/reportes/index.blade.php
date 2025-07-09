<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Reportes</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
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
      <li><a href="{{ route('login') }}" class="btn-rojo" onclick="return confirmarCerrarSesion()">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
      </a></li>
    </ul>
  </div>

  <div class="main-content">
    <header>
      <h1>Gestión de Reportes</h1>
      <a href="{{ route('home') }}" class="btn btn-primary d-flex align-items-center">
        <i class="fas fa-home me-2"></i> Inicio
      </a>
    </header>

    <main class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <form action="{{ route('reportes.index') }}" method="GET" class="d-flex w-100 me-3">
          <input type="text" name="search" class="form-control" placeholder="Buscar Reportes">
        </form>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
          <i class="fas fa-plus"></i> Agregar Reporte
        </button>
      </div>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha Emisión</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reportes as $index => $reporte)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $reporte->id }}</td>
            <td>{{ $reporte->titulo }}</td>
            <td>{{ $reporte->descripcion }}</td>
            <td>{{ $reporte->fecha_emision }}</td>
            <td>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $reporte->id }}"><i class="fas fa-edit"></i></button>
              <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Eliminar reporte?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
              </form>
            </td>
          </tr>

          <!-- Modal Editar -->
          <div class="modal fade" id="editModal{{ $reporte->id }}" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="{{ route('reportes.update', $reporte->id) }}" method="POST">
                  @csrf @method('PUT')
                  <div class="modal-header">
                    <h5 class="modal-title">Editar Reporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label>Título</label>
                      <input type="text" name="titulo" class="form-control" value="{{ $reporte->titulo }}" required>
                    </div>
                    <div class="mb-3">
                      <label>Descripción</label>
                      <input type="text" name="descripcion" class="form-control" value="{{ $reporte->descripcion }}" required>
                    </div>
                    <div class="mb-3">
                      <label>Fecha Emisión</label>
                      <input type="date" name="fecha_emision" class="form-control" value="{{ $reporte->fecha_emision }}" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>

      {{ $reportes->links() }}
    </main>
  </div>

  <!-- Modal Agregar -->
  <div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('reportes.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Agregar Reporte</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Título</label>
              <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Descripción</label>
              <input type="text" name="descripcion" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Fecha Emisión</label>
              <input type="date" name="fecha_emision" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
