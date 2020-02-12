@extends('plantillas.plantilla')
@section('titulo')
    Artículos
@endsection
@section('cabecera')
    Crear Articulo
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

<form action="{{route('articulos.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-row mt-3">
                <div class="col">
                    Nombre:
                  <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
                </div>
                <div class="col">
                    Categoría:
                    <select name="categoria" class="form-control">
                      <option selected>Electrónica</option>
                      <option >Bazar</option>
                      <option >Hogar</option>
                  </select>
                </div>
                <div class="col">
                    Precio:
                    <input type="number" class="form-control" placeholder="Precio (€)" name="pvp" required>
                  </div>                 
        </div>
        <div class="form-row mt-3">
                <div class="col">
                    Stock:
                    <input type="number" class="form-control" placeholder="Stock" name="stock" required>
                </div>
                <div class="col">
                    Imagen:
                    <input type="file" class="form-control"  name="imagen" >
                </div>
        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-success " value="Guardad">Crear</button>
            <button type="reset" class="btn btn-danger ml-3" value="Reset">Reset</button>
            <a href="{{route('articulos.index')}}" class="btn btn-info ml-3">Volver</a>
        </div>
        
    </form>
@endsection