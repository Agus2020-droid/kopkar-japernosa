<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use Illuminate\Support\Facades\DB;


class VisitorController extends Controller
{
    public function __construct()
    {
        $this->Pegawai = new Pegawai();
        $this->middleware('auth');
    }

    
}
