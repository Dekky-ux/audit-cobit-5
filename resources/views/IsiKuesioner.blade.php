@extends("app")

@section("content")
<section class="bg-white p-2">
    <div class="text-center font-bold text-lg my-5 italic">
      <h1>Daftar Pertanyaan Yang Diajukan</h1>
    </div>
    <div class="flex flex-col md:flex-row justify-center gap-10">
      <div class="border rounded shadow p-5" style="width: 400px">
        <p class="font-semibold text-justify italic">Jawablah pertanyaan-pertanyaan dibawah ini dengan baik dan sejujur-jujurnya. Jawaban yang anda berikan akan memengaruhi penilaian tingkat kematangan sistem informasi {{Auth::User()->SistemInformasi["nama"]}}</p>
      </div>
      <div class="font-semibold border rounded shadow" style="width: 400px">
        <p class="text-center italic">Keterangan Nilai</p>
        <div class="px-2 py-1 text-xs flex gap-5">
          <span>1.</span>
          <span>Sangat Tidak Setuju</span>
        </div>
        <div class="px-2 py-1 text-xs flex gap-5">
          <span>2.</span>
          <span>Tidak Setuju</span>
        </div>
        <div class="px-2 py-1 text-xs flex gap-5">
          <span>3.</span>
          <span>Setuju</span>
        </div>
        <div class="px-2 py-1 text-xs flex gap-5">
          <span>4.</span>
          <span>Sangat Setuju</span>
        </div>
      </div>
    </div>
    {{-- Start Error --}}
    @if ($errors->any())
    <div class="text-red-500 text-xs italic">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="text-red-500 text-xs italic ps-5">
            <span>{{ $message }}</span>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="text-green-500 text-xs italic ps-5">
            <span>{{ $message }}</span>
        </div>
    @endif
    {{-- End Error --}}
    <div class="w-full mt-5">
      <table class="text-sm w-full">
        <tr class="text-nowrap">
          <th class="py-3 px-4 border border-gray-500 w-20">No</th>
          <th class="py-3 px-4 border border-gray-500 w-56">Domain</th>
          <th class="py-3 px-4 border border-gray-500">Pertanyaan</th>
          <th class="py-3 px-4 border border-gray-500">Jawaban</th>
        </tr>
        @for ($i = 0; $i < count(Auth::User()->SistemInformasi->Kuesioner); $i++)
          <tr class="text-center">
            <td class="border py-2 px-1 text-center">{{$i+1}}</td>
            <td class="border py-2 px-1 text-center">{{Auth::User()->SistemInformasi->Kuesioner[$i]["domain"]}}</td>
            <td class="border py-2 px-1 text-center">{{Auth::User()->SistemInformasi->Kuesioner[$i]["pertanyaan"]}}</td>
            <td class="border flex flex-wrap justify-center gap-5 py-2 px-1 text-center items-center w-96">
                <div class="flex justify-center items-center gap-1 border p-1">
                  <span>1</span>
                  <input type="checkbox" onclick="handleClick('{{Auth::User()->SistemInformasi->Kuesioner[$i]['id']}}', 1)">
                </div>
                <div class="flex justify-center items-center gap-1 border p-1">
                  <span>2</span>
                  <input type="checkbox" onclick="handleClick('{{Auth::User()->SistemInformasi->Kuesioner[$i]['id']}}', 2)">
                </div>
                <div class="flex justify-center items-center gap-1 border p-1">
                  <span>3</span>
                  <input type="checkbox" onclick="handleClick('{{Auth::User()->SistemInformasi->Kuesioner[$i]['id']}}', 3)">
                </div>
                <div class="flex justify-center items-center gap-1 border p-1">
                  <span>4</span>
                  <input type="checkbox" onclick="handleClick('{{Auth::User()->SistemInformasi->Kuesioner[$i]['id']}}', 4)">
                </div>
                <div id="{{Auth::User()->SistemInformasi->Kuesioner[$i]['id']}}">
                  
                </div>
            </td>
          </tr>
        @endfor
      </table>
      <div class="flex justify-end p-2 mt-5">
        <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs py-2 px-5 rounded shadow font-bold" onclick="handleSubmit({{count(Auth::User()->SistemInformasi->Kuesioner)}})">Kirim</button>
      </div>
    </div>
  </section>
  <form action="/isi-kuesioner" method="post" class="hidden">
    @method('post')
    @csrf
      <div id="form-post"></div>
      <button id="submit" type="submit">klik</button>
  </form>
<script>
  let data = {};
  function handleClick(id, value){
    data[id] = value;
    let el = document.getElementById(id);
    if(value){
      el.innerHTML = `
        <span>Selected</span>
        <span>:</span>
        <span>${value}</span>
      `
    }else{
      el.innerHTML = ""
    }
  }
  async function handleSubmit(total){
    let el = document.getElementById("form-post");
    let btn = document.getElementById("submit");

    let currTotal = Object.entries(data).length;
    if(currTotal < total){
      alert("Mohon isi semua kuesioner terlebih dahulu");
      return;
    }
    for (const [key, value] of Object.entries(data)) {
      el.innerHTML +=`<input name="${key}" value="${value}" />`      
    }
    btn.click();
  }
</script>
@endsection