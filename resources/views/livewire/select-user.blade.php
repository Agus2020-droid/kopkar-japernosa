<div>
    <div class="form-group has-feedback">
        <select name="nik_ktp" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" placeholder="Nomor Induk Kependudukan" id="nik"value="{{old('nik_ktp')}}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <option value="">-Pilih NIK-</option>
            @foreach($pegawai as $key => $data)
            <option value="{{$data->nik_ktp}}">{{$data->nik_ktp}} - {{$data->nama}}</option>
            @endforeach 
        </select>
    </div>
    
    <div class="form-group has-feedback">
        <label for="">Nama</label>
        <select name="nik_karyawan"  wire:model="pegawai"class="form-control">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <option selected disabled>Pilih Nama</option>
        <option value="{{$data->nama}}"></option>
     
        </select>
        </div>
  
     
</div>