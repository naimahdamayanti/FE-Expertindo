@extends('layout')
@section('title','Profil Kami')
@section('judul','Profil Kami')
@section('isi')

<style>
    body {
        background: #f5f5f5;
    }
    
    .back-link {
        color: #e53935;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .profile-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 0 20px 50px;
    }
    
    .company-logo {
        background: white;
        padding: 40px;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .logo-img {
        max-width: 350px;
        width: 100%;
        height: auto;
    }
    
    .content-section {
        background: white;
        border-radius: 15px;
        padding: 35px;
        margin-bottom: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .content-section:hover {
        box-shadow: 0 6px 25px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    .section-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        border-bottom: 3px solid #e53935;
        padding-bottom: 12px;
    }
    
    .section-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #e53935, #ff5252);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }
    
    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
    
    .section-content {
        color: #555;
        line-height: 1.9;
        text-align: justify;
        font-size: 15px;
    }
    
    .section-content ul {
        padding-left: 25px;
    }
    
    .section-content li {
        margin-bottom: 12px;
    }
    
    .section-content li::marker {
        color: #e53935;
        font-weight: bold;
    }
</style>

<div class="profile-header">
    <div class="container">
        <a href="{{ route('profile') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Profil
        </a>
    </div>
</div>

<div class="profile-container">
    <!-- Logo -->
    <div class="company-logo">
        <img src="{{ asset(session('logo', 'template/assets/img/logo/logo-expertindo.png')) }}"
        alt="Logo Perusahaan"
        class="logo-img">
    </div>

    <!-- Visi -->
<div class="content-section">
    <div class="section-header">
        <div class="section-icon">
            <i class="fas fa-eye"></i>
        </div>
        <h2 class="section-title">Visi</h2>
    </div>
    <div class="section-content">
        <p>Menjadi partner terbaik untuk melayani kebutuhan yang lengkap dan menyeluruh di Indonesia yang berkualitas, efektif, dan efisien dalam memberikan pelayanan konsultasi, pelatihan, pendampingan, dan audit yang dapat membantu perusahaan dan organisasi meningkatkan kinerja yang optimal melalui SDM yang berkualitas.</p>
    </div>
</div>

<!-- Misi -->
<div class="content-section">
    <div class="section-header">
        <div class="section-icon">
            <i class="fas fa-bullseye"></i>
        </div>
        <h2 class="section-title">Misi</h2>
    </div>
    <div class="section-content">
        <ul>
            <li>Menyelenggarakan training dan pendampingan terbaik dan berstandar tinggi dengan sistem metode dan pendekatan belajar yang efektif yang sesuai dengan kebutuhan, tantangan dan keadaan peserta serta organisasi dan manajemen organisasi.</li>
            <li>Menyelenggarakan konsultasi dan pendampingan untuk memperoleh kesuksesan yang konsultan berguna membantu organisasi untuk melakukan evaluasi terhadap SDM dan sistem organisasi yang ada dan memberikan rekomendasi untuk mencapai target yang diinginkan secara kolaboratif.</li>
            <li>Meningkatkan jumlah dengan berbagai paket untuk meningkatkan kualitas dan kompetensi dengan fasilitas yang memadai kepada pelanggan dengan indikator pelanggan semakin puas terhadap pelayanan dan produk yang diberikan oleh Expertindo. Memberikan jasa audit yang berguna untuk kepentingan perusahaan.</li>
        </ul>
    </div>
</div>

<!-- Tujuan -->
<div class="content-section">
    <div class="section-header">
        <div class="section-icon">
            <i class="fas fa-flag-checkered"></i>
        </div>
        <h2 class="section-title">Tujuan</h2>
    </div>
    <div class="section-content">
        <ul>
            <li>Meningkatkan kompetensi karyawan sesuai dengan bidang yang diperlukan dengan professional, terhadap dan berkualitas.</li>
            <li>Menyelenggarakan training dan konsultasi bagi yang memenuhi organisasi dan manajemen organisasi. Mendapatkan instruktur yang berkualitas untuk mencapai tujuan dengan SDM yang profesional dan baik kepada organisasi dan manajemen organisasi.</li>
            <li>Menyelenggarakan untuk mencapai produktivitas karyawan yang tinggi yang berkualitas melalui program yang ada.</li>
        </ul>
    </div>
</div>
</div>
@endsection