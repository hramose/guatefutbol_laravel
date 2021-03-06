@extends('layouts.admin')

@section('title') Posiciones {{$liga->nombre}} @stop

@section('css')
<link href="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table watermark" >
				<thead>
					<tr class="gradient-gray white">
						<th class="text-center">POS</th>
						<th class="text-center">EQUIPO</th>
						<th class="text-center">PTS</th>
						<th class="text-center">JJ</th>
						<th class="text-center">JG</th>
						<th class="text-center">JE</th>
						<th class="text-center">JP</th>
						<th class="text-center">GF</th>
						<th class="text-center">GC</th>
						<th class="text-center">DIF</th>
					</tr>
				</thead>
				<tbody class="color">
					@foreach($posiciones as $posicion)
					<tr>
						<td class="text-center">{{$posicion->POS}}</td>
						<td style="text-align: left"> 
							<img src="{{$posicion->equipo->logo}}" style="height: 25px; width: 25px"> 
							{{$posicion->equipo->nombre}}
						</td>
						<td class="text-center">{{$posicion->PTS}}</td>
						<td class="text-center">{{$posicion->JJ}}</td>
						<td class="text-center">{{$posicion->JG}}</td>
						<td class="text-center">{{$posicion->JE}}</td>
						<td class="text-center">{{$posicion->JP}}</td>
						<td class="text-center">{{$posicion->GF}}</td>
						<td class="text-center">{{$posicion->GC}}</td>
						<td class="text-center">{{$posicion->DIF}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@stop

@section('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script>
	$(document).ready(function() {
   		$('#table').dataTable({
   			"bSort" : true
   		});
	});
</script>
@stop