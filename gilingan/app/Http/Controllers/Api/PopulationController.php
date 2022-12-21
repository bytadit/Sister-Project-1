<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Population;
// use App\Models\Dusun;
use App\Http\Resources\PopulationResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class PopulationController extends Controller
{
    //     /**
    //  * index
    //  *
    //  * @return void
    //  */
    public function index()
    {
        $population = DB::table('populations')
                        ->leftJoin('dusuns', 'populations.dusun_id', '=', 'dusuns.id')
                        ->leftJoin('sexes', 'populations.sex_id', '=', 'sexes.id')
                        ->select(['dusuns.desa_id as DesaID', 'dusuns.id as DusunID', 'dusuns.name as nama_dusun', 'dusuns.rt as RT', 'dusuns.rw as RW',
                                    DB::raw("COUNT(DISTINCT populations.kk_id) as 'Jumlah_KK'"),
                                    DB::raw("COUNT(CASE WHEN sexes.name = 'Pria' THEN 1 END) as Pria"),
                                    DB::raw("COUNT(CASE WHEN sexes.name = 'Wanita' THEN 1 END) as Wanita"),
                                    DB::raw("COUNT(*) AS Total_PW")
                                 ]
                                )
                        ->groupBy('dusuns.name')
                        ->get();

        return new PopulationResource(true, 'Data Populasi Desa 2', $population);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'nik'       => 'required|unique:populations|size:16',
            'dusun_id'     => 'required|integer|between:1,4',
            'sex_id'   => 'required|integer|between:1,2',
            'citizen_id'     => 'required|integer|between:1,3',
            'blood_type_id'   => 'required|integer|between:1,4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $populations = Population::create([
            'name'     => $request->name,
            'nik'     => $request->nik,
            'dusun_id'     => $request->dusun_id,
            'sex_id'     => $request->sex_id,
            'citizen_id'     => $request->citizen_id,
            'blood_type_id'   => $request->blood_type_id,
        ]);

        return new PopulationResource(true, 'Data Penduduk Berhasil Ditambahkan!', $populations);
    }

    public function show(Population $population)
    {
        return new PopulationResource(true, 'Data Penduduk Ditemukan!', $population);
    }

    public function update(Request $request, Population $population)
    {
        $rules = [
            'name'      => 'required|max:100',
            'dusun_id'     => 'required|integer|between:1,4',
            'sex_id'   => 'required|integer|between:1,2',
            'citizen_id'     => 'required|integer|between:1,3',
            'blood_type_id'   => 'required|integer|between:1,4',
        ];
        if($request->nik != $population->nik){
            $rules['nik'] = 'required|unique:populations|size:16';
        };

        $validatedData = $request->validate($rules);
        Population::where('id', $population->id)
                    ->update($validatedData);

        return new PopulationResource(true, 'Data Penduduk Berhasil Diubah!', $population);
    }
    public function destroy(Population $population)
    {

        $population->delete();

        //return response
        return new PopulationResource(true, 'Data Penduduk Berhasil Dihapus!', null);
    }
}
