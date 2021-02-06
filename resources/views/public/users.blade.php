<div class="panel panel-default">
  <div class="panel-heading">
    {{-- 

      Saco el texto a un archivo de idioma para que al cambiar el idioma se cambie solo y poder tener los mensajes concentrados en un solo lugar.

      Ideealmente deberia hacer esto mismo con todos los mensajes de la página
    --}}
    {{-- @lang('public.last_users') --}}
    <strong>Usuarios</strong>
  </div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Equipo</th>
          <th>Puntos</th>
        </tr>
      </thead>
      <tbody>
      @if($users->count() > 0)
        {{-- Muestro un listado de posts de todos los usuarios --}}        
        @foreach($users as $user)
        <tr>
          <td>{{$user->id}}</td>
            <td>
              {{-- <a href="#"> --}}
                {{$user->name}}
              {{-- </a> --}}
            </td>
            <td>{{$user->equipo_id}}</td>
            <td>{{$user->puntaje}}</td>
          </tr>
          @endforeach
      @else
      <tr>
        <div>
          No hay usuarios aun :(
        </div>
      </tr>
      <tr>
        <div>
          <s>¿Ejecutaste php artisan migrate --seed?</s>
        </div>
      </tr>
      @endif
    </tbody>
    </table>
  </div>
</div>