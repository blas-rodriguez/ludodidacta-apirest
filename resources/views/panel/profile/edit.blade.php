@extends('layouts.app')

@section('section_name')
	Mi perfil!
@endsection

@section('content')
<div class="container">
	<div class="row">
		{{-- Muestro los errores que llegan del formulario --}}
		@include('layouts.components.errors')
		{{--
			IMPORTANTE!

			Nunca olvidarse de especificar el atributo enctype="multipart/form-data" cuando en nuesro formulario tenemos carga de archivos 
		--}}
		<form action="{{route('panel::profile.update')}}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
		    {{-- Email del usuario --}}
		    <div class="form-group">
		      <label for="email">Email</label>
		      <input type="email" name="email" disabled class="form-control" value="{{$profile->email}}" >
		    </div>

		    {{-- Nombre del usuario --}}    
		    <div class="form-group">
		      <label for="name">Nombre</label>
		      <input type="text" name="name" value="{{old('name')?:$profile->name}}" class="form-control">
		    </div>

		    <div class="form-group">
		      <label for="name">Apellido</label>
		      <input type="text" name="lastname" value="{{old('lastname')?:$profile->lastname}}" class="form-control">
		    </div>

			<div class="form-group">
		      <label for="name">Avatar</label>
		      <input type="file" name="avatar" value="" class="form-control">

			  {{-- Si tiene un avatar subido, lo mostramos --}}
		      @if($profile->avatar)
		      	{{-- 
		      		El source de la imagen o de cualqquier ruta que utilicemos
					en nuestro HTML siempre es relativa a la carpeta public. 
		      		Debo prefijarlo con storage porqque el link simbolico se
		      		encuentra en la carpeta public/storage 
		      	--}}
		      	<div style="margin-top:20px; margin-bottom:20px; text-align:center">
		      		<img class="img-responsive img-thumbnail img-rounded" style="max-height:200px" src="storage/{{ $profile->avatar }}">
		      	</div>
	      	  @endif
		    </div>


			{{--
			<div class="alert alert-danger">
		    	Los cambios que hagas pueden tardar de 5 a 10 minutos en actualizarse correctamente!
	    	</div>

	    	--}}

		    <input type="submit" value="Guardar" class="btn btn-info">
	    </form>
    </div>
</div>
@endsection