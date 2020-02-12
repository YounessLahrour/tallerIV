@extends('plantillas.plantilla')
@section('titulo')
    Artículos
@endsection
@section('cabecera')
    Articulos Disponibles
@endsection
@section('contenido')
@if ($texto=Session::get('mensaje'))
<p class="alert alert-success my-3">{{$texto}}</p>    
@endif
<a href="{{route('articulos.create')}}" class="btn btn-success mb-3">Nuevo articulo</a>
<form name="search" action="{{route('articulos.index')}}" method="GET" class="form-inline float-right">
        
        <i class="fa fa-search ml-2 mr-2" aria-hidden="true"></i>           
        Categoria:
        <select name="categoria" onchange="this.form.submit()">
                <option value="%">Todos</option>
                @foreach ($categoria as $item)
                @if ($item== $request->categoria)
                    <option  selected>{{$item}}</option>
                  @else
                  <option  >{{$item}}</option>
                @endif
                @endforeach    
        </select>
        Precio:
        <select name="pvp" onchange="this.form.submit()">
            @if ($request->pvp=='%')
                <option value="%" selected>Todos</option>
            @else
                <option value="%" >Todos</option>
            @endif
            @if ($request->pvp=='1')
                <option value="1" selected>De 1€ a 50€</option>
            @else
            <option value="1">De 1€ a 50€</option>
            @endif
            @if ($request->pvp=='2')
                <option value="2" selected>De 50€ a 100€</option>
            @else
            <option value="2">De 50€ a 100€</option>
            @endif
            @if ($request->pvp=='3')
                <option value="3" selected>De 100€ a 500€</option>
            @else
            <option value="3">De 100€ a 500€</option>
            @endif
            @if ($request->pvp=='4')
                <option value="4" selected>De 500€ a 800€</option>
            @else
            <option value="4">De 500€ a 800€</option>
            @endif
            @if ($request->pvp=='5')
                <option value="5" selected>Más de 800€</option>
            @else
            <option value="5">Más de 800€</option>
            @endif
                   
        </select>    
        <input type="submit" value="Buscar" class="btn btn-info ml-2">
          </form>
<table class="table table-bordered">
    <thead>
      <tr class="table-active">
        <th scope="col">Detalles</th>
        <th scope="col">Nombre</th>
        <th scope="col">Categoria</th>
        <th scope="col">Imagen</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($articulos as $articulo)
            <tr class="table-success">
                <th class="align-middle" scope="row"><a href="{{route('articulos.show', $articulo)}}" class="btn btn-info">detalles</a></th>
                <td class="align-middle">{{$articulo->nombre}}</td>
                <td class="align-middle">{{$articulo->categoria}}</td>                
                <td class="align-middle"><img src="{{asset($articulo->imagen)}}" width="90px" height="90px" class="rounded-circle"></td>
                <td class="align-middle">
                    <form name="borrar" action="{{route('articulos.destroy', $articulo)}}" method="POST" style="white-space: nowrap">
                        @csrf
                        @method('DELETE')
                        <a href="{{route('articulos.edit', $articulo)}}" class="btn btn-warning normal">Editar</a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea borrar el articulo?')">Borrar</button>
                                
                    </form>
                </td>
            </tr>
        @endforeach
      
    </tbody>
  </table>
  {{$articulos->appends(Request::except('page'))->links()}}
@endsection