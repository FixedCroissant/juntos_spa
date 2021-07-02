<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class ParentsExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
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
        return 'Parent List';
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
            $parents = DB::table('parents')
                ->leftJoin('students', 'parents.student_id', '=', 'students.id')
                ->leftJoin('sites', 'students.site_id', '=', 'sites.id')
                ->select('parents.*','students.site_id','students.student_first_name','students.student_last_name', 'students.site_id', 'sites.site_name')
                ->whereIn('site_id',$sitePicked)->whereIn('site_id', $userSites)->orderBy('parents.student_id', 'ASC')
                ->get();
        }
        //Counties are picked, but everything else is blank.
        if(!is_null($counties[0]) && is_null($sitePicked[0]) && is_null($gradePicked[0])){
            $parents = DB::table('parents')
                ->leftJoin('students', 'parents.student_id', '=', 'students.id')
                ->leftJoin('sites', 'students.site_id', '=', 'sites.id')
                ->select('parents.*','students.county','students.student_first_name','students.student_last_name', 'students.site_id', 'sites.site_name')
                ->whereIn('county',$counties)->whereIn('site_id', $userSites)->orderBy('parents.student_id', 'ASC')
                ->get();
        }
        //No sites and no counties and no grade give all.
        else if(is_null($sitePicked[0]) && is_null($counties[0]) && is_null($gradePicked[0])){
            $parents = DB::table('parents')
                ->leftJoin('students', 'parents.student_id', '=', 'students.id')
                ->leftJoin('sites', 'students.site_id', '=', 'sites.id')
                ->select('parents.*','students.site_id','students.student_first_name','students.student_last_name', 'students.site_id', 'sites.site_name')
                ->whereIn('site_id', $userSites)->orderBy('parents.student_id', 'ASC')
                ->get();

        }
        //If counties are Null, but grade is filtered
        else if(is_null($counties[0]) && !is_null($gradePicked[0])){
            $parents = DB::table('parents')
                ->leftJoin('students', 'parents.student_id', '=', 'students.id')->leftJoin('sites', 'students.site_id', '=', 'sites.id')
                ->select('parents.*','students.grade','students.student_first_name','students.student_last_name', 'students.site_id', 'sites.site_name')
                ->whereIn('grade',$gradePicked)->whereIn('site_id', $userSites)->orderBy('parents.student_id', 'ASC')
                ->get();
        }
        //If counties are Null, but grade and site are filtered.
        else if(is_null($counties[0]) && !is_null($sitePicked[0]) && !is_null($gradePicked[0])){
            $parents = DB::table('parents')
                ->leftJoin('students', 'parents.student_id', '=', 'students.id')->leftJoin('sites', 'students.site_id', '=', 'sites.id')
                ->select('parents.*','students.grade','students.site_id','students.student_first_name','students.student_last_name', 'students.site_id', 'sites.site_name')
                ->whereIn('grade',$gradePicked)->whereIn('site_id',$sitePicked)->whereIn('site_id', $userSites)
                ->orderBy('parents.student_id', 'ASC')
                ->get();
        }
        return view('pages.reports.parents.report_generate', ['parents'=>$parents]);
    }
}
