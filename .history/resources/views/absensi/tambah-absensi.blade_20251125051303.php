<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="offcanvas offcanvas-start show bg-light" style="width: 15%" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header d-flex justify-content-center" style="height: 9vh">
                 <a class="navbar-brand d-flex flex-column align-items-center" href="#">
                    <img src="{{ asset('assets/img/image.png') }}" alt="SMKN 12 JAKARTA" height="64">
                    <p class="mt-2 mb-0">SMKN 12 Jakarta</p>
                </a>
            </div>
            <hr>
            <div class="offcanvas-body d-flex flex-column justify-content-between p-0">
                <div class="d-flex flex-column gap-2 w-100">
                    <a href="{{ route('guru.dashboard-guru-page') }}" class="btn text-start ps-4 py-2">
                        <i class="fas fa-users me-2"></i>Daftar Guru
                    </a>
                    <a href="{{ route('guru.dashboard-siswa-page') }}" class="btn text-start ps-4 py-2">
                        <i class="fas fa-users me-2"></i>Daftar Siswa
                    </a>
                    <a href="{{ route('guru.dashboard-absensi-page') }}" class="btn text-start ps-4 py-2">
                        <i class="fas fa-clipboard-list me-2"></i>Absensi
                    </a>
                </div>

                <div class="w-100">
                    <hr class="my-2">
                   <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn text-start ps-4 py-2 text-danger w-100">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0" style="margin-left: 15%">
            <nav class="navbar bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center" style="height: 9vh" href="{{ route('guru.dashboard-absensi-page') }}">
                        <h3 class="text-white">
                            Absensi / Dashboard / Tambah-Absensi
                        </h3>
                    </a>
                </div>
            </nav>
                <div class="container mx-0 mt-3" style="max-width: 85%">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1>Dashboard Daftar Absensi</h1>
                    </div>

                    {{-- Filter Section --}}
                    <div class="card mt-4 shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('guru.tambah-absensi-page') }}" method="GET" class="row g-3 align-items-end">
                               <div class="col-md-3">
                                    <label for="kelas" class="form-label fw-semibold">Kelas</label>
                                        <select name="kelas" id="kelas" class="form-select">
                                            <option value="">-- Semua Kelas --</option>
                                            <option value="x" {{ request('kelas') == 'x' ? 'selected' : '' }}>X</option>
                                            <option value="xi" {{ request('kelas') == 'xi' ? 'selected' : '' }}>XI</option>
                                            <option value="xii" {{ request('kelas') == 'xii' ? 'selected' : '' }}>XII</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="jurusan" class="form-label fw-semibold">Jurusan</label>
                                        <select name="jurusan" id="jurusan" class="form-select">
                                            <option value="">-- Semua Jurusan --</option>
                                            <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
                                            <option value="BR" {{ request('jurusan') == 'BR' ? 'selected' : '' }}>BR</option>
                                            <option value="MP" {{ request('jurusan') == 'MP' ? 'selected' : '' }}>MP</option>
                                            <option value="AKL" {{ request('jurusan') == 'AKL' ? 'selected' : '' }}>AKL</option>
                                        </select>
                                    </div>


                                <div class="col-md-4 d-flex align-items-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-search me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('guru.tambah-absensi-page') }}" class="btn btn-secondary ms-2">
                                        <i class="fas fa-sync-alt me-1"></i> Reset
                                    </a>
                                    <a href="{{ route('guru.dashboard-absensi-page') }}" class="btn btn-danger ms-2">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>


                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(request()->filled('kelas'))
                        <form method="POST" action="{{ route('guru.tambah-absensi') }}">
                            @csrf
                            <input type="hidden" name="id_guru" value="{{ $guru->id }}">
                            <input type="hidden" name="tanggal_absensi" value="{{ $tanggal }}">

                            <div class="card mt-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Daftar Siswa</h5>
                                    <p class="text-muted small mb-3">Pilih status kehadiran untuk setiap siswa pada tanggal <strong>{{ $tanggal }}</strong>.</p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama Siswa</th>
                                                    <th>NIS</th>
                                                    <th style="min-width:170px">Status Kehadiran</th>
                                                    <th style="min-width:200px">Alasan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($siswa as $data)
                                                    <tr>
                                                        <td class="align-middle">{{ $data->nama }}</td>
                                                        <td class="align-middle">{{ $data->nis }}</td>
                                                        <td>
                                                            <select name="status_kehadiran[{{ $data->id }}]" class="form-select" required>
                                                                <option value="Hadir">Hadir</option>
                                                                <option value="Izin">Izin</option>
                                                                <option value="Sakit">Sakit</option>
                                                                <option value="Alfa">Alpa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="alasan[{{ $data->id }}]" class="form-control" placeholder="Opsional">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('guru.tambah-absensi-page') }}" class="btn btn-secondary me-2">Kembali / Reset</a>
                                        <button type="submit" class="btn btn-success">Simpan Absensi</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif

                </div>
             </div>
             <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
