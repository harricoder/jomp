<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      @include('layouts.navigation')

      <!-- Page Heading -->
      @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 d-flex align-items-center flex justify-between">
            {{ $header }}
          </div>
        </header>
      @endif

      <!-- Page Content -->
      <main>
        @if (Session::has('success'))
          <div class="py-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-data="{ showSuccess: true }" x-show="showSuccess" x-init="setTimeout(() => showSuccess = false, 3000)">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center" role="alert">
                <span class="font-medium">Success!</span> {!! Session::get('success') !!}
              </div>
            </div>
          </div>
        @endif

        @if (Session::has('error'))
          <div class="py-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => showError = false, 3000)">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center" role="alert">
                <span class="font-medium">Error!</span> {!! Session::get('error') !!}
              </div>
            </div>
          </div>
        @endif

        {{ $slot }}

      </main>
    </div>
  </body>
</html>
