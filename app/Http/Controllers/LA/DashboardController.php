<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Socio;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $convites = 12;
        $pagamentos = 99;
        $socios = $this->getSocios();
        $visitantes = 554;
        
        $teste1 = 24;
        $teste2 = 56;
        $teste3 = 20;
        echo json_encode($teste1);
        echo json_encode($teste2);
        echo json_encode($teste3);
        
        return view('la.dashboard',compact('convites','pagamentos','socios','visitantes'));
    }

	/**
	 * Display the total count of the Convites.
	 *
	 * @return int
	 */
	public function getConvites()
	{
    	//return	$module = Convite::count();
	}	

	/**
	 * Display the total count of the Pagamentos.
	 *
	 * @return int
	 */
	public function getPagamentos()
	{
    	//return	$module = Pagamento::count();
	}
	/**
	 * Display the total count of the Socios.
	 *
	 * @return int
	 */
	public function getSocios()
	{
    	return	$module = Socio::count();
	}	

	/**
	 * Display the total count of the Visitantes.
	 *
	 * @return int
	 */
	public function getVisitantes()
	{
    	//return	$module = Visitante::count();
	}		
}