@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/produtos') }}">Produto</a> :
@endsection
@section("contentheader_description", $produto->$view_col)
@section("section", "Produtos")
@section("section_url", url(config('laraadmin.adminRoute') . '/produtos'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar Produtos: ".$produto->$view_col)

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
				{!! Form::model($produto, ['route' => [config('laraadmin.adminRoute') . '.produtos.update', $produto->id ], 'method'=>'PUT', 'id' => 'produto-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'descricao')
					@la_input($module, 'preco_unitario')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/produtos') }}">Cancelar</a></button>
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
	$("#produto-edit-form").validate({
		
	});
});
</script>
@endpush
