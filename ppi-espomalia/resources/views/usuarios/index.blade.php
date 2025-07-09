<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Usuarios</title>
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
            <h1>Gestión de Usuarios</h1>
            <a href="{{ route('home') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-home me-2"></i> Inicio
            </a>
        </header>

        <main class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar Usuarios" />
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus"></i> Agregar Usuarios
                </button>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cédula</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $index => $usuario)
                        <tr>
                            <td>{{ $usuarios->firstItem() + $index }}</td>
                            <td>{{ $usuario->cedula }}</td>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->contrasenia }}</td>
                            <td>{{ $usuario->nombres }}</td>
                            <td>{{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>{{ $usuario->direccion }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm edit-btn"
                                    data-id="{{ $usuario->id }}"
                                    data-cedula="{{ $usuario->cedula }}"
                                    data-usuario="{{ $usuario->usuario }}"
                                    data-contrasenia="{{ $usuario->contrasenia }}"
                                    data-nombres="{{ $usuario->nombres }}"
                                    data-apellidos="{{ $usuario->apellidos }}"
                                    data-correo="{{ $usuario->correo }}"
                                    data-direccion="{{ $usuario->direccion }}"
                                    data-telefono="{{ $usuario->telefono }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar este usuario?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $usuarios->links() }}
            </div>
        </main>
    </div>

    <!-- Modal Agregar Usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('usuarios.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addCedula" class="form-label">Cédula</label>
                        <input type="text" name="cedula" id="addCedula" class="form-control" pattern="[0-9]{10}" 
                        minlength="10" maxlength="10" required title="La cédula debe contener exactamente 10 dígitos numéricos" />
                    </div>
                    <div class="mb-3">
                        <label for="addUsuario" class="form-label">Usuario</label>
                        <input type="text" name="usuario" id="addUsuario" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addContrasenia" class="form-label">Contraseña</label>
                        <input type="text" name="contrasenia" id="addContrasenia" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addNombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" id="addNombres" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addApellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" id="addApellidos" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addCorreo" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo" id="addCorreo" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addDireccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="addDireccion" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="addTelefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="addTelefono" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" required title="El teléfono debe contener exactamente 10 dígitos numéricos" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editUserForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId" />
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editCedula" class="form-label">Cédula</label>
                        <input type="text" name="cedula" id="editCedula" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" required title="La cédula debe contener exactamente 10 dígitos numéricos" />
                    </div>
                    <div class="mb-3">
                        <label for="editUsuario" class="form-label">Usuario</label>
                        <input type="text" name="usuario" id="editUsuario" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editContrasenia" class="form-label">Contraseña</label>
                        <input type="text" name="contrasenia" id="editContrasenia" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editNombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" id="editNombres" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editApellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" id="editApellidos" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editCorreo" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo" id="editCorreo" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editDireccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="editDireccion" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="editTelefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="editTelefono" class="form-control" pattern="[0-9]{10}" minlength="10" maxlength="10" required title="El teléfono debe contener exactamente 10 dígitos numéricos" />
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
        // Rellenar modal editar con los datos del usuario seleccionado
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const cedula = button.getAttribute('data-cedula');
                const usuario = button.getAttribute('data-usuario');
                const contrasenia = button.getAttribute('data-contrasenia');
                const nombres = button.getAttribute('data-nombres');
                const apellidos = button.getAttribute('data-apellidos');
                const correo = button.getAttribute('data-correo');
                const direccion = button.getAttribute('data-direccion');
                const telefono = button.getAttribute('data-telefono');

                document.getElementById('editId').value = id;
                document.getElementById('editCedula').value = cedula;
                document.getElementById('editUsuario').value = usuario;
                document.getElementById('editContrasenia').value = contrasenia;
                document.getElementById('editNombres').value = nombres;
                document.getElementById('editApellidos').value = apellidos;
                document.getElementById('editCorreo').value = correo;
                document.getElementById('editDireccion').value = direccion;
                document.getElementById('editTelefono').value = telefono;

                // Cambiar la acción del formulario para apuntar al update con el ID
                document.getElementById('editUserForm').action = `/usuarios/${id}`;
            });
        });
    </script>
</body>
</html>
