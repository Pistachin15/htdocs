<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda'; // Asegúrate de que esta es la tabla correcta en tu BD
    protected $primaryKey = 'idpersona';
    public $timestamps = false;

    protected $fillable = ['fecha', 'hora', 'idpersona', 'imagen_id'];

    // Relación con Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idpersona');
    }

    // Relación con Imagen
    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'imagen_id');
    }
}
