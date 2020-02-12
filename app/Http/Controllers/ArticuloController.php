<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoria=['Bazar', 'Electrónica', 'Hogar'];
        //alemaceno los valores que me llegan del formu para los scopes
        $cate=$request->get('categoria');
        $precio=$request->get('pvp');
        //devolvemos todos los articulos ordenados por id
        $articulos=Articulo::orderBy('id')
        //llamo a los scopes creados en el modelo Articulo para categoria y precio
        ->categoria($cate)
        ->precio($precio)
        //hacemos la paginacion de 2 en 2
        ->paginate(2);
        //devolvemos la vista index y en un array los articulos
        //para poder trabajar con ellos en la vista
        return view('articulos.index', compact('articulos', 'categoria', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //devolvemos la vista crear.blade.php
        return view('articulos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //hacemos las validaciones a los campos necesarios
        $request->validate([
            'nombre'=>['required'],
            'categoria'=>['required'],
            'pvp'=>['required'],
            'stock'=>['required']
        ]);
        //Comprobamos si se ha subido una imagen
        if($request->has('imagen')){
            $request->validate([
                'imagen'=>['image']
            ]);
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('imagen');
            //creo un nombre unico para la imagen
            $nombre='articulos/'.time().' '.$file->getClientOriginalName();
            //guardo el archivo imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //guardo el coche pero la imagn estaria mal
            $articulo=Articulo::create($request->all());
            //actualiza el registro foto del articulo guardado
            $articulo->update(['imagen'=>"img/$nombre"]);
        }else{
            //si no se ha subido imagen, creamos el articulo con los datos que nos llegan por formulario
            Articulo::create($request->all());
        }
        //redirijo al usuario a la página principal
        return redirect()->route('articulos.index')->with('mensaje','Articulo creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //devuelvo la vista detalles.blade.php con el articulo
        return view('articulos.detalles', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        //paso un array para recorerlo en el select de la vista editar.blade.php
        $categoria=['Bazar', 'Electrónica', 'Hogar'];
        //devolvemos en junto a la vista el articulo a modificar y las categorias.
        return view('articulos.editar', compact('articulo', 'categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        //hacemos las validaciones a los campos necesarios
        $request->validate([
            'nombre'=>['required'],
            'categoria'=>['required'],
            'pvp'=>['required'],
            'stock'=>['required']
        ]);
        //Comprobamos si se ha subido una imagen
        if($request->has('imagen')){
            $request->validate([
                'imagen'=>['image']
            ]);
            //compruebo que no sea la default
            $imagen=$articulo->imagen;
            if(basename($imagen)!="default.jpg"){
                //la borro No es default.jpg
                unlink($imagen);
            }
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('imagen');
            //creo un nombre unico para la imagen
            $nombre='articulos/'.time().' '.$file->getClientOriginalName();
            //guardo el archivo imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //guardo el coche pero la imagn estaria mal
            $articulo->update($request->all());
            //actualiza el registro foto del articulo guardado
            $articulo->update(['imagen'=>"img/$nombre"]);
        }else{
            //si no se ha subido imagen, creamos el articulo con los datos que nos llegan por formulario
            $articulo->update($request->all());
        }
        //redirijo al usuario a la página principal
        return redirect()->route('articulos.index')->with('mensaje','Articulo modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        //guardo la imagen del articulo a borrar
        $foto=$articulo->imagen;
        //compruebo que la foto no sea default
        if(basename($foto)!="default.jpg"){
            //borro la foto si no es default
            unlink($foto);
        }
        //borramos el articulo
        $articulo->delete();
        //y volvemos al index de articulos
        return redirect()->route('articulos.index')->with('mensaje','Articulo borrado correctamente');
    }
}
