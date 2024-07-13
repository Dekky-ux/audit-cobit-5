@extends("app")
@section("content")

<section class="p-7">
  <h1 class="text-center text-lg font-bold">Detail Rekapitulasi {{$si->nama}}</h1>
  <div class="border rounded p-3 mt-2 flex flex-col gap-10 md:flex-row ">
    <div class="flex-1 border-r">
      <div class="flex gap-3 py-2">
        <span style="width: 200px">Nama Sistem Informasi</span>
        <span style="width: 50px">:</span>
        <span style="width: 200px" class="text-justify">{{$si->nama}}</span>
      </div>
      <div class="flex gap-3 py-2">
        <span style="width: 200px">Keterangan</span>
        <span style="width: 50px">:</span>
        <span style="width: 200px" class="text-justify">{{$si->deskripsi}}</span>
      </div>
      <div class="flex gap-3 py-2">
        <span style="width: 200px">Tanggal Ditambahkan</span>
        <span style="width: 50px">:</span>
        <span style="width: 200px" class="text-justify">{{\Carbon\Carbon::parse($si->created_at)->format("d F Y")}}</span>
      </div>
      <div class="flex gap-3 py-2">
        <span style="width: 200px">Tanggal hari ini</span>
        <span style="width: 50px">:</span>
        <span style="width: 200px" class="text-justify">{{\Carbon\Carbon::now()->format("d F Y")}}</span>
      </div>
    </div>
    <div class="flex-1">
      <div class="my-2">
        <div class="flex gap-3 py-2">
          <span style="width: 200px">Jumlah Responden</span>
          <span style="width: 50px">:</span>
          <span style="width: 200px">{{count($si->User)}}</span>
        </div>
        <div class="flex gap-3 py-2">
          <span style="width: 200px">Jumlah Pertanyaan</span>
          <span style="width: 50px">:</span>
          <span style="width: 200px">{{count($si->Kuesioner)}}</span>
        </div>
        <div class="py-2">
          <span style="width: 200px">Jumlah Jawaban</span>
          <div class="ps-2 md:ps-11">
            @php
                $totalJawaban = 0;
            @endphp
            @foreach ($si->Kuesioner as $item)
            <div class="flex gap-3 py-2">
              <span style="width: 200px">Pertanyaan ID {{$item->id}}</span>
              <span style="width: 50px">:</span>
              <span style="width: 200px">
                @php
                  $total = 0;
                  foreach ($item->JawabanResponden as $jawaban) {
                    $total += $jawaban["jawaban"];
                  }
                  $totalJawaban += $total;
                @endphp
                {{$total}}
              </span>
            </div>
            @endforeach
          </div>
        </div>
        <div class="flex gap-3 py-2">
          <span style="width: 200px">Maturity Level</span>
          <span style="width: 50px">:</span>
          @php
              $temp = $totalJawaban / count($si->User);
              $maturity = $temp / count($si->Kuesioner);
          @endphp
          <span style="width: 200px">{{floor($maturity)}}</span>
        </div>
        <div class="flex gap-3 py-2">
          <span style="width: 200px">Keterangan</span>
          <span style="width: 50px">:</span>
          <span style="width: 200px" class="text-justify">{{$keterangan[$maturity]}}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="flex justify-center gap-5 mt-2">
    <a href="/cetak?id={{$si->id}}">
      <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold italic py-2 px-3 rounded shadow">Cetak PDF</button>
    </a>
    <a href="/sistem-informasi">
      <button class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold italic py-2 px-3 rounded shadow">Kembali</button>
    </a>
  </div>
</section>

@endsection