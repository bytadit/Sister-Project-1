<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DusunResource;
use Illuminate\Support\Facades\DB;
use App\Models\Dusun;
// use App\Models\Dusun;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DusunController extends Controller
{
    public function index(){
        $dusun = Dusun::all();

        return new DusunResource(true, 'Data Dusun Desa 5', $dusun);
    }
}
