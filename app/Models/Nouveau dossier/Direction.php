<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $table = 'directions';

    protected $primaryKey = 'id_dir';
    protected $fillable = [
        'code',
        'lib_dir',
        'type_dir',
        'ordre',
    ];
    public $timestamps = false;

    // public function User()
    // {
    //     return $this->belongsTo(User::class, 'id_user');
    // }

    public function VdaC()
    {
        return $this->hasMany(VDA::class, 'id_dc');
    }

    public function VdaR()
    {
        return $this->hasMany(VDA::class, 'id_dr');
    }
}
