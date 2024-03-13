@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <h3>Datos del proyecto</h3>
                <p><b>Folio:</b> {{ $proyecto->folio }}</p>
                <p><b> Responsable:</b> {{ $proyecto->user->name }}
                    @if (isset($proyecto->avances) && strcmp($proyecto->avances, 'No aplica') != 0)
                        <a target="_blank" class="btn border-2 border-start mx-2 px-2"
                            href="{{ url('/storage/continuacion/' . $proyecto->avances) }}">Informe de avances del
                            proyecto</a>
                    @else
                        <span class="btn border-2 border-start mx-2 px-2 ">No subio documento</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('evaluaciones.update', $evaluacion->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <h3>Evaluación</h3>
                    <input type="text" class="d-none" value="{{ $evaluacion->proyectos_id }}" name="id_proyecto">
                    <div class="col-md-12 row my-3 ">
                        <div class="col-sm-6">
                            <label class="form-label">¿Cuenta con su informe de avance de investigación?</label>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="avance" id="avance">
                                @if (isset($evaluacion->avance))
                                    <option value="{{ $evaluacion->avance }}">{{ $evaluacion->avance }}</option>
                                @endif
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 row my-3 ">
                        <div class="col-sm-6">
                            <label class="form-label">¿El informe de avances de resultados del proyecto de investigación
                                cuenta con el aval de su Colegio Departamental?</label>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="informe" id="informe">
                                @if (isset($evaluacion->informe))
                                    <option value="{{ $evaluacion->informe }}">{{ $evaluacion->informe }}</option>
                                @endif
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 row my-3 ">
                        <div class="col-sm-6">
                            <label class="form-label">¿Solicita recursos económicos?</label>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="recursos[]" id="recursos">
                                @if (isset($evaluacion->recursos))
                                    <option value="{{ $evaluacion->recursos }}">{{ $evaluacion->recursos }}</option>
                                @endif
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    @include('proyectos.form-continuacion')

                    <div class="col-md-12 row my-3 ">
                        <div class="col-sm-12 col-md-1">
                            <label class="form-label">Dictamen</label>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <select class="form-control" name="dictamen" id="dictamen">
                                <option value="Aprobado">Aprobado</option>
                                <option value="Aprobado con financiamiento">Aprobado con financiamiento</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <button type="submit" class="btn btn-success">Guardar evaluación</button>
            </div>

            </form>
        </div>
    </div>
@endsection
