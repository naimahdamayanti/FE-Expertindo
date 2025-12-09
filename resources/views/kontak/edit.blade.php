@extends('layout')
@section('title','Edit Dosen')
@section('judul','Form Edit Dosen')
@section('isi')
<div class="card">
    <div class="card-body">
        <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="POST">
            @csrf
            @method('PUT') <!-- Gunakan method PUT untuk update -->

            <div class="mb-3">
                <label for="id_dosen" class="form-label">ID Dosen</label>
                <input type="text" class="form-control" id="id_dosen" name="id_dosen" value="{{ $dosen->id_dosen }}" readonly>
            </div>

            <div class="mb-3">
                <label for="nama_dosen" class="form-label">Nama Dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="{{ $dosen->nama_dosen }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>


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