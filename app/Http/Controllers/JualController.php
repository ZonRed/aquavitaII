<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\jual;
use Illuminate\Support\Facades\Auth;


class JualController extends Controller
{
    public function Jual()
    {
            // Fetch jadwal data from the database
            $jual = jual::paginate(5); // Paginate with 5 items per page
            return view('admin.d_jual', ['jual' => $jual]);
    }

    public function pencarianadminjual(Request $request)
    {
        $query = $request->input('caricodejualadmin_jual');
        $jual = jual::where('type_jual', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($jual); // Return paginated results as JSON for AJAX handling
    }

    public function pengguna_Jual()
    {
        $jual = jual::paginate(5); // Paginate with 5 items per page
        return view('pengguna.jual', ['jual' => $jual]);
    }

    public function pencarianpenggunajual(Request $request)
    {
        $query = $request->input('caricodejualpengguna_jual');
        $jual = jual::where('type_jual', 'like', '%' . $query . '%')->paginate(5);
        return response()->json($jual);
    }


    public function InputJual()
    {
        $jual = jual::all();
        return view('admin.d_inputjual',compact('jual'));
    }

    public function SaveJual(Request $request) 
    {
    // Validasi agar tidak terjadi duplikat
    $existingJual = jual::where(function($query) use ($request) {
                            $query->where('code_jual', $request->code_jual)
                                  ->orWhere('type_jual', $request->type_jual);
                        })
                        ->where('users_id', auth()->user()->id)
                        ->first();

    if ($existingJual) {
        if ($existingJual->code_jual == $request->code_jual && $existingJual->type_jual == $request->type_jual) {
            return redirect('d_inputjual')->with('error', 'Code dan Type Barang terjadi duplikat!');
        } elseif ($existingJual->code_jual == $request->code_jual) {
            return redirect('d_inputjual')->with('error', 'Code Barang terjadi duplikat!');
        } else {
            return redirect('d_inputjual')->with('error', 'Type Barang terjadi duplikat!');
        }
    }


        $jual = new jual;
        $jual->tanggal_jual=$request->tanggal_jual;
        $jual->code_jual=$request->code_jual;
        $jual->type_jual=$request->type_jual;
        // Format harga_jual menggunakan number_format
        $harga_jual = str_replace('.', '', $request->harga_jual); // Hilangkan titik sebagai pemisah ribuan
        $harga_jual = str_replace(',', '.', $harga_jual); // Ganti koma dengan titik sebagai pemisah desimal
        $jual->harga_jual = $harga_jual;
        $jual->stock_jual=$request->stock_jual;
        $jual->jumlah_jual=$request->jumlah_jual;
        $jual->users_id=auth()->user()->id;
        $jual->save();


        // Menggunakan session flash untuk menyimpan pesan
        return redirect('d_jual')->with('success', 'Data jual berhasil diinput.');
    }


    public function delete_Jual($id)
    {
        $jual = jual::find($id);
    
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
        $deleted = jual::truncate();
    
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Semua jual berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus semua jual.']);
        }
    }
    

    public function edit_Jual($id)
    {
        $jual = jual::find($id);
        return view('admin.d_editjual', compact('jual'));
    }

    public function update_Jual(Request $request, $id)
    {
    // Validasi agar tidak terjadi duplikat
    $existingJual = jual::where(function($query) use ($request) {
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

        $jual = Jual::find($id);
        
        // Update data hasil dengan data baru
        $jual ->tanggal_jual=$request->tanggal_jual;
        $jual ->code_jual=$request->code_jual;
        $jual ->type_jual=$request->type_jual;
        // Format harga_jual menggunakan number_format
        $harga_jual = str_replace('.', '', $request->harga_jual); // Hilangkan titik sebagai pemisah ribuan
        $harga_jual = str_replace(',', '.', $harga_jual); // Ganti koma dengan titik sebagai pemisah desimal
        $jual->harga_jual = $harga_jual;
        $jual->stock_jual=$request->stock_jual;
        $jual->jumlah_jual=$request->jumlah_jual;


        // Simpan perubahan
        $jual->save();

        // Redirect ke halaman D_Jual setelah update
        return redirect('d_jual')->with('success', 'data jual berhasil di update!');
    }
}
