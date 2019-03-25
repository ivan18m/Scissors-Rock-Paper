<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Element;
use App\Queries\Result;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:element,id',
        ]);

        $randomElement = Element::inRandomOrder()->first();
        
        $result = Result::getResult($request->id, $randomElement->id);
        
        return ["element" => $randomElement, "result" => $result];
    }
}
