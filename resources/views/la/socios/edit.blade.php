@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/socios') }}">S&oacute;cios</a> :
@endsection
@section("contentheader_description", $socio->$view_col)
@section("section", "S&oacute;cios")
@section("section_url", url(config('laraadmin.adminRoute') . '/socios'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar S&oacute;cio: ".$socio->$view_col)

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
				{!! Form::model($socio, ['route' => [config('laraadmin.adminRoute') . '.socios.update', $socio->id ], 'method'=>'PUT', 'id' => 'socio-edit-form']) !!}
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
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/socios') }}">Cancelar</a></button>
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
	$("#socio-edit-form").validate({
		
	});
});
</script>
@endpush
