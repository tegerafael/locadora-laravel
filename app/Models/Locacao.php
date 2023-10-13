<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;
    protected $table = 'locacoes';
    protected $primaryKey = 'id_loc';

    protected $fillable = ['data_inicio_periodo_loc', 
                            'data_final_previsto_periodo_loc',
                            'data_final_realizado_periodo_loc',
                            'valor_diaria_loc',
                            'km_inicial_loc',
                            'km_final_loc',
                            'id_cli_fk',
                            'id_car_fk'];


    public function rules() {
        return [];
    }
}