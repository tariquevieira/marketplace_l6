@extends('layouts.app')

@section('content')
@if($unreadNotifcations->count())
<div class="row">
	<div class="col-12">
		<a href="{{route('notification.readall')}}" class="btn btn-lg  btn-success">

		Marcartodas como lidas</a>
	</div>	
</div>
<hr>
@endif
<table class="table table-striped">
	<thead>
		<tr>
			<th>Notificação</th>
			<th>Criado em</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		@forelse($unreadNotifcations as $n)
		<tr>
			<td>{{$n->data['message']}}</td>
			<td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
			<td>
				<div class="btn-group">
					<a href="{{route('notification.read',['notification'=>$n->id])}}" class="btn btn-sm  btn-primary">Marcar como lida</a>
				</div>
			</td>
		</tr>
		@empty
		<div class="alert alert-success">
			Nenhuma notificação
		</div>
		@endforelse
	</tbody>
</table>

@endsection