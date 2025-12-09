@extends('layout')
@section('title','Home')
@section('judul','Home')
@section('isi')

@php
$user = session('user');
$cards = [];

if ($user && $user->role === 'admin') {
   $cards = [
    ['title' => 'Total Artikel', 'model' => \App\Models\Artikel::class, 'route' => 'artikel.index', 'color' => 'bg-gradient-primary', 'icon' => 'ni ni-single-02'],
    ['title' => 'Total Jadwal', 'model' => \App\Models\Jadwal::class, 'route' => 'jadwal.index', 'color' => 'bg-gradient-danger', 'icon' => 'ni ni-hat-3'],
    ['title' => 'Sertifikasi', 'model' => \App\Models\Sertifikasi::class, 'route' => 'sertifikasi.index', 'color' => 'bg-gradient-info', 'icon' => 'ni ni-atom'],
    ['title' => 'Public Training', 'model' => \App\Models\PublicTraining::class, 'route' => 'publictraining.index', 'color' => 'bg-gradient-secondary', 'icon' => 'ni ni-bullet-list-67'],
   ];
}elseif ($user && $user->role === 'user'){
$cards = [
  ['title'=>'Public Training', 'route'=>'publictraining.index', 'icon'=>'fa-solid fa-chalkboard-teacher', 'color'=>'bg-gradient-success'],
  ['title'=>'Sertifikasi', 'route'=>'sertifikasi.index', 'icon'=>'fa-solid fa-certificate', 'color'=>'bg-gradient-warning'],
  ['title'=>'In House Training', 'route'=>'training.index', 'icon'=>'fa-solid fa-building', 'color'=>'bg-gradient-warning'],
  ['title'=>'Konsultan', 'route'=>'konsultan.index', 'icon'=>'fa-solid fa-user-tie', 'color'=>'bg-gradient-warning'],
];

}
@endphp

<style>
.admin-card-section .card {
    border-radius: 15px;
    transition: all 0.3s ease;
}

.admin-card-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Style untuk User Card (baru) */
.user-card-section {
    text-align: center;
    margin-bottom: 60px;
}

.user-services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    max-width: 1000px;
    margin: 0 auto;
}

.service-card {
    background: #fff;
    border: 2px solid #e0e0e0;
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    display: block;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    border-color: #e53935;
}

.service-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: #f5f5f5;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #666;
    transition: all 0.3s ease;
}

.service-card:hover .service-icon {
    background: #e53835;
    color: #fff;
    transform: scale(1.1);
}

.service-title {
    font-size: 18px;
    font-weight: 700;
    color: #e53935;
    margin: 0;
}

.formulir-link {
    margin-top: 30px;
    text-align: center;
}

.formulir-link a {
    color: #666;
    text-decoration: underline;
    font-size: 14px;
    transition: color 0.3s ease;
}

.formulir-link a:hover {
    color: #e53935;
}

.section-title {
    text-align: center;
    margin-bottom: 50px;
    margin-top: 50px;
}

.section-title h1 {
    font-size: 42px;
    font-weight: 700;
    color: #000000ff;
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}

.section-title h1::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #ff0000, #cc0000);
    border-radius: 2px;
}

.section-title p {
    font-size: 16px;
    color: #666;
    margin-top: 25px;
    letter-spacing: 1px;
}

.event-carousel {
    padding: 40px 0;
    position: relative;
}

.event-carousel .owl-nav button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #fff !important;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    font-size: 20px;
    color: #333 !important;
    transition: all 0.3s ease;
}

.event-carousel .owl-nav button:hover {
    background: #ff0000ff !important;
    color: #fff !important;
}

.event-carousel .owl-nav .owl-prev {
    left: -25px;
}

.event-carousel .owl-nav .owl-next {
    right: -25px;
}

.event-carousel .hero-img img {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.event-carousel .hero-img img:hover {
    transform: scale(1.05);
}

.testimonial-section {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
}

.testimonial-carousel {
            position: relative;
            padding: 20px 60px;
        }
        
        .testimonial-item {
            background: linear-gradient(135deg, #e53935 0%, #d32f2f 100%);
            border-radius: 20px;
            padding: 40px 30px;
            margin: 10px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .testimonial-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }
        
        .testimonial-avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        
        .testimonial-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .testimonial-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .testimonial-text {
            color: #fff;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 25px;
            font-style: italic;
            min-height: 120px;
        }
        
        .testimonial-author {
            margin-top: auto;
        }
        
        .author-name {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .author-position {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
        }
        
        .testimonial-carousel .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #fff !important;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            font-size: 24px;
            color: #e53935 !important;
            transition: all 0.3s ease;
        }
        
        .testimonial-carousel .owl-nav button:hover {
            background: #e53935 !important;
            color: #fff !important;
            transform: translateY(-50%) scale(1.1);
        }
        
        .testimonial-carousel .owl-nav .owl-prev {
            left: 0;
        }
        
        .testimonial-carousel .owl-nav .owl-next {
            right: 0;
        }
        
        @media (max-width: 768px) {
            .section-title h1 {
                font-size: 36px;
            }
            
            .testimonial-carousel {
                padding: 20px 40px;
            }
            
            .testimonial-item {
                min-height: 350px;
                padding: 30px 20px;
            }
            
            .testimonial-carousel .owl-nav button {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
        }

        .staff-carousel {
            position: relative;
            padding: 20px 60px;
        }
        
        .staff-card {
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            margin: 10px;
            min-height: 320px;
        }
        
        .staff-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border-color: #4285f4;
        }
        
        .staff-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 25px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 5px;
        }
        
        .staff-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
        }
        
        .staff-name {
            font-size: 16px;
            font-weight: 700;
            color: #000;
            margin-bottom: 8px;
            line-height: 1.4;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .staff-role {
            font-size: 13px;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        /* Carousel Navigation */
        .staff-carousel .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #fff !important;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            font-size: 20px;
            color: #333 !important;
            transition: all 0.3s ease;
        }
        
        .staff-carousel .owl-nav button:hover {
            background: #ff0000ff !important;
            color: #fff !important;
        }
        
        .staff-carousel .owl-nav .owl-prev {
            left: 0;
        }
        
        .staff-carousel .owl-nav .owl-next {
            right: 0;
        }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="d-flex align-items-center justify-content-center" style="min-height: 65vh; overflow-x: hidden;">
  <div class="container">
    
    <!-- Section Layanan -->
    <div class="section-title">
        <h1 class="wow fadeInUp" data-wow-delay=".4s">
            Layanan Kami
        </h1>
        <p class="wow fadeInUp" data-wow-delay=".6s">
            TINGKATKAN KOMPETENSI ANDA DENGAN LAYANAN TERBAIK KAMI.
        </p>
    </div>

    @if($user && $user->role === 'admin')
<!-- Card untuk Admin -->
<div class="admin-card-section">
    <div class="row justify-content-center mb-5">
      @foreach($cards as $card)
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ $card['title'] }}</p>
                  <h1>{{ $card['model']::count() }}</h1>
                  <a class="stretched-link" href="{{ route($card['route']) }}">Detail..</a>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape {{ $card['color'] }} shadow-primary text-center rounded-circle">
                  <i class="{{ $card['icon'] }} text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
</div>

@elseif($user && $user->role === 'user')
<!-- Card untuk User -->
<div class="user-card-section">
    <div class="user-services-grid">
      @foreach($cards as $card)
        <a href="{{ route($card['route']) }}" class="service-card">
            <div class="service-icon">
                <i class="{{ $card['icon'] }}"></i>
            </div>
            <h3 class="service-title">{{ $card['title'] }}</h3>
        </a>
      @endforeach
    </div>
    
    <div class="formulir-link">
        <a href="#">Formulir Permintaan Informasi Training</a>
    </div>
</div>
@endif

    <!-- Section Event -->
    <div class="section-title">
        <h1 class="wow fadeInUp" data-wow-delay=".4s">
            Event
        </h1>
        <p class="wow fadeInUp" data-wow-delay=".6s">
            IKUTI EVENT DAN PELATIHAN TERBAIK UNTUK KARIR ANDA.
        </p>
    </div>
    
    <div class="event-carousel owl-carousel owl-theme">
        <div class="item">
            <div class="hero-img">
                <img src="{{ asset('template/assets/img/event/event 1.png') }}" alt="event">
            </div>
        </div>
        <div class="item">
            <div class="hero-img">
                <img src="{{ asset('template/assets/img/event/event 2.png') }}" alt="event">
            </div>
        </div>
        <div class="item">
            <div class="hero-img">
                <img src="{{ asset('template/assets/img/event/event 1.png') }}" alt="event">
            </div>
        </div>
        <div class="item">
            <div class="hero-img">
                <img src="{{ asset('template/assets/img/event/event 1.png') }}" alt="event">
            </div>
        </div>
        <div class="item">
            <div class="hero-img">
                <img src="{{ asset('template/assets/img/event/event 2.png') }}" alt="event">
            </div>
        </div>
        <div class="item">
            <div class="hero-img">
                <img src="{{ asset('template/assets/img/event/event 1.png') }}" alt="event">
            </div>
        </div>
    </div>

    <!-- Section Testimoni -->
  <div class="testimonial-section">
    <div class="section-title">
        <h1 class="wow fadeInUp" data-wow-delay=".4s">
            Testimoni
        </h1>
        <p class="wow fadeInUp" data-wow-delay=".6s">
            PENGALAMAN KLIENT BERSAMA PT. EXPERTINDO
        </p>
    </div>

    <div class="testimonial-carousel owl-carousel owl-theme">
            <!-- Testimoni 1 -->
            <div class="testimonial-item">
                <div class="testimonial-avatar">
                    <img src="https://i.pravatar.cc/150?img=1" alt="Steve Jobs">
                </div>
                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Kami sudah menggunakan jasa Expertindo Training sejak tahun 2018. Sangat puas dengan pelayanan, materi training sangat relevan dengan kebutuhan kami. Tim trainer sangat profesional dan kompeten."
                    </p>
                </div>
                <div class="testimonial-author">
                    <h4 class="author-name">Steve Jobs</h4>
                    <p class="author-position">CEO, Apple Inc.</p>
                </div>
            </div>
            
            <!-- Testimoni 2 -->
            <div class="testimonial-item">
                <div class="testimonial-avatar">
                    <img src="https://i.pravatar.cc/150?img=2" alt="Steve Jobs">
                </div>
                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Pelatihan Expertindo training sangat membantu meningkatkan produktivitas karyawan. Kami merasa investasi yang kami lakukan sangat berpengaruh terhadap perusahaan."
                    </p>
                </div>
                <div class="testimonial-author">
                    <h4 class="author-name">Steve Jobs</h4>
                    <p class="author-position">CEO, Apple Inc.</p>
                </div>
            </div>
            
            <!-- Testimoni 3 -->
            <div class="testimonial-item">
                <div class="testimonial-avatar">
                    <img src="https://i.pravatar.cc/150?img=3" alt="Steve Jobs">
                </div>
                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Training dari Expertindo selalu kami tunggu-tunggu. Materinya selalu update dan sesuai dengan perkembangan industri saat ini. Kami sangat merekomendasikan kepada perusahaan lain."
                    </p>
                </div>
                <div class="testimonial-author">
                    <h4 class="author-name">Steve Jobs</h4>
                    <p class="author-position">CEO, Apple Inc.</p>
                </div>
            </div>
            
            <!-- Testimoni 4 -->
            <div class="testimonial-item">
                <div class="testimonial-avatar">
                    <img src="https://i.pravatar.cc/150?img=4" alt="Bill Gates">
                </div>
                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Pelayanan yang sangat memuaskan! Tim Expertindo sangat responsif dan membantu kami dalam menyesuaikan program training sesuai kebutuhan perusahaan. Highly recommended!"
                    </p>
                </div>
                <div class="testimonial-author">
                    <h4 class="author-name">Bill Gates</h4>
                    <p class="author-position">Founder, Microsoft</p>
                </div>
            </div>
            
            <!-- Testimoni 5 -->
            <div class="testimonial-item">
                <div class="testimonial-avatar">
                    <img src="https://i.pravatar.cc/150?img=5" alt="Elon Musk">
                </div>
                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Program sertifikasi yang disediakan Expertindo sangat membantu meningkatkan kredibilitas tim kami. Prosesnya mudah dan hasilnya memuaskan. Terima kasih Expertindo!"
                    </p>
                </div>
                <div class="testimonial-author">
                    <h4 class="author-name">Elon Musk</h4>
                    <p class="author-position">CEO, Tesla & SpaceX</p>
                </div>
            </div>
  </div>

        <!-- Section Staff -->
  <div class="staff-section">
    <div class="section-title">
        <h1 class="wow fadeInUp" data-wow-delay=".4s">
            Staff Ahli
        </h1>
        <p class="wow fadeInUp" data-wow-delay=".6s">
            TIM AHLI KITA YANG SIAP MEMBANTU ANDA.
        </p>
    </div>
    <div class="staff-carousel owl-carousel owl-theme">
                <!-- Staff 1 -->
                <div class="staff-card">
                    <div class="staff-avatar">
                        <img src="https://i.pravatar.cc/150?img=12" alt="Prof. Dr. Ir. Erna Kusrini">
                    </div>
                    <h3 class="staff-name">Prof. Dr. Ir. Erna Kusrini, MT, CIPM, CSCP, SCOR-P</h3>
                    <p class="staff-role">Executive Director</p>
                </div>
                
                <!-- Staff 2 -->
                <div class="staff-card">
                    <div class="staff-avatar">
                        <img src="https://i.pravatar.cc/150?img=13" alt="Agus Darmawan">
                    </div>
                    <h3 class="staff-name">Agus Darmawan, S.Kom, M.Cs</h3>
                    <p class="staff-role">Dosen Teknologi Informasi</p>
                </div>
                
                <!-- Staff 3 -->
                <div class="staff-card">
                    <div class="staff-avatar">
                        <img src="https://i.pravatar.cc/150?img=14" alt="Khotimatun Mustofa">
                    </div>
                    <h3 class="staff-name">Khotimatun Mustofa, SPi</h3>
                    <p class="staff-role">Marketing I</p>
                </div>
                
                <!-- Staff 4 -->
                <div class="staff-card">
                    <div class="staff-avatar">
                        <img src="https://i.pravatar.cc/150?img=15" alt="Ahmad Fauzi">
                    </div>
                    <h3 class="staff-name">Ahmad Fauzi, S.T., M.Eng</h3>
                    <p class="staff-role">Senior Consultant</p>
                </div>
                
                <!-- Staff 5 -->
                <div class="staff-card">
                    <div class="staff-avatar">
                        <img src="https://i.pravatar.cc/150?img=16" alt="Siti Nurhaliza">
                    </div>
                    <h3 class="staff-name">Siti Nurhaliza, S.Psi., M.M</h3>
                    <p class="staff-role">HR Development Specialist</p>
                </div>
                
                <!-- Staff 6 -->
                <div class="staff-card">
                    <div class="staff-avatar">
                        <img src="https://i.pravatar.cc/150?img=17" alt="Budi Santoso">
                    </div>
                    <h3 class="staff-name">Budi Santoso, S.E., M.BA</h3>
                    <p class="staff-role">Business Analyst</p>
                </div>
            </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<!-- jQuery HARUS PERTAMA -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function(){
    $('.event-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>'
        ],
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

$('.testimonial-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1024: {
                        items: 3
                    }
                }
            });

$('.staff-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1024: {
                        items: 3
                    }
                }
            });
        });
</script>

<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
