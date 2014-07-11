@section('content')
<div class="row pedal-tabs">
  <div class="col-xs-12">
    <header>
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#shop-start" data-toggle="tab">Start</a>
        </li>
        <li>
          <a href="#shop-buy" data-toggle="tab">Köp</a>
        </li>
        <li>
          <a href="#shop-spend" data-toggle="tab">Spendera</a>
        </li>
      </ul>
    </header>
    <div class="information">
      <div class="row">
        <div class="col-xs-12">
          <!-- Tab panes -->
          <div class="tab-content">

            {{-- TAB PANE --}}
            <div class="tab-pane active" id="shop-start">
              <p class="lead">i BaxaCykel finns det två olika valutor, den ena är stålar och den andra är pedaler...</p>

              <p>Stålar som du kanske redan har märkt tjänar man när man baxar och säljer cyklar, men vad är då pedaler?</p>

              <p>Pedaler är en valuta du kan köpa för att investera i ditt spelandet, du kan köpa olika fördelar eller vår Premium tjänst. Fördelarna är inte avgörande för spelets utgång, utan det är bara en hjälp på traven, det går alldeles utmärkt att spela utan dem med.</p>
            </div>
          
            {{-- TAB PANE --}}
            <div class="tab-pane" id="shop-buy">
              <h2>Köp pedaler</h2>
              <h3>Paypal</h3>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="AFRGTUBEHVVQ6">
                <table>
                <tr><td><input type="hidden" name="on0" value="Pedaler">Pedaler</td></tr><tr><td><select name="os0">
                  <option value="10 Pedaler">10 Pedaler 8,00 SEK</option>
                  <option value="25 Pedaler">25 Pedaler 15,00 SEK</option>
                  <option value="50 Pedaler">50 Pedaler 25,00 SEK</option>
                  <option value="100 Pedaler">100 Pedaler 45,00 SEK</option>
                  <option value="250 Pedaler">250 Pedaler 100,00 SEK</option>
                  <option value="550 Pedaler">550 Pedaler 200,00 SEK</option>
                  <option value="1000 Pedaler">1000 Pedaler 300,00 SEK</option>
                </select> </td></tr>
                </table>
                <input type="hidden" name="currency_code" value="SEK">
                <input type="hidden" name="custom" value='{{json_encode(array("user_id" => Auth::user()->id))}}'>
                <input type="image" src="https://www.paypalobjects.com/sv_SE/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="PayPal – ett tryggt och smidigt sätt att betala på nätet!">
                <img alt="" border="0" src="https://www.paypalobjects.com/sv_SE/i/scr/pixel.gif" width="1" height="1">
              </form>


              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="ZYKVMDM33DB9Q">
                <table>
                <tr><td><input type="hidden" name="on0" value="Pedaler">Pedaler</td></tr><tr><td><select name="os0">
                  <option value="25 Pedaler">25 Pedaler : 14,00 SEK - varje vecka</option>
                  <option value="50 Pedaler">50 Pedaler : 21,00 SEK - varje månad</option>
                  <option value="150 Pedaler">150 Pedaler : 60,00 SEK - varje månad</option>
                </select> </td></tr>
                </table>
                <input type="hidden" name="currency_code" value="SEK">
                <input type="hidden" name="custom" value='{{json_encode(array("user_id" => Auth::user()->id))}}'>
                <input type="image" src="https://www.paypalobjects.com/sv_SE/i/btn/btn_subscribe_SM.gif" border="0" name="submit" alt="PayPal – ett tryggt och smidigt sätt att betala på nätet!">
                <img alt="" border="0" src="https://www.paypalobjects.com/sv_SE/i/scr/pixel.gif" width="1" height="1">
              </form>

              
              <h3>SMS Betalning</h3>
                <table class="table table-responsive">
                  <thead>
                    <tr>
                      <th>10 Pedaler (10 kr)</th>
                      <th>25 Pedaler (20 kr)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>SMSa <strong>baxacykel 10 {{ Auth::user()->username }} </strong> till 72550</td>
                      
                      <td>SMSa <strong>baxacykel 20 {{ Auth::user()->username }} </strong> till 72550</td>

                    </tr>
                  </tbody>
                </table>
                    
                <table class="table table-responsive">
                  <thead>
                    <tr>
                      <th>75 Pedaler (50 kr)</th>
                      <th>175 Pedaler (100 kr)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>SMSa <strong>baxacykel 50 {{ Auth::user()->username }} </strong> till 72550</td>
                      <td>SMSa <strong>baxacykel 75 {{ Auth::user()->username }} </strong> till 72550</td>
                    </tr>
                  </tbody>
                </table>

                <div class="alert alert-info">Skicka den fetmarkerade texten till 72550.</div>

                <div class="alert alert-success">Efter att du skickat ett SMS kan det dröja upp till 5 minuter, du kommer få ett bekräftelsesms när din betalning mottagits. Dina pedaler kommer i samband med detta, så uppdatera webbläsaren och shoppa loss!</div>

                <div class="alert alert-warning">
                  OBS. Ifall du är under 18år så krävs det att du har målsmans tillstånd för att köpa pedaler!
                </div>
            </div>

            {{-- TAB PANE --}}
            <div class="tab-pane" id="shop-spend">
              <div class="row">
                <div class="col-xs-12">
                  <h2>Minska väntetiden med <strong>25%</strong></h2>
                    <div class="row">
                      @if( !Auth::user()->hasBoost(1) )
                        @foreach ($agility_boosts as $boost)
                          <div class="col-xs-12 col-md-4">
                            <form method="post" action="{{ action('ShopController@postShop') }}">
                              {{ Form::token() }}
                              <input type="hidden" name="boost_id" value="{{$boost->id}}">
                              <button class="btn btn-block btn-info">
                                @if ($boost->length > 0)
                                  {{ $boost->length / 86400}} dag(ar) 
                                @else 
                                  1 runda 
                                @endif
                                - {{ $boost->pedals }} pedaler</button>

                            </form>
                          </div>
                        @endforeach
                      @else
                        <div class="col-xs-12">
                          <p class="small alert alert-info">
                            Du har boosten aktiverad och den utgår: 
                            <strong>{{ Auth::user()->getBoost(1)->pivot->finished }}</strong>
                          </p>
                        </div>
                      @endif
                    </div>

                  <h2>Öka försäljningspriset med <strong>50%</strong></h2>
                    <div class="row">
                      @if( !Auth::user()->hasBoost(2) )
                        @foreach ($intelligence_boosts as $boost)
                          <div class="col-xs-12 col-md-4">
                            <form method="post" action="{{ action('ShopController@postShop') }}">
                              {{ Form::token() }}
                              <input type="hidden" name="boost_id" value="{{$boost->id}}">
                              <button class="btn btn-block btn-info">
                                @if ($boost->length > 0)
                                  {{ $boost->length / 86400}} dag(ar) 
                                @else 
                                  1 runda 
                                @endif
                                - {{ $boost->pedals }} pedaler</button>

                            </form>
                          </div>
                        @endforeach
                      @else
                        <div class="col-xs-12">
                          <p class="small alert alert-info">
                            Du har boosten aktiverad och den utgår: 
                            <strong>{{ Auth::user()->getBoost(2)->pivot->finished }}</strong>
                          </p>
                        </div>
                      @endif
                    </div>
                  <h2>Öka farten med erfarenhetspoängen med <strong>50%</strong></h2>
                    <div class="row">
                      @if( !Auth::user()->hasBoost(3) )
                        @foreach ($experience_boosts as $boost)
                          <div class="col-xs-12 col-md-4">
                            <form method="post" action="{{ action('ShopController@postShop') }}">
                              {{ Form::token() }}
                              <input type="hidden" name="boost_id" value="{{$boost->id}}">
                              <button class="btn btn-block btn-info">
                                @if ($boost->length > 0)
                                  {{ $boost->length / 86400}} dag(ar) 
                                @else 
                                  1 runda 
                                @endif
                                - {{ $boost->pedals }} pedaler</button>

                            </form>
                          </div>
                        @endforeach
                      @else
                        <div class="col-xs-12">
                          <p class="small alert alert-info">
                            Du har boosten aktiverad och den utgår: 
                            <strong>{{ Auth::user()->getBoost(3)->pivot->finished }}</strong>
                          </p>
                        </div>
                      @endif
                    </div>

                    @if(Auth::user()->getRemainingCooldown() > 0)
                      <h2>Ta bort nuvarande cooldown</h2>
                      <form method="post" action="{{ action('ShopController@postShop') }}">
                        {{ Form::token() }}
                        <button type="submit" name="removeCooldown" value="removeCooldown" class="btn btn-info">3 Pedaler</button>
                      </form>
                    @endif
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