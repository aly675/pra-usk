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
                            Siswa / Dashboar /
                        </h3>
                    </a>
                </div>
            </nav>
            <div class="container m-0" style="max-width: 85%">
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <h1>Dashboard Daftar Siswa</h1>
                    <a class="btn btn-primary" href="{{ route('guru.tambah-siswa-page') }}"><i class="fas fa-plus me-2"></i>Tambah Siswa</a>
                </div>
                    <table class="table table-striped table-hover mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->jurusan }}</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('guru.edit-siswa-page', ['id' => $siswa->id]) }}">Edit</a>
                                        <form action="{{ route('guru.delete-siswa', ['id' => $siswa->id]) }}" method="POST" style="display:inline;">
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
