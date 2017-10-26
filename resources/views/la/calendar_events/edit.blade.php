@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/calendar_events') }}">Evento</a> :
@endsection
@section("contentheader_description", $calendar_event->$view_col)
@section("section", "Evento")
@section("section_url", url(config('laraadmin.adminRoute') . '/calendar_events'))
@section("sub_section", "Editar")

@section("htmlheader_title", "Editar Evento: ".$calendar_event->$view_col)

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
				{!! Form::model($calendar_event, ['route' => [config('laraadmin.adminRoute') . '.calendar_events.update', $calendar_event->id ], 'method'=>'PUT', 'id' => 'calendar_event-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title')
					@la_input($module, 'allday')
					@la_input($module, 'start')
					@la_input($module, 'end')
					@la_input($module, 'espaco_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Atualizar', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/calendar_events') }}">Cancelar</a></button>
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
	$("#calendar_event-edit-form").validate({
		
	});
});
</script>
@endpush
