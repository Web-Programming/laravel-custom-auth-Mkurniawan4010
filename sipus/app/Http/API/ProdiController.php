<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdiController extends Controller
{
    //
    public function index()
    {
        $prodi = Prodi::all();
        return $this->sendResponse($prodi, "Data Prodi");
    }

}
