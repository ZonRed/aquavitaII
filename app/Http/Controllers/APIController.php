<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function Laporan()
    {
        $Laporan = laporan::all();

        return response()->json([
            'succsess' => true,
            'message'  => 'berhasil di tampilkan',
            'data'     => $Laporan
        ], 200);
    }

    public function addLaporan (Request $request)
    {
        try 
        {
            Laporan::create([
            'nama' => $request->input('nama'),
            'email'=> $request->input('email'),
            'pesan'=> $request->input('pesan')
            ]);

            return response()->json([
                'succsess' => true,
                'message' => 'Berhasil Simpan'
            ],200);
        } 
        catch (Exception $e) 
        {
            return response()->json([
                'succsess' => false,
                'message' => 'gagal di simpan. kesalahan: '.$e->getMessage()
            ],422);
        }
    }
}
