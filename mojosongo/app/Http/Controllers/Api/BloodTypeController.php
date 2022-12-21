<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Population;
use App\Models\BloodType;
use App\Http\Resources\BloodTypeResource;
use Illuminate\Support\Facades\DB;

class BloodTypeController extends Controller
{
    //     /**
    //  * index
    //  *
    //  * @return void
    //  */
    public function index()
    {
        $bloodType = DB::table('populations')
                        ->leftJoin('dusuns', 'populations.dusun_id', '=', 'dusuns.id')
                        ->leftJoin('blood_types', 'populations.blood_type_id', '=', 'blood_types.id')
                        ->leftJoin('sexes', 'populations.sex_id', '=', 'sexes.id')
                        ->select(['dusuns.desa_id as DesaID','dusuns.id as DusunID', 'dusuns.name as nama_dusun', 'blood_types.id as BloodTypeID', 'blood_types.name as BloodTypeName',
                                    DB::raw("COUNT(CASE WHEN sexes.name = 'Pria' THEN 1 END) as Pria"),
                                    DB::raw("COUNT(CASE WHEN sexes.name = 'Wanita' THEN 1 END) as Wanita"),
                                    DB::raw("COUNT(*) AS Total")
                                 ]
                                )
                        ->groupBy(['dusuns.name', 'blood_types.name'])
                        ->get();

        return new BloodTypeResource(true, 'Data Golongan Darah Desa 9', $bloodType);
    }
}
