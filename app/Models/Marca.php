<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mar';

    protected $fillable = ['nome_mar', 'imagem_mar'];

    public function rules()
    {
        return [
            'nome_mar' => 'required|unique:marcas,nome_mar,' . $this->id_mar . ',id_mar|min:3',
            'imagem_mar' => 'required|file|mimes:png'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'image_mar.mimes' => 'O arquivo deve ser uma imagem do tipo PNG',
            'nome_mar.unique' => 'O nome da marca já existe',
            'nome_mar.min' => 'O nome deve ter no mínimo 3 caracteres',
        ];
    }
}