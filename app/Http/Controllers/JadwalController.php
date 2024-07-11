<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\jadwal;
use Illuminate\Support\Facades\Auth;


class JadwalController extends Controller
{
    public function Jadwal()
    {
        // Fetch jadwal data from the database
        $jadwal = jadwal::paginate(5); // Paginate with 5 items per page
        return view('admin.d_jadwal', ['jadwal' => $jadwal]);
    }
    public function pencarianadminjadwal(Request $request)
    {
        $query = $request->input('carihariadmin_jadwal');
        $jadwal = jadwal::where('hari_jadwal', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($jadwal); // Return paginated results as JSON for AJAX handling
    }
    
    public function pengguna_Jadwal()
    {
        $jadwal = jadwal::paginate(5); // Paginate with 5 items per page
        return view('pengguna.jadwal', ['jadwal' => $jadwal]);
    }
    

    public function pencarianpenggunajadwal(Request $request)
    {
        $query = $request->input('cariharipengguna_jadwal');
        $jadwal= jadwal::where('hari_jadwal', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($jadwal);
    }


    public function InputJadwal()
    {
        $jadwal = jadwal::all();
        return view('admin.d_inputjadwal',compact('jadwal'));
    }

    public function SaveJadwal(Request $request) 
    {
        // Validasi agar tidak terjadi duplikat
        $existingJadwal = jadwal::where('hari_jadwal', $request->hari_jadwal)
                                ->where('users_id', auth()->user()->id)
                                ->first();
    
        if ($existingJadwal) {
            return redirect('d_inputjadwal')->with('error', 'Data hari terjadi duplikat!.');
        }
    
        // Jika tidak ada duplikat, simpan data baru
        $jadwal = new jadwal;
        $jadwal->hari_jadwal = $request->hari_jadwal;
        $jadwal->buka_jadwal = $request->buka_jadwal;
        $jadwal->tutup_jadwal = $request->tutup_jadwal;
        $jadwal->users_id = auth()->user()->id;
        $jadwal->save();
    
        return redirect('d_jadwal')->with('success', 'Data jadwal berhasil diinput.');
    }
    
    


    // Method untuk menghapus satu jadwal
    public function delete_Jadwal($id)
    {
        $jadwal = jadwal::find($id);
    
        if (!$jadwal) {
            return response()->json(['status' => 'error', 'message' => 'Data jadwal tidak ditemukan.']);
        }
    
        if ($jadwal->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data jadwal berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data jadwal.']);
        }
    }
    

    // Method untuk menghapus semua jadwal
    public function deleteAll_Jadwal()
    {
        $deleted = jadwal::truncate();
    
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Semua jadwal berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus semua jadwal.']);
        }
    }
    



    public function edit_Jadwal($id)
    {
        $jadwal = jadwal::find($id);
        return view('admin.d_editjadwal', compact('jadwal'));
    }

    public function update_jadwal(Request $request, $id)
    {
    // Validasi agar tidak terjadi duplikat
    $existingJadwal = jadwal::where(function($query) use ($request) {
                            $query->where('hari_jadwal', $request->hari_jadwal);
                        })
                        ->where('id', '!=', $id) // Pastikan id tidak sama dengan id yang sedang diupdate
                        ->first();

    if ($existingJadwal) {
        return redirect()->back()->with('error', 'Hari terjadi duplikat!');
    }

    $jadwal = Jadwal::find($id);
    $jadwal->hari_jadwal = $request->hari_jadwal;
    $jadwal->buka_jadwal = $request->buka_jadwal;
    $jadwal->tutup_jadwal = $request->tutup_jadwal;
    $jadwal->save();

    return redirect('d_jadwal')->with('success', 'Jadwal berhasil di update!');
    }


}
