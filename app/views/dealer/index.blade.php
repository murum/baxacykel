@section('content')
<div class="row">
	<div class="col-xs-12">
		<ul class="row dealers">
			@foreach ($dealers as $dealer)
				<li class="col-md-6 col-sm-12" data-dealer="{{ $dealer->id }}">
					<div class="dealer">
						<header>
							@if ( Auth::user()->bikes > $dealer->max_bikes || Auth::user()->bikes < $dealer->min_bikes)
								<span class="label label-danger required-bikes">
							@else
								<span class="label label-success required-bikes">
							@endif
								{{ number_format($dealer->min_bikes, '0', '.', '.') }} - {{ number_format($dealer->max_bikes, '0', '.', '.') }}
							</span>
							<div class="title">
								<h3>{{ $dealer->name }}</h3>
							</div>
						</header>
						<div class="information">
							<div class="row">
								@if( !Auth::user()->hasBoost(2) )
									<div class="col-xs-12 pedal-tip">
										<p>
											Mer pengar per cykel kanske? Gå till <a href="/pedalshop">pedalshoppen</a> och köp dig lite sälj skills.
										</p>
									</div>
								@endif
								
								<div class="col-xs-12 dealer-stats">
									<div class="row">
										<span class="label label-danger">
											Min. Cyklar: {{ number_format($dealer->min_bikes, '0', '.', '.') }}
										</span>
										<span class="label label-success">
											Max. Cyklar: {{ number_format($dealer->max_bikes, '0', '.', '.') }}
										</span>
									</div>
									<div class="row">
										<span class="label label-info">
											Cykelpris: {{ number_format(Auth::user()->getCalculatedPrice($dealer->min_price), '0', '.', '.') }}kr - {{ number_format(Auth::user()->getCalculatedPrice($dealer->max_price), '0', '.', '.') }}kr
										</span>
									</div>
								</div>

							</div>
						</div>
						@if ( Auth::user()->bikes <= $dealer->max_bikes && Auth::user()->bikes >= $dealer->min_bikes)
							<div class="row">
								<div class="col-xs-12">
									<footer class="actions">
										<form action="{{ action('DealerController@postDealer') }}" method="post">
											{{ Form::token() }}
											<input type="hidden" name="dealer_id" value="{{ $dealer->id }}">
											<button type="submit" class="btn btn-thin btn-block btn-lg btn-info">Sälj cyklar</button>
										</form>
									</footer>
								</div>
							</div>
						@endif
					</div>
				</li>
			@endforeach
		</ul>
	</div>
</div>
@stop