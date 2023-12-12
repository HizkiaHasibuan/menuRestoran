<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // if ($request->file('photo')) {
        //     $validasi['photo'] = $request->file('photo')->store('gambar');
        // }

        Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        return response([
            'status' => true,
            'message' => 'Menu successful added'
        ], 201);
    }

    public function get(Request $request)
    {
        try {
            $menus = Menu::all();

            return response()->json([
                'status' => true,
                'menus' => $menus
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $data = Menu::find($id);
        $data->nama = $request->nama;
        $data->deskripsi = $request->deskripsi;
        $data->kategori = $request->kategori;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        // if ($request->file('photo')) {
        //     Storage::delete($data->photo);
        //     $data->photo = Storage::putFile('gambar', $request->file('photo'));
        // }
        $data->save();
        return response([
            'status' => true,
            'message' => 'Menu successful updated'
        ], 200);
    }

    public function deleteMenu($id)
    {
        try {
        $data = Menu::find($id);
        // if ($data->photo) {
        //     Storage::delete($data->photo);
        // }

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'error' => 'Data tidak ditemukan.'
            ], 404);
        }

        $data->delete();

        return response([
            'status' => true,
            'message' => 'Menu successfully deleted'
        ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data.'], 500);
        }
    }

}
