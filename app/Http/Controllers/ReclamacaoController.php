<?php

namespace App\Http\Controllers;
use App\Reclamacao;
use App\Politico;
use Illuminate\Http\Request;
use App\Http\Requests\ReclamacaoRequest;

class ReclamacaoController extends Controller
{
    public function index()
    {
        $reclamacaos = Reclamacao::Paginate(3);
        
        return response()->json($reclamacaos);

    }

    public function create(ReclamacaoRequest $request)
    {
        $date = date('y/m/d');

    	$data = $request->all();
        $data2 = $data + ['datap' => $date];
    	$product = Reclamacao::create($data2 = $data + ['datap' => $date]);
        return response()->json(null, 204);
    }//

    public function getIdPolitico()
    {
        $politicos = Politico::all('id','name');
        
        return response()->json($politicos);

    }
    public function edit($id)
    {
		$data = Reclamacao::find($id);

        return response()->json($data);

		
    }
    public function show($id)
    {
		$politicoName = Reclamacao::find($id)->politico->name;
        $politicoPartido = Reclamacao::find($id)->politico->partido;
        $reclamacao = Reclamacao::find($id);
        $reclamacao->name = $politicoName;
        $reclamacao->partido = $politicoPartido;
        $tentativa = [$reclamacao];

        return response()->json($tentativa);

		
    }
    public function update(ReclamacaoRequest $request, $id)
    {
    	$data = $request->all();
        $data2 = $data['id'];

        if($data2 == $id){
            $politico = Reclamacao::find($data['id']);
            $politico->update($data);
            return response()->json(null, 204);
        }else {
            abort(408, "Processing error");
        }
   	
    }

    public function delete($id)
    {
    	$product = Reclamacao::find($id);

        $product->delete();
        return response()->json(null, 204);

    }
}
