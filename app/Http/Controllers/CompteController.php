<?php

namespace App\Http\Controllers;

use App\Compte;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'idClient' => 'required',
        'username' => 'required',
        'password' => 'required',
        'type' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error'], 500);
    }

    try {
        $compte = new Compte;
        $compte->idClient = $request->input('idClient');
        $compte->username = $request->input('username');
        $compte->password = $request->input('password');
        $compte->solde =0;
        $compte->type = $request->input('type');
        $compte->save();
        return response()->json(['status' => 'success'], 201);
    } catch (Exception $e) {
        return response()->json(['status' => 'failed'], 500);
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = $request->get('username');
        $compte= json_decode(Compte::where('username', $username)->first());
        if ($compte==null||$compte->password!=$request->get('password'))
            return response([
                'status' =>'failed',
                'data'=>null
            ],404);
        return response([
            'status' =>'succes',
            'data'=>$compte
            ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->get('id');
        $compte = Compte::find($id);
        //echo $compte;
        if ($compte) {
            $data = [
                'status'=>'success',
                'solde' => $compte->solde,
            ];
            return response()->json($data);
        } else {
            return response()->json(['status' => 'failed'], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(Compte $compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function verser(Request $request)
    {
        $id1=$request->get('id1');
        $id2=$request->get('id2');
        if($id1==$id2)  return response()->json([
            'status'=>'failed',
            'error' => 'impssible de verser à sois meme'
        ], 404);
        $montant=$request->get('montant');
        $compte1=Compte::find($id1);
        $compte2=Compte::find($id2);
        if($compte1->verser($compte2,$montant))
            return response()->json(['status' => 'success'], 201);
        return response()->json(['status'=>'failed','error' => 'impssible de verser un montant plus grand'], 500);
    }
    public function update(Request $request, Compte $compte)
    {
        $validator = \Validator::make($request->all(), [
            'idClient' => 'required',
            'username' => 'required',
            'password' => 'required',
            'solde' => 'required',
            'type' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error'], 500);
        }
    
        try {
            $compte->idClient = $request->input('idClient');
            $compte->username = $request->input('username');
            $compte->password = $request->input('password');
            $compte->solde = $request->input('solde');
            $compte->type = $request->input('type');
            $compte->save();
            return response()->json(['status' => 'success'], 201);
        } catch (Exception $e) {
            return response()->json(['status' => 'failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->get('id');
        $compte= Compte::find($id);
        if($compte) {
            $compte->delete();
            return response()->json(['status' => 'success'], 201);
        }
        return response()->json(['status' => 'failed'],404);
    }
}
