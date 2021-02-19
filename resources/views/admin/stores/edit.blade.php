@extends('layouts.app')

@section('content')
	<h1>Atualizar Loja</h1>
	<form action="/admin/stores/update/{{$store->id}}" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="form-group">
			<label>
				Loja
			</label>
			<input type="text" name="name" class="form-control" value="{{$store->name}}">
		</div class="form-group">
		<div>
			<label>
				Descrição
			</label>
			<input type="text" name="description" class="form-control" value="{{$store->description}}">
		</div>
		<div class="form-group">
			<label>
				Telefone
			</label>
			<input type="text" name="phone" class="form-control" value="{{$store->phone}}">
		</div>
		<div class="form-group">
			<label>
				Celular
			</label>
			<input type="text" name="mobile_phone" class="form-control" value="{{$store->mobile_phone}}">
		</div class="form-group">
		<div class="form-group">
			<p>
				<img src="{{asset('storage/'.$store->logo)}}">
			</p>
            <label>Fotos do Produto</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
             @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
		<div class="form-group">
			<label>
				Slug
			</label>
			<input type="text" name="slug" class="form-control" value="{{$store->slug}}">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-lg btn-success">Atualizar</button>
		</div>
		

	</form>

@endsection