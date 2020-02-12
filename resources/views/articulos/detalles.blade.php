@extends('plantillas.plantilla')
@section('titulo')
    Articulos
@endsection
@section('cabecera')
<div>Detalles de <b>{{$articulo->nombre}}</b></div>
@endsection
@section('contenido')
<table class="ml-3" cellspacing='5' cellspacing='5'>
        <tr>
            <td >
            Nombre:
            <p class="font-weight-bold"> {{$articulo->nombre}}</p>
            </td>
            <td rowspan="5" >
            <img src="{{asset($articulo->imagen)}}" width="150vw" height="150vh" class="rounded-circle">
            </td>
        </tr>
        <tr>
                <td>
                    Categoria:
                    <p class="font-weight-bold"> {{$articulo->categoria}}</p>
                </td>
        </tr>
        <tr>
                <td>
                    Precio:
                    <p class="font-weight-bold"> {{$articulo->pvp}}</p>
                </td>
        </tr>
        <tr>
                <td>
                    Stock:
                    <p class="font-weight-bold"> {{$articulo->stock}}</p>
                </td>
        </tr>
    
    </table>
    <a href="{{route('articulos.index')}}" class="btn btn-info ">Volver</a>
@endsection