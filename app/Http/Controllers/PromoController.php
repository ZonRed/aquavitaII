<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Promo;
use Illuminate\Support\Facades\Auth;


class PromoController extends Controller
{
    public function Promo()
    {
         // Fetch jadwal data from the database
         $Promo = Promo::paginate(5); // Paginate with 5 items per page
         return view('admin.D_Promo', ['Promo' => $Promo]);
    }

    public function pencarianadminpromo(Request $request)
    {
        $query = $request->input('caricodepromoadmin_promo');
        $Promo = Promo::where('code_promo', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($Promo); // Return paginated results as JSON for AJAX handling
    }

    public function pengguna_Promo()
    {
        $Promo = Promo::paginate(5); // Paginate with 5 items per page
        return view('pengguna.Promo', ['Promo' => $Promo]);
    }

    public function pencarianpenggunapromo(Request $request)
    {
        $query = $request->input('caricodepromopengguna_promo');
        $Promo = Promo::where('code_promo', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($Promo);
    }


    public function InputPromo()
    {
        $Promo = Promo::all();
        return view('admin.D_InputPromo',compact('Promo'));
    }

    public function SavePromo(Request $request) 
    {
    // Validasi agar tidak terjadi duplikat
    $existingPromo = Promo::where(function($query) use ($request) {
                            $query->where('code_promo', $request->code_promo)
                                  ->orWhere('type_promo', $request->type_promo);
                        })
                        ->where('users_id', auth()->user()->id)
                        ->first();

    if ($existingPromo) {
        if ($existingPromo->code_promo == $request->code_promo && $existingPromo->type_promo == $request->type_promo) {
            return redirect('D_InputPromo')->with('error', 'Code dan Type Promo terjadi duplikat!');
        } elseif ($existingPromo->code_promo == $request->code_promo) {
            return redirect('D_InputPromo')->with('error', 'Code Promo terjadi duplikat!');
        } else {
            return redirect('D_InputPromo')->with('error', 'Barang Promo terjadi duplikat!');
        }
    }

        $Promo = new Promo;
        $Promo->tanggal_mulai_promo=$request->tanggal_mulai_promo;
        $Promo->tanggal_akhir_promo=$request->tanggal_akhir_promo;
        $Promo->code_promo=$request->code_promo;
        $Promo->type_promo=$request->type_promo;
        $Promo->info_promo=$request->info_promo;
        // Formatting data harga promo
        $harga_promo = str_replace('.', '', $request->harga_promo); // Hilangkan titik sebagai pemisah ribuan
        $harga_promo = str_replace(',', '.', $harga_promo); // Ganti koma dengan titik sebagai pemisah desimal
        $Promo->harga_promo = $harga_promo; // Simpan harga yang sudah diformat
        $Promo->users_id=auth()->user()->id;
        $Promo->save();
      // Menggunakan session flash untuk menyimpan pesan
      return redirect('D_Promo')->with('success', 'Data Promo berhasil diinput.');
    }


    public function delete_Promo($id)
    {
        $Promo = Promo::find($id);
    
        if (!$Promo) {
            return response()->json(['status' => 'error', 'message' => 'Data jual tidak ditemukan.']);
        }
    
        if ($Promo->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data jual berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data jual.']);
        }
    }

    public function deleteAll_Promo()
    {
        $deleted = Promo::truncate();
    
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Semua promo berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus semua promo.']);
        }
    }

    public function edit_Promo($id)
    {
        $Promo = Promo::find($id);
        return view('admin.D_EditPromo', compact('Promo'));
    }

    public function update_Promo(Request $request, $id)
    {

  // Validasi agar tidak terjadi duplikat
    $existingPromo = Promo::where(function($query) use ($request) {
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

        $Promo = Promo::find($id);
        
        // Update data hasil dengan data baru
        $Promo ->tanggal_mulai_promo=$request->tanggal_mulai_promo;
        $Promo ->tanggal_akhir_promo=$request->tanggal_akhir_promo;
        $Promo ->code_promo=$request->code_promo;
        $Promo ->type_promo=$request->type_promo;
        $Promo ->info_promo=$request->info_promo;
        // Formatting data harga promo
        $harga_promo = str_replace('.', '', $request->harga_promo); // Hilangkan titik sebagai pemisah ribuan
        $harga_promo = str_replace(',', '.', $harga_promo); // Ganti koma dengan titik sebagai pemisah desimal
        $Promo->harga_promo = $harga_promo; // Simpan harga yang sudah diformat

        // Simpan perubahan
        $Promo->save();

        // Redirect ke halaman D_Promo setelah update
        return redirect('D_Promo')->with('success', 'data promo berhasil di update!');
    }
}
