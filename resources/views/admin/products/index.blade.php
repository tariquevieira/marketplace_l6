@extends('layouts.app')

@section('content')
	
	<a href="{{route('products.create')}}" class="btn btn-lg  btn-success">Criar Produto</a>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Preço</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $p)
			<tr>
				<td>{{$p->id}}</td>
				<td>{{$p->name}}</td>
				<td>R$ {{$p->price}}</td>
				<td>
					<div class="btn-group">
						<a href="{{route('products.edit',['product'=>$p->id])}}" class="btn btn-sm  btn-primary">EDITAR</a>
					<form action="{{route('products.destroy',['product'=>$p->id])}}" method="POST">
						@csrf
						@method("DELETE")
						<button class="btn btn-sm btn-danger">REMOVER</button> 
					</form>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$products->links()}}
@endsection