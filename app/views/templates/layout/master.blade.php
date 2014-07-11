<?php 
	$progress = 100;
	$progress_status = 'success';
?>
<!doctype html>
<html lang="sv">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>
		@if(isset($title))
			{{ $title }}
		@else
			Baxacykel - Baxa, Flaxa, Maxa
		@endif

	</title>
	{{ HTML::style('/assets/stylesheets/frontend.css?v='.$progress) }}
    <!-- TradeDoubler site verification 2417830 -->

<script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-49293358-1', 'baxacykel.se'); ga('send', 'pageview'); </script>
</head>
<body>  
	@if(!Auth::guest() && Auth::user()->noticed == 0)
	<?php /*
		<div class="visible-lg admin-notice">
			<div class="alert alert-info">
				<div class="container">
					<h2>Meddelande från utvecklarna</h2>

					<a href="/notis-last" class="btn btn-primary" id="noticed-accepted">
						Jag har läst och tagit del av notisen.
					</a>
				</div>
			</div>
		</div>
		*/ 
	?>
	@endif
	<?php 
		$notice = Session::get('message');
		$success = Session::get('success');
		$error = Session::get('error');
		$warning = Session::get('warning');
	?>
	@if(isset($notice))
		<section class="message-area">
			<div class="alert alert-info">
				<strong>{{ $notice }}</strong>
			</div>
		</section>
	@endif
	@if(isset($success))
		<section class="message-area">
			<div class="alert alert-success">
				<strong>{{ $success }}</strong>
			</div>
		</section>
	@endif
	@if(isset($error))
		<section class="message-area">
			<div class="alert alert-danger">
				<strong>{{ $error }}</strong>
			</div>
		</section>
	@endif
	@if(isset($warning))
		<section class="message-area">
			<div class="alert alert-warning">
				<strong>{{ $warning }}</strong>
			</div>
		</section>
	@endif
	@if($errors->any())
		<section class="message-area">
			<div class="alert alert-danger">
				<ul class="errors">
					@foreach ($errors->all() as $validation_error)
						<li>{{ $validation_error }}</li>
					@endforeach					
				</ul>
			</div>
		</section>
	@endif
	<div class="message-area">
		<div id="error"></div>
		<div id="success"></div>
		<div id="info"></div>
		<div id="warn"></div>
	</div>

	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="/"><strong>Baxa</strong>Cykel</a>
			<ul class="nav navbar-nav navbar-right">
				<li>
	        		<a href="{{ url('/guide', $parameters = array(), $secure = null); }}">Spelguide</a>
	        	</li>
				@if(!Auth::guest())
					<li>
						@if ( Request::segment(1) == 'forum' )
							<a class="forum active" href="{{ url('/forum', $parameters = array(), $secure = null); }}">Forum</a>
						@else
							<a class="forum" href="{{ url('/forum', $parameters = array(), $secure = null); }}">Forum</a>
						@endif
					</li>
				@endif
				<li>
		        	@if ( Request::segment(1) == 'topplista' )
						<a class="toplist active" href="{{ url('/topplista', $parameters = array(), $secure = null); }}">Topplista</a>
					@else
						<a class="toplist" href="{{ url('/topplista', $parameters = array(), $secure = null); }}">Topplista</a>
					@endif
				</li>
				<li>
					<a href="{{ url('/bug-dev', $parameters = array(), $secure = null); }}">Utvecklande / Buggar</a>
				</li>
				@if(!Auth::guest())
					<li>
						<a href="{{ url('/logout', $parameters = array(), $secure = null); }}">Logga ut</a>
					</li>
				@else
		        	<li>
		        		<a href="{{ url('/registrering', $parameters = array(), $secure = null); }}">Registrera dig</a>
		        	</li>
	        	@endif
	        	@if(Round::any_active_round())
		        	<div class="pull-left round-info">
	        			{{ $days_left }} av den här rundan.
						<div class="progress">
							<div class="progress-bar progress-bar-success " role="progressbar" aria-valuenow="{{ $percent_left }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent_left }}%">
							<span>{{ $percent_left }}%</span>
							</div>
						</div>
	        		</div>
	        	@else
	        		<div class="pull-left round-info small" style="padding-top: 7px;">
	        			Ingen aktiv runda just nu<br />
	        			Nästa runda öppnar Tisdag 20.00.
	        		</div>
	        	@endif
	        	<div class="pull-left small inlogged-users">
	        		{{ $inlogged_users }} användare online
	        	</div>
			</ul>
		</div><!-- /.container-fluid -->
	</nav>
		@if( !Auth::guest() )
			{{-- Spelguide meny --}}
			{{-- 
			<li class="col-md-3 col-sm-6 col-xs-12">
				@if ( Request::segment(1) == 'spelguide' )
					<a class="guide active" href="{{ url('/spelguide', $parameters = array(), $secure = null); }}">Spelguide</a>
				@else
					<a class="guide" href="{{ url('/spelguide', $parameters = array(), $secure = null); }}">Spelguide</a>
				@endif
			</li>
			--}}
			
			{{-- Vanliga frågor meny --}}
			{{-- 
			<li class="col-md-3 col-sm-6 col-xs-12">
				@if ( Request::segment(1) == 'faq' )
					<a class="faq active" href="{{ url('/faq', $parameters = array(), $secure = null); }}">FAQ</a>
				@else
					<a class="faq" href="{{ url('/faq', $parameters = array(), $secure = null); }}">FAQ</a>
				@endif
			</li>
			--}}
		@endif

	<section class="game-menu">
		<div class="container">
			<div class="row">
				<ul>
					@if( !Auth::guest() )
						@if(Round::any_active_round())
							{{-- BAXA --}}
							<li class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
								@if ( Request::segment(1) == 'baxa' )
									<a class="baxa active" href="{{ url('/baxa', $parameters = array(), $secure = null); }}">Baxa</a>
								@else
									<a class="baxa" href="{{ url('/baxa', $parameters = array(), $secure = null); }}">Baxa</a>
								@endif
							</li>

							{{-- HANDLARE --}}
							<li class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
								@if ( Request::segment(1) == 'handlare' )
									<a class="dealer active" href="{{ url('/handlare', $parameters = array(), $secure = null); }}">Handlare</a>
								@else
									<a class="dealer" href="{{ url('/handlare', $parameters = array(), $secure = null); }}">Handlare</a>
								@endif
							</li>

							{{-- Kvarters meny --}}
							<li class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
								@if ( Request::segment(1) == 'resor' )
									<a class="travel active" href="{{ url('/resor', $parameters = array(), $secure = null); }}">Resor</a>
								@else
									<a class="travel" href="{{ url('/resor', $parameters = array(), $secure = null); }}">Resor</a>
								@endif
							</li>

							{{-- Kvarters meny --}}
							<li class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
								@if ( Request::segment(1) == 'marknad' )
									<a class="market active" href="{{ url('/marknad', $parameters = array(), $secure = null); }}">Marknad</a>
								@else
									<a class="market" href="{{ url('/marknad', $parameters = array(), $secure = null); }}">Marknad</a>
								@endif
							</li>
							
							{{-- Kvarters meny --}}
							<li class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
								@if ( Request::segment(1) == 'mitt-kvarter' )
									<a class="quarter active" href="{{ url('/mitt-kvarter', $parameters = array(), $secure = null); }}">Kvarteret</a>
								@else
									<a class="quarter" href="{{ url('/mitt-kvarter', $parameters = array(), $secure = null); }}">Kvarteret</a>
								@endif
							</li>

							{{-- Kurser meny --}}
							<li class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
								@if ( Request::segment(1) == 'skolan' )
									<a class="school active" href="{{ url('/skolan', $parameters = array(), $secure = null); }}">Skolan</a>
								@else
									<a class="school" href="{{ url('/skolan', $parameters = array(), $secure = null); }}">Skolan</a>
								@endif
							</li>
						@endif
			        @else
				        <form role="form" class="col-xs-10 form-inline login-form" action="{{ action('AuthController@postLogin') }}" method="post">
							{{ Form::token(); }}
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Ange användarnamn" name="login-username" />
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Ange lösenord" name="login-password" />
							</div>
							<button type="submit" class="btn btn-thin btn-primary">Logga in</button>
						</form>
			        @endif
				</ul>
			</div>
		</div>
	</section>
    <div class="hidden">
        <div class="hidden-xs">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Huvudannons -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:930px;height:180px"
                 data-ad-client="ca-pub-6725713569575731"
                 data-ad-slot="9346888605"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div class="visible-xs">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Huvudannons mobil -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:50px"
                 data-ad-client="ca-pub-6725713569575731"
                 data-ad-slot="7730554604"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
	@yield('message')
	<section class="wrapper">
		<div class="container">
			<div class="row">
				@if( !Auth::guest() )
				<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
					@if( !Auth::guest() )
					<div class="row left-sidebar">
						<h3 class="text-center username">
							<a href="/anvandare/{{Auth::user()->id}}">{{ Auth::user()->username }}</a>
						</h3>
						<div class="row row-margin skills">
							<span class="pull-left intelligence">
								Int. {{ Auth::user()->getIntelligence() }}
							</span>
							<span class="pull-right agility">
								Rör. {{ Auth::user()->getAgility() }}
							</span>
						</div>
						<div class="row">
							<div class="col-xs-12">
					        	Level {{ Auth::user()->level }}
					        	<div class="progress">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ Auth::user()->getNextLevelPercent() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ Auth::user()->getNextLevelPercent() }}%">
									<span><strong>{{Auth::user()->getNextLevelPercent()}}%</strong></span>
									</div>
								</div>
							</div>
						</div>
					</div>
						{{-- 
						<h4>XP</h4>
						{{Auth::user()->getCurrentLevelExpSubCurrentExp() }} / {{ Auth::user()->getNextLevelExpSubCurrentLevelExp() }}
						--}}
						<div class="current-stats">
							<div class="row left-sidebar money-stats">
		        				{{ number_format(Auth::user()->money, '0', '.', '.') }}kr
		        			</div>
		        			<div class="row left-sidebar garage-stats">
		        				{{ number_format(Auth::user()->bikes, '0', '.', '.') }} / {{number_format(Auth::user()->garage->size, '0', '.', '.') }} cyklar
		        			</div>
		        			<div class="row left-sidebar vehicle-stats">
		        				{{ number_format(Auth::user()->getVehicleItemCount(), '0', '.', '.') }} / {{number_format(Auth::user()->vehicle->size, '0', '.', '.') }} 
		        				@if(Auth::user()->vehicle->size >= 100000 && Auth::user()->getVehicleItemCount() < 10000)
		        					varor
		        				@endif
		        			</div>
		        			<div class="row left-sidebar storage-stats">
		        				{{ number_format(Auth::user()->getStorageItemCount(), '0', '.', '.') }} i lager
		        			</div>
		        			<div class="row left-sidebar town-stats">
		        				Du är i {{ Auth::user()->currentTown() }}
		        			</div>
		        			@if( Auth::user()->clubs()->first() && !Auth::user()->clubs()->first()->pivot->chat_read )
		        				<a class="club-link has-unread" href="{{ url('/klubb', $parameters = array(), $secure = null); }}">
		        			@else
		        				<a class="club-link" href="{{ url('/klubb', $parameters = array(), $secure = null); }}">
		        			@endif		        				
		        				<div class="row left-sidebar club-stats">
		        					@if(Auth::user()->clubs()->first() &&  Auth::user()->clubs()->first()->pivot->approved)
		        						{{ Auth::user()->clubs()->first()->name }}
		        					@else 
		        						Ingen klubb
		        					@endif
		        				</div>
	        				</a>
	        				@if(Auth::user()->getUnreadMessages()->count() > 0)
	        					<a class="message-link has-unread" href="{{ url('/meddelanden', $parameters = array(), $secure = null); }}">
	        				@else
	        					<a class="message-link" href="{{ url('/meddelanden', $parameters = array(), $secure = null); }}">
        					@endif
		        				<div class="row left-sidebar message-stats">
		        					{{ Auth::user()->getUnreadMessages()->count() }} nya mess
		        				</div>
	        				</a>
		        			<a class="pedalshop-link" href="{{ url('/pedalshop', $parameters = array(), $secure = null); }}">
			        			<div class="row left-sidebar pedals-stats">
			        				{{ Auth::user()->pedals }} pedaler
			        			</div>
			        		</a>
			        		<a class="message-link">
			        			<div class="row left-sidebar message-stats">
			        				<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Tipsa en vän</button>
			        			</div>
			        		</a>
		        		</div>
					@endif
				</div>
				@endif
				@if( !Auth::guest() )
					<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">
				@else
					<div class="col-xs-12">
				@endif
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer class="footer">
		<div class="container">
            <div class="hidden-xs">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Sidfotsannons Vänster -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:468px;height:60px"
                             data-ad-client="ca-pub-6725713569575731"
                             data-ad-slot="9207287803"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Sidfotsannons Höger -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:468px;height:60px"
                             data-ad-client="ca-pub-6725713569575731"
                             data-ad-slot="1684021003"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </div>
		</div>
	</footer>
	
	@if(!Auth::guest())
		<div class="hidden-xs chat">
			@if( Auth::user()->chat_noticed == 0)
				<button class="btn btn-success" id="show-chat">Visa chatt <i class="fa fa-arrow-up"></i> <span class="new-message">!</span></button>
			@else
				<button class="btn btn-success" id="show-chat">Visa chatt <i class="fa fa-arrow-up"></i></button>
			@endif
			<button class="btn btn-danger" id="hide-chat">Dölj chatt <i class="fa fa-arrow-down"></i></button>
			
			<div class="chat-container">
				<iframe src="{{ URL::to('/') }}/chatt" frameborder="0" width="620" height="520"></iframe>
			</div>
		</div>
	@endif

	@if(!Auth::guest())
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      </div>
	      <div class="modal-body">
	      	<p>
	      		Du kommer att bli belönad en vacker dag för allt ditt engangemang till spelet. Genom att rekrytera nya medlemmar till spelet hjälper du spelet oss väldigt mycket.
	      	</p>
	      	<label for="">Din länk att kopiera</label>
	      	<input type="text" disabled class="form-control" value="{{ Config::get('app.url'); }}/registrering?referral_user={{Auth::user()->id}}">
	      	<br />
	      	<p>
	        	Kopiera länken och skicka till dina vänner
	        </p>
	        <p>
	        	Gilla oss på facebook
	        	<div class="fb-like-box" data-href="https://www.facebook.com/baxacykel" data-colorscheme="light" data-show-faces="true" data-header="false" data-show-border="false"></div>
	        </p>
	        <p>
	        	Dela
	        </p>

	        <!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515e897b4ca2bd50"></script>
				<!-- AddThis Button END -->

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
	      </div>
	    </div>
	  </div>
	</div>
	@endif

	<script>
		var BASE_URL = "{{ Config::get('app.custom_path'); }}"
	</script>
	{{ HTML::script('/assets/javascript/frontend.js?v='.$progress) }}

	        	<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&appId=242509379270253&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
