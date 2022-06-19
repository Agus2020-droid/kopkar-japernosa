<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MitrakuModel;

class MitrakuController extends Controller
{
    public function __construct()
    {
        $this->MitrakuModel = new MitrakuModel();
        $this->middleware('auth');
    }

    public function index()
    {

        return view('mitraku.v_belanjaku');

    }

    public function detailProduk()
    {

        return view('mitraku.v_detailProduk');

    }
}
