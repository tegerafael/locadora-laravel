<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_car';

    protected $fillable = ['placa_car', 'disponivel_car', 'km_car', 'id_mod_fk'];

    public function rules()
    {
        return [
            'placa_car' => 'required',
            'disponivel_car' => 'required',
            'km_car' => 'required',
            'id_mod_fk' => 'exists:modelos,id_mod'
        ];
    }

    public function modelo() {
        return $this->belongsTo(Modelo::class, 'id_mod_fk');
    }
}