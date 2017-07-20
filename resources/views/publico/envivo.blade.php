@extends('layouts.publico')

@section('css')


@stop

@section('content')

<div class="dir-result">
	<div class="container">
		<div class="eq-local">
			<a class="nom-equip" href="#">
				<span class="escudo">
					<img height="50px" src="{{$partido->equipo_local->logo}}" >
				</span>
				<span class="nom" itemprop="name">{{$partido->equipo_local->nombre}} </span>
			</a>
		</div>
		<div class="marcador cf">
			<span class="tanteo-local">{{$partido->goles_local}}</span>
			<span class="tanteo-time"> {{$partido->tiempo}} </span>
			<span class="tanteo-visit">{{$partido->goles_visita}}</span>
			@if(!is_null($partido->descripcion_penales)) <span class="tanteo-visit">({{$partido->descripcion_penales}})</span> @endif
		</div>
		<div class="eq-visit">
			<a class="nom-equip" href="#">
				<span class="escudo">
					<img height="50px" src="{{$partido->equipo_visita->logo}}" >
				</span>
				<span class="nom">{{$partido->equipo_visita->nombre}} </span>
			</a>
		</div>
	</div>
</div>
<br/>
@if($configuracion->parametro3)
	<h2 style="margin-top: 10px; float:right"><i class="fa fa-refresh"></i> <span id="txtActualizar"></span></h2>
@endif

<ul class="nav nav-tabs">
  <li><a data-toggle="tab" href="#home" onclick="redirect();">Ficha</a></li>
  <li class="active"><a data-toggle="tab" href="#minuto">Minuto a minuto</a></li>
</ul>
<div class="tab-content">
	<div id="home" class="tab-pane fade">
		Cargando...
	</div>
	<div id="minuto" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>MIN</th>
								<th></th>
								<th>COMENTARIO</th>
							</tr>
						</thead>
						<tbody>
							@if($eventos)
								@foreach($eventos as $evento)
									<tr @if($evento->evento->id == 6 || $evento->evento->id == 7) style="background-color: #9FF19F" @endif>
										<td style="width: 40px">{{$evento->minuto}}'</td>
										<td style="width: 40px; text-align: center"><img src="{{$evento->imagen}}" height="25px"></td>
										<td>{{$evento->comentario}}</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@stop

@section('js')

<script>
	var segundos = 0;
	$(function(){
		@if($configuracion->parametro3)
			segundos = {{$configuracion->parametro1}};
 			actualizar(); 
		@endif
	});

	function redirect(){
		window.location.replace("{{route('ficha',$partido->id)}}");
	}

	function actualizar(){
    	if(segundos > 0){
    		segundos = segundos - 1;
    		$('#txtActualizar').text(segundos);
    		setTimeout("actualizar()",1000) 
        }
        else{
        	window.location.reload();
        }
    } 
</script>

@stop