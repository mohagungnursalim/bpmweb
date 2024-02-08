<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Models\Subscriber;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscriberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return DB::table('subscribers')->select('email')->get();
    }
}
