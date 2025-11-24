<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function dashboard_guru_page()
    {
        $datas = Guru::all();
        return view('guru.dashboard-guru', compact('datas'));
    }

    public function tambah_guru_page()
    {
        return view('guru.tambah-guru');
    }

    public function tambah_guru(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:256',
            'nip'           => 'required|string|max:10|unique:guru,nip',
            'password'      => 'required|string',
        ]);

        try{
            $validated['password'] = Hash::make($validated['password']);
            guru::create($validated);
            return redirect()->route('guru.dashboard-guru-page')->with('success', 'Data guru berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data guru: ' . $e->getMessage());
        }
    }

    public function edit_guru_page($id)
    {
        $data = Guru::findOrFail($id);

        return view('guru.edit-guru', compact('data'));
    }

    public function edit_guru(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $validated = $request->validate([
            'nama'          => 'required|string|max:256',
            'nip'           => 'required|string|max:10|unique:guru,nip,' . $id,
            'password'      => 'nullable|string',
        ]);

        if($validated['password'] == null){
            $validated['password'] = $guru->password;
        }
        else{
            $validated['password'] = Hash::make($validated['password']);
        }


        try{
            $guru->update($validated);
            return redirect()->route('guru.dashboard-guru-page')->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data guru: ' . $e->getMessage());
        }
    }

    public function delete_guru($id)
    {
        try{
            Guru::destroy($id);
            return redirect()->route('guru.dashboard-guru-page')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data guru: ' . $e->getMessage());
        }
    }
}
