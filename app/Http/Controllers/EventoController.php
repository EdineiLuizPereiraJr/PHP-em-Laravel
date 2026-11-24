<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        return response()->json(Evento::all());
    }

    public function store(Request $request)
    {
        $evento = Evento::create($request->all());

        return response()->json($evento, 201);
    }
}
