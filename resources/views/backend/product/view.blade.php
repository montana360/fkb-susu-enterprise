@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-header">
				<span class="header-title">{{ _lang('Product Details') }}</span>
			</div>
			
			<div class="card-body">
			    <table class="table table-bordered">
				    <tr><td>{{ _lang('Name') }}</td><td>{{ $product->name }}</td></tr>
					<tr><td>{{ _lang('Descriptions') }}</td><td>{{ $product->descriptions }}</td></tr>
			    </table>
			</div>
	    </div>
	</div>
</div>
@endsection


