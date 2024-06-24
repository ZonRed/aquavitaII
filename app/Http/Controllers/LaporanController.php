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
        $Laporan = Laporan::paginate(5); // Menggunakan paginate untuk mendukung pagination
        return view('admin.D_Laporan', ['Laporan' => $Laporan]);
    }

    public function pencarianadmin(Request $request)
    {
        $query = $request->input('query');
        $laporan = Laporan::orderBy('created_at', 'desc');
    
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
        $Laporan = Laporan::all();
        return view('pengguna.index', compact('Laporan'));
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
        $Laporan = new Laporan;
        $Laporan->nama_laporan = $request->nama_laporan;
        $Laporan->email_laporan = $request->email_laporan;
        $Laporan->pesan_laporan = $request->pesan_laporan;
        $Laporan->users_id = auth()->user()->id;
        $Laporan->save();
    
        // Redirect dengan SweetAlert
        if ($Laporan) {
            return redirect()->back()->with('success', 'Pesan telah berhasil dikirim!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
        }
    }

    public function delete_Laporan($id)
    {
        $laporan = Laporan::find($id);
    
        if (!$laporan) {
            return redirect('D_Laporan')->with('error', 'Data tidak ditemukan.');
        }
    
        $laporan->delete();
    
        return redirect('D_Laporan')->with('success', '1 Data berhasil dihapus.');
    }
    
    public function deleteAllLaporan()
    {
        Laporan::truncate();
    
        return redirect('/D_Laporan')->with('success', 'Semua data berhasil dihapus.');
    }
    
}