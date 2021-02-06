<div class="panel panel-default">
  <div class="panel-heading">
    Equipos
  </div>
  <div class="panel-body">

      @if($posts->count() > 0)
        {{-- Muestro un listado de posts de todos los usuarios --}}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Equipo</th>
              <th>Puntos</th>
            </tr>
          </thead>
          <tbody>
          @foreach($Equipos as $Equipo)
            <tr>
              <td>
                {{-- <a href="#"> --}}
                  {{str_limit($Equipo->name, 45)}} 
                  {{-- ({{$post->user->name}}) --}}
                {{-- </a> --}}
              </td>
              <td></td>
           </tr>
          @endforeach
      @else
        <div>
          No hay ningun post aun :(
        </div>

        <div>
          <img src="{{asset('img/sorry.jpg')}}" style="max-width:100%; max-height:100%">
        </div>

        <div>
          <s>¿Ejecutaste php artisan migrate --seed?</s>
        </div>
      @endif
    </tbody>
  </table>
  </div>
</div>
