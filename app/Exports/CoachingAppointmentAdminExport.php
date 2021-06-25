<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\User;
use App\Models\CoachAppointment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class CoachingAppointmentAdminExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    public $counties;
    public $site;

    public function __construct($countySearch,$sitePicked){
        $this->counties = $countySearch;
        $this->site = $sitePicked;
    }

    public function title(): string{
        return 'Admin Success Coaching List';
    }

    /**
     * @return array
     */
    public function registerEvents(): array{
        return [
            AfterSheet::class=>function (AfterSheet $event){
                $cellRange = 'A1:P1';
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
        //Admin report, provide all data.
        //Filters
        $counties = $this->counties;
        $sitePicked = $this->site;

        //If counties are Null provide everything.
        if(is_null($counties[0]) && !is_null($sitePicked[0])){
            $appointments = CoachAppointment::leftJoin('students','coach_appointments.student_id','=','students.id')
                ->leftJoin('sites','students.site_id','=','sites.id')
                ->leftJoin('users','coach_appointments.user_id','=','users.id')
                ->orderBy('appointment_date','ASC')
                ->get();
        }
        //If site is null, but counties are not
        else if(!is_null($counties[0]) && is_null($sitePicked[0])){
            $appointments = CoachAppointment::leftJoin('students','coach_appointments.student_id','=','students.id')
                ->leftJoin('sites','students.site_id','=','sites.id')
                ->leftJoin('users','coach_appointments.user_id','=','users.id')
                ->orderBy('appointment_date','ASC')
                ->get();
        }
        //No sites and no counties and no grade give all.
        else if(is_null($sitePicked[0]) && is_null($counties[0])){
            $appointments = CoachAppointment::leftJoin('students','coach_appointments.student_id','=','students.id')
                ->leftJoin('sites','students.site_id','=','sites.id')
                ->leftJoin('users','coach_appointments.user_id','=','users.id')
                ->orderBy('appointment_date','ASC')
                ->get();
        }
        //Both county and site picked, add another limitation.
        else if(!is_null($sitePicked[0]) && !is_null($counties[0])){
            $appointments = CoachAppointment::leftJoin('students','coach_appointments.student_id','=','students.id')
                ->leftJoin('sites','students.site_id','=','sites.id')
                ->leftJoin('users','coach_appointments.user_id','=','users.id')
                ->orderBy('appointment_date','ASC')
                ->get();
        }

        return view('pages.reports.coaching.report_generate', [
                    'appointments'=>$appointments

        ]);
    }
}
