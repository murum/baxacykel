@section('content')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          <h3>Din hemstad</h3>
        </div>
      </div>
      <div class="panel-body">
        <p class="lead">Ditt kvarter finns i {{Auth::user()->town->name}}</p>
        <ul class="towns">
          @foreach ($towns as $town)
            @if($town->id == Auth::user()->town_id)
              <form action="{{ action('TravelController@postTravel') }}" method="post">
                {{ Form::token() }}
                <input type="hidden" name="town_id" value="{{ $town->id }}">
                @if($town->id == Auth::user()->current_town)
                  <button type="submit" class="disabled btn btn-thin btn-block btn-lg btn-info">I hemstaden {{$town->name}}</button>
                @else
                  <button type="submit" class="btn btn-thin btn-block btn-lg btn-info">Res hem</button>
                @endif
              </form>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          <h3>Vart vill du resa?</h3>
        </div>
      </div>
      <div class="panel-body">
        <ul class="towns">
          @foreach ($towns as $town)
            <form action="{{ action('TravelController@postTravel') }}" method="post">
              {{ Form::token() }}
              <input type="hidden" name="town_id" value="{{ $town->id }}">
              @if($town->id == Auth::user()->current_town)
                <button type="submit" class="disabled btn btn-thin btn-block btn-lg btn-info">Du är i {{$town->name}}</button>
              @else
                <button type="submit" class="btn btn-thin btn-block btn-lg btn-info">Res till {{$town->name}}</button>
              @endif
            </form>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

@stop