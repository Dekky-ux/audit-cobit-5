<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <title>REKAPITULASI SISTEM INFORMASI {{Str::upper($nama)}}</title>
</head>
<body class="body-cetak" style="padding: : 5px">
  <section class="header-cetak" style="display: flex; justify-content: space-between; border-bottom: 1px solid #aaa; padding-bottom: 5px; align-items: center">
    <div class="flex-1" style="flex: 1">
      {{-- <img src="{{ public_path("/logo.png") }}" alt="Logo ASIKBP2MI" style="width: 50px"> --}}
    </div>
    <div class="flex-1 text-center font-bold text-lg" style="flex:1; text-align: center;font-weight: bold;font-size: 12px">
      <h1>REKAPITULASI SISTEM INFORMASI {{Str::upper($nama)}}</h1>
    </div>
    <div class="flex-1 flex justify-end" style="flex:1;display: flex;justify-content: flex-end">
      {{-- <img src="http://http://127.0.0.1/:8000/logo.png" alt="Logo ASIKBP2MI" style="width: 50px"> --}}
    </div>
  </section>
  <section class="data">
      <div >
        <div class="item" >
          <span style="width: 200px">Nama Sistem Informasi</span>
          <span style="width: 50px">:</span>
          <span style="width: 200px" class="text-justify">{{$si->nama}}</span>
        </div>
        <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
          <span style="width: 200px">Keterangan</span>
          <span style="width: 50px">:</span>
          <span style="width: 200px" class="text-justify">{{$si->deskripsi}}</span>
        </div>
        <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
          <span style="width: 200px">Tanggal Ditambahkan</span>
          <span style="width: 50px">:</span>
          <span style="width: 200px" class="text-justify">{{\Carbon\Carbon::parse($si->created_at)->format("d F Y")}}</span>
        </div>
        <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
          <span style="width: 200px">Tanggal hari ini</span>
          <span style="width: 50px">:</span>
          <span style="width: 200px" class="text-justify">{{\Carbon\Carbon::now()->format("d F Y")}}</span>
        </div>
      </div>
      <div class="mt-20" style="margin-top: 20px">
        <div class="my-2" style="margin: 5px 0">
          <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
            <span style="width: 200px">Jumlah Responden</span>
            <span style="width: 50px">:</span>
            <span style="width: 200px">{{count($si->User)}}</span>
          </div>
          <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
            <span style="width: 200px">Jumlah Pertanyaan</span>
            <span style="width: 50px">:</span>
            <span style="width: 200px">{{count($si->Kuesioner)}}</span>
          </div>
          <div class="py-2" style="display: flex;gap: 3;padding: 3px 0">
            <span style="width: 200px">Jumlah Jawaban</span>
            <div class="ps-2 md:ps-11" style="padding-left: 20px">
              @php
                  $totalJawaban = 0;
              @endphp
              @foreach ($si->Kuesioner as $item)
              <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
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
          <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
            <span style="width: 200px">Maturity Level</span>
            <span style="width: 50px">:</span>
            @php
                $temp = $totalJawaban / count($si->User);
                $maturity = $temp / count($si->Kuesioner);
            @endphp
            <span style="width: 200px">{{floor($maturity)}}</span>
          </div>
          <div class="flex gap-3 py-2" style="display: flex;gap: 3;padding: 3px 0">
            <span style="width: 200px">Keterangan</span>
            <span style="width: 50px">:</span>
            <span style="width: 200px" class="text-justify">{{$keterangan[$maturity]}}</span>
          </div>
        </div>
      </div>
  </section>
</body>
</html>