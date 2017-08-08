@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/espacos') }}">Espaço</a> :
@endsection
@section("contentheader_description", $espaco->$view_col)
@section("section", "Espacos")
@section("section_url", url(config('laraadmin.adminRoute') . '/espacos'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar Espaços: ".$espaco->$view_col)

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
				{!! Form::model($espaco, ['route' => [config('laraadmin.adminRoute') . '.espacos.update', $espaco->id ], 'method'=>'PUT', 'id' => 'espaco-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'descricao')
					@la_input($module, 'nome')
					@la_input($module, 'capacidade')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/espacos') }}">Cancelar</a></button>
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
	$("#espaco-edit-form").validate({
		
	});
});
</script>
@endpush
