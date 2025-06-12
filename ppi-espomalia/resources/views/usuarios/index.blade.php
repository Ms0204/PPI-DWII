@extends('layouts.app')

@section('content')
<div class="main-content">
    <header>
        <h1>Gestión de Usuarios</h1>
        <form action="{{ route('usuarios.index') }}" method="GET">
            <input type="text" name="search" id="search" class="form-control" placeholder="Buscar usuarios...">
        </form>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">
            <i class="bi bi-person-plus-fill"></i> Agregar Usuario
        </a>
    </header>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->cedula }}</td>
                <td>{{ $usuario->usuario }}</td>
                <td>{{ $usuario->password }}</td>
                <td>{{ $usuario->nombres }}</td>
                <td>{{ $usuario->apellidos }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>{{ $usuario->direccion }}</td>
                <td>{{ $usuario->telefono }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Agregar Usuario -->
<div class="modal fade" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="agregarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="cedula" class="form-control mb-2" placeholder="Cédula" required>
                    <input type="text" name="usuario" class="form-control mb-2" placeholder="Usuario" required>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Contraseña" required>
                    <input type="text" name="nombres" class="form-control mb-2" placeholder="Nombres" required>
                    <input type="text" name="apellidos" class="form-control mb-2" placeholder="Apellidos" required>
                    <input type="email" name="correo" class="form-control mb-2" placeholder="Correo electrónico" required>
                    <input type="text" name="direccion" class="form-control mb-2" placeholder="Dirección" required>
                    <input type="text" name="telefono" class="form-control mb-2" placeholder="Teléfono" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
