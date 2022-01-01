<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Informasi extends Model
{
    use HasFactory;

    public function tampilInformasi()
    {
        return DB::table('information')->get();
    }

    public function getInformasi($id)
    {
        return DB::table('information')->where('id', $id)->first();
    }

    public function simpanInfomasi($data)
    {
        DB::table('information')->insert($data);
    }

    public function editInformasi($id, $data)
    {
        DB::table('information')->where('id', $id)->update($data);
    }

    public function hapusInformasi($id)
    {
        DB::table('information')->where('id', $id)->delete();
    }
}
