@section('content')
<div class="row">
	<div class="col-xs-12">
		<h2>Nuvarange Garage</h2>
		<div class="row">
			<div class="col-xs-12">
				<div class="garage">
					<header>
						<div class="title">
							<h3>{{ $current_garage->name }}</h3>
						</div>
					</header>
					<div class="information">
						<div class="row">
							<div class="col-xs-12">
								<p>
									{{ $current_garage->description }}
								</p>
							</div>
							<div class="col-xs-12">
								<span class="label label-info max-bikes">
									Utrymme för: {{ number_format($current_garage->size, '0', '.', '.') }} cyklar
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<h2>Garage att uppgradera till</h2>
		<ul class="row garages">
			<?php $counter = 0; ?>
			@foreach ($garages as $garage)
				@if($garage->id > $current_garage->id)
					<?php $counter++; ?>
					<li class="col-md-6 col-sm-12" data-garage="{{ $garage->id }}">
						<div class="garage">
							<header>
								<div class="title">
									<h3>{{ $garage->name }}</h3>
								</div>
							</header>
							<div class="information">
								<div class="row">
									<div class="col-xs-12 garage-stats">
										<span class="label label-info max-bikes">
											Utrymme för: {{ number_format($garage->size, '0', '.', '.') }} cyklar
										</span>
										<span class="label label-warning price">
											{{ number_format($garage->price, '0', '.', '.') }}kr
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<footer class="actions">
										<form action="{{ action('GarageController@postGarages') }}" method="post">
											{{ Form::token() }}
											<input type="hidden" name="garage_id" value="{{ $garage->id }}">
											<button type="submit" class="btn btn-thin btn-block btn-lg btn-info buy-garage">Köp garage</button>
										</form>
									</footer>
								</div>
							</div>
						</div>
					</li>
				@endif
			@endforeach
			@if ($counter == 0)
				<div class="col-xs-12">
					<div class="alert alert-info">
						<p>Du har det bästa garaget redan</p>
					</div>
				</div>
			@endif
		</ul>
	</div>
</div>
@stop