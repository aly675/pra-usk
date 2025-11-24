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
                    <a class="navbar-brand d-flex align-items-center" style="height: 9vh" href="{{ route('guru.dashboard-siswa-page') }}">
                        <h3 class="text-white">
                            Siswa / Dashboard / Tambah-Siswa
                        </h3>
                    </a>
                </div>
            </nav>
            <div class="container m-0" style="max-width: 85%">
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <h1>Tambah Siswa</h1>
                </div>
                  <form action="{{ route('guru.tambah-siswa') }}" method="POST" class="mt-4">
                        @csrf
                        @method('POST')

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nis" class="form-label">NIS</label>
                                            <input type="number" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}" required>
                                            @error('nis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select name="kelas" id="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                                                <option value="" {{ old('kelas') ? '' : 'selected' }} disabled> Pilih Kelas </option>
                                                <option value="x" {{ old('kelas') == 'x' ? 'selected' : '' }}>X</option>
                                                <option value="xi" {{ old('kelas') == 'xi' ? 'selected' : '' }}>XI</option>
                                                <option value="xii" {{ old('kelas') == 'xii' ? 'selected' : '' }}>XII</option>
                                            </select>
                                            @error('kelas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="jurusan" class="form-label">Jurusan</label>
                                            <select name="jurusan" id="jurusan" class="form-select @error('jurusan') is-invalid @enderror" required>
                                                <option value="" {{ old('jurusan') ? '' : 'selected' }} disabled> Pilih Jurusan </option>
                                                <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
                                                <option value="MP" {{ old('jurusan') == 'MP' ? 'selected' : '' }}>MP</option>
                                                <option value="AKL" {{ old('jurusan') == 'AKL' ? 'selected' : '' }}>AKL</option>
                                                <option value="BR" {{ old('jurusan') == 'BR' ? 'selected' : '' }}>BR</option>
                                            </select>
                                            @error('jurusan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                                <option value="" {{ old('jenis_kelamin') ? '' : 'selected' }} disabled> Pilih Jenis Kelamin </option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('guru.dashboard-siswa-page') }}" class="btn btn-secondary me-2">Batal</a>
                                    <button type="submit" class="btn btn-primary">Tambah Siswa</button>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
             </div>
             <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
