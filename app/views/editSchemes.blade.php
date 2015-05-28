@extends('layouts.master')

@section('content')

@if (isset($sch))
<div class="panel-body col-md-4">
	<p class="well text-center"><b>RELACIJSKE SHEME</b></p>
	<div class="list-group">
		@foreach ($sch as $rs)
		<div class="list-group-item">
			{{ $rs->rschema }}
			<a href="{{ URL::route('editScheme', array('id' => $rs->ID)) }}">Edit</a>
		</div>
		@endforeach
	</div>
</div>
@endif


@if (isset($scheme_id))
<div class="panel-body col-md-4 col-md-offset-1">
	<p class="well text-center">
		<b>DETALJI</b>
	</p>
	<blockquote>Shema: {{ $schema->rschema }}</blockquote>
	<div class="list-group">
		<p><b>Ključevi</b></p>
		@foreach ($pk as $kljucevi)
		<div class="list-group-item">
			{{ $kljucevi->pr_key }}
		</div>
		@endforeach
	</div>
	<div class="list-group">
		<p><b>Funkcijske ovisnosti</b></p>
		@foreach ($fd as $dep)
		<div class="list-group-item col-md-6">
			{{ $dep->fd_L }}
		</div>
		<div class="list-group-item col-md-6">
			{{ $dep->fd_R }}
		</div>
		@endforeach
	</div>
</div>

<div class="panel-body col-md-4 col-md-offset-1">
	<p class="well text-center">
		<b>EDIT</b>

		<form method="POST" action="{{ URL::route('save', array('id' => $schema->ID)) }}">
			<div class="form-group">
				<label>Shema:</label>
				<input class="form-control" required name="schema" value="{{ $schema->rschema }}">
			</div>
			<label>Ključevi:</label>
			<?php $cntKeys = 0; ?>
			@foreach($pk as $kljucevi)
			<div class="form-group">
				<input class="form-control" required name="{{ 'key' . $cntKeys }}" value="{{ $kljucevi->pr_key }}">
			</div>
			<?php	$cntKeys++; ?>
			@endforeach

			<label>Funkcijske ovisnosti:</label><br>
			<?php $cntDep = 0; ?>
			@foreach($fd as $dep)
			<div class="form-group col-md-6">
				<input class="form-control" required name="{{ 'depL' . $cntDep }}" value="{{ $dep->fd_L }}">
			</div>
			<div class="form-group col-md-6">
				<input class="form-control" required name="{{ 'depR' . $cntDep }}" value="{{ $dep->fd_R }}">
			</div>
			<?php	$cntDep++; ?>
			@endforeach
			<input type="hidden" class="form-control" name="cntKeys" value="{{ $cntKeys }}">
			<input type="hidden" class="form-control" name="cntDep" value="{{ $cntDep }}">

			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>
	@endif

	@stop