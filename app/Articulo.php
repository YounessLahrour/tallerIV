<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $fillable=['nombre', 'categoria', 'pvp', 'stock', 'imagen'];
    
    //scope para categoria
    public function scopeCategoria($query, $v){
        if(!isset($v)){
            return $query->where('categoria', 'like','%');
        }
        if($v=='%'){
            return $query->where('categoria','like', $v);
        }
        return $query->where('categoria', $v);
    }
    //scope para precio
    public function scopePrecio($query, $v){
        if(!isset($v)){
            return $query->where('pvp', 'like','%');
        }elseif($v=='%'){
            return $query->where('pvp','like', $v);
        }elseif($v=='1'){
            return $query->whereBetween('pvp', [1, 50]);
        }elseif($v=='2'){
            return $query->whereBetween('pvp', [50, 100]);
        }elseif($v=='3'){
            return $query->whereBetween('pvp', [100, 500]);
        }elseif($v=='4'){
            return $query->whereBetween('pvp', [500, 800]);
        }else{
            return $query->where('pvp', '>', 800);
        }
        
    }
}
