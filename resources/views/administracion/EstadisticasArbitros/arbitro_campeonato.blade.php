@extends('layouts.admin')

@section('title') Partidos por Equipo @stop
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop
@section('content')

	{!! Form::open(['route' => ['estadistica_arbitro_campeonato',$ligaId,0], 'method' => 'POST', 'role' => 'form', 'class'=>'validate-form', 'id'=>'form']) !!}
	

		{!! Field::select('campeonato_id',$campeonatos,$campeonatoId,['id'=>'campeonatoId']) !!}

		@if(!is_null($arbitro))
			{!! Field::text('arbitro', $arbitro->nombreCompleto , ['id'=>'arbitro']) !!}
		@else
			{!! Field::text('arbitro', null, ['id'=>'arbitro']) !!}
		@endif

		<input type="hidden" id="arbitroId" value="">
        <p>
            <a href="#" onclick="consultar(); return false;" class="btn btn-primary btn-flat">Buscar</a>
        </p>
		

	{!! Form::close() !!}

	<hr>

	@if($campeonatoId != 0)
		<h3>{{$arbitro->nombreCompleto}} en el Campeonato {{$campeonato->nombre}}</h3>
		<hr>
	@endif

	<div class="table-responsive">
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>ARBITRO</th>
					<th>AP</th>
					<th>G</th>
					<th>A</th>
					<th>AA</th>
					<th>R</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				@if(!is_null($arbitro))
					<td>{{$arbitro->nombreCompleto}}</td>
					<td>{{$totales->apariciones}}</td>
					<td>{{$totales->goles}}</td>
					<td>{{$totales->amarillas}}</td>
					<td>{{$totales->dobles_amarillas}}</td>
					<td>{{$totales->rojas}}</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>

	<div class="table-responsive">
		<table class="table table-responsive" id="partidos">
			<thead>
				<tr>
					<th>FECHA</th>
					<th>HORA</th>
					<th>LOCAL</th>
					<th>RESULTADO</th>
					<th>VISITA</th>
					<th>CAMPEONATO</th>
				</tr>
			</thead>
			<tbody>
				@if( count($partidos) > 0 )
					@foreach($partidos as $partido)
					<tr>
						<td>{{ date('d-m-Y',strtotime($partido->fecha)) }}</td>
						<td>{{ date('H:i',strtotime($partido->fecha)) }}</td>
						<td>{{ $partido->equipoLocal->nombre }}</td>
						<td>{{ $partido->goles_local }} - {{ $partido->goles_visita }}</td>
						<td>{{ $partido->equipoVisita->nombre }}</td>
						<td>{{ $partido->campeonato->nombre }}</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
     
    <hr>

    <ul>
        <li><b>AP:</b> Apariciones | 
            <b>A:</b> Amarillas | 
            <b>AA:</b> Dobles Amarillas | 
            <b>G:</b> Goles | 
            <b>GA:</b> Goles Acumulados | 
            <b>MJ:</b> Minutos Jugados |
            <b>R:</b> Rojas .
        </li>
        <li>Haga click sobre el resultado para ver la ficha del partido.</li>
        <li>Haga click sobre el nombre del rival para ver todos los partidos en los que
            participó el arbitro contra dicho equipo.</li>
        <li>Haga click sobre el nombre del campeonato para ver todos los partidos en los que
            participó el arbitro en dicho campeonato.</li>
        <li>Haga click sobre el nombre del equipo para ver todos los partidos en los que
            participó el arbitro con dicho equipo.</li>
    </ul>


@stop
@section('js')
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script>
	$(document).ready(function() {
   		$('#partidos').dataTable({
   			"bSort" : false
   		});
	});
</script>
<script>

	$(function(){

		$('#arbitroId').val({{$arbitroId}});

		$('#form').submit(function(){
			return false;
		})

		$('#arbitro').autocomplete({
		    source: "{{route('inicio')}}/Arbitros-Liga/{{$ligaId}}",
		    dataType: 'json',
		    type: 'GET',
		    select: function(event, ui) {
		    	console.log(ui.item);
			  	$('#arbitro').val(ui.item.label);
			  	$('#arbitroId').val(ui.item.id);
			}

		});
	});

	function consultar()
	{
		var arbitroId = $('#arbitroId').val();
		var campeonatoId = $('#campeonatoId').val();
		if(arbitroId == '') arbitroId = 0;
		if(campeonatoId == '') campeonatoId = 0;
		var url = "{{route('inicio')}}/Estadisticas-Arbitros/{{$ligaId}}/"+campeonatoId+"/" + arbitroId;
		window.location = url;
	}
</script>

@stop

