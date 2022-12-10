@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between;">
	<h1>Lista de todos alunos</h1>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Matrícula</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->subscription}}</td>
        </tr>
        @endforeach
        @if (count($students) == 0)
        <tr>
            <td class="text-center" colspan="10">Nenhum resultado encontrado.</td>
        </tr>
        @endif
    </tbody>
</table>
@stop
