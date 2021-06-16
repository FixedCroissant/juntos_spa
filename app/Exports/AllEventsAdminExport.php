<?php

namespace App\Exports;

use App\Models\Event;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class AllEventsAdminExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    public $site;
    public $event_type;

    public function __construct($sitePicked,$eventType){
        $this->site = $sitePicked;
        $this->event_type = $eventType;
    }

    public function title(): string{
        return 'Event List - Admin';
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
        //Filters
        $eventTypePicked = $this->event_type;
        $sitePicked = $this->site;

        //If no event type and no site is picked, display all.
        if(is_null($eventTypePicked[0])&& is_null($sitePicked[0])){
            $events = Event::leftJoin('sites', 'events.site_id', '=', 'sites.id')->select('events.id as id', 'events.*', 'sites.site_name')->get();
        }
        //If site association is provided, but no event type.
        else if(is_null($eventTypePicked[0]) && !is_null($sitePicked[0])){
            $events = Event::leftJoin('sites', 'events.site_id', '=', 'sites.id')->whereIn('site_id',$sitePicked)
                ->select('events.id as id', 'events.*', 'sites.site_name')->get();
        }
        else {
            //Filter events down.
            $events = Event::leftJoin('sites', 'events.site_id', '=', 'sites.id')->whereIn('event_type', $eventTypePicked)
                ->select('events.id as id', 'events.*', 'sites.site_name')->get();
        }

        return view('pages.reports.events.admin_report_generate', ['events'=>$events]);
    }
}
