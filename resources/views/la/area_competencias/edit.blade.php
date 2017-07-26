@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/area_competencias') }}">&Aacute;reas de Compet&ecirc;ncias</a> :
@endsection
@section("contentheader_description", $area_competencia->$view_col)
@section("section", "&Aacute;reas de Compet&ecirc;ncias")
@section("section_url", url(config('laraadmin.adminRoute') . '/area_competencias'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar &Aacute;rea de Compet&ecirc;ncia: ".$area_competencia->$view_col)

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
				{!! Form::model($area_competencia, ['route' => [config('laraadmin.adminRoute') . '.area_competencias.update', $area_competencia->id ], 'method'=>'PUT', 'id' => 'area_competencia-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'sigla')
					@la_input($module, 'descricao')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/area_competencias') }}">Cancelar</a></button>
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
	$("#area_competencia-edit-form").validate({
		
	});
});
</script>
@endpush
