<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Inventarios</title>
    <!-- Fuente Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <!-- Estilos CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>
<body>
    <!-- Botón para abrir la barra lateral en móviles -->
    <button class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
    <!-- Barra lateral -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('Static/Img/marine_16484329.png') }}" alt="Logo del Sistema" />
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
            <li>
                <a href="{{ route('login') }}" class="btn-rojo" onclick="return confirmarCerrarSesion()">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Gestión de Inventarios</h1>
            <a href="{{ route('home') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-home me-2"></i> Inicio
            </a>
        </header>

        <main class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar Inventarios" />
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
                    <i class="fas fa-plus"></i> Agregar Inventario
                </button>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Tipo Movimiento</th>
                        <th>Fecha Registro</th>
                        <th>Cantidad Productos</th>
                        <th>Cédula Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventarios as $index => $inventario)
                        <tr>
                            <td>{{ $inventarios->firstItem() + $index }}</td>
                            <td>{{ $inventario->codigo }}</td>
                            <td>{{ $inventario->tipo_movimiento }}</td>
                            <td>{{ $inventario->fecha_registro }}</td>
                            <td>{{ $inventario->cantidad_productos }}</td>
                            <td>{{ $inventario->cedula_usuario }}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm edit-btn"
                                    data-id="{{ $inventario->id }}"
                                    data-codigo="{{ $inventario->codigo }}"
                                    data-tipo_movimiento="{{ $inventario->tipo_movimiento }}"
                                    data-fecha_registro="{{ $inventario->fecha_registro }}"
                                    data-cantidad_productos="{{ $inventario->cantidad_productos }}"
                                    data-cedula_usuario="{{ $inventario->cedula_usuario }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editInventoryModal"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('inventarios.destroy', $inventario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar este inventario?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay inventarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $inventarios->links() }}
            </div>
        </main>
    </div>

    <!-- Modal Agregar Inventario -->
    <div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('inventarios.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addInventoryModalLabel">Agregar Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addCodigo" class="form-label">Código</label>
                        <input type="text" name="codigo" id="addCodigo" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addTipoMovimiento" class="form-label">Tipo Movimiento</label>
                        <input type="text" name="tipoMovimiento" id="addTipoMovimiento" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addFechaRegistro" class="form-label">Fecha Registro</label>
                        <input type="date" name="fecha_registro" id="addFechaRegistro" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addCantidadProductos" class="form-label">Cantidad Productos</label>
                        <input type="number" name="cantidad_productos" id="addCantidadProductos" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addCedulaUsuario" class="form-label">Cédula Usuario</label>
                        <input type="text" name="cedula_usuario" id="addCedulaUsuario" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Inventario -->
    <div class="modal fade" id="editInventoryModal" tabindex="-1" aria-labelledby="editInventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editInventoryForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId" />
                <div class="modal-header">
                    <h5 class="modal-title" id="editInventoryModalLabel">Editar Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editCodigo" class="form-label">Código</label>
                        <input type="text" name="codigo" id="editCodigo" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editTipoMovimiento" class="form-label">Tipo Movimiento</label>
                        <input type="text" name="tipoMovimiento" id="editTipoMovimiento" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editFechaRegistro" class="form-label">Fecha Registro</label>
                        <input type="date" name="fecha_registro" id="editFechaRegistro" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editCantidadProductos" class="form-label">Cantidad Productos</label>
                        <input type="number" name="cantidad_productos" id="editCantidadProductos" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editCedulaUsuario" class="form-label">Cédula Usuario</label>
                        <input type="text" name="cedula_usuario" id="editCedulaUsuario" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const codigo = button.getAttribute('data-codigo');
                const tipo_movimiento = button.getAttribute('data-tipo_movimiento');
                const fecha_registro = button.getAttribute('data-fecha_registro');
                const cantidad_productos = button.getAttribute('data-cantidad_productos');
                const cedula_usuario = button.getAttribute('data-cedula_usuario');

                document.getElementById('editId').value = id;
                document.getElementById('editCodigo').value = codigo;
                document.getElementById('editTipoMovimiento').value = tipo_movimiento;
                document.getElementById('editFechaRegistro').value = fecha_registro;
                document.getElementById('editCantidadProductos').value = cantidad_productos;
                document.getElementById('editCedulaUsuario').value = cedula_usuario;

                document.getElementById('editInventoryForm').action = `/inventarios/${id}`;
            });
        });
    </script>
</body>
</html>
