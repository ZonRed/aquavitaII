<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Jual;
use Illuminate\Support\Facades\Auth;


class JualController extends Controller
{
    public function Jual()
    {
        return view('admin.D_Jual',['Jual'=>$Jual]);
    }
    public function pengguna_Jual()
    {
        $Jual = Jual::paginate(5); // Paginate with 5 items per page
        return view('pengguna.Jual',['Jual'=>$Jual]);
    }

    public function pencarianpenggunajual(Request $request)
    {
        $cari = $request->caricodepengguna_jual;
        $Jual = Jual::where('code_jual', 'like', '%' . $cari . '%')->paginate(5);
        $Jual->appends($request->all());
        return view('pengguna.Jual', ['Key' => '' ,'Jual' => $Jual]);
    }
    
    public function pencarianadminjual(Request $request)
    {
        $cari = $request->caricodeadmin_jual;
        $Jual = Jual::where('code_jual', 'like', '%' . $cari . '%')->paginate(5);
        $Jual->appends($request->all());
        return view('admin.D_Jual', ['Key' => '' ,'Jual' => $Jual]);
    }


    public function InputJual()
    {
        $Jual = Jual::all();
        return view('admin.D_InputJual',compact('Jual'));
    }

    public function SaveJual(Request $request) 
    {
  
        $Jual = new Jual;
        $Jual ->tanggal_jual=$request->tanggal_jual;
        $Jual ->code_jual=$request->code_jual;
        $Jual ->type_jual=$request->type_jual;
        $Jual ->harga_jual=$request->harga_jual;
        $Jual ->stock_jual=$request->stock_jual;
        $Jual ->jumlah_jual=$request->jumlah_jual;
        $Jual ->save();
        return redirect('D_Jual');
    }


    public function delete_Jual($id)
    {
        Jual::destroy($id);
        return redirect('D_Jual');
    }

    public function edit_Jual($id)
    {
        $Jual = Jual::find($id);
        return view('admin.D_EditJual', compact('Jual'));
    }

    public function update_Jual(Request $request, $id)
    {
        $Jual = Jual::find($id);
        
        // Update data hasil dengan data baru
        $Jual ->tanggal_jual=$request->tanggal_jual;
        $Jual ->code_jual=$request->code_jual;
        $Jual ->type_jual=$request->type_jual;
        $Jual ->harga_jual=$request->harga_jual;
        $Jual ->stock_jual=$request->stock_jual;
        $Jual ->jumlah_jual=$request->jumlah_jual;

        // Simpan perubahan
        $Jual->save();

        // Redirect ke halaman D_Jual setelah update
        return redirect('D_Jual');
    }
}
