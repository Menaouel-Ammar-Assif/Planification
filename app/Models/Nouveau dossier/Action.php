<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $table = 'actions';

    protected $primaryKey = 'id_act';
    protected $fillable = [
        'lib_act',
        'code_act',
        'dd',
        'df',
        'id_dir',
        'etat',
        'id_p',
    ];
    public $timestamps = false;


    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function VDA()
    {
        return $this->hasMany(VDA::class, 'id_act');
    }
    public function Description()
    {
        return $this->hasMany(Description::class, 'id_desc');
    }
    public function prioritaires()
    {
        return $this->belongsTo(prioritaires::class,);
    }
}
