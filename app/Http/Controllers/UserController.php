<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SistemInformasi;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = [];
        $page = (int)request("page") || 1;
        $skip = ceil(($page-1)*20);

        if(request('nama')){
            if(request('role') && request('role') !== 'ALL'){
                $data = User::latest()->where("nama", "LIKE", "%".request('nama')."%")->orWhere("username", "LIKE", "%".request('nama')."%")->where("role", "=", request('role'))->get();
            }else{
                $data = User::latest()->where("nama", "LIKE", "%".request('nama')."%")->orWhere("username", "LIKE", "%".request('nama')."%")->get();
            }
        }else{
            if(request('role') && request('role') !== 'ALL'){
                $data = User::latest()->where("role", "=", request('role'))->skip($skip)->take(20)->get();
            }else{
                $data = User::latest()->skip($skip)->take(20)->get();
            }
        }
        $total = User::latest()->get();
        $si = SistemInformasi::latest()->get();

        return view("kelolaPengguna", [
            "data" => $data,
            "total" => request("nama") ? count($data) : count($total),
            "page" => $page,
            "si" => $si
        ]);
    }
    public function create(Request $request){
        $validate = $request->validate([
            "nama" => ["required", "min:2"],
            "username" => ['required', 'min:2'],
            "password" => ["required", "min:2"],
            "sistem_informasi_id" => ["required"],
            "role" => ['required']
        ]);
        try{
            $find = User::where("username", "=", $validate["username"])->first();
            if($find){
                return redirect('/pengguna')->with(["error"=> "Username telah digunakan!"]);
            }
            $validate["password"] = Hash::make($validate["password"]);
            User::create($validate);

            return redirect('/pengguna')->with(['success' => "Data pengguna berhasil ditambahkan"]);
        }catch(Exception $err){
            dd([
                "data" => $validate,
                "err" => $err
            ]);
            return redirect('/pengguna')->with(["error"=> "Server Error"]);
        }
    }
    public function update(Request $request){
        $validate = $request->validate([
            "id" => ['required', 'min:1'],
            "nama" => ['required', 'min:2'],
            "username" => ['required', 'min: 2'],
        ]);
        try{
            $find = User::where('id', '=', $validate['id'])->first();
            if(!$find){
                return redirect('/pengguna')->with(['error' => "Data pengguna tidak ditemukan!"]);
            }
            $find->nama = $validate["nama"];
            $find->username = $validate["username"];
            $find->updated_at = Carbon::now()->format("Y-m-d");
            $find->save();

            return redirect('/pengguna')->with(['success' => "Update data berhasil!"]);
        }catch(Exception $err){
            dd([
                "data" => $request,
                "error" => $err
            ]);
            return redirect('/pengguna')->with(['error' => "Server Error!"]);
        }
    }

    public function delete(Request $request) {
        try{
            User::destroy($request["id"]);
            return redirect('/pengguna')->with(['success' => "Data pengguna berhasil dihapus"]);
        }catch(Exception $err){
            dd([
                "data" => $request,
                "error" => $err
            ]);
            return redirect('/pengguna')->with(['error' => "Server Error!"]);
        }
    }
}
