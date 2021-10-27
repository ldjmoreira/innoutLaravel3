<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\SaveuserRequest;
class Save_userController extends Controller
{
    public function edit($id)
    {
		$politico = User::find($id);

        return response()->json($politico);

		
    }
    public function update(SaveuserRequest $request, $id)
    {
    	$data = $request->all();
        $data2 = $data['id'];

        if($data2 == $id){
            $user = User::find($data['id']);
            $user->update($data);
            return response()->json(null, 204);
        }else {
            abort(408, "Processing error");
        }
   	
    }
    public function delete($id)
    {
    	$user = User::find($id);
        $selected = $user->working_hours;
        if (!empty($selected[0])) {

            abort(408, "O usuario possui horas cadastradas");
       }else{
            $user->delete();
            return response()->json(null, 204);
        }
    	//$product->delete();

    	//return response()->json(['data' => ['msg' => 'Produto foi removido com sucesso!']]);
    }
}
