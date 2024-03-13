@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 text-center">
                <span class="mx-auto ">
                    <a target="_blank" style="background:#072d45;color:#fff;" class="btn "
                        href="{{ asset('storage/convocatoria_2023.pdf') }}">Enlace para ver la convocatoria</a>
                    @if (Auth::user()->role == 'evaluador' ||
                            Auth::user()->s_role == 'evaluador' ||
                            (Auth::user()->role == 'admin' || Auth::user()->s_role == 'admin'))
                        <a target="_blank" style="background:#072d45;color:#fff;" class="btn "
                            href="{{ asset('storage/Carta de imparcialidad y confidencialidad de datos-23.docx') }}">Carta
                            de imparcialidad y confidencialidad de datos</a>
                    @endif
                </span>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (Auth::user()->role == 'investigador' || Auth::user()->s_role == 'investigador')
                @include('usuarios.menu-investigador')
            @endif

            @if (Auth::user()->role == 'evaluador' || Auth::user()->s_role == 'evaluador')
                @include('usuarios.menu-evaluador')
            @endif
            @if (Auth::user()->role == 'admin' || Auth::user()->s_role == 'admin')
                @include('usuarios.menu-admin')
            @endif
        </div>
    </div>
@endsection
@section('js')
    @include('sweetalert::alert')
@endsection
