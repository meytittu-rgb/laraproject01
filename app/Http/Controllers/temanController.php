<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class temanController extends Controller
{
    private $dta = [
        [
            'idbuku'=>1,
            'namateman'=>'Yuanes Idah Blili',
            'alamat'=>'Jl. Lurus Terus Blok D.29A',
            'kota'=>'Denpasar',
            'telp'=>'03611011',
            'wa'=>'08778877',
        ],
        [
            'idbuku'=>2,
            'namateman'=>'Yunita Sari dewi Purnama',
            'alamat'=>'Jl. Lika-liku D No 29A',
            'kota'=>'Denpasar',
            'telp'=>'036445544',
            'wa'=>'0866554433',
        ],
    ];
    public function index(){
        $dt = $this->dta;
        return view('teman',compact('dt') ) ;
    }
    public function selengkapnya($id){
        $dt = collect($this->dta)->firstWhere('idbuku',$id);

        if(!$dt){
            abort(404,"Data tidak dengan $id ditemukan");
        }

        return view('datateman',compact('dt'));
    }
}
