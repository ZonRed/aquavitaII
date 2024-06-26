<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Jual;
use Illuminate\Support\Facades\Auth;


class JualController extends Controller
{
    public function Jual()
    {
            // Fetch jadwal data from the database
            $Jual = Jual::paginate(5); // Paginate with 5 items per page
            return view('admin.D_Jual', ['Jual' => $Jual]);
    }

    public function pencarianadminjual(Request $request)
    {
        $query = $request->input('caricodejualadmin_jual');
        $Jual = Jual::where('type_jual', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($Jual); // Return paginated results as JSON for AJAX handling
    }

    public function pengguna_Jual()
    {
        $Jual = Jual::paginate(5); // Paginate with 5 items per page
        return view('pengguna.Jual', ['Jual' => $Jual]);
    }

    public function pencarianpenggunajual(Request $request)
    {
        $query = $request->input('caricodejualpengguna_jual');
        $Jual = Jual::where('type_jual', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($Jual);
    }


    public function InputJual()
    {
        $Jual = Jual::all();
        return view('admin.D_InputJual',compact('Jual'));
    }

    public function SaveJual(Request $request) 
    {
    // Validasi agar tidak terjadi duplikat
    $existingJual = Jual::where(function($query) use ($request) {
                            $query->where('code_jual', $request->code_jual)
                                  ->orWhere('type_jual', $request->type_jual);
                        })
                        ->where('users_id', auth()->user()->id)
                        ->first();

    if ($existingJual) {
        if ($existingJual->code_jual == $request->code_jual && $existingJual->type_jual == $request->type_jual) {
            return redirect('D_InputJual')->with('error', 'Code dan Type Barang terjadi duplikat!');
        } elseif ($existingJual->code_jual == $request->code_jual) {
            return redirect('D_InputJual')->with('error', 'Code Barang terjadi duplikat!');
        } else {
            return redirect('D_InputJual')->with('error', 'Type Barang terjadi duplikat!');
        }
    }


        $Jual = new Jual;
        $Jual->tanggal_jual=$request->tanggal_jual;
        $Jual->code_jual=$request->code_jual;
        $Jual->type_jual=$request->type_jual;
        // Format harga_jual menggunakan number_format
        $harga_jual = str_replace('.', '', $request->harga_jual); // Hilangkan titik sebagai pemisah ribuan
        $harga_jual = str_replace(',', '.', $harga_jual); // Ganti koma dengan titik sebagai pemisah desimal
        $Jual->harga_jual = $harga_jual;
        $Jual->stock_jual=$request->stock_jual;
        $Jual->jumlah_jual=$request->jumlah_jual;
        $Jual->users_id=auth()->user()->id;
        $Jual->save();


        // Menggunakan session flash untuk menyimpan pesan
        return redirect('D_Jual')->with('success', 'Data jual berhasil diinput.');
    }


    public function delete_Jual($id)
    {
        $jual = Jual::find($id);
    
        if (!$jual) {
            return response()->json(['status' => 'error', 'message' => 'Data jual tidak ditemukan.']);
        }
    
        if ($jual->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data jual berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data jual.']);
        }
    }
    
    public function deleteAll_Jual()
    {
        $deleted = Jual::truncate();
    
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Semua jual berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus semua jual.']);
        }
    }
    

    public function edit_Jual($id)
    {
        $Jual = Jual::find($id);
        return view('admin.D_EditJual', compact('Jual'));
    }

    public function update_Jual(Request $request, $id)
    {
    // Validasi agar tidak terjadi duplikat
    $existingJual = Jual::where(function($query) use ($request) {
                            $query->where('code_jual', $request->code_jual)
                                  ->orWhere('type_jual', $request->type_jual);
                        })
                        ->where('id', '!=', $id) // Pastikan id tidak sama dengan id yang sedang diupdate
                        ->where('users_id', auth()->user()->id)
                        ->first();

    if ($existingJual) {
        if ($existingJual->code_jual == $request->code_jual && $existingJual->type_jual == $request->type_jual) {
            return redirect()->back()->with('error', 'Code dan Type Barang terjadi duplikat!');
        } elseif ($existingJual->code_jual == $request->code_jual) {
            return redirect()->back()->with('error', 'Code Barang terjadi duplikat!');
        } else {
            return redirect()->back()->with('error', 'Type Barang terjadi duplikat!');
        }
    }

        $Jual = Jual::find($id);
        
        // Update data hasil dengan data baru
        $Jual ->tanggal_jual=$request->tanggal_jual;
        $Jual ->code_jual=$request->code_jual;
        $Jual ->type_jual=$request->type_jual;
        // Format harga_jual menggunakan number_format
        $harga_jual = str_replace('.', '', $request->harga_jual); // Hilangkan titik sebagai pemisah ribuan
        $harga_jual = str_replace(',', '.', $harga_jual); // Ganti koma dengan titik sebagai pemisah desimal
        $Jual->harga_jual = $harga_jual;
        $Jual ->stock_jual=$request->stock_jual;
        $Jual ->jumlah_jual=$request->jumlah_jual;


        // Simpan perubahan
        $Jual->save();

        // Redirect ke halaman D_Jual setelah update
        return redirect('D_Jual')->with('success', 'data jual berhasil di update!');
    }
}
