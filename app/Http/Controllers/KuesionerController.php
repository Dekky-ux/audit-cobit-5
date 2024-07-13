<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kuesioner;
use App\Models\SistemInformasi;
use Exception;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function index(){
        $data = [];
        $page = (int)request("page") || 1;
        $skip = ceil(($page-1)*20);

        if(request('nama')){
            $data = SistemInformasi::latest()->where("nama", "LIKE", "%".request('nama')."%")->get();
        }else{
            $data = SistemInformasi::latest()->skip($skip)->take(20)->get();
        }
        $total = count(SistemInformasi::latest()->get());

        return view("Kuesioner", [
            "data" => $data,
            "total" => request("nama") ? count($data) : $total,
            "page" => $page
        ]);
    }
    public function create(Request $request){
        $validate = $request->validate([
            "domain" => ['required'],
            "pertanyaan" => ["required"],
            "sistem_informasi_id" => ["required"]
        ]);
        try{
            Kuesioner::create($validate);
            return redirect('/kuesioner')->with(["success" => "Kuesioner berhasil ditambahkan"]);
        }catch(Exception $err){
            dd([
                "data" => $validate,
                "err" => $err
            ]);
            return redirect('/kuesioner')->with(["error" => "Server Error!"]);
        }
    }
    public function update(Request $request){
        $validate = $request->validate([
            "id" => ['required'],
            "domain" => ['required'],
            "pertanyaan" => ["required"],
        ]);
        try{
            $find = Kuesioner::where("id", "=", $validate["id"])->first();
            if(!$find){
                return redirect('/kuesioner')->with(["error" => "Data kuesioner tidak ditemukan"]);
            }
            $find->domain = $validate["domain"];
            $find->pertanyaan = $validate["pertanyaan"];
            $find->save();
            return redirect('/kuesioner')->with(["success" => "Update data Kuesioner berhasil"]);
        }catch(Exception $err){
            dd([
                "data" => $validate,
                "err" => $err
            ]);
            return redirect('/kuesioner')->with(["error" => "Server Error!"]);
        }
    }
    public function delete(Request $request){
        try{
            Kuesioner::destroy($request["id"]);
            return redirect('/kuesioner')->with(["success" => "Hapus data kuesioner berhasil"]);
        }catch(Exception $err){
            dd([
                "data" => $request,
                "err" => $err
            ]);
            return redirect('/kuesioner')->with(["error" => "Server Error!"]);
        }
    }
}
