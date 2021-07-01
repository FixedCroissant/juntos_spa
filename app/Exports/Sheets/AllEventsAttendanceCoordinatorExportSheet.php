<?php

namespace App\Exports\Sheets;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AllEventsAttendanceCoordinatorExportSheet implements FromView, WithTitle, ShouldAutoSize,WithEvents
{
    public $site;
    public $event_type;
    public $startDate;
    public $endDate;


    public function __construct($sitePicked,$eventType,$startDatePicked,$endDatePicked){
        $this->site = $sitePicked;
        $this->event_type = $eventType;
        $this->startDate = $startDatePicked;
        $this->endDate = $endDatePicked;
    }

    /**
     * @return array
     */
    public function registerEvents(): array{
        return [
            AfterSheet::class=>function (AfterSheet $event){
                $cellRange = 'A1:G1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e6ebe6');
            },
        ];
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $userAccess = auth()->user();
        $userSites=[];

        foreach($userAccess->studentAccess as $siteAccess){
            $userSites[]=$siteAccess->pivot->site_id;
        }

        //Filters
        $eventTypePicked = $this->event_type;
        $sitePicked = $this->site;
        $startDate = $this->startDate;
        $endDate = $this->endDate;

        //Limited results based on site assignment.
        //If no event type and no site is picked, display all.
        if(is_null($eventTypePicked[0])&& is_null($sitePicked[0])){
            $events = Event::leftJoin('event_attendance','events.id','=','event_attendance.event_id')->leftJoin('sites', 'events.site_id', '=', 'sites.id')->select('events.id as id', 'events.*', 'sites.site_name',\DB::raw('sibling_number+other_guests_number AS totalOtherGuest'),'sibling_number','other_guests_number','event_id')->distinct()->whereIn('site_id',$userSites)->whereDate('event_start_date','>=',$startDate)->whereDate('event_end_date','<=',$endDate)->get();
        }
        //Limited results based on site assignment.
        //If site association is provided, but no event type.
        else if(is_null($eventTypePicked[0]) && !is_null($sitePicked[0])){
            $events = Event::leftJoin('event_attendance','events.id','=','event_attendance.event_id')->leftJoin('sites', 'events.site_id', '=', 'sites.id')->whereIn('site_id',$sitePicked)
                ->select('events.id as id', 'events.*', 'sites.site_name',\DB::raw('sibling_number+other_guests_number AS totalOtherGuest'),'sibling_number','other_guests_number','event_id')->distinct()
                ->whereIn('site_id',$userSites)->whereDate('event_start_date','>=',$startDate)->whereDate('event_end_date','<=',$endDate)->get();
        }
        else {
            //Filter events down.
          $events = Event::leftJoin('event_attendance','events.id','=','event_attendance.event_id')->leftJoin('sites', 'events.site_id', '=', 'sites.id')->whereIn('event_type', $eventTypePicked)
                ->whereIn('site_id',$userSites)->select('events.id as id', 'events.*', 'sites.site_name')->whereDate('event_start_date','>=',$startDate)->whereDate('event_end_date','<=',$endDate)->get();
        }

        return view('pages.reports.events.coordinator_attendance_report_generate', ['events'=>$events]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Event Attendance';
    }
}
