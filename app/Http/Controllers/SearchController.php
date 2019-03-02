<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class SearchController extends Controller
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

    public function search(Request $request)
    {
        if (!$request->criteria) {
            return redirect()->action('AppointmentController@index');
        }

        $formatDateTime = function($event) {
            $event->start->dateTime = AppointmentController::formatDateTime(
            AppointmentController::typecastToCarbon($event->start->dateTime));
            
            return $event;
        };

        $events = [];
        foreach(Event::get() as $event) {
            if (strpos(
                strtolower($event->name), 
                strtolower($request->criteria)) !== false) {
                array_push($events, $formatDateTime($event));
            }
        }

        return view('appointments/index', [
            'events' => $events
        ]);
    }
}
