<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login ASIK</title>
    @vite('resources/css/app.css')
</head>
<body id="body-login " class="bg-blue-300">
    <div class="border shadow rounded bg-white loginForm text-sm">
        <h2 class="text-center my-5 font-bold">LOGIN <span class="text-blue-500">ASIKBP2MI</span></h2>
        <form action="/login" class="flex flex-col gap-5 py-5" method="POST">
            @method("post")
            @csrf
            <div class="flex flex-col gap-1" style="width: 80%; margin: 0 auto">
                <label for="username" >Username</label>
                <input type="text" name="username" class="border rounded p-2 w-full" />
            </div>
            <div class="flex flex-col gap-1" style="width: 80%; margin: 0 auto">
                <label for="password" >Password</label>
                <input type="password" name="password" class="border rounded p-2" />
            </div>

            {{-- Start Error --}}
            {{-- @if ($errors->any())
            <div class="text-red-500 text-xs italic">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}

            @if ($message = Session::get('error'))
                <div class="text-red-500 text-xs italic ps-5">
                    <span>{{ $message }}</span>
                </div>
            @endif
            {{-- End Error --}}

            <div class="flex justify-center mt-10">
                <button class="border py-2 px-10 rounded shadow bg-blue-500 text-white hover:bg-blue-600"
                    style="width: 80%"
                    type="submit"
                >
                    SUBMIT
                </button>
            </div>
        </form>
    </div>
</body>
</html>