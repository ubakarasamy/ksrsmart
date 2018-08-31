<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    public function hello(){
        $data = ['name' => 'Abigail', 'state' => 'CA'];
        
        return response()->json($data);
    }
}
