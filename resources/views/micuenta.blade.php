<!DOCTYPE html>
<html lang="en">

<head>
  @viteReactRefresh
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

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
</head>

<body class="body">
  @if (request()->is('pago') && !auth()->check())
    <script>
      window.location.href = "{{ route('login', ['ref' => 'pago']) }}";
    </script>
  @endif
  {{-- <div class="overlay"></div> --}}
  @include('components.public.header')


  <span id="gift-icon" class="fas"></span>

  <div class="main">
    {{-- Aqui va el contenido de cada pagina --}}
    @inertia

  </div>



  @include('components.public.footer')

  @if (Route::currentRouteName() == 'Pago.jsx')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}" />

    <script src="https://checkout.culqi.com/js/v4"></script>

    <script>
      const culqi = async () => {
        try {
          const carrito = Local.get('carrito') ?? []
          const paymentData = Local.get('payment-data') ?? {}
          if (Culqi.token) {
            const body = {
              _token: $('[name="_token"]').val(),
              cart: carrito.map((x) => ({
                id: x.id,
                imagen: x.imagen,
                quantity: x.cantidad,
                usePoints: x.usePoints || false
              })),
              ...paymentData,
              culqi: Culqi.token
            }
            const res = await fetch("{{ route('payment.culqi') }}", {
              method: 'POST',
              headers: {
                'Content-type': 'application/json'
              },
              body: JSON.stringify(body)
            })
            const data = await res.json()
            if (!res.ok) throw new Error(data?.message ?? 'Ocurrio un error inesperado al generar el cargo')

            $(document.body).append(`<div id="card-animation">
              <div class="container">
                <div class="left-side">
                  <div class="card">
                    <div class="card-line"></div>
                    <div class="buttons"></div>
                  </div>
                  <div class="post">
                    <div class="post-line"></div>
                    <div class="screen">
                      <div class="dollar">💲</div>
                    </div>
                    <div class="numbers"></div>
                    <div class="numbers-line2"></div>
                  </div>
                </div>
                <div class="right-side">
                  <div class="new truncate">{{ env('APP_NAME') }}</div>
                </div>
              </div>
            </div>`);

            $('#card-animation .right-side').attr('simulate-hover', 'something')
            $('#card-animation .container').attr('simulate-hover', 'something')
            Local.delete('carrito')
            Local.delete('payment-data')

            setTimeout(() => {
              location.href = `/agradecimiento?code=${data.data.reference_code}`
            }, 1500);
          } else if (Culqi.order) {
            const order = Culqi.order;
          } else {
            throw new Error(Culqi.error.message);
          }
        } catch (error) {
          Swal.fire({
            title: `Error!!`,
            text: error.message,
            icon: "error",
          });
        }
      }
    </script>
  @endif


  @yield('scripts_importados')
  {{-- @vite(['resources/js/functions.js']) --}}
  {{-- <script src="{{ asset('js/functions.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/function.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/carrito.js') }}"></script> --}}


</body>

</html>
