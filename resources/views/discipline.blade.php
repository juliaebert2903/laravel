@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between;">
	<h1>Disciplinas</h1>
	<a class="btn btn-info text-white" style="align-self: center; padding: 10px 15px;" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Adicionar</a>
</div>
@include('components.feedback')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Carga horária</th>
            <th>Hora por aula</th>
            <th>Responsável</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($disciplines as $discipline)
        <tr>
            <td>{{$discipline->name}}</td>
            <td>{{$discipline->weight}}</td>
            <td>{{$discipline->hours}} hora(s)</td>
            <td>{{$discipline->teacher ?? 'Não possui'}}</td>
            <td><a href="{{ route('discipline.listStudents', $discipline->id) }}" class="btn btn-info text-white">Ver alunos</a></td>
            <td>
                <form action="{{ route('discipline.destroy', $discipline->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Excluir">
                </form>
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

<!-- MODAL -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalToggleLabel">Adicionar disciplina</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('discipline.create') }}" method="post">
					@csrf
					<div class="mb-3">
						<label for="name" class="form-label">Nome*</label>
						<input type="text" class="form-control" id="name" name="name" maxlength="150" placeholder="Digite um nome" required>
					</div>
					<div class="mb-3">
						<label for="weight" class="form-label">Carga horária*</label>
						<input type="number" class="form-control" id="weight" name="weight" placeholder="Digite a carga horária" required>
					</div>
					<div class="mb-3">
						<label for="hours" class="form-label">Hora por aula*</label>
						<input type="number" class="form-control" id="hours" name="hours" placeholder="Digite o número de horas por aula" required>
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
