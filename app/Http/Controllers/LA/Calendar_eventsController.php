<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Calendar_event;

class Calendar_eventsController extends Controller
{
	public $show_action = true;
	public $view_col = 'title';
	public $listing_cols = ['id', 'title', 'start', 'end', 'espaco_id'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Calendar_events', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Calendar_events', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Calendar_events.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Calendar_events');
		
		if(Module::hasAccess($module->id)) {
			return View('la.calendar_events.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new calendar_event.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created calendar_event in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Calendar_events", "create")) {
		
			$rules = Module::validateRules("Calendar_events", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			/* Verifica se há disponibilidade de horário para o espaço escolhido | M97 */
			$validator->after(function($validator) use ($request)
			{
				$disponibilidade = $this->checkDisponibilidade($request);
				
				if (!$disponibilidade) {
					$validator->errors()->add('start', 'Intervalo de horário já OCUPADO para o espaço escolhido!');
				}
			});	
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Calendar_events", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.calendar_events.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified calendar_event.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Calendar_events", "view")) {
			
			$calendar_event = Calendar_event::find($id);
			if(isset($calendar_event->id)) {
				$module = Module::get('Calendar_events');
				$module->row = $calendar_event;
				
				return view('la.calendar_events.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('calendar_event', $calendar_event);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("calendar_event"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified calendar_event.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Calendar_events", "edit")) {			
			$calendar_event = Calendar_event::find($id);
			if(isset($calendar_event->id)) {	
				$module = Module::get('Calendar_events');
				
				$module->row = $calendar_event;
				
				return view('la.calendar_events.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('calendar_event', $calendar_event);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("calendar_event"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified calendar_event in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Calendar_events", "edit")) {
			
			$rules = Module::validateRules("Calendar_events", $request, true);
			
			$validator = Validator::make($request->all(), $rules);

			/* Verifica se há disponibilidade de horário para o espaço escolhido | M97 */
			$validator->after(function($validator) use ($request)
			{
				$disponibilidade = $this->checkDisponibilidade($request);
				
				if (!$disponibilidade) {
					$validator->errors()->add('start', 'Intervalo de horário já OCUPADO para o espaço escolhido!');
				}
			});
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Calendar_events", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.calendar_events.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified calendar_event from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Calendar_events", "delete")) {
			Calendar_event::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.calendar_events.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('calendar_events')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Calendar_events');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/calendar_events/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Calendar_events", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/calendar_events/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Calendar_events", "delete")) {
					$output .= ' <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DelModal_'.$data->data[$i][0].'"><i class="fa fa-times"></i></button>';
					$output .= '  <div class="modal fade" id="DelModal_'.$data->data[$i][0].'" role="dialog" aria-labelledby="myModalLabel">';
					$output .= '   <div class="modal-dialog" role="document">';
					$output .= '    <div class="modal-content">';
					$output .= '      <div class="modal-header">';
					$output .= '	   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					$output .= '	   <h4 class="modal-title" id="myDelModalLabel">Excluir Evento</h4>';
					$output .= '	  </div>';
					$output .=   	  Form::open(['route' => [config('laraadmin.adminRoute') . '.calendar_events.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= '	  <div class="modal-body">';
					$output .= '	   <div class="box-body">Tem certeza de que deseja excluir este registro?</div>';
					$output .= '	  </div>';
					$output .= '	  <div class="modal-footer">';
					$output .= '	   <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>';
					$output .=         Form::submit( 'Sim', ['class'=>'btn btn-success']);
					$output .= '      </div>';
					$output .=        Form::close();
					$output .= '   </div>';
					$output .= '  </div>';
					$output .= ' </div>';
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
	
	/**
	 * Verifica disponibilidade de data antes de criar o evento.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 * 
	 * 
	  // Debug de Query 
	  DB::enableQueryLog(); 
	  DB::table('eventos')->where(function ($query) use ($inicio, $espaco) {
					  $query->where('data_inicial'	, '<='	, $inicio);
					  $query->where('data_final'	, '>='	, $inicio);
					  $query->where('espaco_id'		, '='	, $espaco);
					  $query->whereNull('deleted_at');
			})
			->orWhere(function ($query) use ($fim, $espaco) {
					  $query->where('data_inicial'	, '<='	, $fim);
					  $query->where('data_final'	, '>='	, $fim);
					  $query->where('espaco_id'		, '='	, $espaco); 
					  $query->whereNull('deleted_at');
			})->first();
	  dd(DB::getQueryLog());
	*/
	
	public function checkDisponibilidade(Request $request) {

		$inicio 	= date("Y-m-d G:i A",strtotime(str_replace('/', '-', $request->input('start'))));
		$fim 		= date("Y-m-d G:i A",strtotime(str_replace('/', '-', $request->input('end'))));
		$espaco 	= $request->input('espaco_id');
		
		$evento = Calendar_event::where(function ($query) use ($inicio, $espaco) {
								  $query->where('start'		, '<='	, $inicio);
								  $query->where('end'		, '>='	, $inicio);
								  $query->where('espaco_id'	, '='	, $espaco);
								  $query->whereNull('deleted_at');
						})
						->orWhere(function ($query) use ($fim, $espaco) {
								  $query->where('start'		,  '<='	, $fim);
								  $query->where('end'		,  '>='	, $fim);
								  $query->where('espaco_id'	,  '='	, $espaco);
								  $query->whereNull('deleted_at');   					
				  })->first();
	  
        if(isset($evento)) {
        	return false; // Intervalo de horário já OCUPADO para o espaço escolhido!
        }
        return true; // Intervalo de horário DISPONÍVEL para o espaço escolhido!
	}	
}
