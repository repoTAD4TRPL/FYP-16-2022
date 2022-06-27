<?php

namespace App\Imports;

use App\Models\Laporan_keuangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Uuid;
use Carbon\Carbon;
use Session;

class Laporan_keuangan_import implements ToModel, WithStartRow, WithCustomCsvSettings
{

    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Laporan_keuangan([
            'uuid_keuangan' => Uuid::generate(),
            'tanggal'       => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date:: excelToDateTimeObject($row[1]))->toDateString(),
            'jenis'         => $row[2],
            'keterangan'    => $row[3],
            'nilai'         => str_replace(array(',','.'), '', $row[4]),
            'id_unit'       => $row[5],
            'upload_by'         => Session::get('username')

        ]);
    }

}
