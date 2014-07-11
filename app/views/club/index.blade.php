<?php $any_pending_users = false; ?>
@section('content')
    <div class="jumbotron text-center">
        <h2>Välkommen till klubben {{ $club->name }}</h2>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>Medlemmar</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="club-members">
                        @foreach ($club->users()->get() as $user)
                            @if($user->pivot->approved == 1)
                                <li>
                                    @if($user->id == Auth::user()->id || $is_owner)
                                        @if($user->id != $club->owner)
                                            <a class="pull-right btn btn-sm btn-danger" href="{{ url('klubb/lamna/' . $user->id) }}">&times;</a>
                                        @endif
                                    @endif
                                    <a class="club-member" href="{{ url('anvandare/' . $user->id) }}">{{ $user->username }}</a>
                                </li>
                            @endif 
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>Klubbinformation</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Ägare</strong>: {{ $club->user->username }}
                    </p>

                    @if ($club->description)
                        <p>{{ $club->description }}</p>
                    @else
                        <p>Den här klubben har ingen beskrivning ännu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($is_member)
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>Väntande medlemsansökningar</h3>
                    </div>
                </div>
                <div class="panel-body"> 
                    @foreach ($club->users()->get() as $user)
                        @if($user->pivot->approved == 0)
                            <?php $any_pending_users = true; ?>
                        @endif
                    @endforeach

                    @if(!$any_pending_users)
                        <p>Inga väntande medlemsansökningar just nu...</p>
                    @else
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th colspan='3'>Användare</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($club->users()->get() as $user)
                                    @if($user->pivot->approved == 0)
                                        <tr>
                                            @if($club->user->id == Auth::user()->id)
                                                <td>{{ $user->username }}</td>
                                                <td class="text-right">
                                                    <form class="pull-right" method="post" action="{{ action('ClubController@declineUser') }}">
                                                        {{ Form::token() }}
                                                        <input type="hidden" name="user" value="{{$user->pivot->id}}">
                                                        <button type="submit" class="btn btn-sm btn-danger">Neka</button>
                                                    </form>

                                                     <form class="pull-right" method="post" action="{{ action('ClubController@acceptUser') }}">
                                                        {{ Form::token() }}
                                                        <input type="hidden" name="user" value="{{$user->pivot->id}}">
                                                        <button type="submit" class="btn btn-sm btn-success">Accpetera</button>
                                                    </form>

                                                </td>
                                            @else
                                                <td colspan="3">{{ $user->username }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>Klubbchatt</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach ($club->messages()->orderBy('id', 'desc')->take(10)->get() as $message)
                            <div class="col-xs-12">
                                <p>{{ nl2br(e($message->message)) }}</p>
                                <span class="label label-default">
                                    Skrivet av {{ $message->user->username }}
                                    -
                                    {{ $message->get_message_time() }}
                                </span>
                                <hr />
                            </div>
                        @endforeach
                    </div>
                    <form method="post" action="{{action('ClubController@postClubMessage')}}">
                        {{ Form::token() }}
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="club-message-input">Chatmeddelande</label>
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea type="text" id="club-message-input" class="form-control" name="message"></textarea>
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="submit" class="btn btn-block btn-success" value="Skicka" name="club-chat-submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else 
            @if( !$is_appling)
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>Ansök till klubben</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <a class="btn btn-sm btn-block btn-success" href="{{ url('klubb/ansok/'.$club->id) }}">
                                Ansök till klubben
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @if($is_owner)
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>Ta bort klubb</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="{{ action('ClubController@deleteClub') }}">
                                <button type="submit" class="btn btn-block btn-danger">Riv upp klubben</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>Ändra beskrivning</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="{{ action('ClubController@saveDescription') }}"> 
                                <div class="form-group">
                                    <label for="description">Klubbeskrivning</label>
                                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-block btn-success">Spara</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop