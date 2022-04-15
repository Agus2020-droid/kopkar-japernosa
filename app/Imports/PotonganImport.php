<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\PotonggajiModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;
class PotonganImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;
    
    public function rules(): array
    {
        return [
            '*.kode_potongan' => 'required|unique:potonggaji',
            '*.nik_ktp' => 'required',
            '*.jumlah_potongan' => 'required',
            '*.simpanan_pokok' => 'required',
            '*.simpanan_wajib' => 'required',
            '*.simpanan_sukarela' => 'required',
            '*.jumlah_simpanan' => 'required',

            
        ];
    }
    
    public function customValidationMessages()
    {
        return [
            
            'kode_potongan.required' => 'Kode potongan tidak boleh kosong',
            'kode_potongan.unique' => 'Kode potongan sudah ada',
            'nik_ktp.required' => 'Nik KTP tidak boleh kosong',
            'jumlah_potongan.required' => 'Jumlah potongan tidak boleh kosong',
            'simpanan_pokok.required' => 'Simpanan Pokok tidak boleh kosong',
            'simpanan_wajib.required' => 'Simpanan Wajib tidak boleh kosong',
            'simpanan_sukarela.required' => 'Simpanan Sukarela tidak boleh kosong',
            'jumlah_simpanan.required' => 'jumlah Simpanan tidak boleh kosong',
            

        ];
    }
   

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            $potonggaji = PotonggajiModel::create([
                'kode_potongan' => $row['kode_potongan'],
                'nik_ktp' => $row['nik_ktp'],
                'jumlah_potongan' => $row['jumlah_potongan'],
            ]);
            $potonggaji->simpanan()->create([
                'nik_ktp' => $row['nik_ktp'],
                'simpanan_pokok'=> $row['simpanan_pokok'],
                'simpanan_wajib'=> $row['simpanan_wajib'],
                'simpanan_sukarela'=> $row['simpanan_sukarela'],
                'jumlah_simpanan'=> $row['jumlah_simpanan'],
            ]);
            $potonggaji->angsuran()->create([
                'nik_ktp' => $row['nik_ktp'],
                'no_pinjaman'=> $row['no_pinjaman'],
                'jumlah_angsuran'=> $row['jumlah_angsuran'],
               
            ]);
        }
    }

    
}
