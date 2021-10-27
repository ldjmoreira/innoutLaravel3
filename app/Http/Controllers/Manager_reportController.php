<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class Manager_reportController extends Controller
{
    public function index()
    {
        $users = User::paginate(3);
        $users->msg = 'produto';
        
        return response()->json(  
            [
                'msg' => $users->msg,
                'data' => $users
            ]   
            );

    }
}
