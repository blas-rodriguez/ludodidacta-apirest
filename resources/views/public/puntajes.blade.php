<div class="panel panel-default">
  <div class="panel-heading">
    Puntajes por equipos
  </div>
  <div class="panel-body">

      @if($puntajes->count() > 0)
        {{-- Muestro un listado de posts de todos los usuarios --}}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Equipo</th>
              {{-- <th>juego</th> --}}
              <th>Puntos</th>
            </tr>
          </thead>
          <tbody>
          @foreach($puntajes as $puntaje)
            <tr>
              <td>
                  {{$puntaje->id}} 
              </td>
              <td>{{str_limit($puntaje->name, 45)}} </td>
              <td>{{str_limit($puntaje->puntaje, 45)}} </td>
           </tr>
          @endforeach
      @else
        <div>
          No hay ningun punto aun :(
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
