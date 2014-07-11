@section('content')
	<div class="row">
		<div class="col-md-12">
	        {{ Form::model($user, array('route' => array('update_profile', $user->id), 'method' => 'PUT', 'role' => 'form', 'id' => 'edit_user_form', 'class' => 'form-horizontal form-groups-bordered form-wizard validate', 'files' => true)) }}
	        <div class="panel panel-primary" data-collapsed="0">
	            <div class="panel-heading">
	                <div class="panel-title">
	                        Uppgifter
	                </div>
	            </div>
	           
	            <div class="panel-body">
	                <div class="form-group">
	                    <div class="col-xs-6 text-right">
	                    	<strong>
	                    		Användarnamn
	                    	</strong>
	                    </div>
	                       
	                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                    	{{ $user->username }}
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6 control-label" for="email">Email</label>
	                   
	                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                            {{ Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => 'Ange en email', 'data-validate' => 'required,email', 'data-message-minlength' => 'Måste vara en email adress')) }}
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6 control-label" for="profile">Profil</label>
	                   
	                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            {{ Form::textarea('profile', $user->profile, array('class' => 'form-control', )) }}
	                    </div>
	                </div>
	               
	                <div class="form-group">
	                    <label for="field-1" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 control-label">Lösenord</label>
	                   
	                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                            {{ Form::password('password', array('class' => 'form-control ignore', 'id' => 'password', 'placeholder' => 'Lösenord', 'data-validate' => 'required')) }}                                              
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label for="field-1" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 control-label">Repetera lösenord</label>
	                   
	                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                            {{ Form::password('password_confirmation', array('class' => 'form-control password_confirmation ignore', 'placeholder' => 'Bekräfta lösenord', 'data-message-equal-to' => 'Passwords doesnt match.')) }}
	                    </div>
	                </div>

					{{-- 
	                <div class="form-group">
	                    <label for="field-1" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 control-label">Glömt lösenord?</label>
	                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <button type="button" class="btn btn-block btn-primary">
	                                    Generera lösenord
	                                    <i class="entypo-mail"></i>
	                            </button>
	                    </div>
	                </div>
	                --}}

	                <div class="form-group">
	                	<div class="col-xs-offset-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
	                		<button type="submit" class="btn btn-block btn-success">Spara<i class="entypo-check"></i></button>
	                	</div>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
	{{ Form::close() }}
@stop