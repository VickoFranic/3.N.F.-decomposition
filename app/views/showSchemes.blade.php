@extends('layouts.master')

@section('body')
	<body>
@stop

@section('content')

<?php 
$schema = DB::table('rel_schema')->get();
?>

<div class="panel-body col-md-4">
	<p class="well text-center"><b>RELACIJSKE SHEME</b></p>
	<div class="list-group">
		@foreach ($schema as $rs)
		<div class="list-group-item">
			{{ $rs->rschema }}
			<a href="{{ URL::route('detalji-sheme', array('scheme_ID' => $rs->ID)) }}"> | Dekompozicija</a> |
			<a href="{{ URL::route('edit', array('scheme_ID' => $rs->ID)) }}">Uredi</a> |
			<a href="{{ URL::route('delete', array('scheme_ID' => $rs->ID)) }}">Izbriši</a>
		</div>
		@endforeach
	</div>
</div>

@if(isset($del))
	<div class="list-group-item col-md-4 col-md-offset-1 text-center" style="margin-top:20px;">
		{{ "<b>Relacijska shema izbrisana.</b>" }}
	</div>
@elseif(isset($sch))
<div class="panel-body col-md-4 col-md-offset-1">
	<p class="well text-center">
		<b>DETALJI</b>
	</p>
	<blockquote>Shema: {{ $sch->rschema }}</blockquote>
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
	<a href="{{ URL::route('dekompozicija', array('scheme_ID' => $sch->ID)) }}">
		<input style="margin-top:20px;" type="button" value="Dekompozicija" class="btn btn-danger" />
	</a>
	@if(isset($test))	<!-- ako je sema vec u 3.N.F. -->
	<div class="list-group">
		<div class="list-group-item" style="margin-top:20px;">
			{{ "<b>Relacijska shema je već u 3. N.F. !!</b>" }}
		</div>
	</div>
	@endif
</div>
@endif

@stop