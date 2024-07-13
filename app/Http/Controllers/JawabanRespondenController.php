<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JawabanResponden;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JawabanRespondenController extends Controller
{
    public function index(){
        return view("IsiKuesioner");
    }
    public function create(Request $request){
        try{
            // $data = [];
            for($i = 0; $i < count(Auth::User()->SistemInformasi->Kuesioner); $i++){
                $find = JawabanResponden::where("kuesioner_id", "=", Auth::User()->SistemInformasi->Kuesioner[$i]->id)->orWhere("user_id", "=", Auth::user()->id)->first();
                if($find){
                    $find->jawaban = $request[Auth::User()->SistemInformasi->Kuesioner[$i]->id];
                    $find->save();
                }else{
                    JawabanResponden::create([
                        "user_id" => Auth::user()->id,
                        "kuesioner_id" => Auth::User()->SistemInformasi->Kuesioner[$i]->id, 
                        "jawaban" => $request[Auth::User()->SistemInformasi->Kuesioner[$i]->id]
                    ]);
                }
            }
            // JawabanResponden::insert($data); 
            return redirect("/dashboard")->with(["success" => "Isi kuesioner berhasil!. lihat detail di rekapitulasi"]);
        }catch(Exception $err){
            dd([
                "data" => $request,
                "err" => $err
            ]);
            return redirect('/isi-kuesioner')->with(["error" => "Server Error!"]);
        }
    }
}
