<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $table = 'codes';

    protected $fillable = [
        'code_email',
        'code_phone',
        'user_id'
    ];



    public function obtenerCodigoUsuario($id)
    {
        return $this->where('user_id','=',$id)->first();
    }
}
