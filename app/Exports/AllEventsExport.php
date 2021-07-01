<?php

namespace App\Exports;

use App\Models\Event;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class AllEventsExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
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

    public function title(): string{
        return 'Event List';
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
            $events = Event::leftJoin('sites', 'events.site_id', '=', 'sites.id')->select('events.id as id', 'events.*', 'sites.site_name')->whereIn('site_id',$userSites)->whereDate('event_start_date','>=',$startDate)->whereDate('event_end_date','<=',$endDate)->get();
        }
        //Limited results based on site assignment.
        //If site association is provided, but no event type.
        else if(is_null($eventTypePicked[0]) && !is_null($sitePicked[0])){
            $events = Event::leftJoin('sites', 'events.site_id', '=', 'sites.id')->whereIn('site_id',$sitePicked)
                ->whereIn('site_id',$userSites)->select('events.id as id', 'events.*', 'sites.site_name')->whereDate('event_start_date','>=',$startDate)->whereDate('event_end_date','<=',$endDate)->get();
        }
        else {
            //Filter events down.
            $events = Event::leftJoin('sites', 'events.site_id', '=', 'sites.id')->whereIn('event_type', $eventTypePicked)
                ->whereIn('site_id',$userSites)->select('events.id as id', 'events.*', 'sites.site_name')->whereDate('event_start_date','>=',$startDate)->whereDate('event_end_date','<=',$endDate)->get();
        }

        return view('pages.reports.events.admin_report_generate', ['events'=>$events]);
    }
}
