<!DOCTYPE html>
<html>
<head>
	<title>Marketplace L6</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">
    <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     @auth
     <ul class="navbar-nav mr-auto">
      <li class="nav-item @if(request()->is('admin/orders*'))active @endif">
        <a class="nav-link" href="{{route('orders.my')}}">Meus Pedidos</a>
      </li>
      <li class="nav-item @if(request()->is('admin/stores*'))active @endif">
        <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item  @if(request()->is('admin/products*'))active @endif" >
        <a class="nav-link" href="{{route('products.index')}}">Produtos</a>
      </li>
      <li class="nav-item  @if(request()->is('admin/categories*'))active @endif" >
        <a class="nav-link" href="{{route('categories.index')}}">Categorias</a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
    	<ul class="navbar-nav mr-auto">
        <li class="nav-item  @if(request()->is('admin/notificatio*'))active @endif" >

          <a class="nav-link" href="{{route('notification.index')}}">
            <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
            <i class="fa fa-bell"></i> 
            Notificações
          </a>

        </li>
        <li class="nav-item">
          <span class="nav-link">{{auth()->user()->name}}</span>
        </li>
        <li class="nav-item active">
         <a class="nav-link" href="#" onclick="document.querySelector('form.logout').submit();">Sair</a>
         <form action="{{route('logout')}}" class="logout" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
      
    </ul>
    @endauth
  </div>

</div>
</nav>
<div class="container">
  @include('flash::message')
  @yield('content')
</div>
<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')
</body>
</html>