<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use Illuminate\Http\Request;
use App\Repositories\LocacaoRepository;

class LocacaoController extends Controller
{
    public function __construct(Locacao $locacao) {
        $this->locacao = $locacao;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        if ($request->has('filtro')){
            $locacaoRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $locacaoRepository->selectAtributos($request->atributos);
        }

        return response()->json($locacaoRepository->getResultado(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->locacao->rules());

        $locacao = $this->locacao->create([
            'data_inicio_periodo_loc' => $request->data_inicio_periodo_loc,
            'data_final_previsto_periodo_loc' => $request->data_final_previsto_periodo_loc,
            'data_final_realizado_periodo_loc' => $request->data_final_realizado_periodo_loc,
            'valor_diaria_loc' => $request->valor_diaria_loc,
            'km_inicial_loc' => $request->km_inicial_loc,
            'km_final_loc' => $request->km_final_loc,
            'id_cli_fk' => $request->id_cli_fk,
            'id_car_fk' => $request->id_car_fk,

        ]);

        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $locacao = $this->locacao->find($id);

        if ($locacao === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        return response()->json($locacao, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locacao $locacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locacao = $this->locacao->find($id);

        if ($locacao === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização, o recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();

            foreach ($locacao->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);

        } else {
            $request->validate($locacao->rules());
        }

        $locacao->fill($request->all());
        $locacao->save();

        return response()->json($locacao, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $locacao = $this->locacao->find($id);

        if ($locacao === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        $locacao->delete();
        return response()->json(['msg' => 'A locação foi removida com sucesso'], 200);
    }
}
