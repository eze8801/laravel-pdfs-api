<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $table = 'pdfs';
    
    protected $fillable = [
        'nombre',
        'ref',
        'titulo',
        'archivo'
    ];

    public $timestamps = false;
}
