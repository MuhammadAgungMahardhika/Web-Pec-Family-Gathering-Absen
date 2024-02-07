<?php

namespace App\Http\Controllers;

use App\Models\DataKaryawan;
use App\Models\DataKaryawanModel;
use Illuminate\Http\Request;
use App\Models\Karyawan; // Pastikan mengganti ini dengan model yang sesuai

class DataKaryawanController extends Controller
{
    protected $dataKaryawanModel;

    public function __construct(DataKaryawan $dataKaryawanModel)
    {
        $this->dataKaryawanModel = $dataKaryawanModel;
    }

    public function karyawanByName(Request $request)
    {
        $name = $request->name;

        // Lakukan pencarian berdasarkan nama
        $karyawan = $this->dataKaryawanModel->where('name', 'like', '%' . $name . '%')->get();

        return response()->json($karyawan);
    }
}
