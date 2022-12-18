<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PemilihResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SexResource;
use App\Models\Population;
use Illuminate\Support\Carbon;



class PemilihController extends Controller
{
    //     /**
    //  * index
    //  *
    //  * @return void
    //  */
    public function index()
    {
        $pemilih = DB::table('populations')->where('populations.tanggal_lahir', '>=', Carbon::now()->subYear(18))
                    ->leftJoin('dusuns', 'populations.dusun_id', '=', 'dusuns.id')
                    ->leftJoin('sexes', 'populations.sex_id', '=', 'sexes.id')
                    ->select(['dusuns.desa_id as DesaID', 'dusuns.id as DusunID', 'dusuns.name as nama_dusun', 'dusuns.rt AS RT', 'dusuns.rw AS RW',
                                DB::raw("COUNT(CASE WHEN sexes.name = 'Pria' THEN 1 END) as Lk"),
                                DB::raw("COUNT(CASE WHEN sexes.name = 'Wanita' THEN 1 END) as Pr"),
                                DB::raw("COUNT(*) AS Jiwa")
                             ]
                            )
                        ->groupBy(['dusuns.name'])
                        ->get();

        return new PemilihResource(true, 'Data Calon Pemilih Desa 10', $pemilih);
    }


}
