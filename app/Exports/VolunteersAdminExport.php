<?php

namespace App\Exports;

use App\Models\Volunteer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class VolunteersAdminExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    public $counties;
    public $site;

    public function __construct($countySearch,$sitePicked){
        $this->counties = $countySearch;
        $this->site = $sitePicked;
    }

    public function title(): string{
        return 'Admin Volunteer List';
    }

    /**
     * @return array
     */
    public function registerEvents(): array{
        return [
            AfterSheet::class=>function (AfterSheet $event){
                $cellRange = 'A1:H1';
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
            $volunteers = Volunteer::leftJoin('sites','volunteers.site_id','=','sites.id')->whereIn('site_id',$sitePicked)->get();
        }
        //If site is null, but counties are not
        else if(!is_null($counties[0]) && is_null($sitePicked[0])){
            $volunteers = Volunteer::leftJoin('sites','volunteers.site_id','=','sites.id')->whereIn('county',$counties)->get();
        }
        //No sites and no counties and no grade give all.
        else if(is_null($sitePicked[0]) && is_null($counties[0])){
            $volunteers = Volunteer::leftJoin('sites','volunteers.site_id','=','sites.id')->get();
        }
        //Both county and site picked, add another limitation.
        else if(!is_null($sitePicked[0]) && !is_null($counties[0])){
            $volunteers = Volunteer::leftJoin('sites','volunteers.site_id','=','sites.id')->whereIn('site_id',$sitePicked)->whereIn('county',$counties)->get();
        }
        //Filter items down.
        else
        {
            $volunteers = Volunteer::leftJoin('sites','volunteers.site_id','=','sites.id')->get();
        }

        return view('pages.reports.volunteers.report_generate', [
            'volunteers'=>$volunteers
        ]);
    }
}
