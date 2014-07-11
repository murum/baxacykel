@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<h3>Köp och sälj varor på marknaden</h3>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-stripped market">
					<colgroup>
						<col class="col-xs-3">
						<col class="col-xs-2">
						<col class="col-xs-2">
						<col class="col-xs-2">
						<col class="col-xs-3">
					</colgroup>
					<thead>
						<tr>
							<th>Vara</th>
							<th>Pris</th>
							<th>Marknaden</th>
							<th>Fordonet</th>
							<th>Köp / Sälj</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4">
								Marknaden i {{ Auth::user()->currentTown() }}
							</td>
						</tr>
					</tfoot>
					<tbody>
					@foreach($market->items as $item)
					<tr>
						<td>{{ $item->name }}</td>
						<td>{{ $item->pivot->price }}kr</td>
						<td class="amount-market">{{ $item->pivot->amount }}</td>
						<td class="amount-market">{{ Auth::user()->getItem($item->id)->in_vehicle }}</td>
						<td class="market-form">
							<form method="post" action="{{ action('MarketController@postMarket')}}">
								{{ Form::token() }}
								<input type="hidden" value="{{$item->id}}" name="item_id">
								<div class="row">
									<div class="pull-left col-xs-6">
										<input type="text" class="amount-input form-control" name="amount">
									</div>
									<div class="pull-right">
										<input type="submit" name="action-sell" class="btn btn-sm btn-success" value="Sälj" />
									</div>
									<div class="pull-right">
										<input type="submit" name="action-buy" class="btn btn-sm btn-primary" value="Köp" />
									</div>
								</div>
							</form>
						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@stop