@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="cooldown">
			@if($cooldown > 0)
				<div id="cooldown-alert" class="alert alert-info">
					<p>Väntetid kvar: <span id="cooldown-value">{{ $cooldown }}</span> sekunder</p>
					@if( !Auth::user()->hasBoost(1) )
						<p>
							Minska väntetiden? <a href="/pedalshop">Köp boosten som minskar väntetiden</a>
						</p>
					@endif
				</div>
			@else
				<div id="cooldown-alert" class="alert alert-success">
					<p>Du är redo att baxa nya cyklar...</p>
				</div>
			@endif
		</div>
		<ul class="row npcs">
			@if ($comingNpc)
				<li class="col-md-6">
					<div class="npc">
						<header>
							<span class="label label-danger required-level">
								{{ $comingNpc->required_level }}
							</span>
							<div class="row">
								<div class="title col-xs-12">
									<h3>{{ $comingNpc->name }}</h3>
								</div>
							</div>
						</header>
						<div class="information">
							<div class="row">
								<div class="col-xs-12">
									<span class="label label-danger">
										Min. Cyklar: {{ number_format($comingNpc->min, '0', '.', '.') }}
									</span>
									<span class="label label-success">
										Max. Cyklar: {{ number_format($comingNpc->max, '0', '.', '.') }}
									</span>
									<span class="label label-info">
										Cooldown: {{ (int)Auth::user()->getCalculatedCooldown($comingNpc->cooldown)}}s
									</span>
								</div>
								@if( !Auth::user()->hasBoost(1) )
									<div class="col-xs-12 pedal-tip">
										<p>
											Trött på väntetid? Gå till <a href="/pedalshop">pedalshoppen</a> och köp dig snabbare.
										</p>
									</div>
								@endif
								@if( !Auth::user()->hasBoost(3) )
									<div class="col-xs-12 pedal-tip">
										<p>
											Trött på att levla? Gå till <a href="/pedalshop">pedalshoppen</a> och köp boosten som ger dig mer erfarenhetspoäng.
										</p>
									</div>
								@endif
							</div>
						</div>
					</div>
				</li>
			@endif
			@foreach ($npcs as $npc)
				<li class="col-md-6" data-npc="{{ $npc->id }}">
					<div class="npc">
						<header>
							<span class="label label-success required-level">
								{{ $npc->required_level }}
							</span>
							<div class="row">
								<div class="title col-xs-12">
									<h3>{{ $npc->name }}</h3>
								</div>
							</div>
						</header>
						<div class="information">
							<div class="row">
								<div class="col-xs-12">
									<span class="label label-danger">
										Min. Cyklar: {{ number_format($npc->min, '0', '.', '.') }}
									</span>
									<span class="label label-success">
										Max. Cyklar: {{ number_format($npc->max, '0', '.', '.') }}
									</span>
									<span class="label label-info">
										Väntetid: {{ (int)Auth::user()->getCalculatedCooldown($npc->cooldown)}}s
									</span>
								</div>
								@if( !Auth::user()->hasBoost(1) )
									<div class="col-xs-12 pedal-tip">
										<p>
											Trött på väntetid? Gå till <a href="/pedalshop">pedalshoppen</a> och köp dig snabbare.
										</p>
									</div>
								@endif
								@if( !Auth::user()->hasBoost(3) )
									<div class="col-xs-12 pedal-tip">
										<p>
											Trött på att levla? Gå till <a href="/pedalshop">pedalshoppen</a> och köp boosten som ger dig mer erfarenhetspoäng.
										</p>
									</div>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<footer class="actions">
									<form action="{{ action('RobController@postRobbing') }}" method="post">
										{{ Form::token() }}
										<input type="hidden" name="npc_id" value="{{ $npc->id }}">
										<button type="submit" class="btn btn-thin btn-block btn-lg btn-info">Baxa</button>
									</form>
								</footer>
							</div>
						</div>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
</div>
@stop