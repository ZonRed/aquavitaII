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
  
        $Jadwal = new Jadwal;
        $Jadwal->hari_jadwal=$request->hari_jadwal;
        $Jadwal->buka_jadwal=$request->buka_jadwal;
        $Jadwal->tutup_jadwal=$request->tutup_jadwal;
        $Jadwal->users_id=auth()->user()->id;
        $Jadwal->save();
        return redirect('D_Jadwal');
    }


    public function delete_Jadwal($id)
    {
        Jadwal::destroy($id);
        return redirect('D_Jadwal');
    }

    public function edit_Jadwal($id)
    {
        $Jadwal = Jadwal::find($id);
        return view('admin.D_EditJadwal', compact('Jadwal'));
    }

    public function update_Jadwal(Request $request, $id)
    {
        $Jadwal = Jadwal::find($id);
        
        // Update data hasil dengan data baru
        $Jadwal ->hari_jadwal=$request->hari_jadwal;
        $Jadwal ->buka_jadwal=$request->buka_jadwal;
        $Jadwal ->tutup_jadwal=$request->tutup_jadwal;

        // Simpan perubahan
        $Jadwal->save();

        // Redirect ke halaman D_Jadwal setelah update
        return redirect('D_Jadwal');
    }
}
