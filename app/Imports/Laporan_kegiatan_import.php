<?php

namespace App\Imports;

use App\Models\Laporan_kegiatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Uuid;
use Carbon\Carbon;

class Laporan_kegiatan_import implements ToModel, WithStartRow, WithCustomCsvSettings
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
        return new Laporan_kegiatan([
            'uuid_kegiatan' => Uuid::generate(),
            'tanggal'       => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date:: excelToDateTimeObject($row[1]))->toDateString(),
            'id_unit'       => $row[2],
            'keterangan'    => $row[3],
            'lokasi'        => $row[4]
        ]);
    }
}
