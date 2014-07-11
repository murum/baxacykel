@section('content')
@if(Auth::user()->level < 10)
<div class="row">
	<div class="col-xs-12">
		<div class="alert alert-warning">
			<p>Skolan öppnas upp för dig så snart du är level 10</p>
		</div>
	</div>
</div>
@else
	<div class="row">
		<div class="col-xs-12">
			<div class="cooldown">
				@if($cooldown > 0)
					<div id="cooldown-alert" class="alert alert-info">
						<p>Väntetid kvar: <span id="cooldown-value">{{ $cooldown }}</span> sekunder</p>
					</div>
				@else
					<div id="cooldown-alert" class="alert alert-success">
						<p>Du är redo att gå på kurs...</p>
					</div>
				@endif
			</div>
			<ul class="row courses">
				@if(count($courses) > 0)
					@foreach ($courses as $course)
						<li class="col-md-6 col-sm-12" data-course="{{ $course->id }}">
							<div class="course">
								<header>
									<div class="row">
										<div class="title col-xs-12">
											<h3>{{ $course->name }}</h3>
										</div>
									</div>
								</header>
								<div class="information">
									<div class="row">
										<div class="col-xs-12 course-stats">
											<div class="row">
												<span class="label label-danger">
													Min. poäng: {{ $course->min_point }}
												</span>
												<span class="label label-success">
													Max. poäng: {{ $course->max_point }}
												</span>
											</div>
											<div class="row">
												<span class="label label-info">
													Längd: {{ number_format(Auth::user()->getCalculatedCooldown($course->cooldown) / 3600, '2', ',', '.')}}h
												</span>
												<span class="label label-info">
													Färdighet: {{ $course->getCourseAttribute()}}
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<footer class="actions">
											<form method="post" action="{{ action('CourseController@postCourse') }}">
												{{ Form::token() }}
												<input type="hidden" name="course_id" value="{{ $course->id }}">
												<button class="btn btn-thin btn-block btn-lg btn-info go-to-course">Gå på kurs</button>
											</form>
										</footer>
									</div>
								</div>
							</div>
						</li>
					@endforeach
				@else
					<div class="col-xs-12">
						<div class="jumbotron">
							<p>Du har maxat alla dina attribut. Välkommen åter till en annan runda.</p>
						</div>
					</div>
				@endif
			</ul>
		</div>
	</div>
@endif
@stop