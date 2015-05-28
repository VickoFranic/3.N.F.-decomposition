@extends('layouts.master')

@section('content')


<div class="panel-body col-md-4 col-md-offset-1">
	<p class="well text-center">
		<b>NEW</b>

		@if(!isset($keyNum))
		<form method="POST" action="{{ URL::route('saveNew') }}">
			<div class="form-group">
				<label>Shema:</label>
				<input class="form-control" required name="schema">
			</div>
			<div class="form-group">
				<label>Broj ključeva:</label>
				<input class="form-control" required name="keyNum">
			</div>
			<div class="form-group">
				<label>Broj funkcionalnih ovisnosti:</label>
				<input class="form-control" required name="fdNum">
			</div>
			<button type="submit" class="btn btn-success">Dalje</button>
		</form>

		@else
		<form method="POST" action="{{ URL::route('saveNewFinal') }}">
			<div class="form-group">
				<blockquote>Shema: {{ $schema }}</blockquote>
			</div>
			<label>Ključevi:</label>
			@for ($i=0; $i < $keyNum; $i++)
			<div class="form-group">
				<input class="form-control" required name="{{ 'key' . $i }}">
			</div>
			@endfor

			<label>Funkcijske ovisnosti:</label><br>
			@for ($i=0; $i < $fdNum; $i++)
			<div class="form-group col-md-6">
				<input class="form-control" required name="{{ 'depL' . $i }}">
			</div>
			<div class="form-group col-md-6">
				<input class="form-control" required name="{{ 'depR' . $i }}">
			</div>
			@endfor
			<input type="hidden" class="form-control" name="schema" value="{{ $schema }}">
			<input type="hidden" class="form-control" name="keyNum" value="{{ $keyNum }}">
			<input type="hidden" class="form-control" name="fdNum" value="{{ $fdNum }}">

			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>
	@endif

@stop