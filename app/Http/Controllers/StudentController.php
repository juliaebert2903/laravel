<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::orderBy('name', 'asc')->get();
        return view('student', ['students' => $students]);
    }

    public function create(Request $request)
    {
        try {
            Student::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Criado com sucesso!');
    }

    public function destroy($id)
    {
        Student::find($id)->delete();
        return redirect()->back()->with('success', 'Deletado com sucesso!');
    }
}
