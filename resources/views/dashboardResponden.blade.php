@extends("app")

@section("content")
<section>
    <div class="text-xl py-10 text-center">
        <span>Selamat Datang Responden Di 
            <span class="text-blue-500 font-semibold">ASIKBP2MI</span>
        </span>
    </div>
    @if ($message = Session::get('success'))
        <div class="text-green-500 text-xs italic ps-5 text-center">
            <span>{{ $message }}</span>
        </div>
    @endif
    <div class="bg-white flex flex-wrap gap-10 items-center">
        <div class="flex-1 p-3 text-sm">
            <table>
                <tr>
                    <td class="py-1 px-5 text-nowrap">Nama Pengguna</td>
                    <td class="py-1 px-5 text-nowrap">:</td>
                    <td class="py-1 px-5">{{Auth::User()->nama}}</td>
                </tr>
                <tr>
                    <td class="py-1 px-5 text-nowrap">Username</td>
                    <td class="py-1 px-5 text-nowrap">:</td>
                    <td class="py-1 px-5">{{Auth::User()->username}}</td>
                </tr>
                <tr>
                    <td class="py-1 px-5 text-nowrap">Sistem Informasi</td>
                    <td class="py-1 px-5 text-nowrap">:</td>
                    <td class="py-1 px-5">{{Auth::User()->SistemInformasi["nama"]}}</td>
                </tr>
                <tr>
                    <td class="py-1 px-5 text-nowrap">Keterangan</td>
                    <td class="py-1 px-5 text-nowrap text-justify">:</td>
                    <td class="py-1 px-5">{{Auth::User()->SistemInformasi["deskripsi"]}}</td>
                </tr>
                <tr>
                    <td class="py-1 px-5 text-nowrap">Jumlah Kuesioner</td>
                    <td class="py-1 px-5 text-nowrap text-justify">:</td>
                    <td class="py-1 px-5">{{count(Auth::User()->SistemInformasi->Kuesioner)}}</td>
                </tr>
            </table>
        </div>
        <div class="flex-1 p-3 flex justify-center">
            <div class="border rounded shadow w-96 md:w-4/6">
                <p class="text-green-400 font-bold text-center">INFORMASI</p>
                <div class="p-2 my-5 text-justify">
                    <p class="text-sm">
                        Ada beberapa pertanyaan yang akan diajukan kepada {{Auth::User()->nama}} untuk dilakukan Rekapitulasi Perhitungan Audit pada sistem informasi {{Auth::User()->SistemInformasi["nama"]}} BP2MI Jawa Barat.
                    </p>
                    <p class="text-sm mt-4">
                        Tekan mulai untuk memulai menjawab pertanyaan yang diajukan Auditor.
                    </p>
                    <a href="/isi-kuesioner" class="flex justify-center mt-5">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-7 rounded shadow text-xs">MULAI</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection