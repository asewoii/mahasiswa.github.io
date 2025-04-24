<?php

namespace App\Http\Controllers; // nama directory kita
use App\Models\Mahasiswa; // nama directory yang di tuju kita
use Directory;
use Illuminate\Http\Request;

class Control_Mahasiswa extends Controller {
    public function index() {
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa);
    }

    public function show($id) {
        $mahasiswa = Mahasiswa::find($id);
        return redirect('plus_mahasiswa.php');
    }

    public function create(Request $request) {
        $jurusanList = [
            "Teknik Informatika" => "Teknik Informatika",
            "Sistem Informasi" => "Sistem Informasi"
        ];

        $mahasiswa = new Mahasiswa();

        $mahasiswa->nama        = $request->nama;
        $mahasiswa->nim         = $request->nim;
        $mahasiswa->jurusan     = $jurusanList[$request->jurusan]; //INI MAPPING

        $mahasiswa->save();
    }

    public function update(Request $request, $id) {
        $mahasiswa = Mahasiswa::find($id);

        $mahasiswa->nama        = $request->nama;
        $mahasiswa->nim         = $request->nim;
        $mahasiswa->jurusan     = $request->jurusan;

        $mahasiswa->save();
        return response()->json($mahasiswa, "Berhasil Di Update...!");
    }

    public function delete($id) {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return response("Data Telah Berhasil Di Hapus!");
    }
}
