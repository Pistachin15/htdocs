<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas'; // Laravel usará esta tabla existente
    protected $primaryKey = 'idpersona'; // Si la clave primaria tiene otro nombre, cámbialo aquí

    protected $fillable = ['nombre']; // Ajusta según las columnas reales de tu tabla
}
