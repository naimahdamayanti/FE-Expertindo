@extends('layout')
@section('title','Konsultan')
@section('judul','Konsultan')
@section('isi')

@if (Session::has('create'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Di Tambah</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Di Hapus!</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('update'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Di Edit!</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('daftar'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Pendaftaran Berhasil!</strong> Anda telah terdaftar dalam training ini.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="container mt-5">     
        <a href="{{ url('/dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Konsultan
        </a>
        <div class="card-body p-5">
            <img src="{{ asset('template/assets/img/konsultan.png') }}" alt="Konsultan Professional" class="card-img-top"
                 style="height: 400px; object-fit: cover;">
            <div class="hero-overlay">
                <h1 class="hero-title"><a href="https://docs.google.com/forms/d/e/1FAIpQLSelRz-cdWbvE2F47OwJn0myR4WnpafNcgyIjKZN3iXt7gWRiQ/viewform">Formulir Pendaftaran Konsultan</a></h1>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content-section">
            <h1 class="card-title display-5 fw-bold mb-3">Tentang Layanan Konsultan</h1>
            <p>
                Konsultan profesional untuk puluhan bidang keahlian yang ditangani langsung oleh 
                profesional dan praktisi terbaik.
            </p>
            <p>
                Daftar saat ini jadi <a href="https://expertindo-training.com/">PT Expertindo</a> dapat dilihat <a href="https://docs.google.com/forms/d/e/1FAIpQLSelRz-cdWbvE2F47OwJn0myR4WnpafNcgyIjKZN3iXt7gWRiQ/viewform">disini</a>.
            </p>

            <div class="info-box">
                <p>
                    <strong><i class="fas fa-info-circle"></i> Informasi:</strong><br>
                    Untuk informasi lebih lanjut atau pendaftaran, silakan hubungi tim kami atau 
                    kunjungi halaman kontak.
                </p>
            </div>
        </div>
    </div>
</body>
</html>

@endsection