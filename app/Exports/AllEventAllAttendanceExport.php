<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AllEventAllAttendanceExport implements FromView
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $events = Event::with(['attendance','parentAttendance'])
            ->leftJoin('event_attendance','events.id','=','event_attendance.event_id')
            ->select('events.*',DB::raw('sibling_number+other_guests_number AS totalOtherGuest'),'sibling_number','other_guests_number','event_id')->distinct()
            ->get();

        return view('pages.reports.events.report_generate', [
            'events'=>$events
        ]);
    }
}
