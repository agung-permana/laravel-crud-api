<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Validator;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();

        return response()->json([
            "success" => true,
            "message" => "List Dosen",
            "data" => $dosen
        ]);
    }

    public function tambah(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $dosen = Dosen::create($input);
        return response()->json([
            "success" => true,
            "message" => "Data Berhasil Ditambah",
            "data" => $dosen
        ]);
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $dosen = Dosen::whereId($request->input('id'))->update([
                'nip'     => $request->input('nip'),
                'nama'   => $request->input('nama'),
                'email'   => $request->input('email'),
                'telp'   => $request->input('telp'),
                'alamat'   => $request->input('alamat'),

            ]);

            if ($dosen) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Gagal Diupdate!',
                ], 401);
            }

        }

    }

    public function hapus($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        if ($dosen) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Dihapus!',
            ], 400);
        }

    }
}
