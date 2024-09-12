<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    use HasFactory;
    protected $table = 'indicateurs';

    protected $primaryKey = 'id_ind';
    protected $fillable = [
        'lib_ind',
        'formule'
    ];
    public $timestamps = false;


    public function CopInd()
    {
        return $this->hasMany(ActCopInd::class, 'id_ind');
    }

}
