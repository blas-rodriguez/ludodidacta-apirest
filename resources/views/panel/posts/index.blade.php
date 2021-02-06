@extends('layouts.app')

@section('section_name')
	Mis posts!
@endsection

@section('content')
<div class="container">
	<div class="row">
		@if($posts->count() > 0)
			<div class="posts">
				<h3>Tenés {{ $posts->count() }} posts!</h3>
				
				<ul>
					@foreach($posts as $post)
					  <li>
					    {{$post->title}}
					  </li>
					@endforeach
				</ul>
			
				<hr/>
				<a href="#" class="btn btn-default">Crear post!</a>
			</div>              
		@else
			<div class="alert alert-danger">
				Todavia no tenes ningún post :(
			</div>

			<a href="#" class="btn btn-default">Crealo ya!</a>
		@endif
	</div>
</div>
@endsection