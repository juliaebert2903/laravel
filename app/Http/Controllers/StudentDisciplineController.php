<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\StudentDiscipline;
use App\Models\Student;
use DB;

class StudentDisciplineController extends Controller
{
    public function index(Request $request, $id)
    {
        $teacher = DB::raw('(SELECT teacher.name FROM teacher WHERE teacher.id = discipline.teacher_id) AS teacher');
        $disciplines = Discipline::select('discipline.*', $teacher)->orderBy('name', 'asc')->get();
        $student = Student::find($id);
        $sd = StudentDiscipline::where('student_id', $id)->join('discipline', 'discipline_id', '=', 'id')->get();
        $newSD = array();

        $weight = 0;
        foreach ($sd as $s) {
            $weight += $s->weight;
            $newSD[] = $s->discipline_id;
        }

        return view('subscription', ['disciplines' => $disciplines, 'student' => $student, 'sd' => $newSD, 'weight' => $weight]);
    }

    public function create(Request $request)
    {
        $minister = DB::raw('(SELECT SUM(discipline.weight) FROM discipline, student_discipline WHERE discipline.id = student_discipline.discipline_id AND student_discipline.student_id = student.id) AS weight');
        $student = Student::select($minister)->where('id', $request->input('student_id'))->orderBy('name', 'asc')->first();

        $discipline = Discipline::find($request->input('discipline_id'));

        if (($student->weight + $discipline->weight) > 50) {
            return redirect()->back()->with('error', 'Carga horária ultrapassa limite de 50 horas!');
        }

        try {
            StudentDiscipline::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Criado com sucesso!');
    }

    public function destroy(Request $request)
    {
        StudentDiscipline::where('student_id', $request->input('student_id'))->where('discipline_id', $request->input('discipline_id'))->delete();
        return redirect()->back()->with('success', 'Deletado com sucesso!');
    }

    public function listStudents($id)
    {
        $frequence = DB::raw('(SELECT COUNT(*) FROM frequences WHERE frequences.student_id = student_discipline.student_id) AS frequence');
        $note = DB::raw('(SELECT SUM(value)/COUNT(*) FROM `notes` WHERE notes.student_id = student_discipline.student_id) AS note');
        $discipline = Discipline::find($id);
        $students = StudentDiscipline::select('student_discipline.*', 'student.*', $frequence, $note)->where('discipline_id', $id)->join('student', 'student_id', '=', 'student.id')->orderBy('note', 'desc')->get();

        return view('listStudents', ['discipline' => $discipline, 'students' => $students]);
    }
}
