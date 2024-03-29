@extends('layouts.front')

@section('content')

	<div class="row front">
			@foreach($products as $product)
				<div class="col-md-4 front">
					<div class="card" style="width 98%;">
						@if($product->photos->count())
							<img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="foto" class="card-img-top">
						@else
							<img src="{{asset('assets/img/no-photo.jpg')}}" alt=" sem foto" class="card-img-top">
						@endif
						<div class="card-body">
							<h2 class="card-title">{{$product->name}}</h2>
							<p class="card-text">
								{{$product->description}}
							</p>
							<h3>
								R$ {{number_format($product->price,'2',',','.')}}
							</h3>
							<a href="{{route('product.single',['slug'=>$product->slug])}}" class="btn btn-success">Ver Produto</a>
						</div>
					</div>
				</div>
		@endforeach
	</div>
	<div class="row">
		<div class="col-12">
			<h2>Lojas em Destaque</h2>
		</div>
		@foreach($stores as $store)
		<div class="col-md-4-4">
			@if($product->photos->count())
				<img src="{{asset('storage/'.$store->logo)}}" alt="Logo da Loja {{$store->name}}" class="img-fluid">	
			@else
				<img src="https://via.placeholder.com/600X300.png?text=logo" alt="sem logo..." class="img-fluid">
			@endif
			
			<h3>
				{{$store->name}}
			</h3>
			<p>
				{{$store->description}}
			</p>
			<a href="{{route('store.single',['slug' => $store->slug])}}" class="btn btn-success">Ver Loja</a>
		</div>
		@endforeach
	</div>

@endsection