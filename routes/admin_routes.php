<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/user_month_chart', 'LA\DashboardController@user_month_chart');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Categorias ================== */
	Route::resource(config('laraadmin.adminRoute') . '/categorias', 'LA\CategoriasController');
	Route::get(config('laraadmin.adminRoute') . '/categoria_dt_ajax', 'LA\CategoriasController@dtajax');

	/* ================== Area_Competencias ================== */
	Route::resource(config('laraadmin.adminRoute') . '/area_competencias', 'LA\Area_CompetenciasController');
	Route::get(config('laraadmin.adminRoute') . '/area_competencia_dt_ajax', 'LA\Area_CompetenciasController@dtajax');

	/* ================== Cobrancas ================== */
	Route::resource(config('laraadmin.adminRoute') . '/cobrancas', 'LA\CobrancasController');
	Route::get(config('laraadmin.adminRoute') . '/cobranca_dt_ajax', 'LA\CobrancasController@dtajax');

	/* ================== Socios ================== */
	Route::resource(config('laraadmin.adminRoute') . '/socios', 'LA\SociosController');
	Route::get(config('laraadmin.adminRoute') . '/socio_dt_ajax', 'LA\SociosController@dtajax');

	/* ================== Dependentes ================== */
	Route::resource(config('laraadmin.adminRoute') . '/dependentes', 'LA\DependentesController');
	Route::get(config('laraadmin.adminRoute') . '/dependente_dt_ajax', 'LA\DependentesController@dtajax');

	/* ================== Atividades ================== */
	Route::resource(config('laraadmin.adminRoute') . '/atividades', 'LA\AtividadesController');
	Route::get(config('laraadmin.adminRoute') . '/atividade_dt_ajax', 'LA\AtividadesController@dtajax');

	/* ================== Espacos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/espacos', 'LA\EspacosController');
	Route::get(config('laraadmin.adminRoute') . '/espaco_dt_ajax', 'LA\EspacosController@dtajax');

	/* ================== Produtos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/produtos', 'LA\ProdutosController');
	Route::get(config('laraadmin.adminRoute') . '/produto_dt_ajax', 'LA\ProdutosController@dtajax');

	/* ================== Calendar_events ================== */
	Route::resource(config('laraadmin.adminRoute') . '/calendar_events', 'LA\Calendar_eventsController');
	Route::get(config('laraadmin.adminRoute') . '/calendar_event_dt_ajax', 'LA\Calendar_eventsController@dtajax');
	
	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	| It's a breeze. Simply tell Laravel the URIs it should respond to
	| and give it the controller to call when that URI is requested.
	|
	*/
	Route::get(config('laraadmin.adminRoute') . '/calendar', ['uses' => 'SampleController@calendar']);

});