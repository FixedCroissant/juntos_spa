<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Exports\Sheets\AllEventsExportSheet;
use App\Exports\Sheets\AllEventsAttendanceCoordinatorExportSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllEventsExport implements WithTitle,WithMultipleSheets
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
    public function sheets(): array
    {
        $sheets = [];
        //Sheet 1 - Event List
        $sheets[] = new AllEventsExportSheet($this->site,$this->event_type,$this->startDate,$this->endDate);
        //Sheet 2 - Event Attendance
        $sheets[] = new AllEventsAttendanceCoordinatorExportSheet($this->site,$this->event_type,$this->startDate,$this->endDate);

        return $sheets;
    }
}
