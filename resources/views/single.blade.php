@extends('layouts.front')

@section('content')

	<div class="row">
		<div class="col-6">
			@if($product->photos->count())
				<img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="foto" class="card-img-top">
				<div class="row">
					@foreach($product->photos as $photo)
						<div class="col-4" style="margin-top: 20px;">
							<img src="{{asset('storage/'.$photo->image)}}" alt="foto" class="card-img-top">	
						</div>
					
					@endforeach
				</div>
			@else
				<img src="{{asset('assets/img/no-photo.jpg')}}" alt=" sem foto" class="card-img-top">
			@endif
		</div>
		<div class="col-6">
				<div class="col-md-12">
					<h2>
						{{$product->name}}
					</h2>
					<p>
						Descrição: {{$product->description}}
					</p>
					 <h3>
						R$ {{number_format($product->price,'2',',','.')}}
					</h3>
						
					<span>
						Loja: {{$product->store->name}}
					</span>	
				</div>
				<div class="product-add col-md-12">

					<form action="{{route('cart.add')}}" method="post" >
						@csrf
						<input type="hidden" name="product[name]" value="{{$product->name}}">
						<input type="hidden" name="product[price]" value="{{$product->price}}">
						<input type="hidden" name="product[slug]" value="{{$product->slug}}">
						<div class="form-group">
							<label>Quantidade: </label>
							<input type="number" name="product[amount]" class="form-control col-md-2" value="1">
						</div>
						
						
						<button class="btn btn-lg btn-danger">Comprar</button>
							
					</form>
						
				</div>
				
			</div>
	</div>
	<div class="row">
			<div class="col-12">
				<hr>
				{{$product->body}}
			</div>
			
	</div>


@endsection