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

use App\Models\Atividade;

class AtividadesController extends Controller
{
	public $show_action = true;
	public $view_col = 'descricao';
	public $listing_cols = ['id', 'mensalidade', 'descricao'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Atividades', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Atividades', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Atividades.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Atividades');
		
		if(Module::hasAccess($module->id)) {
			return View('la.atividades.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new atividade.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created atividade in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Atividades", "create")) {
		
			$rules = Module::validateRules("Atividades", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Atividades", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.atividades.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified atividade.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Atividades", "view")) {
			
			$atividade = Atividade::find($id);
			if(isset($atividade->id)) {
				$module = Module::get('Atividades');
				$module->row = $atividade;
				
				return view('la.atividades.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('atividade', $atividade);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("atividade"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified atividade.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Atividades", "edit")) {			
			$atividade = Atividade::find($id);
			if(isset($atividade->id)) {	
				$module = Module::get('Atividades');
				
				$module->row = $atividade;
				
				return view('la.atividades.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('atividade', $atividade);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("atividade"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified atividade in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Atividades", "edit")) {
			
			$rules = Module::validateRules("Atividades", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Atividades", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.atividades.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified atividade from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Atividades", "delete")) {
			Atividade::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.atividades.index');
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
		$values = DB::table('atividades')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Atividades');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/atividades/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Atividades", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/atividades/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Atividades", "delete")) {
					$output .= ' <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DelModal_'.$data->data[$i][0].'"><i class="fa fa-times"></i></button>';
					$output .= '  <div class="modal fade" id="DelModal_'.$data->data[$i][0].'" role="dialog" aria-labelledby="myModalLabel">';
					$output .= '   <div class="modal-dialog" role="document">';
					$output .= '    <div class="modal-content">';
					$output .= '      <div class="modal-header">';
					$output .= '	   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					$output .= '	   <h4 class="modal-title" id="myDelModalLabel">Excluir Atividades</h4>';
					$output .= '	  </div>';
					$output .=   	  Form::open(['route' => [config('laraadmin.adminRoute') . '.atividades.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
}
