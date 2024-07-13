<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/logo.png">
  @vite('resources/css/app.css')
</head>
<body class="relative">
  <div class="flex justify-between items-center px-7 py-3 md:py-4 border-b shadow bg-gray-600 text-white">
    <div class="font-semibold italic text-blue-500" >ASIKBP2MI</div>
    <div class="hidden sm:flex gap-6 text-sm">
      <span class="hover:border-b hover:text-blue-500 hover:border-blue-500">
        <a href="/">Dashboard</a>
      </span>
      @if (Auth::User()->role === "AUDITOR")
          <span class="hover:border-b hover:text-blue-500 hover:border-blue-500">
            <a href="/pengguna">Pengguna</a>
          </span>
          <span class="hover:border-b hover:text-blue-500 hover:border-blue-500">
            <a href="/kuesioner">Kuisioner</a>
          </span>
      @endif
      <span class="hover:border-b hover:text-blue-500 hover:border-blue-500">
        <a href="/sistem-informasi">Sistem Informasi</a>
      </span>
      <span class="text-red-500 hover:border-b hover:border-red-500">
        <a href="/logout" class="flex gap-2 items-center">Logout 
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
          </svg>
        </a>
      </span>
    </div>
    <div class="flex sm:hidden">
      <button class="border py-1 px-3 rounded shadow hover:bg-gray-100" onclick="handleClickMenu()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
      </button>
      <div class="hidden" id="menu-mobile">
        <div class="absolute w-full left-0 top-14 flex flex-col gap-3 p-2 border text-sm bg-slate-600 text-white" >
          <span class="hover:border-b">
            <a href="/">Dashboard</a>
          </span>
          @if (Auth::User()->role === "AUDITOR")
            <span class="hover:border-b">
              <a href="/pengguna">Pengguna</a>
            </span>
            <span class="hover:border-b">
              <a href="/kuesioner">Kuisioner</a>
            </span>
          @endif
          <span class="hover:border-b">
            <a href="/sistem-informasi">Sistem Informasi</a>
          </span>
          <span class="text-red-500 hover:border-b hover:border-red-500">
            <a href="/" class="flex gap-2 items-center">Logout 
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
              </svg>
            </a>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div style="min-height: 85vh;" class="bg-slate-50">
    @yield("content")
  </div>
  <div class="flex-1 border p-3 text-xs">
    <span>Copyright by <a href="/" class="italic text-blue-500">ASIKBP2MI</a> Jawa Barat</span>
  </div>
  
  <script>
    function handleClickMenu(){
      document.getElementById("menu-mobile").classList.toggle("hidden");
    }
    function showHideModal(id){
      document.getElementById(id).classList.toggle("auto-hide");
    }
  </script>
</body>
</html>