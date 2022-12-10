@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between;">
	<h1>Alunos</h1>
	<a class="btn btn-info text-white" style="align-self: center; padding: 10px 15px;" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Adicionar</a>
</div>
@include('components.feedback')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Matrícula</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->subscription}}</td>
            <td>
                <a href="{{ route('studentdiscipline.index', $student->id) }}" class="btn btn-secondary">Matricular</a>
            </td>
            <td>
                <form action="{{ route('student.destroy', $student->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Excluir">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($students) == 0)
        <tr>
            <td class="text-center" colspan="10">Nenhum resultado encontrado.</td>
        </tr>
        @endif
    </tbody>
</table>

<!-- MODAL -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalToggleLabel">Adicionar aluno(a)</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('student.create') }}" method="post">
					@csrf
					<div class="mb-3">
						<label for="name" class="form-label">Nome*</label>
						<input type="text" class="form-control" id="name" name="name" maxlength="150" placeholder="Digite um nome" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email*</label>
						<input type="email" class="form-control" id="email" name="email" maxlength="150" placeholder="Digite um email" required>
					</div>
					<div class="mb-3">
						<label for="subscription" class="form-label">N° de matrícula*</label>
						<input type="number" class="form-control" id="subscription" name="subscription" placeholder="Digite um número de matrícula" required>
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
