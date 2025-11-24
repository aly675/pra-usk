<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_page()
    {
        return view('login');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        $guru = Guru::where('nip', $validated['nip'])->first();

        if($guru && Hash::check($validated['password'], $guru->password)){
            $request->session()->regenerate();
            session(['guru' => $guru]);
            return redirect()->route('guru.dashboard-siswa-page');
        }

        return back()->withErrors([
            'nip' => 'NIP atau password salah',
        ])->withInput($request->only('nip'));
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-page')->with('success', 'Anda telah berhasil logout.');
    }
}
