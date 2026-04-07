<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} -  Backend</title>
  <link rel="shortcut icon" href="/img_donas/icon.svg" type="image/x-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <link href="/css/icons.min.css" rel="stylesheet" type="text/css">

  <!-- funciones -->

  {{-- colorpicker  --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
  <!-- 'classic' theme -->
  <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>


  <!-- DataTable -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.tailwindcss.css">
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.tailwindcss.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- Include the Quill library -->
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
  @livewireStyles
  @yield('css')
  @yield('js_vendor')
  @yield('js_page')

  <script>
    if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
      document.querySelector('html').classList.remove('dark');
      document.querySelector('html').style.colorScheme = 'light';
    } else {
      document.querySelector('html').classList.add('dark');
      document.querySelector('html').style.colorScheme = 'dark';
    }
  </script>

  <style>
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
      margin-top: 0.25rem;
      /* mt-1 */
      background-color: #F9FAFB;
      /* bg-gray-50 */
      border: 1px solid #D1D5DB;
      /* border-gray-300 */
      color: #111827;
      /* text-gray-900 */
      border-radius: 0.5rem;
      /* rounded-lg */
      padding-left: 2.5rem;
      /* pl-10 */
      padding: 7px 14px;
      /* p-2.5 */
      height: unset;
      font-size: 0.875rem;
      /* text-sm */
    }

    .select2-container--open .select2-dropdown--below {
      border-color: #D1D5DB;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered,
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
      color: #111827;
      /* text-gray-900 */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow,
    .select2-container--default .select2-selection--multiple .select2-selection__arrow {
      height: 100%;
      right: 1rem;
      /* align with pl-10 */
    }

    .select2-container--default .select2-selection--single:focus,
    .select2-container--default .select2-selection--multiple:focus {
      border-color: #3B82F6;
      /* focus:border-blue-500 */
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
      /* focus:ring-blue-500 */
    }

    /* Dark mode styles */
    .dark .select2-container .select2-selection--single,
    .dark .select2-container .select2-selection--multiple {
      background-color: #374151;
      /* dark:bg-gray-700 */
      border-color: #4B5563;
      /* dark:border-gray-600 */
      color: #F9FAFB;
      /* dark:text-white */
    }

    .dark .select2-container--default .select2-selection--single .select2-selection__rendered,
    .dark .select2-container--default .select2-selection--multiple .select2-selection__rendered {
      color: #F9FAFB;
      /* dark:text-white */
    }

    .dark .select2-container--default .select2-selection--single:focus,
    .dark .select2-container--default .select2-selection--multiple:focus {
      border-color: #3B82F6;
      /* dark:focus:border-blue-500 */
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
      /* dark:focus:ring-blue-500 */
    }

    /* Adjust the width to match Tailwind CSS block w-full */
    .select2-container {
      width: 100% !important;
      /* block w-full */
    }
  </style>

</head>

<body class="font-inter antialiased bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400"
  :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

  <script>
    if (localStorage.getItem('sidebar-expanded') == 'true') {
      document.querySelector('body').classList.add('sidebar-expanded');
    } else {
      document.querySelector('body').classList.remove('sidebar-expanded');
    }
  </script>

  <!-- Page wrapper -->
  <div class="flex h-[100dvh] overflow-hidden">

    <x-app.sidebar />

    <!-- Content area -->
    <div
      class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if ($attributes['background']) {{ $attributes['background'] }} @endif"
      x-ref="contentarea">

      <x-app.header />

      <main class="grow">
        {{ $slot }}
      </main>

    </div>

  </div>

  @livewireScripts
  @yield('scripts_importados')

</body>

</html>
