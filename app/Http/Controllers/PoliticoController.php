<?php

namespace App\Http\Controllers;
use App\Politico;
use Illuminate\Http\Request;
use App\Http\Requests\PoliticoRequest;
class PoliticoController extends Controller
{
    public function index()
    {
        $politicos = Politico::all();
        
        return response()->json($politicos);

    }
    public function create(PoliticoRequest $request)
    {
    	$data = $request->all();
    	$product = Politico::create($data);

        return response()->json(null, 204);
    }
    public function edit($id)
    {
		$politico = Politico::find($id);

        return response()->json($politico);

		
    }
    public function update(PoliticoRequest $request, $id)
    {
    	$data = $request->all();
        $data2 = $data['id'];

        if($data2 == $id){
            $politico = Politico::find($data['id']);
            $politico->update($data);
            return response()->json(null, 204);
        }else {
            abort(408, "Processing error");
        }
   	
    }

    public function delete($id)
    {
    	$product = Politico::find($id);
        $selected = $product->Reclamacaos;
        if (!empty($selected[0])) {

            abort(408, "O politico possui reclamações");
       }else{
            $product->delete();
            return response()->json(null, 204);
        }
    	//$product->delete();

    	//return response()->json(['data' => ['msg' => 'Produto foi removido com sucesso!']]);
    }


}
