<!DOCTYPE html>
<html lang="en">

<head>
  @viteReactRefresh
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  <link rel="stylesheet" id="send-to-cart-style" href="" />
  {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> --}}

  @stack('head')

  {{-- Aqui van los CSS --}}
  @yield('css_importados')

  {{-- Swipper --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script src="/js/file.extend.js"></script>



  {{-- Alpine --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  {{-- Sweet Alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/' . Route::currentRouteName()])
  <link rel="shortcut icon" href="/img_donas/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="/css/icons.min.css" rel="stylesheet" type="text/css">
  @inertiaHead

  <style>
    .swiper-button-prev,
    .swiper-button-next {
      color: #ff8555 !important;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
      color: #ff8555aa !important;
    }

    .thumbs-swiper {
      height: auto !important;
    }

    .thumbs-swiper .swiper-slide {
      opacity: 0.4;
      width: auto !important;
      height: 80px !important;
    }

    .thumbs-swiper .swiper-slide-thumb-active {
      opacity: 1;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .thumbs-swiper .swiper-slide {
        height: 60px !important;
      }
    }
  </style>

  @if (config('app.env') == 'production')
    <script>
      (function(h, o, t, j, a, r) {
        h.hj = h.hj || function() {
          (h.hj.q = h.hj.q || []).push(arguments)
        };
        h._hjSettings = {
          hjid: 6443542,
          hjsv: 6
        };
        a = o.getElementsByTagName('head')[0];
        r = o.createElement('script');
        r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
      })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <!-- Google Tag Manager -->
    <script>
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-WZN8W83K');
    </script>
    <!-- End Google Tag Manager -->
  @endif

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-KDQNNJX4');
  </script>
  <!-- End Google Tag Manager -->

  <!-- Meta Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '3951912481735804');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=3951912481735804&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->

</head>
<style>
  .stepper-wrapper {
    font-family: Arial;
    margin-top: 50px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .stepper-item {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    width: 400px
  }

  .stepper-item::before {
    position: absolute;
    content: "";
    border-bottom: 2px solid #ccc;
    width: 100%;
    top: 40px;
    left: -50%;
    z-index: -5;
  }

  .stepper-item::after {
    position: absolute;
    content: "";
    border-bottom: 2px solid #ccc;
    width: 100%;
    top: 40px;
    left: 50%;
    z-index: -5;
  }

  .stepper-item .step-counter {
    position: relative;
    z-index: -2;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #ccc;
    margin-bottom: 6px;
  }

  .stepper-item.active::before {
    position: absolute;
    content: "";
    border-bottom: 2px solid #ccc;
    width: 100%;
    top: 40px;
    left: -50%;
    z-index: -3;
  }

  .stepper-item.completed .step-counter {
    background-color: #32B3AD;
  }

  .stepper-item.completed::after {
    position: absolute;
    content: "";
    border-bottom: 2px solid #32B3AD;
    width: 100%;
    top: 40px;
    left: 50%;
    z-index: -3;
  }

  .stepper-item.completed::after {
    position: absolute;
    content: "";
    border-bottom: 2px solid #32B3AD;
    width: 100%;
    top: 40px;
    left: 50%;
    z-index: -3;
  }

  .stepper-item:first-child::before {
    content: none;
  }

  .stepper-item:last-child::after {
    content: none;
  }

  .step-name {
    font-size: 18px;
  }

  @media (max-width: 468px) {
    .step-name {
      font-size: 13px;
    }
  }
</style>

<body class="body">
  {{-- @if (request()->is('pago') && !auth()->check())
        <script>
            window.location.href = "{{ route('login', ['ref' => 'pago']) }}";
        </script>
    @endif --}}
  {{-- <div class="overlay"></div> --}}

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDQNNJX4" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  @include('components.public.header')


  <span id="gift-icon" class="fas"></span>

  <div class="main">
    {{-- Aqui va el contenido de cada pagina --}}
    @inertia

  </div>

  @if (Route::currentRouteName() != 'Agradecimiento.jsx')
    @include('components.public.footer')
  @endif


  @if (Route::currentRouteName() == 'Pago.jsx')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}" />

    <script src="https://checkout.culqi.com/js/v4"></script>
    <script src="https://3ds.culqi.com" defer></script>
  @endif


  @yield('scripts_importados')
  @vite(['resources/js/app.js'])
  {{-- <script src="{{ asset('js/functions.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/function.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/carrito.js') }}"></script> --}}


  @if (config('app.env') == 'production')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZN8W83K" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
  @endif

  <script>
    document.addEventListener("wheel", function(event) {
      if (document.activeElement.type === "number") {
        document.activeElement.blur();
      }
    });
    document.addEventListener("keydown", function(event) {

      if (document.activeElement.type === "number" && (event.key === "ArrowUp" || event.key === "ArrowDown")) {
        event.preventDefault();
        document.activeElement.blur();
      }
    });
  </script>

  <script src="resources/js/capturaParams.js"></script>

</body>

</html>
