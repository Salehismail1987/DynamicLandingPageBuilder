<?php

namespace App\Exports;

use App\Models\EmailList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportEmailList implements FromCollection, WithHeadings
{

    protected $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        $emailList =  EmailList::whereIn('id', $this->rows)
            ->select('id', 'name', 'email_address', 'subscribed','fields')
            ->get();
            foreach( $emailList as $single){
                $single->subscribed = $single->subscribed=='1'?'Yes':'No';
            }
        return $emailList;
    }

    public function headings(): array
    {
        $headings =  ["Sr#", "Name", "EmailAddress", "Subscribed",'Fields'];
        return $headings;
    }

    public function sheets(): array
    {
        $sheets = ['Sheet1', 'Sheet2'];

        return $sheets;
    }
}
