@extends('layouts.master')

@section('body')
	<body class="home">
@stop

@section('content')

<div class="panel-body col-md-4">
	<div class="list-group text-center">
		<a class="list-group-item" href="{{ URL::Route('sheme') }}">
			{{ "Prikaži sve sheme/Izračunaj dekompoziciju" }}
		</a>
		<a class="list-group-item" href="{{ URL::Route('new') }}">
			{{ "Unesi novu shemu" }}
		</a>
	</div>
</div>
	@if(isset($saved))
	<div class="well">
		{{ "Shema je uspješno izmjenjena." }}
	</div>
	@endif

	@if(isset($new))
	<div class="well">
		{{ "Nova shema unešena u bazu." }}
	</div>
	@endif
@stop
