@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between;">
	<h1>Professores</h1>
	<a class="btn btn-info text-white" style="align-self: center; padding: 10px 15px;" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Adicionar</a>
</div>
@include('components.feedback')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Siape</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher)
        <tr>
            <td>{{$teacher->name}}</td>
            <td>{{$teacher->email}}</td>
            <td>{{$teacher->siape}}</td>
            <td><a href="{{ route('teacher.allStudents', $teacher->id) }}" class="btn btn-info text-white">Listar todos alunos</a></td>
            <td><a href="{{ route('teacher.minister', $teacher->id) }}" class="btn btn-secondary text-white">Ministrar disciplina</a></td>
            <td>
                <form action="{{ route('teacher.destroy', $teacher->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Excluir">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($teachers) == 0)
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
				<form action="{{ route('teacher.create') }}" method="post">
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
						<label for="siape" class="form-label">N° do Siape*</label>
						<input type="number" class="form-control" id="siape" name="siape" placeholder="Digite um número do Siape" required>
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
