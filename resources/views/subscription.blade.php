@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between;">
	<h1>Matricular na disciplina: Estudante {{ $student->name }} - Carga horária {{ $weight }} hora(s)</h1>
</div>
@include('components.feedback')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Carga horária</th>
            <th>Responsável</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($disciplines as $discipline)
        <tr>
            <td>{{$discipline->name}}</td>
            <td>{{$discipline->weight}}</td>
            <td>{{$discipline->teacher ?? 'Não possui'}}</td>
            <td>
                @if (in_array($discipline->id, $sd))
                <form action="{{ route('studentdiscipline.destroy', $student->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="text" name="discipline_id" value="{{ $discipline->id }}" hidden>
                    <input type="text" name="student_id" value="{{ $student->id }}" hidden>
                    <input type="submit" class="btn btn-danger" value="X">
                </form>
                @else
                @if ($weight < 50)
                <form action="{{ route('studentdiscipline.create', $student->id) }}" method="post">
                    @csrf
                    <input type="text" name="discipline_id" value="{{ $discipline->id }}" hidden>
                    <input type="text" name="student_id" value="{{ $student->id }}" hidden>
                    <input type="submit" class="btn btn-secondary" value="Matricular-se">
                </form>
                @else
                Carga máxima atingida
                @endif
                @endif
            </td>
        </tr>
        @endforeach
        @if (count($disciplines) == 0)
        <tr>
            <td class="text-center" colspan="10">Nenhum resultado encontrado.</td>
        </tr>
        @endif
    </tbody>
</table>
@stop
