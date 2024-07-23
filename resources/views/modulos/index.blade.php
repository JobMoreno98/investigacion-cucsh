@extends('adminlte::page')
@section('title', 'Modulos')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row mt-3">
                <h2 class="text-center">Modulos</h2>
            </div>
            <div class=" my-2">
                <form action="{{ route('modulos.store') }}" class="d-flex align-items-center" method="post">
                    @csrf
                    <div class="mx-1">
                        <input type="text" placeholder="Nombre" name="nombre" class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="text" placeholder="Nombre permiso" name="permiso" class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="text" placeholder="Icono" name="icono" class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="number" placeholder="Orden de ubicación" name="orden" class="form-control">
                    </div>

                    <div class="mx-1">
                        <input type="color" placeholder="Color" name="color" value="#563d7c"
                            class="form-control form-control-color">
                    </div>
                    <div class="mx-1">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12">
                    <table id="myTable" class="display table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Color</th>
                                <th>Icon</th>
                                <th>Orden</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modulos as $item => $value)
                                <tr>
                                    <td>{{ $value->nombre }}</td>
                                    <td>{{ $value->color }}</td>
                                    <td>{{ $value->icono }}</td>
                                    <td>{{ $value->orden }}</td>
                                    <td><a href="{{ route('modulos.edit', $value->id) }}"
                                            class="btn btn-sm btn-primary">editar</a>

                                        <a href="{{ route('modulos.destroy', $value) }}"
                                            class="btn btn-sm btn-primary">eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @else
            No tienes permisos para acceder a este apartado
        @endif
    </div>
@endsection

@section('js')
    @include('layouts.scripts')
@endsection

@section('footer')
    <h6 class="text-end">Favor de reportar cualquier falla</h6>
@endsection
