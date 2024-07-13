@extends("app")

@section("content")
<section>
    <div class="text-xl py-10 text-center">
        <span>Selamat Datang Auditor Di 
            <span class="text-blue-500 font-semibold">ASIKBP2MI</span>
        </span>
    </div>
    <div class="w-full my-10 p-2 bg-white md:bg-slate-50">
        <div class="p-3 md:p-20 bg-white md:flex md:flex-col md:justify-center overflow-x-auto border shadow">
            <table class="text-sm">
                <tr class="text-nowrap">
                    <th class="py-3 px-4 border border-gray-500">No</th>
                    <th class="py-3 px-4 border border-gray-500">Sistem Informasi</th>
                    <th class="py-3 px-4 border border-gray-500">Tanggal</th>
                    <th class="py-3 px-7 border border-gray-500">Keterangan</th>
                    <th class="py-3 px-4 border border-gray-500">Jumlah Kuesioner</th>
                </tr>
                @for ($i = 0; $i < count($data); $i++)
                    <tr>
                        <td class="border py-2 px-1 text-center">{{$i+1}}</td>
                        <td class="border py-2 px-1 text-center">{{$data[$i]->nama}}</td>
                        <td class="border py-2 px-1 text-center">{{\Carbon\Carbon::parse($data[$i]->created_at)->format("d F Y")}}</td>
                        <td class="border py-2 px-1">{{$data[$i]->deskripsi}}</td>
                        <td class="border py-2 px-1 text-center">{{count($data[$i]->Kuesioner)}}</td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>
</section>
@endsection