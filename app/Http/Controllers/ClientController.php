<?php

namespace App\Http\Controllers;

use App\Client;
use App\Compte;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id= $request->get('id');
        $data=Client::find($id);
        if($data) return response()->json([
            'status'=>'success',
            'data'=>$data
        ],200);
        
        return response()->json([
            'status'=>'failed',
            'data'=>null
        ],404);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nom' => 'required',
            'dateN' => 'required',
            'sexe' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'failed'], 500);
        }
        $client= new Client;
        $client->id=0;
        $client->nom = $request->input('nom');
        $client->dateN = $request->input('dateN');
        $client->sexe = $request->input('sexe');
        $client->save();
        return response()->json(['status' => 'success'], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        

    }
   


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Resquest $request)
    {
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->get('id');
        $client=Client::find($id);
        $comptes=Compte::compteParClient($id);
        //echo $comptes;
        if($client){
            $client->delete();
            foreach($comptes as $compt){
                $compt->delete();
            }
            return response()->json(array('status'=>'succes'),200);
        }
        return response()->json(array('status'=>'failed'),404);
    }
}
