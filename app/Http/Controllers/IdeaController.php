<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\idea;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = idea::all();
        return response()->json($item);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validater = Validator::make($request->all(),[
          'name'=> 'required|string|max:10',
          'email'=>'required|email|unique:ideas,email',
          'phone'=>'required|max:12',
          'address'=>'required|max:50|string'
        ]);
        if($validater->fails()){

            $error = $validater->errors();
            return response()->json($error);

        }else{
            $ideas = new idea;
            $ideas->name = $request->input('name');
            $ideas->email = $request->input('email');
            $ideas->phone = $request->input('phone');
            $ideas->address = $request->input('address');
            $ideas->save();
            return response()->json($ideas);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idea = idea::find($id);
        return response()->json($idea);
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
        $validater = Validator::make($request->all(),[
            "name"=>"required|string",
            "email"=>"required|email",
            'phone'=>'required|max:12',
            'address'=>'required|max:50|string'
        ]);
        if($validater->fails()){
            $error = $validater->errors();
            return response()->json($error);
        }else{
            $uidea = idea::find($id);
            $uidea->name = $request->input('name');
            $uidea->email = $request->input('email');
            $uidea->phone = $request->input('phone');
            $uidea->address = $request->input('address');
            $uidea->save();
            return response()->json($uidea);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idea = idea::find($id);
        $idea->delete();
        return response()->json(["deleted"=>true]);
    }
}
