@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    Debe de llenar los campos marcados con un asterisco (*).
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="col-sm-12 col-md-10">
                <h3 class="text-center my-1 py-1 border-bottom border-2">FORMATO DE EVALUACIÓN</h3>
                <h3 class="text-center">Folio: {{ $proyecto->folio }} <br> Titulo:{{ $proyecto->titulo_proyecto }}</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5>La exposición de motivos hasta 400 caracteres. <br /><b>IMPORTANTE</b> USAR CHROME (GOOGLE) O
                        FIREFOX PARA LLENAR ESTE FORMATO.</h5>
                    <h5><b>Favor de indicar si cumple o no cumple las siguientes condiciones:</b></h5>
                </div>
            </div>
            <form action="{{ route('evaluaciones.store') }}" class="row" method="POST">
                @method('POST')
                @csrf
                <input type="text" name="id_proyecto" value="{{ $proyecto->id }}" class="d-none">
                <!-- Pregunta #1 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>a. Queda explicito en el proyecto presentado la importancia de la investigación en la
                                generación
                                de conocimiento y/o incidencia *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <select class="form-control" name="p_01[]" id="">
                            <option disabled selected>Elige una opción</option>
                            <option {{ strcmp(old('p_01.0'), 'Cumple') == 0 ? 'selected' : '' }} value="Cumple">Cumple
                            </option>
                            <option {{ strcmp(old('p_01.0'), 'No cumple') == 0 ? 'selected' : '' }} value="No cumple">No
                                cumple
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_01[]" id="">{{ old('p_01.1') ? old('p_01.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #2 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label" for="p_02">
                            <h5>b. La propuesta de investigación es un problema novedoso y relevante *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <select class="form-control" name="p_02[]" id="">
                            <option disabled selected>Elige una opción</option>
                            <option {{ strcmp(old('p_02.0'), 'Cumple') == 0 ? 'selected' : '' }} value="Cumple">Cumple
                            </option>
                            <option {{ strcmp(old('p_02.0'), 'No cumple') == 0 ? 'selected' : '' }} value="No cumple">No
                                cumple</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_02[]" id="p_02">{{ old('p_02.1') ? old('p_02.1') : '' }}</textarea>
                    </div>
                </div>

                <span class="py-4 my-4">
                    <hr>
                </span>

                <h4 class="text-center pt-0">La calificación numérica será de 0 a 10. La exposición de motivos hasta 600
                    caracteres</h4>
                <!-- Pregunta #3 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>1.- El título del proyecto es claro y es coherente con el planteamiento de la investigación
                                propuesta. *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number" onchange="suma()"
                            value="{{ old('p_03.0') ? old('p_03.0') : '0' }}" name="p_03[]" id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_03[]" id="">{{ old('p_03.1') ? old('p_03.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #4 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>2.- El resumen refleja los elementos esenciales para el logro del cumplimiento de la
                                investigación *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number" onchange="suma()"
                            value="{{ old('p_04.0') ? old('p_04.0') : '0' }}" name="p_04[]" id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_04[]" id="">{{ old('p_04.1') ? old('p_04.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #5 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>3.- Justifica de manera clara y coherente el por qué y para qué se quiere estudiar e
                                investigar ese problema. *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number" onchange="suma()"
                            value="{{ old('p_05.0') ? old('p_05.0') : '0' }}" name="p_05[]" id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_05[]" id="">{{ old('p_05.1') ? old('p_05.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #6 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>4.- La metodología expone el camino a seguir para el logro de los objetivos propuestos. *
                            </h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number"
                            onchange="suma()" value="{{ old('p_06.0') ? old('p_06.0') : '0' }}" name="p_06[]"
                            id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_06[]" id="">{{ old('p_06.1') ? old('p_06.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #7 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>5.- Los objetivos son claros y permiten visualizar el propósito de la investigación. *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number"
                            onchange="suma()" value="{{ old('p_07.0') ? old('p_07.0') : '0' }}" name="p_07[]"
                            id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_07[]" id="">{{ old('p_07.1') ? old('p_07.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #8 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>6.- Las preguntas y/o hipótesis son adecuadas de acuerdo con la naturaleza del proyecto. *
                            </h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number"
                            onchange="suma()" value="{{ old('p_08.0') ? old('p_08.0') : '0' }}" name="p_08[]"
                            id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_08[]" id="">{{ old('p_08.1') ? old('p_08.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #9 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>7.- Se establece el tipo de proyecto y se encuentra vinculada con la metodología descrita. *
                            </h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number"
                            onchange="suma()" value="{{ old('p_09.0') ? old('p_09.0') : '0' }}" name="p_09[]"
                            id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_09[]" id="">{{ old('p_09.1') ? old('p_09.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #10 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>8.- Se establecen los criterios éticos para el desarrollo de la investigación. *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number"
                            onchange="suma()" value="{{ old('p_10.0') ? old('p_10.0') : '0' }}" name="p_10[]"
                            id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_10[]" id="">{{ old('p_10.1') ? old('p_10.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #11 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>9.- Presenta un cronograma de trabajo y sus actividades permiten el cumplimiento de los
                                objetivos de investigación. *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number"
                            onchange="suma()" value="{{ old('p_11.0') ? old('p_11.0') : '0' }}" name="p_11[]"
                            id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_11[]" id="">{{ old('p_11.1') ? old('p_11.1') : '' }}</textarea>
                    </div>
                </div>

                <!-- Pregunta #12 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>10.- En caso de solicitar presupuesto este se encuentra justificado en función del proyecto
                                y va de acuerdo con las normas de austeridad de la Universidad de Guadalajara. *</h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Seleccione *</label>
                        <input class="form-control monto" min="0" max="10" type="number"
                            onchange="suma()" value="{{ old('p_12.0') ? old('p_12.0') : '0' }}" name="p_12[]"
                            id="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_12[]" id="">{{ old('p_12.1') ? old('p_12.1') : '' }}</textarea>
                    </div>
                </div>
                <!-- Pregunta #13 -->
                <div class="col-md-12 row align-items-center">
                    <div class="col-sm-12">
                        <label class="form-label">
                            <h5>De acuerdo con la pregunta anterior (10) señale el porcentaje del presupuesto autorizado: *
                                <br> <b>** En caso de no solicitar recurso favor de colocar -1</b>
                            </h5>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="">Especifique *</label>
                        <input class="form-control" min="-1" max="100" type="number" name="p_13[]"
                            id="" value="{{ old('p_13.0') ? old('p_13.0') : '-1' }}">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <label class="form-label" for="">Argumente *</label>
                        <textarea class="form-control" name="p_13[]" id="">{{ old('p_13.1') ? old('p_13.1') : 'No aplica' }}</textarea>
                    </div>
                </div>

                <!-- Dictamen -->
                <div class="col-md-12 row align-items-center">
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-sm-10 col-md-7 row align-items-center ">
                            <div class="col-sm-12 col-md-4 text-end">
                                <label class="form-label " for="dictamen">Dictamen del proyecto</label>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                <select class="form-control" id="dictamen" name="dictamen" required>
                                    <option disabled selected>Elegir</option>
                                    <option {{ strcmp(old('dictamen'), 'Aprobado') == 0 ? 'selected' : '' }}
                                        value="Aceptado">Aceptado</option>
                                    <option {{ strcmp(old('dictamen'), 'No aprobado') == 0 ? 'selected' : '' }}
                                        value="No aceptado">No aceptado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="col-sm-6"><strong>Puntaje total: </strong><span id="total"></span></div>
                            <div class="col-sm-6"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mt-4">
                        <label class="form-label fs-4" for="">Observaciones y sugerencias </label>
                        <textarea class="form-control" name="sugerencias" id="">{{ old('sugerencias') ? old('sugerencias') : 'Ninguna' }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 mt-2">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function suma() {
            let subtotal = 0;

            let elementos = document.getElementsByClassName("monto");
            [].forEach.call(elementos, function(el) {
                //console.log(el.value);
                subtotal += parseFloat(el.value);
            });
            document.getElementById('total').innerHTML = subtotal;

        };
    </script>
@endsection
