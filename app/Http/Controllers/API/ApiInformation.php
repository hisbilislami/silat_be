<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use Exception;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;

class ApiInformation extends Controller
{
    public function __construct()
    {
        $this->informasi = new Informasi();
    }

    public function index()
    {
        $data=$this->informasi->tampilInformasi();
        return response()->json($data);
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required',
                'created_by' => 'required',
                'updated_by' => 'required',
            ]);
            $data = array(
                'content' => $request->content,
                'created_by' => $request->created_by,
                'updated_by' => $request->updated_by,
            );
            $this->informasi->simpanInfomasi($data);
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data gagal disimpan',
                ]
            );
        }
    }

    public function getInformasi($id)
    {
        $data = $this->informasi->getInformasi($id);
        if($data) {
            return response()->json([
                'success' => true,
                'data'    => $data
            ]);
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data tidak ditemukan!',
                ]
            );
        }
    }

    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'content' => 'required',
                'updated_by' => 'required',
            ]);
            $data = array(
                'content' => $request->content,
                'updated_by' => $request->updated_by,
            );
            $this->informasi->editInformasi($id, $data);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data gagal diupdate',
                ]
            );
        }
    }

    public function delete($id)
    {
        $data = $this->informasi->getInformasi($id);
        if ($data) {
            $this->informasi->hapusInformasi($id);
            return response()->json([
                'success' => true,
                'data'    => 'Data berhasil dihapus'
            ]);
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data tidak ditemukan!',
                ]
            );
        }
    }
}
