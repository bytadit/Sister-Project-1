<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    public function golongan_darah()
    {
        // return $this->belongsTo(GolonganDarah::class, 'golongan_darah_id');
        return $this->belongsTo(GolonganDarah::class);

    }

    public function sex()
    {
        // return $this->belongsTo(GolonganDarah::class, 'golongan_darah_id');
        return $this->belongsTo(Sex::class);

    }

    protected $table = 'tweb_penduduk';
    protected $guarded = ['id'];

}
