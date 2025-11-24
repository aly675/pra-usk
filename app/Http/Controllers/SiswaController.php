<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard_siswa_page()
    {
        $datas = Siswa::all();
        return view('siswa.dashboard-siswa', compact('datas'));
    }

    public function tambah_siswa_page()
    {
        return view('siswa.tambah-siswa');
    }

    public function tambah_siswa(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:256',
            'nis'           => 'required|string|max:10|unique:siswa,nis',
            'kelas'         => 'required|string',
            'jurusan'       => 'required|string',
            'jenis_kelamin' => 'required',
        ]);

        try{
            Siswa::create($validated);
            return redirect()->route('guru.dashboard-siswa-page')->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data siswa: ' . $e->getMessage());
        }
    }

    public function edit_siswa_page($id)
    {
        $data = Siswa::findOrFail($id);

        return view('siswa.edit-siswa', compact('data'));
    }

    public function edit_siswa(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:256',
            'nis'           => 'required|string|max:10|unique:siswa,nis,' . $id,
            'kelas'         => 'required|string',
            'jurusan'       => 'required|string',
            'jenis_kelamin' => 'required',
        ]);

        try{
            Siswa::where('id', $id)->update($validated);
            return redirect()->route('guru.dashboard-siswa-page')->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data siswa: ' . $e->getMessage());
        }
    }

    public function delete_siswa($id)
    {
        try{
            Siswa::destroy($id);
            return redirect()->route('guru.dashboard-siswa-page')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data siswa: ' . $e->getMessage());
        }
    }
}
