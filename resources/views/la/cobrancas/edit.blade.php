@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/cobrancas') }}">Cobranca</a> :
@endsection
@section("contentheader_description", $cobranca->$view_col)
@section("section", "Cobrancas")
@section("section_url", url(config('laraadmin.adminRoute') . '/cobrancas'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Cobrancas Edit : ".$cobranca->$view_col)

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
				{!! Form::model($cobranca, ['route' => [config('laraadmin.adminRoute') . '.cobrancas.update', $cobranca->id ], 'method'=>'PUT', 'id' => 'cobranca-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'descricao')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cobrancas') }}">Cancel</a></button>
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
	$("#cobranca-edit-form").validate({
		
	});
});
</script>
@endpush
