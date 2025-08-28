@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold" style="color:var(--text-color)">Pengaturan Aplikasi</h1>
        <p style="color:var(--text-color)">Kelola pengaturan dan tampilan aplikasi</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan:
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <!-- Pengaturan Umum -->
        <div class="settings-card">
            <div class="card-header-custom">
                <i class="fas fa-globe me-2"></i>Pengaturan Umum
            </div>
            <div class="card-body-custom">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nama Aplikasi</label>
                        <input type="text" name="app_name" class="form-control-custom" 
                               value="{{ old('app_name', app_name()) }}"
                               placeholder="Masukkan nama aplikasi" required>
                        <div class="setting-description">
                            Nama yang ditampilkan di dashboard dan header aplikasi
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Title Halaman</label>
                        <input type="text" name="app_title" class="form-control-custom" 
                               value="{{ old('app_title', app_title()) }}"
                               placeholder="Masukkan title halaman" required>
                        <div class="setting-description">
                            Title yang ditampilkan di tab browser
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo & Tema -->
        <div class="settings-card">
            <div class="card-header-custom">
                <i class="fas fa-paint-brush me-2"></i>Penampilan
            </div>
            <div class="card-body-custom">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Logo Aplikasi</label>
                        <input type="file" name="logo" class="form-control-custom" accept="image/*" id="logoInput">
                        <div class="setting-description">
                            Upload logo aplikasi (max: 2MB, jpeg, png, jpg, svg)
                        </div>
                        <div class="logo-preview mt-3 d-flex align-items-center" id="logoPreview" 
                             style="gap:10px; {{ setting('logo') ? '' : 'display:none;' }}">
                            <img src="{{ setting('logo') ? app_logo() : '' }}" 
                                 alt="Logo" class="rounded shadow-sm border" 
                                 style="max-height: 80px; max-width: 100%;">
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Favicon</label>
                        <input type="file" name="favicon" class="form-control-custom" accept="image/*" id="faviconInput">
                        <div class="setting-description">
                            Upload favicon (max: 1MB, ico, png)
                        </div>
                        <div class="favicon-preview mt-3 d-flex align-items-center" id="faviconPreview" 
                             style="gap:10px; {{ setting('favicon') ? '' : 'display:none;' }}">
                            <img src="{{ setting('favicon') ? app_favicon() : '' }}" 
                                 alt="Favicon" class="rounded border" style="width: 32px; height: 32px;">
                        </div>
                    </div>

                    <!-- Theme -->
                    <div class="col-12 mb-4">
                        <label class="form-label mb-3">Tema Aplikasi</label>
                        <div class="row">
                            @php
                                $currentTheme = setting('theme', 'light');
                                $themes = [
                                    'light' => 'Light',
                                    'dark' => 'Dark',
                                    'blue' => 'Blue',
                                    'green' => 'Green'
                                ];
                            @endphp
                            @foreach($themes as $key => $label)
                            <div class="col-md-3 col-6 mb-3">
                                <div class="theme-option {{ $currentTheme == $key ? 'active' : '' }}" 
                                     onclick="selectTheme('{{ $key }}')">
                                    <div class="theme-preview preview-{{ $key }}"></div>
                                    <span>{{ $label }}</span>
                                    <input type="radio" name="theme" value="{{ $key }}" 
                                           {{ $currentTheme == $key ? 'checked' : '' }} 
                                           style="display: none;">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="setting-description">
                            Pilih tema warna untuk tampilan aplikasi
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn-save">
                <i class="fas fa-save me-2"></i>Simpan Pengaturan
            </button>
            
            <button type="button" class="btn-reset" onclick="confirmReset()">
                <i class="fas fa-undo me-2"></i>Reset ke Default
            </button>
        </div>
    </form>

    <!-- Form Reset -->
    <form action="{{ route('settings.reset') }}" method="POST" id="resetForm" style="display: none;">
        @csrf
    </form>
</div>

<!-- CSS khusus untuk theme & tombol -->
<style>
.theme-option {
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 10px;
    padding: 12px;
    text-align: center;
    transition: all 0.3s ease;
    background: var(--bg-color);
    color: var(--text-color);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.theme-option:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.theme-option.active {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--primary-color)20;
}
.theme-preview {
    width: 100%;
    height: 60px;
    border-radius: 8px;
    margin-bottom: 8px;
}
.preview-light { background: #f9fafb; border:1px solid #e5e7eb; }
.preview-dark { background: #111827; }
.preview-blue { background: #2563eb; }
.preview-green { background: #16a34a; }

.btn-save {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
}
.btn-save:hover { opacity: 0.9; }

.btn-reset {
    background: #e5e7eb;
    color: #374151;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
}
.btn-reset:hover { background: #d1d5db; }
</style>

@section('scripts')
<script>
    function selectTheme(theme) {
        document.querySelectorAll('.theme-option').forEach(option => {
            option.classList.remove('active');
        });
        document.querySelector(`.theme-option[onclick="selectTheme('${theme}')"]`).classList.add('active');
        document.querySelector(`input[name="theme"][value="${theme}"]`).checked = true;
    }

    // Logo preview
    document.getElementById('logoInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('logoPreview');
                preview.style.display = 'flex';
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Favicon preview
    document.getElementById('faviconInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('faviconPreview');
                preview.style.display = 'flex';
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    function confirmReset() {
        if (confirm('Apakah Anda yakin ingin mereset semua pengaturan ke default? Logo dan favicon akan dihapus.')) {
            document.getElementById('resetForm').submit();
        }
    }
</script>
@endsection
@endsection
