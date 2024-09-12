<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumDenomVals extends Model
{
    use HasFactory;
    protected $table = 'numDenomVals';

    protected $primaryKey = 'id_val';
    protected $fillable = [
        'id_num_denom',
        'val',
        'date',
        'id_dc',
        'unite',
    ];
    public $timestamps = false;
}
