<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Discipline;
use App\Models\StudentDiscipline;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('name', 'asc')->get();
        return view('teacher', ['teachers' => $teachers]);
    }

    public function create(Request $request)
    {
        try {
            Teacher::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Criado com sucesso!');
    }

    public function destroy($id)
    {
        Teacher::find($id)->delete();
        return redirect()->back()->with('success', 'Deletado com sucesso!');
    }

    public function minister($id)
    {
        $teacher = Teacher::find($id);
        $disciplines = Discipline::where('teacher_id', null)->orWhere('teacher_id', $id)->orderBy('name', 'asc')->get();
        return view('minister', ['disciplines' => $disciplines, 'teacher' => $teacher]);
    }

    public function allStudents($id)
    {
        $students = StudentDiscipline::select('student.*')->where('discipline.teacher_id', $id)->join('student', 'student_discipline.student_id', '=', 'student.id')->join('discipline', 'student_discipline.discipline_id', '=', 'discipline.id')->orderBy('student.name', 'asc')->get();
        return view('allStudents', ['students' => $students]);
    }
}
