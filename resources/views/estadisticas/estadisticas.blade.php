@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 my-2 py-2 ">
                <div class="card my-1 py-1 shadow">
                    <div class="card-body  ">
                        <h3 class="text-center "><span class="border-bottom">Total de proyectos registrados:
                                {{ $total }}</span> </h3>
                        @foreach ($arreglo as $key => $valor)
                            <div class="row border-bottom my-2 py-2">
                                <h4 class="text-center">{{ $key }}</h4>
                                @foreach ($valor as $llave => $value)
                                    <div class="col-sm-12 col-md-6  my-2 py-2 text-center">
                                        <a href="{{ route('filtro', ['tipo' => \str_slug($key, '_'), 'valor' => $llave]) }}"
                                            class="btn border-bottom my-2 fs-6"> {{ $llave }} {{ $value }}
                                            /
                                            {{ $total }}</a>
                                        @php
                                            $progreso = ((int) $value * 100) / $total;
                                        @endphp
                                        <div class="progress " role="progressbar" aria-label="{{ $key }}"
                                            aria-valuenow="{{ $progreso }}" aria-valuemin="0"
                                            aria-valuemax="{{ $total }}">
                                            <div class="progress-bar bg-success" style="width: {{ $progreso }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="col-sm-12 text-center">
                            <a href="{{ route('filtro', ['tipo' => 'definitivo', 'valor' => '1']) }}"
                                class="btn border-bottom my-2 fs-5">Definitivo {{ $definitivo['total'] }} /
                                {{ $total }}</a>
                            <div class="progress" role="progressbar" aria-label="{{ $definitivo['total'] }}"
                                aria-valuenow="{{ $definitivo['progreso'] }}" aria-valuemin="0"
                                aria-valuemax="{{ $total }}">
                                <div class="progress-bar bg-success" style="width: {{ $definitivo['progreso'] }}%"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if (isset($evaluados))
                <div class="col-sm-12 my-2 py-2 shadow">
                    <div class="row">
                        <div class="card">
                            <h3 class="text-center my-4 py-1 border-bottom border-2">Proyectos evalaudos
                            </h3>
                            <span class="text-center">Aceptados: Proyectos nuevos | Aprobados: Proyectos continuacion | No
                                aceptados</span>

                            <div class="card-body row d-flex justify-content-center">
                                @foreach ($evaluados as $key => $value)
                                    <div class="col-sm-12 col-md-3 my-3">
                                        <div class="card h-100 w-100 mx-1">

                                            <div class="card-body row d-flex align-items-center">
                                                <div class="col-sm-12 col-md-9">
                                                    <p class="border-end my-auto">{{ $key }}</p>
                                                </div>
                                                <div class="col-sm-12 col-md-2 ">
                                                    <a class="btn border-bottom"
                                                        href="{{ route('resultadosEvaluaciones', $key) }}">{{ $value }}</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endif
            @if (isset($departamentos))
                <div class="col-sm-12 my-2 py-2 shadow   ">
                    <div class="row">
                        <div class="card">
                            <h3 class="text-center my-4 py-1 border-bottom border-2">Proyectos por Departamentos
                            </h3>
                            <div class="card-body row d-flex justify-content-center">
                                @foreach ($departamentos as $key => $value)
                                    <div class="col-sm-12 col-md-3 my-3">
                                        <div class="card h-100 w-100 mx-1">
                                            <div class="card-body row d-flex align-items-center">
                                                <div class="col-sm-12 col-md-9">
                                                    <p class="border-end   my-auto">{{ $key }}</p>
                                                </div>
                                                <div class="col-sm-12 col-md-2 ">
                                                    <a class=" btn border-bottom"
                                                        href="{{ route('filtro', ['tipo' => 'departamento', 'valor' => $key]) }}">{{ $value }}</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
