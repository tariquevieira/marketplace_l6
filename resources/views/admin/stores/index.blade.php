@extends('layouts.app')

@section('content')
	@if(!$store)
	<a href="/admin/stores/create" class="btn btn-lg  btn-success">Criar Loja</a>
	@else
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Loja</th>
				<th>Quantidade de produtos</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<td>{{$store->id}}</td>
				<td>{{$store->name}}</td>
				<td>{{$store->products->count()}}</td>
				<td>
					<a href="{{route('admin.stores.edit',['store'=>$store->id])}}" class="btn btn-sm  btn-primary">EDITAR</a>
					<a href="{{route('admin.stores.destroy',['store'=>$store->id])}}" class="btn btn-sm btn-danger">REMOVER</a>
				</td>
			</tr>
			
		</tbody>
	</table>
	@endif
@endsection