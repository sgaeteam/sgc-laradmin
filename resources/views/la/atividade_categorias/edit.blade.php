@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/atividade_categorias') }}">Atividade Categoria</a> :
@endsection
@section("contentheader_description", $atividade_categoria->$view_col)
@section("section", "Atividade Categorias")
@section("section_url", url(config('laraadmin.adminRoute') . '/atividade_categorias'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar Atividade Categorias: ".$atividade_categoria->$view_col)

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
				{!! Form::model($atividade_categoria, ['route' => [config('laraadmin.adminRoute') . '.atividade_categorias.update', $atividade_categoria->id ], 'method'=>'PUT', 'id' => 'atividade_categoria-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'descricao')
					@la_input($module, 'atividade_id')
					@la_input($module, 'mensalidade')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/atividade_categorias') }}">Cancelar</a></button>
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
	$("#atividade_categoria-edit-form").validate({
		
	});
});
</script>
@endpush
