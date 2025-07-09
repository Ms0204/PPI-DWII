<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Egresos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
            <h1>Gestión de Egresos</h1>
            <a href="{{route('home')}}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-home me-2"></i> Inicio
            </a>
        </header>
        <main class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar Egresos" aria-label="Buscar Egresos">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEgresoModal">
                    <i class="fas fa-user-plus"></i> Agregar Egreso
                </button>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id</th>
                        <th>Cantidad</th>
                        <th>Fecha Egreso</th>
                        <th>Id Producto</th>
                        <th>Código Inventario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($egresos as $index => $egreso)
                        <tr>
                            <td>{{ $egresos->firstItem() + $index }}</td>
                            <td>{{ $egreso->id }}</td>
                            <td>{{ $egreso->cantidad }}</td>
                            <td>{{ $egreso->fechaEgreso }}</td>
                            <td>{{ $egreso->idProducto }}</td>
                            <td>{{ $egreso->codigoInventario }}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm edit-btn"
                                    data-id="{{ $egreso->id }}"
                                    data-cantidad="{{ $egreso->cantidad }}"
                                    data-fechaegreso="{{ $egreso->fechaEgreso }}"
                                    data-idproducto="{{ $egreso->idProducto }}"
                                    data-codigoinventario="{{ $egreso->codigoInventario }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editEgresoModal"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('egresos.destroy', $egreso->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar este egreso?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay egresos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $egresos->links() }}
            </div>
        </main>
    </div>
    <!-- Modal Agregar Egreso -->
    <div class="modal fade" id="addEgresoModal" tabindex="-1" aria-labelledby="addEgresoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('egresos.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEgresoModalLabel">Agregar Egreso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="number" name="id" id="id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaEgreso" class="form-label">Fecha Egreso</label>
                        <input type="date" name="fechaEgreso" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="idProducto" class="form-label">Id Producto</label>
                        <input type="text" name="idProducto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigoInventario" class="form-label">Código Inventario</label>
                        <input type="text" name="codigoInventario" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Editar Egreso -->
    <div class="modal fade" id="editEgresoModal" tabindex="-1" aria-labelledby="editEgresoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editEgresoForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEgresoModalLabel">Editar Egreso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editCantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="editCantidad" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editFechaEgreso" class="form-label">Fecha Egreso</label>
                        <input type="date" name="fechaEgreso" id="editFechaEgreso" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editIdProducto" class="form-label">Id Producto</label>
                        <input type="text" name="idProducto" id="editIdProducto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCodigoInventario" class="form-label">Código Inventario</label>
                        <input type="text" name="codigoInventario" id="editCodigoInventario" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const cantidad = button.dataset.cantidad;
                const fecha = button.dataset.fechaegreso;
                const idProducto = button.dataset.idproducto;
                const codigo = button.dataset.codigoinventario;

                document.getElementById('editId').value = id;
                document.getElementById('editCantidad').value = cantidad;
                document.getElementById('editFechaEgreso').value = fecha;
                document.getElementById('editIdProducto').value = idProducto;
                document.getElementById('editCodigoInventario').value = codigo;

                document.getElementById('editEgresoForm').action = `/egresos/${id}`;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>