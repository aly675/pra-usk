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
                        Absensi / Dashboard /
                    </h3>
                </a>
            </div>
        </nav>
        {{-- Content --}}
        <div class="container mx-0 mt-3" style="max-width: 85%">
            <div class="d-flex align-items-center justify-content-between">
                <h1>Dashboard Daftar Absensi</h1>
                <a class="btn btn-primary" href="{{ route('guru.tambah-absensi-page') }}">
                    <i class="fas fa-plus me-2"></i>Tambah Absensi
                </a>
            </div>
            {{-- Filter Section --}}
            <div class="card mt-4 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('guru.dashboard-absensi-page') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ request('tanggal', date('Y-m-d')) }}">
                        </div>
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
                        <div class="col-md-3 d-flex">
                            <button type="submit" class="btn btn-success me-2 w-100">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('guru.dashboard-absensi-page') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-sync-alt me-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Table Section --}}
            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Alasan</th>
                            <th>Guru Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absensi as $data)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->siswa->nama }}</td>
                                <td>{{ $data->siswa->nis }}</td>
                                <td>{{ $data->siswa->jenis_kelamin }}</td>
                                <td>{{ $data->siswa->kelas }}</td>
                                <td>{{ $data->siswa->jurusan }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y H:i') }}</td>
                                <td>
                                  {{ $data->status_kehadiran }}
                                </td>
                                <td>{{ $data->alasan ?: '-' }}</td>
                                <td>{{ $data->guru->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-3">
                                    <i class="fas fa-exclamation-circle me-2"></i>Tidak ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
