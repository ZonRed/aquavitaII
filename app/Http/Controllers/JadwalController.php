<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;


class JadwalController extends Controller
{
    public function Jadwal()
    {
        return view('admin.D_Jadwal',['Jadwal'=>$Jadwal]);
    }
    public function pengguna_Jadwal()
    {
        $Jadwal = Jadwal::paginate(5); // Paginate with 5 items per page
        return view('pengguna.Jadwal',['Jadwal'=>$Jadwal]);
    }

    public function pencarianpenggunajadwal(Request $request)
    {
        $cari = $request->cariharipengguna_jadwal;
        $Jadwal = Jadwal::where('hari_jadwal', 'like', '%' . $cari . '%')->paginate(5);
        $Jadwal->appends($request->all());
        return view('pengguna.Jadwal', ['Key' => '' ,'Jadwal' => $Jadwal]);
    }
    
    public function pencarianadminjadwal(Request $request)
    {
        $cari = $request->carihariadmin_jadwal;
        $Jadwal = Jadwal::where('hari_jadwal', 'like', '%' . $cari . '%')->paginate(5);
        $Jadwal->appends($request->all());
        return view('admin.D_Jadwal', ['Key' => '' ,'Jadwal' => $Jadwal]);
    }


    public function InputJadwal()
    {
        $Jadwal = Jadwal::all();
        return view('admin.D_InputJadwal',compact('Jadwal'));
    }

    public function SaveJadwal(Request $request) 
    {
        // Validasi agar tidak terjadi duplikat
        $existingJadwal = Jadwal::where('hari_jadwal', $request->hari_jadwal)
                                ->where('users_id', auth()->user()->id)
                                ->first();
    
        if ($existingJadwal) {
            return redirect('D_InputJadwal')->with('error', 'Data hari terjadi duplikat!.');
        }
    
        // Jika tidak ada duplikat, simpan data baru
        $Jadwal = new Jadwal;
        $Jadwal->hari_jadwal = $request->hari_jadwal;
        $Jadwal->buka_jadwal = $request->buka_jadwal;
        $Jadwal->tutup_jadwal = $request->tutup_jadwal;
        $Jadwal->users_id = auth()->user()->id;
        $Jadwal->save();
    
        return redirect('D_Jadwal')->with('success', 'Data jadwal berhasil diinput.');
    }
    
    


    // Method untuk menghapus satu jadwal
    public function delete_Jadwal($id)
    {
        $jadwal = Jadwal::find($id);
    
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
        $deleted = Jadwal::truncate();
    
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Semua jadwal berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus semua jadwal.']);
        }
    }
    



    public function edit_Jadwal($id)
    {
        $Jadwal = Jadwal::find($id);
        return view('admin.D_EditJadwal', compact('Jadwal'));
    }

    public function update_jadwal(Request $request, $id)
    {
    // Validasi agar tidak terjadi duplikat
    $existingJadwal = Jadwal::where(function($query) use ($request) {
                            $query->where('hari_jadwal', $request->hari_jadwal);
                        })
                        ->where('id', '!=', $id) // Pastikan id tidak sama dengan id yang sedang diupdate
                        ->first();

    if ($existingJadwal) {
        return redirect()->back()->with('error', 'Hari terjadi duplikat!');
    }

    $Jadwal = Jadwal::find($id);
    $Jadwal->hari_jadwal = $request->hari_jadwal;
    $Jadwal->buka_jadwal = $request->buka_jadwal;
    $Jadwal->tutup_jadwal = $request->tutup_jadwal;
    $Jadwal->save();

    return redirect('D_Jadwal')->with('success', 'Jadwal berhasil di update!');
    }


}
