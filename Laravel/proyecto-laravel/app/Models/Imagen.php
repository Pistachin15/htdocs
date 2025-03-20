<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes'; // Asegúrate de que esta es la tabla correcta en tu BD
    protected $primaryKey = 'idpersona';
    public $timestamps = false; // Si tu tabla no tiene created_at y updated_at

    protected $fillable = ['ruta', 'nombre']; // Asegúrate de incluir los campos correctos
}
