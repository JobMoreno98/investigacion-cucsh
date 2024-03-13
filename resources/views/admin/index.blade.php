@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-md-5">
            @if (Session::has('message'))
                <div class="col-sm-12 col-md-10">
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                </div>
            @endif
            @error('password')
            <div class="col-sm-12 col-md-10">
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            </div>
                
            @enderror
            <div class="col-sm-12 col-md-10">
                <form action="{{ route('admin.update', Auth::user()->id) }}" class="row justify-content-center" method="post">
                    @csrf
                    @method('POST')
                    <div class="col-sm-12  mt-2">
                        <h4>Datos del usuario</h4>
                        <hr class="mt-3 border border-dark border-1 opacity-50">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold">Nombre</label>
                        <input type="text" class="form-control"  name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold">Correo</label>
                        <input type="text" class="form-control" name="email"  value="{{ Auth::user()->email }}">
                    </div>
                    
                    <div class="col-sm-12 mt-3">
                        <h4>Cambio de contraseña</h4>
                        <hr class="mt-3 border border-dark border-1 opacity-50">
                        <a href=""></a>
                    </div>
    
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label" for="">Contraseña nueva</label>
                        <input class="form-control" type="password" name="password" id="" >
                        
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label" for="">Confirmar contraseña</label>
                        <input class="form-control" type="password" name="password_confirmation" id="">
                        @error('password_confirmation')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-3 mt-2">
                            <button type="submit" class="btn btn-outline-success w-100">Guardar</button>
                        </div>
                    </div>
    

                </form>
            </div>

        </div>
    </div>
@endsection
