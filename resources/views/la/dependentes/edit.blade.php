@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/dependentes') }}">Dependente</a> :
@endsection
@section("contentheader_description", $dependente->$view_col)
@section("section", "Dependentes")
@section("section_url", url(config('laraadmin.adminRoute') . '/dependentes'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar Dependente: ".$dependente->$view_col)

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

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($dependente, ['route' => [config('laraadmin.adminRoute') . '.dependentes.update', $dependente->id ], 'method'=>'PUT', 'id' => 'dependente-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nome')
					@la_input($module, 'sexo')
					@la_input($module, 'data_nascimento')
					@la_input($module, 'grau')
					@la_input($module, 'socio')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/dependentes') }}">Cancelar</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#dependente-edit-form").validate({
		
	});
});
</script>
@endpush
