@extends('layouts.master')

@section('content')

<!--
	$shema_id	- 	varijabla
	$sch	 	-	objekt
	$pk 	 	-	objekt
	$fd 	 	-	objekt

-->

<?php
	Session::put('sch', $sch);
	Session::put('pk', $pk);
	Session::put('fd', $fd);
	Session::put('dcmp', $dcmp);
?>


<div class="panel-body col-md-4">
	<p class="well text-center"><b>DEKOMPOZICIJA</b></p>
	<div class="list-group">
		@if(isset($dcmp))
			<?php $cnt = 0; ?>
			@foreach($dcmp as $val)
				<div class="list-group-item">
					<i class="fa fa-circle-o"></i>
					@for($j=0; $j <= $cnt; $j++)
						{{ $dcmp[$j] . " " }}
					@endfor
				<?php $cnt++; ?>
				</div>
			@endforeach
			@if(isset($flag))
				<p class="text-warning">
					{{ "<b>Ključ već sadržan, ne dodajemo ga</b>" }}
				</p>
			@endif
			<a href="{{ URL::route('pdf', array('id' => $shema_id)) }}">
				<input style="margin-top:20px;" type="button" value="Export to PDF" class="btn btn-info" />
			</a>
		@endif
	</div>
</div>


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
</div>

@stop