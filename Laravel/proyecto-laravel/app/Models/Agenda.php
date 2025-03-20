<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si es diferente del plural del nombre del modelo
    protected $table = 'agenda';

    // Los campos que pueden ser llenados de manera masiva (en este caso, los campos del formulario)
    protected $fillable = ['fecha', 'hora', 'idpersona', 'idimagen'];

    // Relación con el modelo Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idpersona');
    }

    // Relación con el modelo Imagen
    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'idimagen');
    }
}
