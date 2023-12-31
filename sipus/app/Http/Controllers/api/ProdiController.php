<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as Basecontoller;

class ProdiController extends BaseController
{
    //
    public function index(){
        $prodis = Prodi::all();
        $success['data'] = $prodis;
        return $this->sendResponse($success, 'Data prodi.');
    }

    public function store(Request $request){
        $validasi = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:5000',
        ]);

        $ext = $request->foto->getClientOriginalExtension();
        $nama_file = "foto-" . time() . "." .$ext;
        $path = $request->foto->storeAs('public', $nama_file);

        $prodi = new Prodi();
        $prodi->nama = $validasi['nama'];
        $prodi->foto = $nama_file;

        if($prodi->save()){
            $success['data'] = $prodi;
            return $this->sendResponse($success, 'Data prodi berhasil disimpan.');
        }
        else{
            return $this->sendError('Error.', ['error' => 'Data prodi gagal disimpan.']);
        }
    }

      public function update(Request $request, $id){
       $validasi = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:5000',
        ]);

        $ext = $request->foto->getClientOriginalExtension();
        $nama_file = "foto-" . time() . "." .$ext;
        $path = $request->foto->storeAs('public', $nama_file);

        $prodi = Prodi::find($id);
        $prodi->nama = $validasi['nama'];
        $prodi->foto = $nama_file;

        if($prodi->save()){
            $success['data'] = $prodi;
            return $this->sendResponse($success, 'Data prodi berhasil diperbaharui.');
        }
        else{
            return $this->sendError('Error.', ['error' => 'Data prodi gagal diperbaharui.']);
        }
    }

     public function delete($id){
        $prodi = Prodi:: findorFail($id);
       if($prodi->delete()){
        $success['data'] = [];
        return $this->sendResponse($success, "Data prodi dengan id $id berhasil dihapus");
       }
       else{
            return $this->sendError('Error.', ['error' => 'Data prodi gagal dihapus.']);
        }
    }
}
