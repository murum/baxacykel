@section('content')
<div class="row my-quarter">
  <div class="col-xs-12">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#quarter-start" data-toggle="tab">Start</a>
      </li>
      <li>
        <a href="#quarter-vehicle" data-toggle="tab">Fordon</a>
      </li>
      <li>
        <a href="#quarter-garage" data-toggle="tab">Garage</a>
      </li>
      <li>
        <a href="#quarter-storage" data-toggle="tab">Lager</a>
      </li>
      <li>
        <a href="#quarter-factories" data-toggle="tab">Fabriker</a>
      </li>
    </ul>
    <div class="quarter-content">
      <div class="row">
        <div class="col-xs-12">
          <!-- Tab panes -->
          <div class="tab-content">






            {{-- TAB PANE QUARTER START--}}
            <div class="tab-pane active" id="quarter-start">
              <p class="lead">
                I ditt kvarter kan du göra följande
                <ul class="lead">
                  <li>Kika in ditt fordon</li>
                  <li>Kika in ditt garage</li>
                  <li>Kika in ditt lager</li>
                  <li>Kika in dina fabriker</li>
                  <li>Lasta över varor från lagret till ditt fordon</li>
                  <li>Tömma dina fabriker till lagret</li>
                  <li>Uppgradera dina fabriker</li>
                  <li>Uppgradera ditt fordon</li>
                  <li>Bygga ut garaget</li>
                </ul>
              </p>
            </div>






            {{-- TAB PANE --}}
            <div class="tab-pane" id="quarter-vehicle">
              <div class="row">

                {{-- Nuvarande fordon --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <h3>Nuvarande fordon</h3>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <h4>{{ $current_vehicle->name }}</h4>
                      </div>
                    </div>
                    <div class="panel-body">
                      <span class="label label-info max-bikes">
                        Fordonet har plats för {{ number_format($current_vehicle->size, '0', '.', '.') }} varor
                      </span>
                      <span class="label label-success">
                        Värde {{ number_format($current_vehicle->price, '0', '.', '.') }} kr
                      </span>
                    </div>
                  </div>
                </div>

                {{-- Rekommenderat fordon --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <h3>Rekomenderat fordon</h3>
                  @if(!$user->getRecommendedVehicle() || $user->getRecommendedVehicle()->id == $current_garage->id)
                    <p>
                      Du har inte råd eller har inte rätt level något bättre fordon än det du redan har, baxa och sälj lite cyklar så ska du se att det snart kommer ett rekommenderat fordon.
                    </p>
                  @else
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <h4>{{ $user->getRecommendedVehicle()->name }}</h4>
                        </div>
                      </div>
                      <div class="panel-body">
                        <span class="label label-info max-bikes">
                          Fordonet har plats för {{ number_format($user->getRecommendedVehicle()->size, '0', '.', '.') }} varor
                        </span>
                        <span class="label label-danger">
                          Kostnad {{ number_format($user->getRecommendedVehicle()->price, '0', '.', '.') }} kr
                        </span>
                      </div>
                      <div class="panel-footer">
                        <form action="{{ action('QuarterController@postBuyVehicle') }}" method="post">
                          {{ Form::token() }}
                          <input type="hidden" name="vehicle_id" value="{{ $user->getRecommendedVehicle()->id }}">
                          <button type="submit" class="btn btn-thin btn-block btn-lg btn-success">Köp fordonet</button>
                        </form>
                      </div>
                    </div>
                  @endif
                </div>

                  {{-- Kommande fordon --}}
                  <div class="col-xs-12">
                    <h3>Kommande fordon</h3>
                  </div>
                  @foreach($user->getComingVehicles() as $vehicle)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <h4>{{ $vehicle->name }}</h4>
                          </div>
                        </div>
                        <div class="panel-body">
                          <span class="label label-info max-items">
                            Fordonet har plats för {{ number_format($vehicle->size, '0', '.', '.') }} varor
                          </span>
                          <span class="label label-danger">
                            Kostnad {{ number_format($vehicle->price, '0', '.', '.') }} kr
                          </span>
                          <div class="row">
                            <div class="col-xs-12 margin-label">
                              @if($user->level > $vehicle->required_level)
                                <span class="label label-success">
                              @else
                                <span class="label label-danger">
                              @endif
                                Level: {{ number_format($vehicle->required_level, '0', '.', '.') }}
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="panel-footer">
                          <form action="{{ action('QuarterController@postBuyVehicle') }}" method="post">
                            {{ Form::token() }}
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                            @if($user->money >= $vehicle->price && $user->level >= $vehicle->required_level)
                              <button type="submit" class="btn btn-thin btn-block btn-lg btn-success">Köp fordonet</button>
                            @elseif($user->level < $vehicle->required_level)
                              <button type="submit" class="btn btn-thin btn-block btn-lg btn-danger disabled">För låg level</button>
                            @else
                              <button type="submit" class="btn btn-thin btn-block btn-lg btn-danger disabled">Du har inte råd</button>
                            @endif
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
              </div>
            </div>






            {{-- TAB PANE --}}
            <div class="tab-pane" id="quarter-garage">
              <div class="row">

                {{-- Nuvarande garage --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <h3>Nuvarande garage</h3>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <h4>{{ $current_garage->name }}</h4>
                      </div>
                    </div>
                    <div class="panel-body">
                      <span class="label label-info max-bikes">
                        Garaget har utrymme för {{ number_format($current_garage->size, '0', '.', '.') }} cyklar
                      </span>
                      <span class="label label-success">
                        Värde {{ number_format($current_garage->price, '0', '.', '.') }} kr
                      </span>
                    </div>
                  </div>
                </div>

                {{-- Rekommenderat garage --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <h3>Rekomenderat garage</h3>
                  @if(!$user->getRecommendedGarage() || $user->getRecommendedGarage()->id == $current_garage->id)
                    <p>
                      Du har inte råd med något bättre garage än det du redan har, baxa och sälj lite cyklar så ska du se att det snart kommer ett rekommenderat garage.
                    </p>
                  @else
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <h4>{{ $user->getRecommendedGarage()->name }}</h4>
                        </div>
                      </div>
                      <div class="panel-body">
                        <span class="label label-info max-bikes">
                          Garaget har utrymme för {{ number_format($user->getRecommendedGarage()->size, '0', '.', '.') }} cyklar
                        </span>
                        <span class="label label-danger">
                          Kostnad {{ number_format($user->getRecommendedGarage()->price, '0', '.', '.') }} kr
                        </span>
                      </div>
                      <div class="panel-footer">
                        <form action="{{ action('QuarterController@postBuyGarage') }}" method="post">
                          {{ Form::token() }}
                          <input type="hidden" name="garage_id" value="{{ $user->getRecommendedGarage()->id }}">
                          <button type="submit" class="btn btn-thin btn-block btn-lg btn-success">Köp garage</button>
                        </form>
                      </div>
                    </div>
                  @endif
                </div>

                  {{-- Kommande garage --}}
                  <div class="col-xs-12">
                    <h3>Kommande garage</h3>
                  </div>
                  @foreach($user->getComingGarages() as $garage)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <h4>{{ $garage->name }}</h4>
                          </div>
                        </div>
                        <div class="panel-body">
                          <span class="label label-info max-bikes">
                            Garaget har utrymme för {{ number_format($garage->size, '0', '.', '.') }} cyklar
                          </span>
                          <span class="label label-danger">
                            Kostnad {{ number_format($garage->price, '0', '.', '.') }} kr
                          </span>
                        </div>
                        <div class="panel-footer">
                          <form action="{{ action('QuarterController@postBuyGarage') }}" method="post">
                            {{ Form::token() }}
                            <input type="hidden" name="garage_id" value="{{ $garage->id }}">
                            @if($user->money >= $garage->price)
                              <button type="submit" class="btn btn-thin btn-block btn-lg btn-success">Köp garaget</button>
                            @else
                              <button type="submit" class="btn btn-thin btn-block btn-lg btn-danger disabled">Du har inte råd</button>
                            @endif
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
              </div>
            </div>






            {{-- TAB PANE --}}
            <div class="tab-pane" id="quarter-storage">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="panel-title">
                    <h4>Ditt lager</h4>
                  </div>
                </div>
                <div class="panel-body">
                  <table class="table">
                    <colgroup>
                      <col class="col-xs-3">
                      <col class="col-xs-2">
                      <col class="col-xs-2">
                      <col class="col-xs-5">
                    </colgroup>
                    <thead>
                      <tr>
                        <th>Vara</th>
                        <th>I lager</th>
                        <th>I fordonet</th>
                        <th>Lasta</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach(Auth::user()->items()->get() as $item)
                        <tr>
                          <td>{{$item->name}}</td>
                          <td class="amount-storage">{{$item->pivot->in_storage}}</td>
                          <td class="amount-storage">{{$item->pivot->in_vehicle}}</td>
                          <td class="storage-form">
                            <form action="{{ action('QuarterController@postStorage')}}" method="post">
                              {{Form::token()}}
                              <input type="hidden" value="{{$item->id}}" name="item_id">
                              <div class="row">
                                <div class="pull-left col-xs-6">
                                  <input type="text" class="form-control amount-input" name="amount">
                                </div>
                                <div class="pull-right">
                                  <input type="submit" name="action-storage" class="btn btn-sm btn-danger" value="Lasta av" />
                                </div>
                                <div class="pull-right">
                                  <input type="submit" name="action-vehicle" class="btn btn-sm btn-success" value="Lasta på" />
                                </div>
                              </div>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>






            {{-- TAB PANE --}}
            <div class="tab-pane" id="quarter-factories">
              <div class="row">
                <div class="col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <h4>Aktiva fabriker</h4>
                      </div>
                    </div>
                    <div class="panel-body">
                      <table class="table table-striped">
                        <colgroup>
                          <col class="col-xs-1">
                          <col class="col-xs-2">
                          <col class="col-xs-2">
                          <col class="col-xs-1">
                          <col class="col-xs-2">
                          <col class="col-xs-4">
                        </colgroup>
                        <thead>
                          <tr>
                            <th></th>
                            <th>Fabrik</th>
                            <th>Varor i fabrik</th>
                            <th>Nivå</th>
                            <th>Hämta varor</th>
                            <th>Uppgradera</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($user->getActiveFactories() as $factory_user)
                            <tr>
                              <td>
                                <form method="post" class="inactivate-factory" action="{{ action('FactoryController@postInactivateFactory')}}">
                                  {{Form::token()}}
                                  <input type="hidden" name="factory_user" value="{{$factory_user->id}}">
                                  <input type="submit" class="btn btn-xs btn-danger" name="inactivate-factory" value="X">
                                </form>
                              </td>
                              <td>{{$factory_user->factory->name}}</td>
                              <td>{{$factory_user->getFactoryLoad() }}</td>
                              <td>{{$factory_user->upgrade }}</td>
                              <td>
                                <form method="post" action="{{ action('FactoryController@postDeliveryFactory')}}">
                                  {{Form::token()}}
                                  <input type="hidden" name="factory_user" value="{{$factory_user->id}}">
                                  <input type="submit" class="btn btn-xs btn-success" name="delivery-factory" value="Hämta">
                                </form>
                              </td>
                              <td>
                                <span class="label label-danger">
                                  {{ number_format($factory_user->getUpgradePrice(), '0', '.', '.') }}kr
                                </span>
                                <div class="pull-right">
                                  <form method="post" action="{{ action('FactoryController@postUpgradeFactory')}}">
                                    {{Form::token()}}
                                    <input type="hidden" name="factory_user" value="{{$factory_user->id}}">
                                    <input type="submit" class="btn btn-xs btn-success" name="upgrade-factory" value="Uppgradera">
                                  </form>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <h4>Inaktiva fabriker</h4>
                      </div>
                    </div>
                    <div class="panel-body">
                      <table class="table table-bordered table-striped">
                        <colgroup>
                          <col class="col-xs-3">
                          <col class="col-xs-2">
                          <col class="col-xs-3">
                        </colgroup>
                        <thead>
                          <tr>
                            <th>Fabrik</th>
                            <th>Aktivera</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($user->getInactiveFactories() as $factory_user)
                            <tr>
                              <td>{{$factory_user->factory->name}}</td>
                              <td>
                                <span class="label label-danger">
                                  {{ number_format($factory_user->getActivatePrice(), '0', '.', '.') }}kr
                                </span>
                                <div class="pull-right">
                                  <form method="post" action="{{ action('FactoryController@postActivateFactory')}}">
                                    {{Form::token()}}
                                    <input type="hidden" name="factory_user" value="{{$factory_user->id}}">
                                    <input type="submit" class="btn btn-xs btn-success" name="activate-factory" value="Aktivera">
                                  </form>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>






            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop