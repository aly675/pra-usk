<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // public function dashboard_absensi_page()
    // {
    //     $datas = Absensi::with(['siswa', 'guru'])->get();
    //     return view('absensi.dashboard-absensi', compact('datas'));
    // }

    public function dashboard_absensi_page(Request $request)
    {
        // Ambil input dari user, default tanggal = hari ini
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');

        // Query utama (include relasi ke siswa dan guru)
        $query = Absensi::with(['siswa', 'guru'])
            ->whereDate('tanggal_absensi', $tanggal);

        // Filter kelas kalau diisi
        if (!empty($kelas)) {
            $query->whereHas('siswa', function ($q) use ($kelas) {
                $q->where('kelas', $kelas);
            });
        }

        // Filter jurusan kalau diisi
        if (!empty($jurusan)) {
            $query->whereHas('siswa', function ($q) use ($jurusan) {
                $q->where('jurusan', $jurusan);
            });
        }

        // Ambil hasil
        $absensi = $query->get();

        // Kirim data ke view
        return view('absensi.dashboard-absensi', compact('absensi', 'tanggal', 'kelas', 'jurusan'));
    }


    public function tambah_absensi_page(Request $request)
    {
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
        $tanggal = now()->format('Y-m-d');

        $siswa = Siswa::where('kelas', $kelas)
              ->where('jurusan', $jurusan)
              ->get();

        $guru = session('guru');

        // Kirim data ke view
        return view('absensi.tambah-absensi', compact('siswa', 'kelas', 'jurusan', 'guru', 'tanggal'));
    }

   public function tambah_absensi(Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id',
            'tanggal_absensi' => 'required|date',
            'status_kehadiran' => 'required|array',
        ]);

        $tanggal = now()->format('Y-m-d');

        try {
            foreach ($request->status_kehadiran as $siswa_id => $status) {
                Absensi::create([
                    'id_siswa' => $siswa_id,
                    'id_guru' => $request->id_guru,
                    'tanggal_absensi' => $tanggal,
                    'status_kehadiran' => $status,
                    'alasan' => $request->alasan[$siswa_id] ?? null,
                ]);
            }

            return redirect()->route('guru.dashboard-absensi-page')->with('success', 'Absensi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan absensi: ' . $e->getMessage());
        }
    }
}

