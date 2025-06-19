<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Egresos</title>
  <!-- Fuente Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- Fuente css -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Botón para abrir la barra lateral en móviles -->
    <button class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
    <!-- Barra lateral con menú de navegación -->
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
  <!-- Cabecera -->
  <header>
    <h1>Gestión de Egresos</h1>
                <a href="{{route('home')}}" class="btn btn-primary d-flex align-items-center">
      <i class="fas fa-home me-2"></i> Inicio </a>
  </header>
    <!-- Contenido Principal -->
  <main class="container">
    <!-- Barra de búsqueda y agregar reporte -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <input type="text" id="search" class="form-control" placeholder="Buscar Egresos" aria-label="Buscar Egresos">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fas fa-user-plus"></i> Agregar Egreso
      </button>
    </div>  
    <!-- Tabla de egreso -->
    <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Id</th>
            <th>Cantidad</th>
            <th>Fecha Egreso</th>
            <th>Id Producto</th>
            <th>Codigo Inventario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="userTableBody">
          <!-- Filas generadas dinámicamente -->
        </tbody>
      </table>
          <!-- Paginación -->
        <div class="d-flex justify-content-between align-items-center">
        <select id="itemsPerPage" class="form-select w-auto">
          <option value="5"selected>5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
        </select>
        <nav>
          <ul class="pagination" id="pagination">
          <!-- Paginación generada dinámicamente -->
          </ul>
        </nav>
      </div>
    </main>
            <!-- Modal Agregar egreso -->
          <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">Agregar Egreso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addUserForm">
              <div class="mb-3">
                <label for="addId" class="form-label">Id</label>
                <input type="text" class="form-control" id="addId" required>
              </div>
              <div class="mb-3">
                <label for="addCodigo" class="form-label">Cantidad</label>
                <input type="text" class="form-control" id="addCodigo" required>
              </div>
              <div class="mb-3">
                <label for="addFechaEgreso" class="form-label">Fecha Egreso</label>
                <input type="date" class="form-control" id="addFechaEgreso" required>
              </div>
              <div class="mb-3">
                <label for="addIdProducto" class="form-label">Id Producto</label>
                <input type="text" class="form-control" id="addIdProducto" required>
              </div>
              <div class="mb-3">
                <label for="addCodigoInventario" class="form-label">Código Inventario</label>
                <input type="text" class="form-control" id="addCodigoInventario" required>
              </div>
              <button type="submit" class="btn btn-success">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- Modal Editar Egreso -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Editar Egreso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editUserForm">
          <div class="mb-3">
            <label for="editId" class="form-label">Id</label>
            <input type="text" class="form-control" id="editId" required>
          </div>
          <div class="mb-3">
            <label for="editCantidad" class="form-label">Cantidad</label>
            <input type="text" class="form-control" id="editCantidad" required>
          </div>
          <div class="mb-3">
            <label for="editFechaEgreso" class="form-label">Fecha Egreso</label>
            <input type="date" class="form-control" id="editFechaEgreso" required>
          </div>
          <div class="mb-3">
            <label for="editIdProducto" class="form-label">Id Producto</label>
            <input type="text" class="form-control" id="editIdProducto" required>
          </div>
          <div class="mb-3">
            <label for="editCodigoInventario" class="form-label">Código Inventario</label>
            <input type="text" class="form-control" id="editCodigoInventario" required>
          </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- Modal Eliminar Egresos -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteUserModalLabel">Confirmar Eliminación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Estás seguro de que deseas eliminar este egreso?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
          <!-- Scripts -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
          <script src="./egresos.js"></script>
</body>
</html>