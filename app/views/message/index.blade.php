@section('content')
<div class="row">
	<div class="col-xs-12 messages">
		<div class="panel panel-default">
	        <div class="panel-heading">
	            <div class="panel-title">
	                <h3>Dina meddelanden</h3>
	            </div>
	        </div>
	        <div class="panel-body">
	        	<table class="table table-hover user-messages">
	        		<colgroup>
	        			<col class="col-xs-1">
	        		</colgroup>
	        		<thead>
	        			<tr>
	        				<th></th>
	        				<th>Avsändare</th>
	        				<th>Ämne</th>
	        				<th>Skickat</th>
	        			</tr>
	        		</thead>
	        		<tfoot>
	        			<tr>
	        				<td colspan="4">PS. Den visar endast de 15 senaste meddelanden.</td>
	        			</tr>
	        		</tfoot>
	        		<tbody>
	        			@foreach ($messages as $message)
	        				@if( $message->read )
	        					<tr class="read" data-message="{{ $message->id }}">
        					@else
        						<tr class="unread" data-message="{{ $message->id }}">
        					@endif
	        					<td>
	        						<form method="post" action="{{ action('MessageController@postDeleteMessage') }}">
	        							{{ Form::token() }}
	        							<input type="hidden" name="message_id" value="{{ $message->id }}">
	        							<button type="submit" class="btn btn-xs btn-danger">
	        								<i class="fa fa-times"></i>
	        							</button>
	        						</form>
	        					</td>
	        					<td>
	        						{{ $message->sender()->first()->username }}
	        					</td>
	        					<td>
	        						{{ $message->title }}
	        					</td>
	        					<td>
	        						{{ relativeTime(strtotime($message->created_at)) }}
	        					</td>
	        				</tr>
	        				<tr>
	        					<td colspan="4">
	        						<p>{{ nl2br($message->message) }}</p>
		        					<a class="btn btn-sm btn-block btn-primary btn-answer" href="#">
		        						Svara
		        					</a>
	        					</td>
	        				</tr>
	        			@endforeach
	        		</tbody>
	        	</table>
	        </div>
	    </div>
	</div>
	<div class="col-xs-12" id="compose-new-message">
		<div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3>Skicka meddelande</h3>
            </div>
        </div>
        <div class="panel-body">
            <form role="form" action="{{ action('MessageController@postMessage') }}" method="post">

                {{ Form::token() }}

                <div class="form-group">
                    <label for="reciever">Mottagare</label>
                    @if( isset($reciever) )
                        <input type="text" name="reciever" value="{{ $reciever->username }}" class="form-control">
                    @else
                        <input type="text" name="reciever" value="{{ Input::old('reciever') }}" class="form-control">
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">Ämne</label>
                    <input type="text" name="title" value="{{ Input::old('title') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="content">Meddelande</label>
                    <textarea class="form-control" name="content" rows="3">{{ Input::old('content') }}</textarea>
                </div>

                <input class="btn btn-lg btn-success btn-block" type="submit" value="Skicka meddelande">        
            </form>
        </div>
    </div>
	</div>
</div>
@stop