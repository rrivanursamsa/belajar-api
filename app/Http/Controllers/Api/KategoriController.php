<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Validator;

class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::latest()->get();
        $response = [
            'success' => true,
            'massege' => 'Data Kategori ',
            'data' => $kategori
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request){
        //validasi data
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|unique:kategoris'
        ],[
            'nama_kategori_required' => 'Masukan Nama Kategoris',
            'nama_kategori_required' => 'Kategori Sudah Digunakan',
        ]);

        if($validator->fails()) {
            return response()-> json([
                'success' => false,
                'massage' => 'Silahkan isi dengan benar',
                'data' => $validator->errors(),
            ],400);
        } else {
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
        }

        if ($kategori) {
            return response()->json([
                'success' => true,
                'massage' => 'data berhasil disimpan',
            ], 200);
        } else{
            return response ()->json([
                'success' => false,
                'massage' => 'data gagal disimpan',
            ], 400);
        }
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);

        if ($kategori){
            return response()->json([
                'success' => true,
                'massage' => 'detail kategori',
                'data' => $kategori,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'Kategori tidak di temukan',
                'data' => '',
            ], 400);
        }
    }

    public function update(Request $request,$id){
        //validasi data
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|unique:kategoris'
        ],[
            'nama_kategori_required' => 'Masukan Nama Kategoris',
        ]);

        if($validator->fails()) {
            return response()-> json([
                'success' => false,
                'massage' => 'Silahkan isi dengan benar',
                'data' => $validator->errors(),
            ],400);

        } else {
            $kategori = Kategori::find($id);
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
        }

        if ($kategori) {
            return response()->json([
                'success' => true,
                'massage' => 'data berhasil diperbaharui',
            ], 200);
        } else{
            return response ()->json([
                'success' => false,
                'massage' => 'data gagal disimpan',
            ], 400);
        }
    }

    public function destroy($id){
        $kategori = Kategori::find($id);
        if ($kategori){
            $kategori->delete();
            return response()->json([
                'success' => true,
                'massage' => 'data' . $kategori->nama_kategori . 'berhasil di hapus',
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'massage' => 'data tidak ditemukan',
            ],400);
        }
    }
}
