<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mod';

    protected $fillable = ['nome_mod', 'imagem_mod', 'numero_portas_mod', 'lugares_mod', 'air_bag_mod', 'abs_mod', 'id_mar_fk'];

    public function rules()
    {
        return [
            'nome_mod' => 'required|unique:modelos,nome_mod,' . $this->id_mod . ',id_mod|min:3',
            'imagem_mod' => 'required|file|mimes:png,jpeg,jpg',
            'numero_portas_mod' => 'required|integer|digits_between:1,5',
            'lugares_mod' => 'required|integer|digits_between:1,5',
            'air_bag_mod' => 'required|boolean',
            'abs_mod' => 'required|boolean',
            'id_mar_fk' => 'exists:marcas,id_mar'
        ];
    }

    // mensagens de feedback
}