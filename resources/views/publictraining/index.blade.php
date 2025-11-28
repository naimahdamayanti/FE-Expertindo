@extends('layout')
@section('title','Public Training')
@section('judul','Public Training')
@section('isi')

<!-- Alert Messages -->
@if (Session::has('create'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Ditambah!</strong> Training baru telah berhasil ditambahkan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Dihapus!</strong> Training telah dihapus dari sistem.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('update'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Data Berhasil Diupdate!</strong> Perubahan telah disimpan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container">
    <!-- Action Buttons -->
    <div class="mb-4">
        <a href="{{ route('publictraining.create') }}">
            <button class="btn btn-icon btn-3 btn-success" type="button">
                <span class="btn-inner--icon me-2"><i class="fas fa-plus"></i></span>
                <span class="btn-inner--text">Tambah Public Training</span>
            </button>
        </a>
        <a href="{{ route('export-pdf') }}" target="_blank">
            <button class="btn btn-icon btn-3 btn-primary" type="button">
                <span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Export ke PDF</span>
            </button>
        </a>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
        <!-- Header with Back Button -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-danger fs-3">
                    ↩
                </a>
                <h2 class="text-danger mb-0">Public Training</h2>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-4">
            <div class="input-group" style="max-width: 400px;">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input 
                    type="text" 
                    id="searchInput"
                    class="form-control"
                    placeholder="Cari training..." 
                />
            </div>
        </div>
    </div>

    <!-- Training Grid -->
    <div id="trainingGrid" class="row g-4">
        @forelse($publictrainings as $public)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="training-card card h-100 hover-shadow" 
                     data-name="{{ strtolower($public->name) }}"
                     style="cursor: pointer;">
                    <div class="card-body text-center position-relative">
                        <!-- Admin Controls -->
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <div class="position-absolute top-0 end-0 p-2 admin-controls" style="opacity: 0; transition: opacity 0.3s;">
                                    <a href="{{ route('publictraining.edit', $public->id) }}" 
                                       class="btn btn-sm btn-primary rounded-circle p-2 me-1"
                                       onclick="event.stopPropagation()">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('publictraining.destroy', $public->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus training ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger rounded-circle p-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                        <!-- Training Content -->
                        <a href="{{ route('schedule.index', ['training' => $public->slug ?? $public->id]) }}" 
                           class="text-decoration-none text-dark">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 120px;">
                                <img 
                                    src="{{ asset('storage/' . $public->image) }}" 
                                    alt="{{ $public->name }}"
                                    data-fallback="{{ asset('template/assets/img/placeholder-training.png') }}"
                                    class="img-fluid mb-3"
                                    style="max-height: 120px; object-fit: contain;"
                                    onerror="this.src=this.dataset.fallback"
                                />
                                <p class="text-center fw-bold mb-0">
                                    {{ $public->name }}
                                </p>
                                @if($public->description)
                                    <small class="text-muted text-center mt-2">
                                        {{ Str::limit($public->description, 60) }}
                                    </small>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <div class="fs-1 mb-3">📚</div>
                        <p class="text-muted mb-3">Belum ada training yang ditambahkan</p>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('publictraining.create') }}" 
                                   class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>
                                    Tambah training pertama
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Empty Search Result -->
    <div id="emptySearch" class="d-none">
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="fs-1 mb-3">🔍</div>
                <p class="text-muted">Tidak ada training yang ditemukan</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    transform: translateY(-5px);
}

.training-card:hover .admin-controls {
    opacity: 1 !important;
}

.training-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
}

.training-card:hover {
    border-color: #b0b0b0;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const trainingCards = document.querySelectorAll('.training-card');
    const trainingGrid = document.getElementById('trainingGrid');
    const emptySearch = document.getElementById('emptySearch');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        trainingCards.forEach(card => {
            const parentCol = card.closest('.col-6, .col-md-4, .col-lg-3');
            const trainingName = card.getAttribute('data-name');
            
            if (trainingName.includes(searchTerm)) {
                parentCol.style.display = 'block';
                visibleCount++;
            } else {
                parentCol.style.display = 'none';
            }
        });

        // Show/hide empty state
        if (visibleCount === 0 && searchTerm !== '') {
            trainingGrid.classList.add('d-none');
            emptySearch.classList.remove('d-none');
        } else {
            trainingGrid.classList.remove('d-none');
            emptySearch.classList.add('d-none');
        }
    });
});
</script>
@endpush

@endsection