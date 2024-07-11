<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\promo;
use Illuminate\Support\Facades\Auth;


class PromoController extends Controller
{
    public function Promo()
    {
         // Fetch jadwal data from the database
         $promo = promo::paginate(5); // Paginate with 5 items per page
         return view('admin.d_promo', ['promo' => $promo]);
    }

    public function pencarianadminpromo(Request $request)
    {
        $query = $request->input('caricodepromoadmin_promo');
        $promo = promo::where('code_promo', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($promo); // Return paginated results as JSON for AJAX handling
    }

    public function pengguna_Promo()
    {
        $promo = promo::paginate(5); // Paginate with 5 items per page
        return view('pengguna.promo', ['promo' => $promo]);
    }

    public function pencarianpenggunapromo(Request $request)
    {
        $query = $request->input('caricodepromopengguna_promo');
        $promo = promo::where('code_promo', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($promo);
    }


    public function InputPromo()
    {
        $promo = promo::all();
        return view('admin.d_inputpromo',compact('promo'));
    }

    public function SavePromo(Request $request) 
    {
    // Validasi agar tidak terjadi duplikat
    $existingPromo = promo::where(function($query) use ($request) {
                            $query->where('code_promo', $request->code_promo)
                                  ->orWhere('type_promo', $request->type_promo);
                        })
                        ->where('users_id', auth()->user()->id)
                        ->first();

    if ($existingPromo) {
        if ($existingPromo->code_promo == $request->code_promo && $existingPromo->type_promo == $request->type_promo) {
            return redirect('d_inputpromo')->with('error', 'Code dan Type Promo terjadi duplikat!');
        } elseif ($existingPromo->code_promo == $request->code_promo) {
            return redirect('d_inputpromo')->with('error', 'Code Promo terjadi duplikat!');
        } else {
            return redirect('d_inputpromo')->with('error', 'Barang Promo terjadi duplikat!');
        }
    }

        $promo = new promo;
        $promo->tanggal_mulai_promo=$request->tanggal_mulai_promo;
        $promo->tanggal_akhir_promo=$request->tanggal_akhir_promo;
        $promo->code_promo=$request->code_promo;
        $promo->type_promo=$request->type_promo;
        $promo->info_promo=$request->info_promo;
        // Formatting data harga promo
        $harga_promo = str_replace('.', '', $request->harga_promo); // Hilangkan titik sebagai pemisah ribuan
        $harga_promo = str_replace(',', '.', $harga_promo); // Ganti koma dengan titik sebagai pemisah desimal
        $promo->harga_promo = $harga_promo; // Simpan harga yang sudah diformat
        $promo->users_id=auth()->user()->id;
        $promo->save();
      // Menggunakan session flash untuk menyimpan pesan
      return redirect('d_promo')->with('success', 'Data Promo berhasil diinput.');
    }


    public function delete_Promo($id)
    {
        $promo = promo::find($id);
    
        if (!$promo) {
            return response()->json(['status' => 'error', 'message' => 'Data jual tidak ditemukan.']);
        }
    
        if ($promo->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data jual berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data jual.']);
        }
    }

    public function deleteAll_Promo()
    {
        $deleted = promo::truncate();
    
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Semua promo berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus semua promo.']);
        }
    }

    public function edit_Promo($id)
    {
        $promo = promo::find($id);
        return view('admin.d_editpromo', compact('promo'));
    }

    public function update_Promo(Request $request, $id)
    {

  // Validasi agar tidak terjadi duplikat
    $existingPromo = promo::where(function($query) use ($request) {
                            $query->where('code_promo', $request->code_promo)
                                  ->orWhere('type_promo', $request->type_promo);
                        })
                        ->where('id', '!=', $id) // Pastikan id tidak sama dengan id yang sedang diupdate
                        ->where('users_id', auth()->user()->id)
                        ->first();

    if ($existingPromo) {
        if ($existingPromo->code_promo == $request->code_promo && $existingPromo->type_promo == $request->type_promo) {
            return redirect()->back()->with('error', 'Code dan Type Promo terjadi duplikat!');
        } elseif ($existingPromo->code_promo == $request->code_promo) {
            return redirect()->back()->with('error', 'Code Promo terjadi duplikat!');
        } else {
            return redirect()->back()->with('error', 'Type Promo terjadi duplikat!');
        }
    }

        $promo = promo::find($id);
        
        // Update data hasil dengan data baru
        $promo ->tanggal_mulai_promo=$request->tanggal_mulai_promo;
        $promo ->tanggal_akhir_promo=$request->tanggal_akhir_promo;
        $promo ->code_promo=$request->code_promo;
        $promo ->type_promo=$request->type_promo;
        $promo ->info_promo=$request->info_promo;
        // Formatting data harga promo
        $harga_promo = str_replace('.', '', $request->harga_promo); // Hilangkan titik sebagai pemisah ribuan
        $harga_promo = str_replace(',', '.', $harga_promo); // Ganti koma dengan titik sebagai pemisah desimal
        $promo->harga_promo = $harga_promo; // Simpan harga yang sudah diformat

        // Simpan perubahan
        $promo->save();

        // Redirect ke halaman D_Promo setelah update
        return redirect('d_promo')->with('success', 'data promo berhasil di update!');
    }
}
