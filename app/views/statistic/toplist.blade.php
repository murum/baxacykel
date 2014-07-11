@section('content')
<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<h1>Topplistan</h1>
				</div>
			</div>
			<div class="panel-body">
				<p class="lead">
					Uppdateras 1 gång i timmen <br />
					<strong>Senast uppdaterad: </strong> {{ $last_update->format('H:i') }}
				</p>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<h2>Användare</h2>
						<ul class="users-toplist">
							<?php $counter = 1; ?>
							@foreach ($users as $user)
								@if(!($user->id == 1 || $user->id == 2))
									<li>
										@if($counter == 1)
											<span class="label label-primary">#1</span>
											<a href="/anvandare/{{$user->id}}">{{ $user->username }} </a>
										({{ $user->level }}) - {{ number_format($user->money, '0', '.', '.') }}kr
										@elseif($counter == 2)
											<span class="label label-default">#2</span>
											<a href="/anvandare/{{$user->id}}">{{ $user->username }} </a>
											({{ $user->level }}) - {{ number_format($user->money, '0', '.', '.') }}kr
										@elseif($counter == 3)
											<span class="label label-warning">#3</span>
											<a href="/anvandare/{{$user->id}}">{{ $user->username }} </a>
											({{ $user->level }}) - {{ number_format($user->money, '0', '.', '.') }}kr
										@else
											<a href="/anvandare/{{$user->id}}">{{ $user->username }} </a>
											({{ $user->level }}) - {{ number_format($user->money, '0', '.', '.') }}kr
										@endif
									</li>
								@endif
								<?php $counter++; ?>
							@endforeach
						</ul>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<h2>Klubbar</h2>
						<ul class="clubs-toplist">
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
	                                ({{ $club->get_users_count() }}) <a href="{{ url('klubb/'.$club->id) }}">{{$club->name}}</a> - {{ number_format($club_money, '0', '.', '.')}}kr - Levels ({{ $club_level }})
	                            </li>
	                        @endforeach
	                    </ul>
                    </div>
				</div>	
			</div>
		</div>
	</div>
</div>
@stop