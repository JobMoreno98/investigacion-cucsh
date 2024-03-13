@if (isset($tipo))
    <h5 class="text-center">{{ ucwords(str_replace('_', ' ', $tipo)) }} /
        {{ ucwords(str_replace('_', ' ', $valor)) }} </h5>
@endif
@if (isset($total))
    <div class="row py-3 my-3 border-bottom">
        <h3 class="text-center">Total de los recursos solicitados: {{ number_format($total) }}</h3>
        
    </div>
    
@endif
@if(Auth::user()->role =='admin' || Auth::user()->s_role =='admin')
<div class="row justify-content-end">
    
    <div class="col-sm-12 col-md-1 my-3">
        <a href="{{route('proyectos.estadisticas') }}" style="background: #072d45" class="w-100 btn text-white">Regresar</a>
    </div>
</div>
@endif