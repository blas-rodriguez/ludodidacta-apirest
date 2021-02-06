@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    
    {{-- <div class="col-xs-12 col-md-6">
      @include('public.posts')
    </div> --}}
    <div class="col-xs-12 col-md-6">
      @include('public.puntajes')
    </div>
  
    {{-- 
      En caso de que el usuario no esté logueado muestro el formulario de login 

      Para cheuqear que un usuario esté logueado utilizamos Auth::check()
    --}}
    @if(Auth::guest())
      <div class="col-md-6 hidden-sm">
        @include('auth.components.login')
      </div>  
      <div class="clearfix"></div>
    @endif
    <div class="col-xs-12 col-md-6">
      @include('public.juegos')
    </div>
    <div class="col-xs-12 col-md-6">
      @include('public.users')
    </div>
  </div>
@endsection
