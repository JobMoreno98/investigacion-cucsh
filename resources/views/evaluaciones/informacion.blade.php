<div class="card w-100  shadow-sm">
    <div class="card-body">
        <h5 class="card-title text-center border-bottom mb-3 pb-3">
            
           <b>Folio:</b>  {{ $proyecto->folio }}
           <b>Título:</b> {{ $proyecto->titulo_proyecto }}
        </h5>
        <div class="row justify-content-center">
            <div class=" col-sm-6 col-md-3 col-lg-2 text-center">
                <p class="card-text"><span class="fw-bold">Fecha inicio</span> <br>
                    {{ $proyecto->fecha_inicio }}</p>
            </div>
            <div class=" col-sm-6 col-md-3 col-lg-2 text-center">
                <p class="card-text"><span class="fw-bold">Fecha fin</span> <br> {{ $proyecto->fecha_fin }}
                </p>
            </div>
            <div class=" col-sm-6 col-md-3 col-lg-2 text-center">
                <p class="card-text"><span class="fw-bold"> Tipo de registro</span><br>
                    {{ $proyecto->tipo_registro }}</p>
            </div>
            <div class=" col-sm-6 col-md-3 col-lg-2 text-center">
                <p class="card-text"><span class="fw-bold"> Tipo proyecto</span><br>
                    {{ $proyecto->tipo_proyecto }}</p>
            </div>
            <div class=" col-sm-6 col-md-3 col-lg-2 text-center">
                <p class="card-text"><span class="fw-bold">Sector que impacta</span> <br>
                    {{ $proyecto->sector }}</p>
            </div>

        </div>
        <div class="row text-center justify-content-center ">
            <h4 class="mt-4 pt-4"><span class="border-1 border-dark border-bottom px-2">Personal adscrito al
                    proyecto</span>
            </h4>
            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                <h6><span class="border-2  border-bottom px-2">Estudiantes</span> </h6>
                {!! $proyecto->personal[0] !!}
            </div>
            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                <h6><span class="border-2  border-bottom px-2">Profesores</span> </h6>
                {!! $proyecto->personal[1] !!}
            </div>
            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                <h6><span class="border-2  border-bottom px-2">Colaboradores</span> </h6>
                {!! $proyecto->personal[2] !!}
            </div>
            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                <h6><span class="border-2  border-bottom px-2">Asistentes externos</span></h6>
                {!! $proyecto->personal[3] !!}
            </div>
            <div class="col-md-6 mt-2 pt-2">
                <h6><span class="border-2  border-bottom px-2">Recursos concurrentes</span></h6>
                {{ $proyecto->recursos_concurrentes }}
            </div>
        </div>
    </div>
    <div class="row text-center ">
        <h4 class="mt-4 pt-4"><span class="border-1 border-dark border-bottom px-2">Redes de
                vinculación</span>
        </h4>
        <div class="col-md-6 mt-2 pt-2">
            <h6><span class="border-2  border-bottom px-2">A través de su proyecto se encuentra vinculado
                    con redes académicas</span></h6>
            @if (isset($proyecto->vinculacion_redes))
                {!! $proyecto->vinculacion_redes !!}
            @endif


        </div>

        <div class="col-md-6 mt-2 pt-2">
            <h6><span class="border-2  border-bottom px-2">Vinculación con Cuerpos Académicos</span></h6>
            {!! $proyecto->vinculacion_ca !!}
        </div>
    </div>
    <div class="row justify-content-center p-2 m-2">
        <div class="col-md-2">
            <a class="btn btn-primary text-center w-100" href="{{ route('imprimirProyecto', $proyecto->id) }}">Imprimir
                proyecto</a>
        </div>
    </div>
</div>
