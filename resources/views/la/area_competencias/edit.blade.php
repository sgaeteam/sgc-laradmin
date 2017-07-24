@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/area_competencias') }}">Area Competencia</a> :
@endsection
@section("contentheader_description", $area_competencia->$view_col)
@section("section", "Area Competencias")
@section("section_url", url(config('laraadmin.adminRoute') . '/area_competencias'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Area Competencias Edit : ".$area_competencia->$view_col)

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
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/area_competencias') }}">Cancel</a></button>
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
