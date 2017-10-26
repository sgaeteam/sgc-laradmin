<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar_event;
use App\Http\Requests;
use Carbon\Carbon;

class SampleController extends Controller
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
        $this->calendarEvent = $calendarEvent;
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
                'color' => '#FF0000',
                'url' => 'http://google.com',
            ]
        );
        $databaseEvents = $this->calendarEvent->all();
        $calendar = \Calendar::addEvent($staticEvent)->addEvents($databaseEvents);
        return view('la.calendar', compact('calendar'));
        
    }
    /**
     *   https://stackoverflow.com/questions/30662238/cannot-get-fullcalendar-to-work-laravel-5
    */
}
