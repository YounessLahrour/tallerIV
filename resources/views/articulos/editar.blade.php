@extends('plantillas.plantilla')
@section('titulo')
    Artículos
@endsection
@section('cabecera')
    Editar Articulo: "{{$articulo->nombre}}"
@endsection
@section('contenido')
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $item)
    <li>
      {{$item}}
    </li>
@endforeach  
</ul>  
</div>    
@endif

<form action="{{route('articulos.update', $articulo)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-row mt-3">
                <div class="col">
                    Nombre:
                <input type="text" class="form-control" value="{{$articulo->nombre}}" name="nombre" required>
                </div>
                <div class="col">
                    Categoría:
                    <select name="categoria" class="form-control">
                        @foreach ($categoria as $item)
                            @if ($item==$articulo->categoria)
                                <option selected>{{$item}}</option>
                            @else
                                <option >{{$item}}</option>
                            @endif
                        @endforeach
                  </select>
                </div>
                <div class="col">
                    Precio:
                    <input type="number" class="form-control" value="{{$articulo->pvp}}" name="pvp" required>
                  </div>                 
        </div>
        <div class="form-row mt-3">
                <div class="col">
                    Stock:
                    <input type="number" class="form-control" value="{{$articulo->stock}}" name="stock" required>
                </div>
                <div class="col">
                    Imagen:
                    <img src="{{asset($articulo->imagen)}}" width="90px" height="90px" class="rounded-circle">
                    
                </div>
        </div>
        <div class="form-row mt-3">
                <div class="col">
                    Cambiar imagen:
                    <input type="file" class="form-control col-md-4"  name="imagen" >
                </div>
                
        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-success " value="Guardad">Editar</button>
            <button type="reset" class="btn btn-danger ml-3" value="Reset">Reset</button>
            <a href="{{route('articulos.index')}}" class="btn btn-info ml-3">Volver</a>
        </div>
        
    </form>
@endsection