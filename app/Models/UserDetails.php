<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'email',
    'nombre',
    'apellidos',
    'phone',
    'departamento_id',
    'provincia_id',
    'distrito_id',
    'dir_av_calle',
    'dir_numero',
    'dir_bloq_lote',
    'imagen',
    'user_id',
    'status'
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function usuarioPedido(){
    return $this->hasMany(Ordenes::class, 'usuario_id');
  } 

}
