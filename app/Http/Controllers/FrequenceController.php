<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frequence;

class FrequenceController extends Controller
{
    public function create(Request $request)
    {
        try {
            Frequence::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Criado com sucesso!');
    }
}
