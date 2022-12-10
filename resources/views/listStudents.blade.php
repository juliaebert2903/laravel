@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between;">
	<h1>Disciplina: {{ $discipline->name }}</h1>
</div>
@include('components.feedback')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th>Frequência</th>
            <th>Média</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{ (100 * ($student->frequence * $discipline->hours)) / $discipline->weight }}% ({{ $student->frequence }}/{{ $discipline->weight / $discipline->hours }}) ({{ ((100 * ($student->frequence * $discipline->hours)) / $discipline->weight) >= 70 ? 'Aprovado' : 'Reprovado' }})</td>
            <td>{{ intval($student->note) }} ({{ (intval($student->note)) >= 7 ? 'Aprovado' : 'Reprovado' }})</td>
            @if ($student->frequence != $discipline->weight / $discipline->hours)
            <td><a class="btn btn-success text-white frequence" data-id="{{ $student->id }}" data-bs-toggle="modal" href="#frequenceModal" role="button">Registrar presença</a></td>
            @else
            <td>Todas presenças registradas</td>
            @endif
            <td><a class="btn btn-success text-white note" data-id="{{ $student->id }}" data-bs-toggle="modal" href="#noteModal" role="button">Registrar nota</a></td>
        </tr>
        @endforeach
        @if (count($students) == 0)
        <tr>
            <td class="text-center" colspan="10">Nenhum resultado encontrado.</td>
        </tr>
        @endif
    </tbody>
</table>

<!-- MODAL FREQUENCE -->
<div class="modal fade" id="frequenceModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalToggleLabel">Adicionar presença</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('frequence.create') }}" method="post">
					@csrf
					<div class="mb-3">
						<label for="date" class="form-label">Data*</label>
						<input type="date" class="form-control" id="date" name="date" placeholder="Digite uma data" required>
					</div>
					<div class="mb-3">
						<input type="number" class="form-control" id="student_id" name="student_id" hidden>
					</div>
					<input type="submit" class="btn btn-success" value="Salvar">
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
<!-- MODAL NOTE -->
<div class="modal fade" id="noteModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalToggleLabel">Adicionar Nota</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('note.create') }}" method="post">
					@csrf
					<div class="mb-3">
						<label for="value" class="form-label">Nota*</label>
						<input type="number" class="form-control" id="value" name="value" placeholder="Digite uma nota" required>
					</div>
					<div class="mb-3">
						<input type="number" class="form-control" id="student_id" name="student_id" hidden>
					</div>
					<input type="submit" class="btn btn-success" value="Salvar">
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script>
    let btns = document.querySelectorAll('.frequence');

    btns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            let input = document.querySelector('#frequenceModal input[type=number]');
            input.value = btn.getAttribute('data-id');
        });
    });

    let btns2 = document.querySelectorAll('.note');

    btns2.forEach(btn => {
        btn.addEventListener('click', (e) => {
            let input = document.querySelector('#noteModal input[type=number]#student_id');
            input.value = btn.getAttribute('data-id');
        });
    });
</script>
@stop
