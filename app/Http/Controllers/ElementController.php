<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Element;
use App\ElementStrength;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Element::all();
    }

    /**
     * Show the listing view
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view("element.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('element.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|alpha|min:2|max:30|unique:element',
            'strengths' => 'array',
            'weaknesses' => 'array',
        ]);

        $element = new Element;
        $element->name = $request->name;
        $element->save();
        $element->strengths()->attach($request->strengths); 
        $element->weaknesses()->attach($request->weaknesses);

        return ['status' => 'success'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = Element::findOrFail($id);
        $element->strengths = ElementStrength::where('element_id' ,'=' , $element->id)->pluck("strength_id")->toArray();
        $element->weaknesses = ElementStrength::where('strength_id' ,'=' , $element->id)->pluck("element_id")->toArray();
        return $element;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Element::findOrFail($id);
        $element->strengths = ElementStrength::where('element_id' ,'=' , $element->id)->pluck("strength_id");
        $element->weaknesses = ElementStrength::where('strength_id' ,'=' , $element->id)->pluck("element_id");
        return view('element.update')->with('element', $element);; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:30',
            'strengths' => 'array',
        ]);

        $element = Element::find($id);

        $element->name = $request->name;
        $element->save();
        $element->strengths()->sync($request->strengths);

        return ['status' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Element::find($id);
        $element->delete();
        return ['status' => 'success'];
    }
}
