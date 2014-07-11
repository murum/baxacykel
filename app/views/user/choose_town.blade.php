@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default towns" data-collapsed="0">
	            <div class="panel-heading">
	                <div class="panel-title">
	                	<h3>Välj stad att flytta in i</h3>
	                </div>
	            </div>
	            <div class="panel-body">
	            	<div class="row">
	                	<ul class="towns">
	                		@foreach( $towns as $town )
	                			<li class="town col-xs-12">
	                				<button data-town="{{$town->id}}" class="btn btn-block btn-lg btn-primary choose-town">
	                					{{ $town->name }}
	                				</button>
	                			</li>
	                		@endforeach
	                	</ul>
                	</div>

                	<form id="choose-town-form" action="{{ action('UserController@postChooseTown') }}" method="post">
                		{{ Form::token() }}
                		<input type="hidden" name="town_id">
                		<button type="submit" class="btn btn-block btn-lg btn-success">
                			Flytta till vald stad
                		</button>
                	</form>
                </div>
	        </div>
		</div>
	</div>
@stop