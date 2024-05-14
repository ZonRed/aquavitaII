<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Promo;
use Illuminate\Support\Facades\Auth;


class PromoController extends Controller
{
    public function Promo()
    {
        return view('admin.D_Promo',['Promo'=>$Promo]);
    }
    public function pengguna_Promo()
    {
        $Promo = Promo::paginate(10); // Paginate with 5 items per page
        return view('pengguna.Promo',['Promo'=>$Promo]);
    }

    public function pencarianpenggunapromo(Request $request)
    {
        $cari = $request->caricodepengguna_promo;
        $Promo = Promo::where('code_promo', 'like', '%' . $cari . '%')->paginate(5);
        $Promo->appends($request->all());
        return view('pengguna.Promo', ['Key' => '' ,'Promo' => $Promo]);
    }

    public function pencarianadminpromo(Request $request)
    {
        $cari = $request->caricodeadmin_promo;
        $Promo = Promo::where('code_promo', 'like', '%' . $cari . '%')->paginate(5);
        $Promo->appends($request->all());
        return view('admin.D_Promo', ['Key' => '' ,'Promo' => $Promo]);
    }


    public function InputPromo()
    {
        $Promo = Promo::all();
        return view('admin.D_InputPromo',compact('Promo'));
    }

    public function SavePromo(Request $request) 
    {
        $Promo = new Promo;
        $Promo ->tanggal_mulai_promo=$request->tanggal_mulai_promo;
        $Promo ->tanggal_akhir_promo=$request->tanggal_akhir_promo;
        $Promo ->code_promo=$request->code_promo;
        $Promo ->type_promo=$request->type_promo;
        $Promo ->info_promo=$request->info_promo;
        $Promo ->harga_promo=$request->harga_promo;
        $Promo ->save();
        return redirect('D_Promo');
    }


    public function delete_Promo($id)
    {
        Promo::destroy($id);
        return redirect('D_Promo');
    }

    public function edit_Promo($id)
    {
        $Promo = Promo::find($id);
        return view('admin.D_EditPromo', compact('Promo'));
    }

    public function update_Promo(Request $request, $id)
    {
        $Promo = Promo::find($id);
        
        // Update data hasil dengan data baru
        $Promo ->tanggal_mulai_promo=$request->tanggal_mulai_promo;
        $Promo ->tanggal_akhir_promo=$request->tanggal_akhir_promo;
        $Promo ->code_promo=$request->code_promo;
        $Promo ->type_promo=$request->type_promo;
        $Promo ->info_promo=$request->info_promo;
        $Promo ->harga_promo=$request->harga_promo;

        // Simpan perubahan
        $Promo->save();

        // Redirect ke halaman D_Promo setelah update
        return redirect('D_Promo');
    }
}
