<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\M_Barang;

class Utama extends Controller
{
    public function index() {
        return view('Utama');
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'file' => 'required|max:2048'
        ]);
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'data_file';
        if ($file->move($tujuan_upload,$nama_file)) {
            $data = M_Barang::create([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'gambar' => $nama_file
            ]);
            $res['message'] = "succsess!";
            $res['values'] = $data;
            return response()->json($res);
        }
    }
}
