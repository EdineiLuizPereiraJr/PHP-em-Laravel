<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index()
    {
        return response()->json(Participante::all());
    }

    public function store(Request $request)
    {
        $participante = Participante::create($request->all());

        return response()->json($participante, 201);
    }
}
