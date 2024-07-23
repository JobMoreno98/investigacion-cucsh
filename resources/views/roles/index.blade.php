@extends('adminlte::page')
@section('title', 'Roles')
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
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center">Administración de Roles</h2>
                </div>
                @if (session('message'))
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4>{{ session('message') }}</h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row justify-content-end">
                <div class="col-auto mb-1">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        {{ __('Nuevo Rol') }}
                    </a>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12">
                    <table id="myTable" class=" display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->descripcion }}</td>
                                    <td>
                                        <form method="GET" action="{{ route('roles.edit', $role->id) }}">
                                            <button type="submit" class="btn btn-info">
                                                {{ __('Editar') }}
                                            </button>
                                            <a href="{{ route('asignar_permisos', $role->id) }}"><button type="button"
                                                    class="btn btn-success">Relacionar Permisos</button> </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection
@section('js')
    @include('layouts.scripts')
    @include('sweetalert::alert')
@endsection
