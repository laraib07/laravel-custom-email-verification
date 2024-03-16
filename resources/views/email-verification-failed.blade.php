<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verifiation Failed</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  @vite('resources/css/app.css')
</head>

<body>
  <main>
    <div class="grid place-content-center h-screen bg-gray-200">
      <form action="{{ route('resend-mail', $id) }}" method="POST"
        class="flex flex-col gap-8 justify-center p-4 max-w-xl bg-white rounded-md">
        @csrf
        <h1 class="text-4xl font-bold">Verification Link Expired!</h1>
        <button type="submit" class="bg-indigo-500 text-white p-2 rounded-md">Resend Link</button>
      </form>
    </div>
  </main>
</body>

</html>
