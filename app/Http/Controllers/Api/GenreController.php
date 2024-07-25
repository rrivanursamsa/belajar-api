<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Validator;

class GenreController extends Controller
{
    public function index(){
        $genre = Genre::latest()->get();
        $response = [
            'success' => true,
            'massege' => 'Data Genre ',
            'data' => $genre
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request){
        //validasi data
        $validator = Validator::make($request->all(),[
            'nama_genre' => 'required|unique:genres'
        ],[
            'nama_genre_required' => 'Masukan Nama Genres',
            'nama_genre_required' => 'Genre Sudah Digunakan',
        ]);

        if($validator->fails()) {
            return response()-> json([
                'success' => false,
                'massage' => 'Silahkan isi dengan benar',
                'data' => $validator->errors(),
            ],400);
        } else {
            $genre = new Genre;
            $genre->nama_genre = $request->nama_genre;
            $genre->save();
        }

        if ($genre) {
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
        $genre = Genre::find($id);

        if ($genre){
            return response()->json([
                'success' => true,
                'massage' => 'detail kategori',
                'data' => $genre,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'Genre tidak di temukan',
                'data' => '',
            ], 400);
        }
    }

    public function update(Request $request, $id){
        //validasi data
        $validator = Validator::make($request->all(),[
            'nama_genre' => 'required'
        ],[
            'nama_genre_required' => 'Masukan Nama Genres',
        ]);

        if($validator->fails()) {
            return response()-> json([
                'success' => false,
                'massage' => 'Silahkan isi dengan benar',
                'data' => $validator->errors(),
            ],400);

        } else {
            $genre = Genre::find($id);
            $genre->nama_genre = $request->nama_genre;
            $genre->save();
        }

        if ($genre) {
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
        $genre = Genre::find($id);
        if ($genre){
            $genre->delete();
            return response()->json([
                'success' => true,
                'massage' => 'data' . $genre->nama_genre . 'berhasil di hapus',
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'massage' => 'data tidak ditemukan',
            ],400);
        }
    }
}

