@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 mt-5">
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Archivo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cartas as $item)
                                <tr>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{$item->user->email}}</td>
                                    <td> <a target="_blank" class="btn btn-success btn-sm" href="{{ asset('storage/cartas/' . $item->anio . '/' . $item->name) }}">Descargar</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
