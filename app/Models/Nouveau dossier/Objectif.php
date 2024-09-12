<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    use HasFactory;
    protected $table = 'objectifs';

    protected $primaryKey = 'id_obj';
    protected $fillable = [
        'lib_obj',
    ];
    public $timestamps = false;


    public function SousObjectif()
    {
        return $this->hasMany(SousObjectif::class, 'id_obj');
    }
}
