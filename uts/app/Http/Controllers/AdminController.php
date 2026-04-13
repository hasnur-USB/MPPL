<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $registrations = Registration::with('event')->latest()->get();
        return view('admin.dashboard', compact('registrations'));
    }

    public function approve($id)
    {
        $reg = Registration::findOrFail($id);
        $reg->update(['status' => 'diterima', 'catatan_admin' => null]);
        return back()->with('success', 'Peserta berhasil diterima!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['catatan_admin' => 'required|string|min:5']);

        $reg = Registration::findOrFail($id);
        $reg->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);
        return back()->with('success', 'Peserta ditolak.');
    }

    public function destroy($id)
    {
        $reg = Registration::findOrFail($id);
        if ($reg->ktm_path) {
            Storage::disk('public')->delete($reg->ktm_path);
        }
        $reg->delete();
        return back()->with('success', 'Data peserta dihapus.');
    }
}
