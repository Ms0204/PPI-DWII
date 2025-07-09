<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Ingresos</title>
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
            <h1>Gestión de Ingresos</h1>
            <a href="{{ route('home') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-home me-2"></i> Inicio
            </a>
        </header>

        <main class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar Ingresos" />
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addIngresoModal">
                    <i class="fas fa-plus"></i> Agregar Ingreso
                </button>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id</th>
                        <th>Cantidad</th>
                        <th>Fecha Ingreso</th>
                        <th>Id Producto</th>
                        <th>Código Inventario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ingresos as $index => $ingreso)
                        <tr>
                            <td>{{ $ingresos->firstItem() + $index }}</td>
                            <td>{{ $ingreso->id }}</td>
                            <td>{{ $ingreso->cantidad }}</td>
                            <td>{{ $ingreso->fecha_ingreso }}</td>
                            <td>{{ $ingreso->id_producto }}</td>
                            <td>{{ $ingreso->codigo_inventario }}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm edit-btn"
                                    data-id="{{ $ingreso->id }}"
                                    data-cantidad="{{ $ingreso->cantidad }}"
                                    data-fecha_ingreso="{{ $ingreso->fecha_ingreso }}"
                                    data-id_producto="{{ $ingreso->id_producto }}"
                                    data-codigo_inventario="{{ $ingreso->codigo_inventario }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editIngresoModal"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('ingresos.destroy', $ingreso->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar este ingreso?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay ingresos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $ingresos->links() }}
            </div>
        </main>
    </div>

    <!-- Modal Agregar Ingreso -->
    <div class="modal fade" id="addIngresoModal" tabindex="-1" aria-labelledby="addIngresoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('ingresos.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addIngresoModalLabel">Agregar Ingreso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                        <input type="date" name="fecha_ingreso" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Id Producto</label>
                        <input type="text" name="id_producto" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="codigo_inventario" class="form-label">Código Inventario</label>
                        <input type="text" name="codigo_inventario" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Ingreso -->
    <div class="modal fade" id="editIngresoModal" tabindex="-1" aria-labelledby="editIngresoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editIngresoForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId" />
                <div class="modal-header">
                    <h5 class="modal-title" id="editIngresoModalLabel">Editar Ingreso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editCantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="editCantidad" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editFechaIngreso" class="form-label">Fecha Ingreso</label>
                        <input type="date" name="fecha_ingreso" id="editFechaIngreso" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editIdProducto" class="form-label">Id Producto</label>
                        <input type="text" name="id_producto" id="editIdProducto" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editCodigoInventario" class="form-label">Código Inventario</label>
                        <input type="text" name="codigo_inventario" id="editCodigoInventario" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para pasar datos al modal de edición -->
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const cantidad = button.dataset.cantidad;
                const fecha = button.dataset.fecha_ingreso;
                const idProducto = button.dataset.id_producto;
                const codigo = button.dataset.codigo_inventario;

                document.getElementById('editId').value = id;
                document.getElementById('editCantidad').value = cantidad;
                document.getElementById('editFechaIngreso').value = fecha;
                document.getElementById('editIdProducto').value = idProducto;
                document.getElementById('editCodigoInventario').value = codigo;

                document.getElementById('editIngresoForm').action = `/ingresos/${id}`;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
