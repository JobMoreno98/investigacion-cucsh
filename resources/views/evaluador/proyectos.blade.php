@extends('adminlte::page')
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
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    <span class="text-center">
                        {{ session('message') }}
                    </span>
                </div>
            @endif
            <div class="col-sm-12">
                <table class="table align-middle compact order-column " id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Folio</th>
                            <th class="text-center">Título</th>
                            <th class="text-center">Archvios</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $item)
                            <tr>
                                <td>{{ $item->proyecto->id }}</td>
                                <td>{{ $item->proyecto->ciclo->anio . '/' . $item->proyecto->folio }}</td>
                                <td>{{ $item->proyecto->titulo_proyecto }}</td>
                                <td class="text-center" style="width: 300px;">
                                    <a href="{{ route('local.temp', ['id' => $item->proyecto->id, 'tipo' => 'extenso']) }}"
                                        class=" btn btn-secondary btn-sm my-1" target="_blank">Proyecto</a>

                                    <a href="{{ route('local.temp', ['id' => $item->proyecto->id, 'tipo' => 'cronograma']) }}"
                                        class=" btn btn-primary btn-sm my-1" target="_blank">Cronograma</a>

                                    <a href="{{ route('local.temp', ['id' => $item->proyecto->id, 'tipo' => 'completo']) }}"
                                        class="btn  text-white btn-sm my-1" style="background:#9124a3;"target="_blank">Detalles</a>
                                </td>
                                <td style="width:150px;">
                                    @if (strcmp($item->dictamen, '-') == 0)
                                        <a href="{{ route('crear-evaluacion', $item->proyecto) }}"
                                            class="my-1 w-100 btn btn-sm btn-success">Evaluar</a>
                                    @else
                                        @if ($item->definitivo == 1)
                                            <p>La evaluación se envio como definitiva</p>
                                        @else
                                            <a href="{{ route('evaluaciones.edit', $item->id) }}"
                                                class=" my-1 w-100 btn btn-sm btn-primary">Ver evaluacion</a>
                                            <a href="{{ route('evaluacion.definitiva', $item->id) }}"
                                                class=" my-1 w-100 btn btn-sm btn-warning">Enviar definitivo</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('js')
    @include('layouts.scripts')
@endsection
