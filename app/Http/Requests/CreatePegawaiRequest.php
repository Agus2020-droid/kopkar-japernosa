<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik_ktp' => 'required|max:16|min:16|unique:pegawai',
            'nama' => 'required',
            'nik_karyawan' => 'required|unique:pegawai|max:6|min:6',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'telp' => 'required',
            'jabatan' => 'required',
            'kepengurusan' => 'required',
            'alamat' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nik_ktp.required'=>'NIK KTP Wajib Diisi !!!',
            'nik_ktp.max'=>'NIK KTP 16 karakter',
            'nik_ktp.min'=>'NIK KTP 16 karakter',
            'nik_ktp.unique'=>'NIK sudah terdaftar',
            'nama.required'=>'Nama Wajib Diisi !!!',
            'nik_karyawan.required'=>'NIK Karyawan Wajib Diisi !!!',
            'nik_karyawan.unique'=>'NIK Karyawan sudah ada !!!',
            'nik_karyawan.max'=>'NIK Karyawan 6 karakter !!!',
            'nik_karyawan.min'=>'NIK Karyawan 6 karakter !!!',
            'tempat_lahir.required'=>'Tempat Lahir Wajib Diisi !!!',
            'tgl_lahir.required'=>'Tanggal Lahir Wajib Diisi !!!',
            'telp.required'=>'No Telp Wajib Diisi !!!',
            'jabatan.required'=>' Status Karyawan Wajib Diisi !!!',
            'kepengurusan.required'=>'Kepengurusan Wajib Diisi !!!',
            'alamat.required'=>'Alamat Wajib Diisi !!!',
        ];
    }
}
