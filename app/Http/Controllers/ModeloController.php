<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
{
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modelos = array();

        if ($request->has('atributos')) {
            $atributos = $request->atributos;
            $modelos = $this->modelo->selectRaw($atributos)->with('marca')->get();
        } else {
            $modelos = $this->modelo->with('marca')->get();
        }
        return response()->json($modelos, 200);
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
        $request->validate($this->modelo->rules());

        $imagem_mod = $request->file('imagem_mod');
        $imagem_urn = $imagem_mod->store('imagens/modelos', 'public');

        $modelo = $this->modelo->create([
            'nome_mod' => $request->nome_mod,
            'imagem_mod' => $imagem_urn,
            'numero_portas_mod' => $request->numero_portas_mod,
            'lugares_mod' => $request->lugares_mod,
            'air_bag_mod' => $request->air_bag_mod,
            'abs_mod' => $request->abs_mod,
            'id_mar_fk' => $request->id_mar_fk
        ]);

        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id);

        if ($modelo === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        return response()->json($modelo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id);

        if ($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização, o recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();

            foreach ($modelo->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);

        } else {
            $request->validate($modelo->rules());
        }

        if ($request->file('imagem_mod')) {
            Storage::disk('public')->delete($modelo->imagem_mod);
        }

        $imagem_mod = $request->file('imagem_mod');
        $imagem_urn = $imagem_mod->store('imagens/modelos', 'public');

        $modelo->fill($request->all());
        $modelo->imagem_mod = $imagem_urn;
        $modelo->save();

        return response()->json($modelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);

        if ($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        Storage::disk('public')->delete($modelo->imagem_mod);

        $modelo->delete();
        return response()->json(['msg' => 'O modelo foi removido com sucesso'], 200);
    }
}