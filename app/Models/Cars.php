<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model{

    protected $table = 'cars';

    protected $primaryKey = 'id_car';

    protected $fillable = [
        'name',
        'description',
        'model',
        'date'
    ];

    protected $cast = [
        'date' => 'Timestamp'
    ];

    public $timestamps = false;
}