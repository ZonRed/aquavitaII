<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;


class LaporanController extends Controller
{
    public function Laporan()
    {
        // Ambil data laporan dari database
        $laporan = laporan::paginate(5); // Menggunakan paginate untuk mendukung pagination
        return view('admin.d_laporan', ['laporan' => $laporan]);
    }

    public function pencarianadmin(Request $request)
    {
        $query = $request->input('query');
        $laporan = laporan::orderBy('created_at', 'desc');
    
        if (!empty($query)) {
            // Mengubah format input menjadi sesuai dengan format di database
            $formattedQuery = date('Y-m-d', strtotime($query));
            $laporan = $laporan->whereDate('created_at', $formattedQuery);
        }
    
        $laporan = $laporan->paginate(5);
        return response()->json($laporan);
    }
    
    public function InputLaporan()
    {
        $laporan = Laporan::all();
        return view('pengguna.index', compact('laporan'));
    }

    public function SaveLaporan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_laporan' => 'required',
            'email_laporan' => 'required|email|ends_with:@gmail.com', // Menambahkan validasi ends_with
            'pesan_laporan' => 'required',
        ], [
            'email_laporan.ends_with' => 'Email harus berakhiran @gmail.com'
        ]);
    
        // Jika tidak ada duplikasi, simpan data
        $laporan = new Laporan;
        $laporan->nama_laporan = $request->nama_laporan;
        $laporan->email_laporan = $request->email_laporan;
        $laporan->pesan_laporan = $request->pesan_laporan;
        $laporan->users_id = auth()->user()->id;
        $laporan->save();
    
        // Redirect dengan SweetAlert
        if ($laporan) {
            return redirect()->back()->with('success', 'Pesan telah berhasil dikirim!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
        }
    }

    public function delete_Laporan($id)
    {
        $laporan = laporan::find($id);
    
        if (!$laporan) {
            return redirect('d_laporan')->with('error', 'Data tidak ditemukan.');
        }
    
        $laporan->delete();
    
        return redirect('d_laporan')->with('success', '1 Data berhasil dihapus.');
    }
    
    public function deleteAllLaporan()
    {
        laporan::truncate();
    
        return redirect('/d_laporan')->with('success', 'Semua data berhasil dihapus.');
    }
    
}