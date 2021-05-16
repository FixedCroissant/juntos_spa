<?php

namespace App\Exports;

use App\Models\Volunteer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VolunteersExport implements FromView
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

        $volunteers = Volunteer::leftJoin('sites','volunteers.site_id','=','sites.id')
            ->whereIn('site_id',$userSites)->get();

        return view('pages.reports.volunteers.report_generate', [
            'volunteers'=>$volunteers
        ]);
    }
}
