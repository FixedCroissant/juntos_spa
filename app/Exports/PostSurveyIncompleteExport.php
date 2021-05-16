<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PostSurveyIncompleteExport implements FromView
{
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

        $students = Student::leftJoin('sites','students.site_id','=','sites.id')
            ->where('post_survey_completed',NULL)->orWhere('post_survey_completed',"N")
            ->whereIn('site_id',$userSites)->get();

        return view('pages.reports.post_survey_incomplete.report_generate', [
            'students'=>$students
        ]);
    }
}
