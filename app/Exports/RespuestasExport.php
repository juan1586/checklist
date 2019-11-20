<?php

namespace App\Exports;
use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class RespuestasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = DB::table('users')->select('id','name','email')->get();
        return $users;
    }
}
