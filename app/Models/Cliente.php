<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cli';

    protected $fillable = ['nome_cli'];

    public function rules() {
        return [
            'nome_cli' => 'required'
        ];
    }
}