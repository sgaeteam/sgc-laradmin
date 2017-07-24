@extends("la.layouts.app")

@section("contentheader_title", "Socios")
@section("contentheader_description", "Socios listing")
@section("section", "Socios")
@section("sub_section", "Listing")
@section("htmlheader_title", "Socios Listing")

@section("headerElems")
@la_access("Socios", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Socio</button>
@endla_access
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Socios", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Socio</h4>
			</div>
			{!! Form::open(['action' => 'LA\SociosController@store', 'id' => 'socio-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'nome')
					@la_input($module, 'matricula')
					@la_input($module, 'areacompetencia')
					@la_input($module, 'categoria')
					@la_input($module, 'funcao')
					@la_input($module, 'telefone')
					@la_input($module, 'ramal')
					@la_input($module, 'sexo')
					@la_input($module, 'estado_civil')
					@la_input($module, 'cpf')
					@la_input($module, 'rg')
					@la_input($module, 'data_nascimento')
					@la_input($module, 'nacionalidade')
					@la_input($module, 'naturalidade')
					@la_input($module, 'lotacao')
					@la_input($module, 'unidade')
					@la_input($module, 'profissao')
					@la_input($module, 'endereco')
					@la_input($module, 'bairro')
					@la_input($module, 'cidade')
					@la_input($module, 'estado')
					@la_input($module, 'cep')
					@la_input($module, 'celular')
					@la_input($module, 'email')
					@la_input($module, 'obs')
					@la_input($module, 'cobranca')
					--}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/socio_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#socio-add-form").validate({
		
	});
});
</script>
@endpush
