<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function create()
    {
        $event = Event::first(); // ambil event pertama (workshop kita)
        return view('registrations.create', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:registrations,nim',
            'email' => 'required|email|unique:registrations,email',
            'jurusan' => 'required|string|max:100',
            'universitas' => 'required|string|max:100',
            'alasan' => 'required|string|min:10',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'ktm' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ktmPath = null;
        if ($request->hasFile('ktm')) {
            $ktmPath = $request->file('ktm')->store('ktm', 'public');
        }

        $event = Event::first();

        Registration::create([
            'event_id' => $event->id,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'universitas' => $request->universitas,
            'alasan' => $request->alasan,
            'no_hp' => $request->no_hp,
            'ktm_path' => $ktmPath,
            'status' => 'pending',
        ]);

        return redirect('/')->with('success', 'Pendaftaran berhasil! Status: Pending. Admin akan memproses secepatnya.');
    }

    // Halaman cek status peserta (opsional tapi recommended)
    public function status()
    {
        return view('registrations.status');
    }

    public function checkStatus(Request $request)
    {
        $request->validate(['nim' => 'required|string|exists:registrations,nim']);

        $registration = Registration::where('nim', $request->nim)->first();
        return view('registrations.status-result', compact('registration'));
    }
}
