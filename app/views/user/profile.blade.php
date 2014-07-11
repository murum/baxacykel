@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-primary" data-collapsed="0">
	            <div class="panel-heading">
	                <div class="panel-title">
	                	<div class="row">
	                		<div class="col-xs-12">
			                	<div class="pull-left">
			                        {{ $user->level }} - {{ $user->username }}
		                        </div>
		                        <div class="pull-right">
		                        	Bosatt i {{ $user->town->name }}
		                        </div>
	                        </div>
                        </div>
	                </div>
	            </div>
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
	            			<div class="panel panel-default">
	            				<div class="panel-heading">
	            					<div class="panel-title">
	            						Pengar
	            					</div>
	            				</div>
	            				<div class="panel-body">
            						<span class="label label-default">
            							{{ number_format($user->money, '0', '.', '.') }}kr
            						</span>
            					</div>
	            			</div>

	            			<div class="panel panel-default">
	            				<div class="panel-heading">
	            					<div class="panel-title">
	            						Stats
	            					</div>
	            				</div>
	            				<div class="panel-body">
	            					<div class="row row-margin">
	            						<div class="col-xs-12">
			            					<span class="label label-default">
		            							Intelligens - {{ $user->getIntelligence() }}
		            						</span>
	            						</div>
            						</div>
            						<div class="row">
            							<div class="col-xs-12">
		            						<span class="label label-default">
		            							Rörlighet - {{ $user->getAgility() }}
		            						</span>
	            						</div>
            						</div>
            					</div>
	            			</div>

	            			<div class="panel panel-default">
	            				<div class="panel-heading">
	            					<div class="panel-title">
	            						Garage
	            					</div>
	            				</div>
	            				<div class="panel-body">
            						<span class="label label-default">
            							{{ $user->garage()->first()->name }}
            						</span>
            					</div>
	            			</div>

	            			<div class="panel panel-default">
	            				<div class="panel-heading">
	            					<div class="panel-title">
	            						Senast aktiv
	            					</div>
	            				</div>
	            				<div class="panel-body">
            						<span class="label label-default">
            							{{ $user->updated_at }}
            						</span>
            					</div>
	            			</div>

	            		</div>

	            		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	            			<div class="panel panel-default">
	            				<div class="panel-heading">
	            					<div class="panel-title">
	            						Profil
	            					</div>
	            				</div>
	            				<div class="panel-body user-profile">
        							{{ nl2br(e($user->profile)) }}
            					</div>
	            			</div>
	            		</div>

	            		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <!--
	            			<div class="panel panel-default">
	            				<div class="panel-heading">
	            					<div class="panel-title">
	            						Medaljer
	            					</div>
	            				</div>
	            				<div class="panel-body">
            						<span class="label label-danger">
            							Testmeistro
            						</span>
            					</div>
	            			</div>
	            			-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        Skicka PM
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <a href="/meddelanden/{{ $user->id }}">
                                        Skicka meddelande till {{ $user->username}}
                                    </a>
                                </div>
                            </div>
	            		</div>
	            	</div>
	            	@if(Auth::user()->id == $user->id)
                    	<a class="btn btn-block btn-success" href="/anvandare/{{$user->id}}/redigera">
                    		Redigera profil
                    	</a>
                    @endif
	            </div>
	        </div>
		</div>
	</div>
@stop