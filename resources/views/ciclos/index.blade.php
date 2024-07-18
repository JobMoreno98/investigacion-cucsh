@extends('adminlte::page')
@section('title', 'Ciclos')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        Debe de llenar los campos marcados con un asterisco (*).
                    </div>
                @endif
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Capturar nuevo ciclo
                </button>

            </div>
            <div class="col-sm-12 mt-5">
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Fin</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($ciclos as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->anio }}</td>
                                    <td>{{ $item->fecha_inicio }}</td>
                                    <td>{{ $item->fecha_fin }}</td>
                                    <td>
                                        @if ($item->activo == 1)
                                            <span class="pe-3 me-3 border-end border-dark">
                                                <a href="{{ route('cerrar-ciclo', $item->id) }}"
                                                    class="btn btn-outline-danger ">Cerrar</a>
                                            </span>
                                            <button onclick="editar({{ $item }})" type="button"
                                                class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Editar
                                            </button>
                                        @else
                                            <span>Ciclo cerrado</span>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar nuevo ciclo de proyectos de investigación
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div {{ isset($ciclo->id) ? 'style=display:none' : '' }} id="bloque-formulario">
                        <form method="POST" id="formulario">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-8">
                                    <label for="" class="form-label text-center">Año *</label>
                                    <input type="text" class="form-control" name="anio" id="anio">
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-8 mx-auto">
                                    <label for="" class="form-label text-center">Fecha de inicio *</label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <label for="" class="form-label text-center">Fecha de fin *</label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                                </div>
                            </div>


                            @if (isset($ciclo->id))
                                <div class="row justify-content-center mt-2" id="actualizar">
                                    <div class="col-sm-12 col-md-3">
                                        <a onclick="actualizar({{ isset($ciclo->id) ? $ciclo->id : '' }})"
                                            class="btn btn-success">Actualizar</a>
                                    </div>
                                </div>
                            @else
                                <div class="row justify-content-center mt-2" id="guardar">
                                    <div class="col-sm-12 col-md-3">
                                        <a onclick="guardar()" class="btn btn-success">Guardar</a>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                    <div {{ !isset($ciclo->id) ? 'style=display:none' : '' }} id="bloque-activo">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-6">
                                <div class="alert alert-success text-center">
                                    <h2 class="text-center">Ya tiene un ciclo activo</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });

        function editar(item) {
            document.getElementById('anio').value = item.anio;
            document.getElementById('fecha_inicio').value = item.fecha_inicio;
            document.getElementById('fecha_fin').value = item.fecha_fin;

            document.getElementById('bloque-activo').style.display = 'none';

            document.getElementById('bloque-formulario').style.display = 'block';


        }

        function guardar() {
            $.ajax({
                url: "{{ route('ciclos.store') }}",
                method: 'POST',
                data: $('#formulario').serialize()
            }).done(function() {
                location.reload();
            });
        }


        function actualizar(element) {
            id = element;
            var url = "{{ route('ciclos.update', ':id') }}";
            url = url.replace(':id', id);
            console.log(url)
            $.ajax({
                url: url,
                method: 'PUT',
                data: $('#formulario').serialize()
            }).done(function() {
                inicio = "{{ route('home') }}",
                    window.location.href = inicio;
            });;
        }
    </script>
@endsection
