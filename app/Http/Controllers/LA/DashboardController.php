<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Calendar_event;
use App\Models\Socio;
use App\Models\Dependente;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
	/**
     * @var CalendarEvent
     */
    private $calendarEvent;
    /**
     * @param CalendarEvent $calendarEvent
     */
    public function __construct(Calendar_event $calendarEvent)
    {
    	$this->middleware('auth');
        $this->calendarEvent = $calendarEvent;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
    
    public function __construct()
    {
        $this->middleware('auth');
    }
 */
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $convites   = $this->getConvites();
        $pagamentos = $this->getPagamentos();
        $socios     = $this->getSocios();
        $visitantes = $this->getVisitantes();
        $calendar   = $this->calendar();
        
        return view('la.dashboard',compact('convites','pagamentos','socios','visitantes','calendar'));
    }

	/**
	 * Display the total count of the Convites.
	 *
	 * @return int
	 */
	public function getConvites()
	{
    	return	$module = 12; // Convite::count();
	}	

	/**
	 * Display the total count of the Pagamentos.
	 *
	 * @return int
	 */
	public function getPagamentos()
	{
    	return	$module = 150; //Pagamento::count();
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
	 * Display the total count of the Socios.
	 *
	 * @return int
	 */
	public function getDependentes()
	{
    	return	$module = Dependente::count();
	}	

	/**
	 * Display the total count of the Visitantes.
	 *
	 * @return int
	 */
	public function getVisitantes()
	{
    	return	$module = 554; //Visitante::count();
	}
	
	/**
	 * Display the donut chart for total user month 
	 *
	 * @return json
	 */
	public function user_month_chart()
	{
		
        $socios = $this->getSocios();
        $dependentes = $this->getDependentes();
        $usuarios = 25;
    	
		return response()->json([
			['label' => "Sócios",		'value' => $socios],
			['label' => "Dependentes",	'value' => $dependentes],
			['label' => "Usuários",		'value' => $usuarios]
		]);
    }
    
    public function calendar()
    {
        $staticEvent = \Calendar::event(
            'Macaco que Voa',
            true,
            Carbon::today()->setTime(0, 0),
            Carbon::today()->setTime(23, 59),
            null,
            [
                'color' => '#F00000',
                'url' => 'http://google.com',
            ]
        );
        $databaseEvents = $this->calendarEvent->all();
        $calendar = \Calendar::addEvent($staticEvent)->addEvents($databaseEvents);
        return $calendar; //view('la.dashboard', compact('calendar'));
        
    }	
}