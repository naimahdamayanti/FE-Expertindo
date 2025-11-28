@extends('layout')
@section('title','Edit Daftar Hadir')
@section('judul','Form Edit Daftar Hadir')
@section('isi')
<form action="{{ route('absensi.update', $absensi->id_kehadiran) }}" method="post">
        @csrf
        <div class="form-group mb-2">
            <label>ID Kehadiran</label>
            <input type="text" name="id_kehadiran" value="{{ old('id_kehadiran') }}" class="form-control">
        </div>
        <div class="form-group mb-2">
            <label>NPM</label>
            <input type="text" name="npm" value="{{ old('npm') }}" class="form-control">
        </div>
        <div class="form-group mb-2">
            <label>ID Dosen</label>
            <input type="text" name="id_dosen" value="{{ old('id_dosen') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
        <label>Pertemuan</label>
        <select class="form-control" name="pertemuan">
            <option value="">--Pilih Pertemuan--</option>
            @for ($i = 1; $i <= 16; $i++)
                <option value="{{ $i }}" {{ old('pertemuan') == $i ? 'selected' : '' }}>Pertemuan {{ $i }}</option>
            @endfor
        </select>
        </div>
        <div class="form-group mb-2">
            <label>Keterangan</label>
            <select name="keterangan" class="form-control">
                <option value="">--Pilih Keterangan--</option>
                <option value="H" {{ old('keterangan') == 'H' ? 'selected' : '' }}>Hadir</option>
                <option value="I" {{ old('keterangan') == 'I' ? 'selected' : '' }}>Izin</option>
                <option value="S" {{ old('keterangan') == 'S' ? 'selected' : '' }}>Sakit</option>
                <option value="A" {{ old('keterangan') == 'A' ? 'selected' : '' }}>Absen</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>



    {{--  javascript untuk validasi form bootstrap di atas  --}}
    
    {{-- <script>// Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
              'use strict'
            
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              const forms = document.querySelectorAll('.needs-validation')
            
              // Loop over them and prevent submission
              Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                  if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                  }
            
                  form.classList.add('was-validated')
                }, false)
              })
            })()
    </script> --}}
@endsection        
