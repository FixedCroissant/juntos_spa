<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentsExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    public $counties;
    public $site;
    public $grade;

    public function __construct($countySearch,$sitePicked, $gradePicked){
        $this->counties = $countySearch;
        $this->site = $sitePicked;
        $this->grade = $gradePicked;
    }

    public function title(): string{
        return 'Students';
    }

    /**
     * @return array
     */
    public function registerEvents(): array{
        return [
            AfterSheet::class=>function (AfterSheet $event){
            $cellRange = 'A1:S1';
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
        $counties = $this->counties;
        $sitePicked = $this->site;
        $gradePicked = $this->grade;

        //If counties are Null provide everything.
        if(is_null($counties[0]) && !is_null($sitePicked[0])){
            $students = Student::leftJoin('sites','students.site_id','=','sites.id')->select('students.id as id','students.*','sites.site_name')
                ->whereIn('site_id',$sitePicked)->get();
        }
        //No sites and no counties and no grade give all.
        else if(is_null($sitePicked[0]) && is_null($counties[0]) && is_null($gradePicked[0])){
            $students = Student::leftJoin('sites','students.site_id','=','sites.id')->select('students.id as id','students.*','sites.site_name')->get();
        }
        //If counties are Null, but grade is filtered
        else if(is_null($counties[0]) && !is_null($gradePicked[0])){
            $students = Student::leftJoin('sites','students.site_id','=','sites.id')->whereIn('grade',$gradePicked)->select('students.id as id','students.*','sites.site_name')->get();
        }
        //Filter items down.
        else{

            $students = Student::leftJoin('sites','students.site_id','=','sites.id')->whereIn('grade',$gradePicked)
                ->whereIn('county',$counties)->select('students.id as id','students.*','sites.site_name')->get();
        }

        return view('pages.reports.students.report_generate', [
            'students'=>$students
        ]);
    }
}
