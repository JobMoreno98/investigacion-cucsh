@extends('adminlte::page')
@section('title', 'Asignar proyecto')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">{{ __('Loading') }}</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card w-100  shadow-sm">
                    <div class="card-body">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="flush-headingOne">
                                    <button class="accordion-button collapsed text-center" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Ver informacion del proyecto
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    @include('evaluaciones.informacion')
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center my-2">Lista de evaluadores</h4>
                        <hr>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>División</th>
                                    <th>Departamento</th>
                                    <th>Asignar</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($evalaudores as $key => $item)
                                    <tr>

                                        <td>{{ $item->name }} </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ isset($item->division) ? $item->division : 'Dato no capturado' }}</td>
                                        <td>{{ isset($item->departamento) ? $item->departamento : 'Dato no capturado' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('asignar_evaluador', [$proyecto, $item->id]) }}">
                                                Asignar este evalaudor
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('layouts.scripts')
    <script>
        function asignar() {
            document.getElementById('form-asignar').submit();
        }
    </script>
@endsection
