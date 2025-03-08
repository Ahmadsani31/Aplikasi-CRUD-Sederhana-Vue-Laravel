<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function get()
    {
        try {
            $obat = Mahasiswa::query()
                ->when(request('search'), function ($query, $search) {
                    return  $query->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('nim', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('no_handphone', 'like', '%' . $search . '%')
                        ->orWhere('alamat', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $obat
            ], 201);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => 'Data empty',
                'errors' => $err->getMessage()
            ], 422);
        }
    }

    public function store(MahasiswaRequest $request)
    {
        try {
            $mahasiswa = Mahasiswa::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Created successfully',
                'data' => $mahasiswa
            ], 201);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $err->getMessage()
            ], 422);
        }
    }

    public function edit($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $mahasiswa
            ], 201);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'errors' => $err->getMessage()
            ], 422);
        }
    }

    public function update(MahasiswaRequest $request, $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Updated successfully',
                'data' => $mahasiswa
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => 'Update data failed',
                'errors' => $err->getMessage()
            ], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->delete();
            return response()->json([
                'status' => true,
                'message' => 'Deleted successfully'
            ], 204);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => 'Delete data failed',
                'errors' => $err->getMessage()
            ], 422);
        }
    }

    public function get_total()
    {
        try {
            $mahasiswa = Mahasiswa::count();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $mahasiswa
            ], 201);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'errors' => $err->getMessage()
            ], 422);
        }
    }
}
