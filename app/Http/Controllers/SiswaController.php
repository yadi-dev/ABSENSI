<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\View\View;
use Illuminate\Http\Request;
class SiswaController extends Controller
{
    public function index() : View //untuk menampilkan semua data 
    {
        $siswakita = Siswa::latest()->paginate(10); //paginate ini membatasi data yang ditampilkan hanya 10 siswa dalam tiap halaman
        return view('siswa.beranda', compact('siswakita')); 
    }
    public function store(Request $request) //tambah data
    {
        $request->validate([
            'nisn' => 'required|digits:10|numeric|unique:siswas',
            'nama' => 'required',
            'password' => 'required',
            'jenis_kelamin' => 'required',
        ]);
         //proses nyimpan data
            $siswa = new Siswa;
            $siswa->nisn = $request->nisn;
            $siswa->nama = $request->nama;
            $siswa->password = bcrypt($request->password);
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->save();
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }
}
