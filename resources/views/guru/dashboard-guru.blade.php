<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Guru</title>
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
                    <a href="{{ route('guru.dashboard-guru-page') }}" class="btn text-start ps-4 py-2 {{ Request::is('guru/dashboard-guru') ? 'active bg-primary text-white' : '' }}">
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
                    <a class="navbar-brand d-flex align-items-center" style="height: 9vh" href="{{ route('guru.dashboard-guru-page') }}">
                        <h3 class="text-white">
                            Guru / Dashboard /
                        </h3>
                    </a>
                </div>
            </nav>
            <div class="container m-0" style="max-width: 85%">
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <h1>Dashboard Daftar Guru</h1>
                    <a class="btn btn-primary" href="{{ route('guru.tambah-guru-page') }}"><i class="fas fa-plus me-2"></i>Tambah Guru</a>
                </div>

                <table class="table table-striped table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $guru)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $guru->nama }}</td>
                                <td>{{ $guru->nip }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('guru.edit-guru-page', ['id' => $guru->id]) }}">Edit</a>
                                    <form action="{{ route('guru.delete-guru', ['id' => $guru->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('apakah yakin ingin menghapus data')" class="btn btn-danger" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>


</html>
