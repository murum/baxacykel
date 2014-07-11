@section('content')
    <div class="jumbotron text-center startpage">
        <h1>Gå med i Klubb</h1>

        <p class="lead">Här kommer lite info om klubb</p>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>Klubbar</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="clubs">
                        @foreach ($clubs as $club)
                            <?php 
                                $club_money = 0;
                                $club_level = 0;

                                foreach ($club->users()->get() as $user) :
                                    if($user->pivot->approved == 1 ) {
                                        $club_money += $user->money;
                                        $club_level += $user->level;
                                    }
                                endforeach;
                            ?>
                            <li>
                                <a href="{{ url('klubb/'.$club->id) }}">{{$club->name}}</a> - {{ number_format($club_money, '0', '.', '.') }}kr - {{$club_level}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>Skapa klubb</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <p>Observera att det kostar 10.000.000kr att skapa en klubb.</p>
                    <form role="form" action="{{ url('klubb/skapa') }}" method="post">

                        {{ Form::token() }}

                        <div class="form-group">
                            <label for="title">Namn</label>
                            <input type="text" name="name" value="" class="form-control">
                        </div>

                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Skapa klubb">        
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop