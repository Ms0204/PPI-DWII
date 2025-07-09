<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Pagos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
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
            <h1>Gestión de Pagos</h1>
            <a href="{{ route('home') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-home me-2"></i> Inicio
            </a>
        </header>

        <main class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar Pagos" />
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPagoModal">
                    <i class="fas fa-user-plus"></i> Agregar Pagos
                </button>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Número Pago</th>
                        <th>Método</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Cédula Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pagos as $index => $pago)
                        <tr>
                            <td>{{ $pagos->firstItem() + $index }}</td>
                            <td>{{ $pago->id }}</td>
                            <td>{{ $pago->numeroPago }}</td>
                            <td>{{ $pago->metodoPago }}</td>
                            <td>{{ $pago->cantidad }}</td>
                            <td>{{ $pago->fechaPago }}</td>
                            <td>{{ $pago->cedulaUsuario }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm edit-btn"
                                    data-id="{{ $pago->id }}"
                                    data-numeropago="{{ $pago->numeroPago }}"
                                    data-metodopago="{{ $pago->metodoPago }}"
                                    data-cantidad="{{ $pago->cantidad }}"
                                    data-fechapago="{{ $pago->fechaPago }}"
                                    data-cedulausuario="{{ $pago->cedulaUsuario }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPagoModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar este pago?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay pagos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $pagos->links() }}
            </div>
        </main>
    </div>

    <!-- Modal Agregar Pago -->
    <div class="modal fade" id="addPagoModal" tabindex="-1" aria-labelledby="addPagoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('pagos.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPagoModalLabel">Agregar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" name="id" id="id" class="form-control" required />
                </div>
                    <div class="mb-3">
                        <label for="numeroPago" class="form-label">Número Pago</label>
                        <input type="text" name="numeroPago" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="metodoPago" class="form-label">Método de Pago</label>
                        <input type="text" name="metodoPago" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="fechaPago" class="form-label">Fecha de Pago</label>
                        <input type="date" name="fechaPago" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="cedulaUsuario" class="form-label">Cédula Usuario</label>
                        <input type="text" name="cedulaUsuario" class="form-control" pattern="[0-9]{10}" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Pago -->
    <div class="modal fade" id="editPagoModal" tabindex="-1" aria-labelledby="editPagoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" class="modal-content" id="editPagoForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPagoModalLabel">Editar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="editId" class="form-label">ID</label>
                    <input type="number" name="id" id="editId" class="form-control" required />
                </div>
                    <div class="mb-3">
                        <label for="editNumeroPago" class="form-label">Número Pago</label>
                        <input type="text" name="numeroPago" id="editNumeroPago" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editMetodoPago" class="form-label">Método de Pago</label>
                        <input type="text" name="metodoPago" id="editMetodoPago" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editCantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="editCantidad" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editFechaPago" class="form-label">Fecha de Pago</label>
                        <input type="date" name="fechaPago" id="editFechaPago" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editCedulaUsuario" class="form-label">Cédula Usuario</label>
                        <input type="text" name="cedulaUsuario" id="editCedulaUsuario" class="form-control" pattern="[0-9]{10}" required />
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
                const id = button.dataset.id;
                document.getElementById('editPagoForm').action = `/pagos/${id}`;
                document.getElementById('editId').value = id;
                document.getElementById('editNumeroPago').value = button.dataset.numeropago;
                document.getElementById('editMetodoPago').value = button.dataset.metodopago;
                document.getElementById('editCantidad').value = button.dataset.cantidad;
                document.getElementById('editFechaPago').value = button.dataset.fechapago;
                document.getElementById('editCedulaUsuario').value = button.dataset.cedulausuario;
            });
        });
    </script>
</body>
</html>