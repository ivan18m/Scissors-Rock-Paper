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

        $maxID = \DB::table('element')->max('id');

        $randomID = mt_rand(1, $maxID);
        $randomElement = Element::find($randomID);

        $result = Result::getResult($request->id, $randomID);
        
        return ["element" => $randomElement, "result" => $result];
    }
}
