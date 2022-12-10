@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between;">
	<h1>Ministrar disciplina: prof. {{ $teacher->name }}</h1>
</div>
@include('components.feedback')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Carga horária</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($disciplines as $discipline)
        <tr>
            <td>{{$discipline->name}}</td>
            <td>{{$discipline->weight}}</td>
            <td>
                @if ($discipline->teacher_id == $teacher->id)
                <form action="{{ route('discipline.update', $discipline->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" name="teacher_id" value="{{ NULL }}" hidden>
                    <input type="submit" class="btn btn-danger" value="X">
                </form>
                @else
                <form action="{{ route('discipline.update', $discipline->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" name="teacher_id" value="{{ $teacher->id }}" hidden>
                    <input type="submit" class="btn btn-secondary" value="Ministrar disciplina">
                </form>
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
