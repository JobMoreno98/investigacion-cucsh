@extends('adminlte::page')
@section('title', 'Home')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection
@section('content')
    <div class="container ">
        <div class="row pt-5">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h2 class="card-title text-center w-100 my-2">Sistema de Investigación</h2>
                    </div>
                    
                    @if (count(Auth::user()->getRoleNames()) == 0)
                        <h3 class="text-center my-3">Contacta a un Administrador para que te asigne un rol</h3>
                    @endif
                    <div class="card-body d-flex flex-wrap">
                        @foreach ($modulos as $key => $value)
                            <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                <div class="card card-margin h-100">
                                    <div class="card-body pt-2">
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex p-2 m-1 rounded-circle"
                                                    style="background: {{ $value[0]->modulo_color }}">
                                                    <span class="material-symbols-outlined" style="font-size: 24pt;">
                                                        {{ $value[0]->modulo_icono }}
                                                    </span>
                                                </div>
                                                <div class="widget-49-meeting-info">
                                                    <h5 class="m-0 widget-49-pro-title">{{ $value[0]->modulo_nombre }}</h5>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @foreach ($value as $enlace)
                                                    @php
                                                        if (Str::contains($enlace->enlace_enlace, '148.202.')) {
                                                            $link = $enlace->enlace_enlace;
                                                        } else {
                                                            $parametros = str_replace(
                                                                'user_id',
                                                                Auth::user()->id,
                                                                $enlace->enlace_parametro,
                                                            );
                                                            $link = route($enlace->enlace_enlace, $parametros);
                                                        }
                                                    @endphp
                                                    <span><a class="{{ $enlace->enlace_estilo }}"
                                                            href="{{ $link }}">
                                                            {{ $enlace->enlace_titulo }}
                                                        </a></span>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('js')
@include('sweetalert::alert')
    @include('layouts.scripts')
@endsection
