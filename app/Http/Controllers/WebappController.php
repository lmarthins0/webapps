<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebappRequest;
use App\Models\Webapp;
use Illuminate\Http\Client\RequestException;

class WebappController extends Controller
{
    public function index(){
        $webapps = Webapp::all();
        return view('webapps.index', ['webapps' => $webapps]);
    }
    
    public function show(Webapp $webapp){
        return view('webapps.show', ['webapp' => $webapp]);
    }

    public function create(Webapp $webapp){
        return view('webapps.create', ['webapp' => $webapp]);
    }


    public function store(WebappRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $validated['dominio'] = $validated['dominio'] . '.fflch.usp.br';

        $webapp = Webapp::create($validated);

        
        session()->flash('alert-success','Solicitação enviada com sucesso. Aguarde a análise de um administrador');
        return redirect('/');
    }
}
