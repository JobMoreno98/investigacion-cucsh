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
                    <div class="card-body d-flex flex-wrap">
                        @foreach ($modulos as $item)
                            <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                <div class="card card-margin h-100">
                                    <div class="card-body pt-2">
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex p-2 m-1 rounded-circle"
                                                    style="background: {{ $item->color }}">
                                                    <span class="material-symbols-outlined" style="font-size: 24pt;">
                                                        {{ $item->icono }}
                                                    </span>
                                                </div>
                                                <div class="widget-49-meeting-info">
                                                    <h5 class="m-0 widget-49-pro-title">{{ $item->nombre }}</h5>
                                                </div>
                                            </div>
                                            @if (isset($item->enlaces))
                                                <div class="mt-3">
                                                    @foreach ($item->enlaces as $enlace)
                                                        @php
                                                            if (Str::contains($enlace->enlace, '148.202.')) {
                                                                $link = $enlace->enlace;
                                                            } else {
                                                                $parametros = str_replace(
                                                                    'user_id',
                                                                    Auth::user()->id,
                                                                    $enlace->parametro,
                                                                );
                                                                $link = route($enlace->enlace, $parametros);
                                                            }
                                                        @endphp
                                                        <span><a class="{{ $enlace->estilo }}" href="{{ $link }}">
                                                                {{ $enlace->titulo }}
                                                            </a></span>
                                                    @endforeach
                                                </div>
                                            @endif
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
    <script>
        $(document).on('click', '.sidebar-toggle', function() {
            if ($('body').hasClass("sidebar-collapse") && $('body').hasClass("sidebar-open")) {
                $('body').removeClass("sidebar-collapse");
            }
        });
    </script>
@endsection
