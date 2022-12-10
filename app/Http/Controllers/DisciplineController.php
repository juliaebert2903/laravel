<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use DB;

class DisciplineController extends Controller
{
    public function index()
    {
        $teacher = DB::raw('(SELECT teacher.name FROM teacher WHERE teacher.id = discipline.teacher_id) AS teacher');
        $disciplines = Discipline::select('discipline.*', $teacher)->orderBy('name', 'asc')->get();
        return view('discipline', ['disciplines' => $disciplines]);
    }

    public function create(Request $request)
    {
        try {
            Discipline::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        try {
            Discipline::find($id)->update($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Discipline::find($id)->delete();
        return redirect()->back()->with('success', 'Deletado com sucesso!');
    }
}
