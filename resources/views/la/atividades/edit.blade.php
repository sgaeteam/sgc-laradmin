@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/atividades') }}">Atividade</a> :
@endsection
@section("contentheader_description", $atividade->$view_col)
@section("section", "Atividades")
@section("section_url", url(config('laraadmin.adminRoute') . '/atividades'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar Atividades: ".$atividade->$view_col)

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
				{!! Form::model($atividade, ['route' => [config('laraadmin.adminRoute') . '.atividades.update', $atividade->id ], 'method'=>'PUT', 'id' => 'atividade-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'mensalidade')
					@la_input($module, 'descricao')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/atividades') }}">Cancelar</a></button>
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
	$("#atividade-edit-form").validate({
		
	});
});
</script>
@endpush
