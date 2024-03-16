<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased bg-gray-200 dark:bg-black dark:text-white/50">
  <div class="grid place-content-center h-screen">
    <form action="{{ route('store') }}" method="POST" class="space-y-4 p-4 bg-white rounded-md max-w-sm mt-6"
      method="POST">
      @csrf
      <h1 class=" text-center text-3xl font-bold">Custom Email Verification</h1>

      <input type="text" placeholder="Name" name="name" class="w-full rounded-md border p-2">
      <input type="text" placeholder="Email" name="email" class="w-full rounded-md border p-2">
      <button type="submit" class="bg-indigo-500 w-full text-white p-2 rounded-md">Submit</button>
    </form>
  </div>
</body>

</html>
