<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;

class InscricaoController extends Controller
{
    public function resumo()
    {
        return response()->json([
            'total_inscricoes' => Inscricao::count(),
            'inscricoes_confirmadas' => Inscricao::where('status', 'confirmada')->count(),
        ]);
    }
}
