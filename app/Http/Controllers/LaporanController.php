<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;


class LaporanController extends Controller
{
    public function Laporan()
    {
        return view('admin.D_Laporan',['Laporan'=>$Laporan]);
    }

    public function pencarianadminlaporan(Request $request)
    {
        $cari = $request->caripengguna_email;
        $Laporan = Laporan::where('email_laporan', 'like', '%' . $cari . '%')->paginate(5);
        $Laporan->appends($request->all());
        return view('admin.D_Laporan', ['Key' => '' ,'Laporan' => $Laporan]);
    }

    public function InputLaporan()
    {
        $Laporan = Laporan::all();
        return view('pengguna.index',compact('Laporan'));
    }


    public function SaveLaporan(Request $request) 
    {
        // $hasil::create([
        //     'tanggal'=> $request->tanggal,
        //     'lawan'=> $request->lawan,
        //     'skor'=> $request->skor,
        //     'hasil'=> $request->hasil

        // ]); 

        // return redirect('admin.D_Hasil');
        $Laporan = new Laporan;
        $Laporan->nama_laporan=$request->nama_laporan;
        $Laporan->email_laporan=$request->email_laporan;
        $Laporan->pesan_laporan=$request->pesan_laporan;
        $Laporan->users_id=auth()->user()->id;
        $Laporan->save();
        return redirect('/');
    }

    public function delete_Laporan($id)
    {
        Laporan::destroy($id);
        return redirect('D_Laporan');
        
    }
}