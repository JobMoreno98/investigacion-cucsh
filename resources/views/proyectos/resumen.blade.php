<div class="row mt-3 justify-content-center align-items-center">
    <h3>Resumen del proyecto</h3>
    <hr class="mt-3">
    <div class="col-md-1 text-center">
        <label class="form-label " for="">Folio</label>
        <input type="text" readonly name="folio" class="text-center form-control-plaintext" id="staticEmail"
            value="{{ isset($proyecto->folio) ? $proyecto->ciclo->anio . '/' . $proyecto->folio : $folio }}"
            placeholder="{{ isset($proyecto->folio) ? $proyecto->ciclo->anio . '/' . $proyecto->folio : $folio }}">
    </div>
    <div class="col-sm-11 mb-2">
        <label class="form-label" for="titulo">Título del Proyecto</label>
        <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Título del Proyecto"
            required value="{{ isset($proyecto->titulo_proyecto) ? $proyecto->titulo_proyecto : old('titulo') }}">
    </div>

    <div class="col-sm-3">
        <label class="form-label" for="fecha_inicio">Fecha inicio</label>
        <input class="form-control" required type="month" name="fecha_inicio" id="fecha_inicio"
            value="{{ isset($proyecto->fecha_inicio) ? $proyecto->fecha_inicio : old('fecha_inicio') }}">
    </div>

    <div class="col-sm-3">
        <label class="form-label" for="fecha_fin">Fecha fin</label>
        <input class="form-control" required type="month" name="fecha_fin" id="fecha_fin"
            value="{{ isset($proyecto->fecha_fin) ? $proyecto->fecha_fin : old('fecha_fin') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label" for="tipo_registro">Tipo de registro</label>
        <select class="form-control" name="tipo_registro" id="tipo_registro" required
            value="{{ isset($proyecto->tipo_registro) ? $proyecto->tipo_registro : old('tipo_registro') }}">
            <option disabled>Elegir una opción</option>
            <option value="Proyecto nuevo">Proyecto nuevo</option>
            <option value="Proyecto continuación">Proyecto continuación</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="">Tipo proyecto</label>
        <select class="form-control" name="tipo_proyecto" id="" required
            value="{{ isset($proyecto->tipo_proyecto) ? $proyecto->tipo_proyecto : old('tipo_proyecto') }}">
            <option disabled>Elegir una opción</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Investigación básica', $proyecto->tipo_proyecto) == 0 ? 'selected' : '') : '' }}
                value="Investigación básica">Investigación básica</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Investigación apliacada', $proyecto->tipo_proyecto) == 0 ? 'selected' : '') : '' }}
                value="Investigación apliacada">Investigación apliacada</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Desarrollo tecnológico y experimental', $proyecto->tipo_proyecto) == 0 ? 'selected' : '') : '' }}
                value="Desarrollo tecnológico y experimental">Desarrollo tecnológico y experimental
            </option>
        </select>
    </div>

</div>
<div class="row mt-3 justify-content-center align-items-center">
    <div class="col-md-3 p-2">
        <label class="form-label" for="sector">Principal sector que impacta</label>
        <select class="form-control" name="sector" id="sector" required value="{{ old('sector') }}">
            <option disabled>Elegir una opción</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Social', $proyecto->sector) == 0 ? 'selected' : '') : '' }}
                value="Social">Social</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Público', $proyecto->sector) == 0 ? 'selected' : '') : '' }}
                value="Público">Público</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Privado', $proyecto->sector) == 0 ? 'selected' : '') : '' }}
                value="Privado">Privado</option>
        </select>
    </div>

    <div class="col-md-3 p-2">
        <label class="form-label" for="sector">Enfoque del proyecto <button type="button" class="btn p-0"
                data-bs-toggle="modal" data-bs-target="#info_enfoque">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                </svg>
            </button></label>
        <select class="form-control" name="enfoque" id="enfoque" required
            value="{{ isset($proyecto->enfoque) ? $proyecto->enfoque : old('enfoque') }}">
            <option selected disabled>Elegir una opción</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Disciplinario', $proyecto->enfoque) == 0 ? 'selected' : '') : '' }}
                value="Disciplinario">
                Disciplinario</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Interdisciplinario', $proyecto->enfoque) == 0 ? 'selected' : '') : '' }}
                value="Interdisciplinario">Interdisciplinario</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Multidisciplinario', $proyecto->enfoque) == 0 ? 'selected' : '') : '' }}
                value="Multidisciplinario">Multidisciplinario</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp('Transdisciplinario', $proyecto->enfoque) == 0 ? 'selected' : '') : '' }}
                value="Transdisciplinario">Transdisciplinario</option>
        </select>
    </div>
    <div class="col-md-4 p-2">
        <label class="form-label" for="">Registro y apoyo económico en otras instituciones</label>
        <select class="form-control" name="otras_intituciones[]" id=""
            value="{{ old('otras_intituciones[0]') }}">
            <option disabled>Elegir una opción</option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp($proyecto->otras_instituciones, 'No aplica') == 0 ? 'selected' : '') : '' }}
                value="No">No
            </option>
            <option
                {{ isset($proyecto->tipo_proyecto) ? (strcmp($proyecto->otras_instituciones, 'No aplica') != 0 ? 'selected' : '') : '' }}
                value="Si">Si
            </option>
        </select>

    </div>
    <div class="col-md-12">
        <label class="form-label" for="abstract">Resumen del proyecto</label>
        <textarea class="form-control" name="abstract" id="abstract" placeholder="Resumen">{{ isset($proyecto->abstract) ? $proyecto->abstract : old('abstract') }}</textarea>
    </div>

    <div class="col-md-12 p-2">
        <label class="form-label" for="">En caso de recibir financiamiento especificar institución y
            monto</label>
        <textarea class="form-control" name="otras_intituciones[]" id="">{{ isset($proyecto->tipo_proyecto) ? (strcmp($proyecto->otras_instituciones, 'No aplica') != 0 ? $proyecto->otras_instituciones : 'No aplica') : '' }}</textarea>
    </div>
    <div class="col-sm-12 col-md-8 p-2">
        <label class="form-label" for="">Justificación</label>
        <textarea class="form-control" name="justificacion" id="" readonly>{{ isset($proyecto->justificacion) ? $proyecto->justificacion : old('justificacion') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="anexos">Anexos</label>
        <input accept=".pdf" class="form-control" type="file" name="anexos" required>

        <label class="form-label" for="cronograma">Cronograma</label>
        <input accept=".pdf" class="form-control" type="file" name="cronograma" required>
    </div>
</div>
