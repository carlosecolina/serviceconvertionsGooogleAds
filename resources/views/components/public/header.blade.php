{{-- <img src="{{ asset('img_donas/Carrito.png') }}" class="absolute top-0 left-0 w-full z-[99999] opacity-30"></img> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

@php
  $pagina = Route::currentRouteName();
  $isIndex = $pagina == 'index';
@endphp

<style>
  .swiper-container,
  .swiper-wrapper,
  .swiper-slide {
    overflow: visible !important;
  }

  .swiper-slide {
    overflow-y: visible !important;
    overflow-x: visible !important;
  }

  .tiporamo,
  .horario {
    z-index: 0 !important;
  }

  /* ---------------------------*/

  .jquery-modal.blocker.current {
    z-index: 20 !important;
  }

  .tiporamo .swiper-pagination {
    position: relative !important;
    margin-top: 20px !important;
  }

  .swiper-pagination-bullet {
    background-color: #3e3b3a;
    /* Cambia el color del bullet */
    width: 12px;
    /* Cambia el tamaño del bullet */
    height: 12px;
  }

  .swiper-pagination-bullet-active {
    background-color: #73b473;
    /* Cambia el color del bullet activo */
  }

  /* ---------------------------*/

  .img-complementarias .swiper-pagination {
    position: relative !important;
    margin-top: 20px !important;
  }

  .swiper-pagination-bullet {
    background-color: #3e3b3a;
    /* Cambia el color del bullet */
    width: 12px;
    /* Cambia el tamaño del bullet */
    height: 12px;
  }

  .swiper-pagination-bullet-active {
    background-color: #73b473;
    /* Cambia el color del bullet activo */
  }

  /* ---------------------------*/

  body {
    overflow-x: hidden;
  }

  #header_top {
    transition: height 0.6s ease, opacity 0.6s ease;
  }

  .fixed-header {
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    z-index: 2;
  }

  #header-mid.fixed-header {
    transition: height 0.6s ease;
  }

  .header_bottom.fixed-header {
    top: 80px;
  }

  #cart-modal {
    z-index: 10000;
  }


  .submenu {
    display: none;
    /* Oculto por defecto */
    position: absolute;
    background-color: white;
    padding: 1rem;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .subcategories {
    margin-right: 2rem;
  }




  .category-image img {
    max-width: 100px;
    height: auto;
    object-fit: cover;
  }
</style>

<style>
  /* Hace que el contenedor de la librería ocupe todo el ancho */
  .iti {
    width: 100%;
  }

  /* Ajusta el diseño para que no rompa tu input redondeado */
  .iti__country-list {
    color: #374151;
  }

  /* Texto gris oscuro para la lista */
</style>



@if (url()->current() != route('Pago.jsx') && url()->current() != route('Agradecimiento.jsx'))


  <div class="navigation shadow-[0px_0px_20px_1px_rgba(115,180,115,0.20)] "
    style="z-index: 9999; background-color: #FFFDF5 !important">



    <img src="/images/ux/headerLogo.png" alt="" class=" w-[163px] h-[48px] absolute left-[17px] top-[16px] ">

    <button aria-label="hamburguer" type="button" class="hamburger" id="position" onclick="show()">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M4.96049 18.596C4.53745 19.0192 4.53751 19.705 4.96062 20.1281C5.38373 20.5511 6.06965 20.5511 6.49268 20.1279L12.5434 14.0762L18.5945 20.1274C19.0176 20.5504 19.7035 20.5504 20.1266 20.1274C20.5496 19.7044 20.5496 19.0184 20.1266 18.5954L14.0753 12.5441L20.1262 6.49216C20.5491 6.06905 20.5491 5.38313 20.1259 4.9601C19.7029 4.53706 19.0169 4.53712 18.5939 4.96023L12.5431 11.012L6.49194 4.96075C6.06888 4.53768 5.38295 4.53768 4.95988 4.96075C4.53681 5.38382 4.53681 6.06974 4.95988 6.49282L11.0113 12.5442L4.96049 18.596Z"
          fill="#292929" />
      </svg>
    </button>


    <nav class="w-full h-full overflow-y-auto p-5 " x-data="{ openCatalogo: true, openSubMenu: null, openFlor: false }">
      <ul class="space-y-1 font-PlusJakartaSans_Regular mt-[27px]">


        @foreach ($submenucategorias as $category)
          @php

            $heref = $category->raw_url ? url($category->raw_url) : route('Catalogo.jsx', $category->slug);
          @endphp

          @if (isset($category->subcategories) && $category->subcategories->isNotEmpty())
            <div class="h-16 w-full border border-[#E3E3E3] rounded-[4px] flex flex-row mt-[11px] items-center gap-4"
              :class="{ 'bg-[#FFF]': openSubMenu === {{ $category->id }} }">
              <img onclick="window.location.href='{{ $heref }}'" src="{{ asset($category->url_image) }}"
                alt="{{ $category->name }}" class="w-[100px] h-full object-cover rounded-[4px]">

              <div @click="openSubMenu === {{ $category->id }} ? openSubMenu = null : openSubMenu = {{ $category->id }}"
                class="flex justify-between flex-row w-full pr-3">
                <div
                  class="text-center justify-center text-[#292929] text-base font-normal uppercase tracking-[2.88px] font-plus_jakarta">
                  <a href="{{ $heref }}">
                    {{ $category->name }}
                  </a>
                </div>
                <img src="/images/ux/abajo.svg" alt=""
                  :class="{ 'rotate-180': openSubMenu === {{ $category->id }} }"
                  class="transform transition-transform duration-300">

              </div>


            </div>
            <ul x-show="openCatalogo" x-transition class="    bg-[#FFF] !mb-[11px]">

              <ul x-show="openSubMenu === {{ $category->id }}" x-transition class="ml-3  ">

                @foreach ($category->subcategories as $subcategory)
                  <li>
                    <a href="{{ $heref }}?subcat={{ $subcategory->id }}"
                      class="text-[#272727] text-base flex items-center py-2 px-3 hover:opacity-75 transition-opacity duration-300">
                      <span class="underline-this">{{ $subcategory->name }}</span>
                    </a>
                  </li>
                @endforeach
              </ul>



            </ul>
          @else
            <div class="h-16 w-full border border-[#E3E3E3] rounded-[4px] flex flex-row mb-[11px] items-center gap-4">
              <img onclick="window.location.href='{{ $heref }}'" src="{{ asset($category->url_image) }}"
                alt="{{ $category->name }}" class="w-[100px] h-full object-cover rounded-[4px]">


              <a class="flex justify-between flex-row w-full pr-3" href="{{ $heref }}">
                <div
                  class="text-center justify-center text-[#292929] text-base font-normal uppercase tracking-[2.88px] font-plus_jakarta">
                  {{ $category->name }}
                </div>
                <img src="/images/ux/abajo.svg" alt="" class="">
              </a>

            </div>
          @endif
        @endforeach





      </ul>
      <div class=" w-full  flex justify-between items-center py-4 text-[18px] mb-10 ">

        <div class="">
          @if (Auth::user() == null)
            <a class="flex" href="{{ route('login') }}"><img class=" rounded-lg"
                src="{{ asset('img_donas/Group11.png') }}" alt="user" /></a>
          @else
            <div class="relative  inline-flex " x-data="{ open: false }">
              <button class="px-3 py-5 inline-flex justify-center items-center group" aria-haspopup="true"
                @click.prevent="open = !open" :aria-expanded="open">
                <div class="flex items-center truncate">
                  <span id="username"
                    class="truncate ml-2  font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                    {{ explode(' ', Auth::user()->name)[0] }}</span>
                  <i class="mdi mdi-chevron-down"></i>
                  {{-- <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                  </svg> --}}
                </div>
              </button>
              <div
                class="origin-top-right top-0 z-30 absolute  min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">
                <ul>
                  <li class="hover:bg-gray-100">
                    @if (Auth::user()->hasRole('Admin'))
                      <a class="font-medium  text-black flex items-center py-1 px-3" href="{{ route('orders') }}"
                        @click="open = false" @focus="open = true" @focusout="open = false">Dashboard</a>
                    @else
                      <a class="font-medium  text-black flex items-center py-1 px-3"
                        href="{{ route('Dashboard.jsx') }}" @click="open = false" @focus="open = true"
                        @focusout="open = false">Mi Cuenta</a>
                    @endif
                  </li>

                  <li class="hover:bg-gray-100">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <button type="submit" class="font-medium  text-black flex items-center py-1 px-3"
                        @click.prevent="$root.submit(); open = false">
                        {{ __('Cerrar sesión') }}
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>

          @endif
        </div>

        <div class="px-8">

        </div>


      </div>
    </nav>

  </div>


  <a id="header_top" href="/"
    class="bg-[#FFFDF5] h-[82px] text-white  justify-center  w-full px-[5%] xl:px-[8%] py-[11px] text-base items-center hidden md:flex">

    <div class="w-[201px] h-[60px]">
      <svg xmlns="http://www.w3.org/2000/svg" width="201" height="60" viewBox="0 0 201 60" fill="none">
        <path
          d="M12.1765 13.844V16.736H32.0695V18.404C32.0695 23.036 26.5942 27.682 18.8839 27.716C11.7966 27.684 6.77963 24.186 6.01382 19.628H5.0249C5.06309 20.286 5.13947 20.942 5.2862 21.586C6.36356 26.29 10.1826 30.82 18.904 30.84C27.6253 30.82 31.4443 26.292 32.5217 21.586C32.7388 20.636 32.8132 19.66 32.8132 18.686V13.844H12.1765Z"
          fill="#FF8555" />
        <path d="M31.3439 5.21V8.102H7.44295C7.64194 10.872 8.2369 13.844 9.27004 16.736H6.448V5.21H31.3439Z"
          fill="#FF8555" />
        <path d="M18.0457 45.326L18.3251 54.79H19.5633L19.8286 44.174C19.2296 44.586 18.6326 44.972 18.0437 45.326"
          fill="#FF8555" />
        <path
          d="M19.8065 41.072C19.8407 41.046 19.8768 41.018 19.911 40.992L20.0959 33.56H17.698L17.9613 42.474C18.5904 42.02 19.2115 41.546 19.8065 41.072Z"
          fill="#FF8555" />
        <path
          d="M30.9699 31.122C31.6955 30.698 32.7448 31.122 32.8091 32.002C32.8553 32.648 32.5036 33.158 31.7197 33.324C30.2564 33.634 28.8253 33.426 26.4414 31.698V31.494C29.4383 32.68 30.1298 31.614 30.9699 31.122Z"
          fill="#FF8555" />
        <path
          d="M10.0317 46.212C11.7422 47.84 16.2325 44.992 19.8063 42.142C22.7691 39.794 26.4956 37.664 28.6342 39.762C29.5508 40.67 29.8865 41.954 29.8865 43.268C29.8865 45.022 29.0624 46.618 27.5348 47.746L25.9469 46.024C28.391 44.834 29.8563 42.33 28.6342 40.984C27.5348 39.794 25.0002 41.454 21.7621 43.864C17.1491 47.276 12.5985 50.062 9.23774 47.026C6.88604 44.898 7.74029 40.046 10.9181 37.854L12.8115 39.952C9.26789 41.674 7.98551 44.272 10.0317 46.214"
          fill="#FF8555" />
        <path
          d="M137.072 36.616C140.334 36.262 142.607 32.296 141.655 24.362C140.774 16.784 137.585 13.1 134.286 13.49C130.839 13.808 128.676 18.094 129.593 25.708C130.545 33.64 133.589 37.006 137.072 36.616ZM126.66 25.07C126.66 16.818 130.692 12.356 135.641 12.356C140.589 12.356 144.624 16.818 144.624 25.07C144.624 33.746 140.591 37.854 135.641 37.854C130.69 37.854 126.66 33.746 126.66 25.07Z"
          fill="#FF8555" />
        <path
          d="M150.668 12.712L160.567 33.57L159.357 12.712H161.813L161.666 37.502H159.246L149.385 17.032L150.595 37.502H148.139L148.286 12.712H150.668Z"
          fill="#FF8555" />
        <path
          d="M171.302 30.276C172.366 30.382 173.393 30.524 174.454 30.63C175.921 30.808 176.948 30.772 176.506 29.496L172.585 16.04L169.284 30.736C169.688 30.382 170.311 30.17 171.3 30.276M181.678 37.502H178.856L176.987 31.162C176.657 31.446 175.923 31.622 174.567 31.48C173.503 31.374 172.476 31.232 171.413 31.126C169.873 30.95 169.214 31.41 168.846 32.756L167.783 37.502H165.327L172.402 12.712H174.345L181.678 37.502Z"
          fill="#FF8555" />
        <path
          d="M193.499 35.482C195.404 33.498 192.07 28.292 188.733 24.15C185.983 20.714 183.491 16.394 185.947 13.916C187.01 12.854 188.514 12.464 190.054 12.464C192.106 12.464 193.977 13.42 195.296 15.192L193.28 17.032C191.887 14.198 188.954 12.498 187.378 13.916C185.985 15.192 187.929 18.13 190.751 21.884C194.747 27.232 198.009 32.508 194.453 36.404C191.961 39.13 186.279 38.14 183.712 34.456L186.168 32.26C188.184 36.368 191.227 37.856 193.501 35.482"
          fill="#FF8555" />
        <path
          d="M152.322 8.996C151.486 9.016 150.694 9.366 149.99 9.972C150.414 8.388 151.53 7.334 152.79 7.334C154.74 7.334 156.046 8.332 157.395 8.332C159.303 8.332 159.96 7.472 159.96 7.472C159.96 7.472 158.921 9.924 157.365 10.034C155.855 10.14 154.284 8.952 152.32 8.998"
          fill="#FF8555" />
        <path
          d="M120.638 25.124C120.608 31.994 116.886 36.688 112.257 36.688H110.755V13.374H112.257C116.425 13.374 120.608 18.254 120.638 25.124ZM123.448 25.106C123.43 17.334 119.354 13.93 115.119 12.97C114.265 12.776 113.386 12.71 112.51 12.71H108.152V37.5H112.51C113.386 37.5 114.265 37.434 115.119 37.24C119.354 36.28 123.43 32.876 123.448 25.104"
          fill="#FF8555" />
        <path d="M49.4219 12.712H52.0248V36.616C54.5172 36.44 57.1945 35.908 59.7975 34.988V37.502H49.4219V12.712Z"
          fill="#FF8555" />
        <path
          d="M91.6277 35.482C93.5332 33.498 90.1986 28.292 86.862 24.15C84.1124 20.714 81.62 16.394 84.0762 13.916C85.1395 12.854 86.643 12.464 88.1826 12.464C90.2348 12.464 92.1061 13.42 93.4247 15.192L91.4087 17.032C90.0157 14.198 87.0831 12.498 85.5073 13.916C84.1144 15.192 86.058 18.13 88.8801 21.884C92.876 27.232 96.1382 32.508 92.5825 36.404C90.0901 39.13 84.4078 38.14 81.8411 34.456L84.2973 32.26C86.3133 36.368 89.3565 37.856 91.6298 35.482"
          fill="#FF8555" />
        <path
          d="M73.8815 27.466C72.8564 26.466 71.371 25.938 69.4896 25.592C69.2002 25.54 68.9007 25.496 68.6072 25.46L70.7157 16.04L74.1448 27.778C74.0584 27.672 73.9699 27.566 73.8815 27.464M79.807 37.502L72.4745 12.712H70.5308L66.9329 25.32C66.7882 25.312 66.7018 25.31 66.7018 25.31C64.6134 25.238 62.523 25.346 60.8366 25.026C58.5271 24.566 57.2447 23.928 56.29 23.008L55.9603 24.672C55.7031 25.912 57.2427 26.514 59.6989 26.904C62.0828 27.294 64.0606 26.94 66.1872 26.832C66.1872 26.832 66.3038 26.828 66.5008 26.826L63.4536 37.502H65.9098L68.2877 26.882C68.7922 26.92 69.3329 26.982 69.8535 27.082C73.0393 27.692 74.6393 29.472 75.1739 31.316L76.9809 37.504H79.803L79.807 37.502Z"
          fill="#FF8555" />
        <path
          d="M64.3905 45.48H66.3341L65.3372 42.93L64.3905 45.48ZM67.0095 47.22L66.4246 45.71H64.306L63.7412 47.22H63.4558L65.2809 42.368H66.0186L67.9281 47.22H67.0095Z"
          fill="#FF8555" />
        <path
          d="M71.6546 42.596V44.73H72.3239C72.75 44.73 73.0616 44.63 73.2586 44.432C73.4535 44.234 73.55 43.976 73.55 43.656C73.55 43.336 73.4515 43.08 73.2546 42.886C73.0576 42.692 72.75 42.596 72.332 42.596H71.6566H71.6546ZM72.33 44.96H71.6546V47.22H70.7983V42.368H72.338C73.0294 42.368 73.554 42.476 73.9118 42.69C74.2696 42.904 74.4485 43.226 74.4485 43.65C74.4485 43.826 74.4123 43.982 74.34 44.118C74.2676 44.254 74.1691 44.372 74.0405 44.472C73.9118 44.572 73.7611 44.65 73.5842 44.71C73.4073 44.77 73.2184 44.81 73.0134 44.828V44.842C73.339 44.874 73.6143 44.97 73.8395 45.126C74.0646 45.284 74.2214 45.542 74.3098 45.902L74.6234 47.218H73.739L73.4194 45.826C73.335 45.47 73.2063 45.236 73.0335 45.126C72.8586 45.016 72.6254 44.96 72.334 44.96"
          fill="#FF8555" />
        <path d="M78.6714 47.22V42.596H77.0051V42.368H81.192V42.596H79.5277V47.22H78.6714Z" fill="#FF8555" />
        <path d="M87.457 46.99V47.22H84.05V42.368H87.4067V42.596H84.9063V44.606H87.2198V44.834H84.9063V46.99H87.457Z"
          fill="#FF8555" />
        <path
          d="M91.9333 47.288C91.3765 47.288 90.9163 47.162 90.5545 46.91C90.1927 46.658 89.9876 46.286 89.9414 45.79H90.7213C90.7394 46.192 90.8519 46.506 91.059 46.732C91.266 46.958 91.5574 47.072 91.9333 47.072C92.267 47.072 92.5504 46.992 92.7835 46.83C93.0167 46.668 93.1313 46.442 93.1313 46.152C93.1313 45.902 93.0368 45.706 92.8499 45.566C92.6609 45.424 92.3916 45.306 92.0378 45.21L91.5012 45.064C91.065 44.948 90.7313 44.792 90.5022 44.594C90.2731 44.394 90.1585 44.108 90.1585 43.734C90.1585 43.512 90.2067 43.312 90.3012 43.132C90.3957 42.952 90.5243 42.796 90.6871 42.668C90.8499 42.538 91.0409 42.44 91.258 42.37C91.477 42.3 91.7082 42.266 91.9554 42.266C92.4519 42.266 92.866 42.38 93.1956 42.608C93.5252 42.836 93.7162 43.162 93.7664 43.582H93.0147C92.9906 43.24 92.8881 42.972 92.7092 42.774C92.5283 42.578 92.277 42.48 91.9574 42.48C91.6378 42.48 91.3705 42.566 91.1595 42.736C90.9484 42.908 90.8419 43.124 90.8419 43.388C90.8419 43.618 90.9183 43.798 91.071 43.928C91.2238 44.058 91.461 44.166 91.7806 44.254L92.3856 44.414C92.8217 44.53 93.1735 44.69 93.4368 44.896C93.7021 45.102 93.8348 45.406 93.8348 45.808C93.8348 46.058 93.7805 46.276 93.674 46.462C93.5674 46.65 93.4267 46.804 93.2519 46.926C93.077 47.048 92.876 47.14 92.6469 47.2C92.4177 47.26 92.1785 47.29 91.9333 47.29"
          fill="#FF8555" />
        <path
          d="M97.276 45.48H99.2196L98.2227 42.93L97.276 45.48ZM99.895 47.22L99.3101 45.71H97.1915L96.6267 47.22H96.3413L98.1664 42.368H98.9041L100.814 47.22H99.895Z"
          fill="#FF8555" />
        <path d="M106.974 47.22L103.937 42.7V47.22H103.666V42.368H104.731L107.322 46.228V42.368H107.593V47.22H106.974Z"
          fill="#FF8555" />
        <path
          d="M111.358 45.48H113.302L112.305 42.93L111.358 45.48ZM113.977 47.22L113.392 45.71H111.274L110.709 47.22H110.423L112.248 42.368H112.988L114.896 47.22H113.977Z"
          fill="#FF8555" />
        <path
          d="M119.35 47.288C118.793 47.288 118.333 47.162 117.971 46.91C117.609 46.658 117.404 46.286 117.358 45.79H118.138C118.156 46.192 118.27 46.506 118.475 46.732C118.682 46.958 118.974 47.072 119.35 47.072C119.683 47.072 119.967 46.992 120.2 46.83C120.433 46.668 120.548 46.442 120.548 46.152C120.548 45.902 120.453 45.706 120.266 45.566C120.077 45.424 119.808 45.306 119.454 45.21L118.918 45.064C118.482 44.948 118.148 44.792 117.919 44.594C117.69 44.394 117.573 44.108 117.573 43.734C117.573 43.512 117.621 43.312 117.716 43.132C117.81 42.952 117.941 42.796 118.104 42.668C118.266 42.538 118.455 42.44 118.674 42.37C118.894 42.3 119.125 42.266 119.372 42.266C119.868 42.266 120.282 42.38 120.612 42.608C120.942 42.836 121.133 43.162 121.183 43.582H120.431C120.407 43.24 120.305 42.972 120.126 42.774C119.945 42.578 119.694 42.48 119.374 42.48C119.054 42.48 118.787 42.566 118.576 42.736C118.365 42.908 118.258 43.124 118.258 43.388C118.258 43.618 118.335 43.798 118.488 43.928C118.64 44.058 118.877 44.166 119.199 44.254L119.806 44.414C120.242 44.53 120.592 44.69 120.857 44.896C121.123 45.102 121.253 45.406 121.253 45.808C121.253 46.058 121.201 46.276 121.092 46.462C120.986 46.65 120.845 46.804 120.67 46.926C120.496 47.048 120.295 47.14 120.065 47.2C119.836 47.26 119.597 47.29 119.352 47.29"
          fill="#FF8555" />
        <path d="M131.309 44.912H129.329V47.22H128.473V42.368H131.518V42.596H129.329V44.682H131.309V44.912Z"
          fill="#FF8555" />
        <path d="M134.407 47.22V42.368H135.265V46.99H137.494V47.22H134.407Z" fill="#FF8555" />
        <path
          d="M142.175 47.074C142.668 47.074 143.044 46.874 143.303 46.472C143.562 46.07 143.693 45.5 143.693 44.76C143.693 44.02 143.562 43.456 143.299 43.066C143.038 42.676 142.662 42.48 142.173 42.48C141.685 42.48 141.299 42.674 141.042 43.066C140.784 43.456 140.656 44.022 140.656 44.76C140.656 45.498 140.786 46.064 141.046 46.468C141.305 46.872 141.681 47.074 142.173 47.074M142.175 47.288C141.836 47.288 141.516 47.23 141.215 47.112C140.913 46.994 140.652 46.826 140.431 46.61C140.21 46.394 140.035 46.128 139.904 45.814C139.773 45.5 139.709 45.148 139.709 44.76C139.709 44.372 139.777 44.016 139.912 43.706C140.047 43.398 140.226 43.136 140.451 42.924C140.676 42.712 140.937 42.548 141.235 42.436C141.532 42.322 141.846 42.266 142.175 42.266C142.505 42.266 142.819 42.322 143.116 42.436C143.414 42.55 143.675 42.71 143.9 42.922C144.125 43.132 144.306 43.394 144.441 43.706C144.575 44.018 144.642 44.37 144.642 44.762C144.642 45.154 144.577 45.494 144.447 45.808C144.316 46.122 144.141 46.388 143.918 46.604C143.695 46.822 143.434 46.99 143.134 47.11C142.835 47.23 142.515 47.29 142.177 47.29"
          fill="#FF8555" />
        <path
          d="M148.611 42.596V44.73H149.281C149.707 44.73 150.018 44.63 150.213 44.432C150.408 44.234 150.505 43.976 150.505 43.656C150.505 43.336 150.406 43.08 150.209 42.886C150.012 42.692 149.705 42.596 149.287 42.596H148.611ZM149.287 44.96H148.611V47.22H147.755V42.368H149.295C149.986 42.368 150.511 42.476 150.869 42.69C151.226 42.904 151.405 43.226 151.405 43.65C151.405 43.826 151.369 43.982 151.297 44.118C151.224 44.254 151.124 44.372 150.997 44.472C150.869 44.572 150.718 44.65 150.541 44.71C150.364 44.77 150.173 44.81 149.97 44.828V44.842C150.296 44.874 150.571 44.97 150.796 45.126C151.021 45.284 151.178 45.542 151.267 45.902L151.58 47.218H150.696L150.374 45.826C150.29 45.47 150.161 45.236 149.988 45.126C149.813 45.016 149.58 44.96 149.289 44.96"
          fill="#FF8555" />
        <path d="M155.518 42.368H154.661V47.22H155.518V42.368Z" fill="#FF8555" />
        <path
          d="M160.565 47.288C160.008 47.288 159.548 47.162 159.186 46.91C158.824 46.658 158.619 46.286 158.573 45.79H159.353C159.371 46.192 159.485 46.506 159.69 46.732C159.897 46.958 160.189 47.072 160.565 47.072C160.898 47.072 161.182 46.992 161.415 46.83C161.648 46.668 161.763 46.442 161.763 46.152C161.763 45.902 161.668 45.706 161.481 45.566C161.292 45.424 161.023 45.306 160.669 45.21L160.133 45.064C159.696 44.948 159.363 44.792 159.134 44.594C158.905 44.394 158.788 44.108 158.788 43.734C158.788 43.512 158.836 43.312 158.931 43.132C159.025 42.952 159.154 42.796 159.319 42.668C159.481 42.538 159.67 42.44 159.889 42.37C160.107 42.3 160.34 42.266 160.587 42.266C161.083 42.266 161.497 42.38 161.827 42.608C162.157 42.836 162.348 43.162 162.398 43.582H161.646C161.622 43.24 161.52 42.972 161.339 42.774C161.158 42.578 160.906 42.48 160.587 42.48C160.267 42.48 160 42.566 159.789 42.736C159.578 42.908 159.471 43.124 159.471 43.388C159.471 43.618 159.548 43.798 159.7 43.928C159.853 44.058 160.09 44.166 160.412 44.254L161.019 44.414C161.455 44.53 161.805 44.69 162.07 44.896C162.336 45.102 162.466 45.406 162.466 45.808C162.466 46.058 162.414 46.276 162.305 46.462C162.199 46.65 162.058 46.804 161.883 46.926C161.708 47.048 161.507 47.14 161.278 47.2C161.049 47.26 160.81 47.29 160.565 47.29"
          fill="#FF8555" />
        <path d="M166.589 47.22V42.596H164.925V42.368H169.109V42.596H167.445V47.22H166.589Z" fill="#FF8555" />
        <path
          d="M171.785 45.48H173.728L172.731 42.93L171.785 45.48ZM174.404 47.22L173.819 45.71H171.7L171.135 47.22H170.85L172.675 42.368H173.413L175.32 47.22H174.402H174.404Z"
          fill="#FF8555" />
        <path
          d="M179.776 47.288C179.22 47.288 178.759 47.162 178.398 46.91C178.036 46.658 177.831 46.286 177.785 45.79H178.564C178.583 46.192 178.697 46.506 178.902 46.732C179.109 46.958 179.401 47.072 179.776 47.072C180.11 47.072 180.394 46.992 180.627 46.83C180.858 46.668 180.974 46.442 180.974 46.152C180.974 45.902 180.88 45.706 180.693 45.566C180.504 45.424 180.235 45.306 179.881 45.21L179.344 45.064C178.908 44.948 178.574 44.792 178.345 44.594C178.116 44.394 178 44.108 178 43.734C178 43.512 178.048 43.312 178.142 43.132C178.237 42.952 178.365 42.796 178.53 42.668C178.693 42.538 178.882 42.44 179.101 42.37C179.32 42.3 179.551 42.266 179.799 42.266C180.295 42.266 180.709 42.38 181.039 42.608C181.368 42.836 181.559 43.162 181.61 43.582H180.858C180.834 43.24 180.731 42.972 180.55 42.774C180.369 42.578 180.118 42.48 179.799 42.48C179.479 42.48 179.212 42.566 179.001 42.736C178.79 42.908 178.683 43.124 178.683 43.388C178.683 43.618 178.759 43.798 178.912 43.928C179.065 44.058 179.302 44.166 179.624 44.254L180.231 44.414C180.667 44.53 181.017 44.69 181.282 44.896C181.547 45.102 181.678 45.406 181.678 45.808C181.678 46.058 181.626 46.276 181.517 46.462C181.409 46.648 181.27 46.804 181.095 46.926C180.92 47.048 180.719 47.14 180.49 47.2C180.261 47.26 180.022 47.29 179.776 47.29"
          fill="#FF8555" />
      </svg>
    </div>
    {{-- <img class="w-[201px] h-[60px] " src="{{ asset('images/ux/headerLogo.png') }}"> --}}



  </a>
  <div id="header-mid"
    class="sticky top-0 w-full h-[82px] md:h-[88px] bg-white shadow-[0px_0px_20px_1px_rgba(115,180,115,0.20)] flex flex-row items-center z-10">
    <div id="containderHeaderMid"
      class="hidden md:flex flex-row h-full items-center  gap-3 w-full px-[2%] xl:px-[8%]   text-[17px] relative bg-white  ">





      <div class="text-base  pb-30 hidden md:block ">


        <nav id="menu-items" class="h-[88px] px-3 tracking-wider text-base flex flex-row items-center max-w-4xl "
          x-data="{ openCatalogo: false, openSubMenu: null, openFlor2: false }">

          <div class="group relative h-full flex items-center">
            <a href="/"
              class="hover:opacity-75 other-class py-3 px-3 {{ request()->is('/') ? 'text-[#FF8555]' : '' }}">
              <span class="underline-this font-PlusJakartaSans_Regular">Inicio</span>
            </a>
            @if (request()->is('/'))
              <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px]">
              </div>
            @else
              <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px] opacity-0 transition-opacity duration-300 group-hover:opacity-100 pointer-events-none">
              </div>
            @endif
          </div>

          <div class="group relative h-full flex items-center ">
            <a href="/nosotros"
              class=" hover:opacity-75 other-class py-3 px-3 {{ request()->is('nosotros') ? 'text-[#FF8555]' : '' }}">
              <span class="underline-this font-PlusJakartaSans_Regular">Nosotros</span>
            </a>

            {{-- Barra cuando la ruta está activa --}}
            @if (request()->is('nosotros'))
              <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px]">
              </div>

              {{-- Barra cuando NO está activa, pero aparece al hover --}}
            @else
              <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px] opacity-0 transition-opacity duration-300 group-hover:opacity-100 pointer-events-none">
              </div>
            @endif
          </div>

          @for ($i = 0; $i < min(3, count($submenucategorias)); $i++)
            <div class="group relative h-full flex items-center">
              <a href="/catalogo/{{ $submenucategorias[$i]->slug }}"
                class="hover:opacity-75 other-class py-3 px-3 {{ request()->is('catalogo/' . $submenucategorias[$i]->slug) || request()->is('catalogo/' . $submenucategorias[$i]->slug . '/*') ? 'text-[#FF8555]' : '' }}">
                <span class="underline-this font-PlusJakartaSans_Regular">{{ $submenucategorias[$i]->name }}</span>
              </a>
              @if (request()->is('catalogo/' . $submenucategorias[$i]->slug) ||
                      request()->is('catalogo/' . $submenucategorias[$i]->slug . '/*'))
                <div
                  class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px]">
                </div>
              @else
                <div
                  class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px] opacity-0 transition-opacity duration-300 group-hover:opacity-100 pointer-events-none">
                </div>
              @endif
            </div>
          @endfor

          <div class=" h-full flex items-center " x-data="{ showSubmenu: false }">
            <a href="/catalogo" class="hover:opacity-75 other-class py-3 px-3" @mouseenter="showSubmenu = true"
              @mouseleave="showSubmenu = false">
              <span class="underline-this font-PlusJakartaSans_Regular">Más categorías </span>
            </a>

            <!-- Submenu desplegable -->
            <div x-show="showSubmenu" x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 transform scale-95"
              x-transition:enter-end="opacity-100 transform scale-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100 transform scale-100"
              x-transition:leave-end="opacity-0 transform scale-95" @mouseenter="showSubmenu = true"
              @mouseleave="showSubmenu = false"
              class="absolute top-[90px] left-[46%] transform -translate-x-1/2 w-[1269px] bg-[#FFFDF5] rounded-lg shadow-lg border z-50">

              <div class="py-6 px-[65px]">
                <div class="grid grid-cols-5 gap-6">

                  @foreach ($submenucategorias as $categoria)
                    @php

                      $heref = $categoria->raw_url ? url($categoria->raw_url) : route('Catalogo.jsx', $categoria->slug);
                    @endphp
                    <div>
                      <h3
                        class="text-[#292929] text-base font-normal font-PlusJakartaSans_Regular uppercase tracking-[3.84px] mb-3 truncate">
                        {{ $categoria->name }}
                      </h3>

                      @if ($categoria->url_image)
                        <img class="w-[162PX] h-[71px] mb-3 rounded object-cover"
                          src="{{ asset($categoria->url_image) }}" alt="{{ $categoria->name }}" />
                      @else
                        <img class="w-[162PX] h-[71px] mb-3 rounded object-cover" src="https://placehold.co/162x71"
                          alt="{{ $categoria->name }}" />
                      @endif

                      <ul class="space-y-2 text-black text-base font-light font-PlusJakartaSans_Regular leading-8">
                        @if (isset($categoria->subcategories) && $categoria->subcategories->isNotEmpty())
                          <li><a href="{{ $heref }}" class="hover:text-orange-500">Ver todo
                              {{ $categoria->name }}</a></li>
                          @foreach ($categoria->subcategories->take(7) as $subcategoria)
                            <li>
                              <a href="{{ $heref }}?subcat={{ $subcategoria->id }}"
                                class="hover:text-orange-500">{{ $subcategoria->name }}</a>
                            </li>
                          @endforeach
                        @else
                          <!-- Si no hay subcategorías, mostrar categorías relacionadas o genéricas -->
                          <li><a href="{{ $heref }}" class="hover:text-orange-500">Ver todo
                              {{ $categoria->name }}</a></li>
                        @endif
                      </ul>
                    </div>
                  @endforeach



                </div>

                <!-- Botones de filtro horizontal en la parte inferior -->

              </div>
            </div>
          </div>

          <div class="group relative h-full flex items-center">
            <a href="/promociones"
              class="font-PlusJakartaSans_Regular hover:opacity-75 other-class py-3 px-3 {{ request()->is('promociones') ? 'text-[#FF8555]' : '' }}">
              <span class="underline-this">Promociones</span>
            </a>
            @if (request()->is('promociones'))
              <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px]">
              </div>
            @else
              <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1.5 bg-orange-400 rounded-[5px] opacity-0 transition-opacity duration-300 group-hover:opacity-100 pointer-events-none">
              </div>
            @endif
          </div>

        </nav>

      </div>



      <div class="flex justify-end md:w-auto  items-center gap-0 lg:gap-9" style="position: absolute; right: 55px;">

        {{-- <x-search-products /> --}}

        <div class="cursor-pointer relative">



          <!-- BOTÓN QUE ABRE EL BUSCADOR -->
          {{-- <div className="w-64 h-12 bg-white rounded-md border border-neutral-200" /> --}}
          <div class="w-64 h-12 absolute top-[-24px] right-[0rem] bg-white rounded-md border border-neutral-200">

            <div class="flex flex-row items-center justify-between  h-full w-full px-[20px]">
              <input type="text" placeholder="¿Qué buscas?" id="buscarproducto"
                class="h-full w-44 outline-none border-none focus:outline-none focus:ring-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"
                fill="none">
                <path
                  d="M24.6945 23.2216L17.5852 16.1123C18.9623 14.4113 19.7915 12.2499 19.7915 9.89575C19.7915 4.43956 15.3519 0 9.8957 0C4.43951 0 0 4.43951 0 9.8957C0 15.3519 4.43956 19.7915 9.89575 19.7915C12.2499 19.7915 14.4113 18.9623 16.1123 17.5852L23.2216 24.6945C23.4248 24.8977 23.6914 24.9998 23.9581 24.9998C24.2248 24.9998 24.4915 24.8977 24.6946 24.6945C25.1019 24.2873 25.1019 23.6289 24.6945 23.2216ZM9.89575 17.7081C5.58745 17.7081 2.08333 14.204 2.08333 9.8957C2.08333 5.5874 5.58745 2.08328 9.89575 2.08328C14.2041 2.08328 17.7082 5.5874 17.7082 9.8957C17.7082 14.204 14.204 17.7081 9.89575 17.7081Z"
                  fill="#292929" />
              </svg>
            </div>
            <div
              class="flex flex-col  max-h-[184px] w-full bg-white overflow-y-auto overflow-hidden font-dm_sans text-[16px] "
              id="resultados">

            </div>
          </div>







        </div>
        <div class="cursor-pointer">

          @if (Auth::user() == null)
            <a class="flex" href="{{ route('login') }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25" viewBox="0 0 23 25"
                fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M11.0623 9.83333C13.0989 9.83333 14.7498 8.18238 14.7498 6.14583C14.7498 4.10929 13.0989 2.45833 11.0623 2.45833C9.02573 2.45833 7.37484 4.10929 7.37484 6.14583C7.37484 8.18238 9.02573 9.83333 11.0623 9.83333ZM11.0623 12.2917C14.4566 12.2917 17.2082 9.54008 17.2082 6.14583C17.2082 2.75159 14.4566 0 11.0623 0C7.66809 0 4.9165 2.75159 4.9165 6.14583C4.9165 9.54008 7.66809 12.2917 11.0623 12.2917Z"
                  fill="black" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M7.375 17.2083C4.6596 17.2083 2.45833 19.4096 2.45833 22.125V23.3542C2.45833 24.033 1.90801 24.5833 1.22917 24.5833C0.550323 24.5833 0 24.033 0 23.3542V22.125C0 18.0519 3.3019 14.75 7.375 14.75H14.75C18.8231 14.75 22.125 18.0519 22.125 22.125V23.3542C22.125 24.033 21.5747 24.5833 20.8958 24.5833C20.217 24.5833 19.6667 24.033 19.6667 23.3542V22.125C19.6667 19.4096 17.4654 17.2083 14.75 17.2083H7.375Z"
                  fill="black" />
              </svg>
            </a>
          @else
            <div class="relative  inline-flex " x-data="{ open: false }">
              <button class="px-3 py-5 inline-flex justify-center items-center group" aria-haspopup="true"
                @click.prevent="open = !open" :aria-expanded="open">
                <div class="flex items-center truncate">
                  {{-- <span id="username"
                    class="truncate ml-2  font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                    {{ explode(' ', Auth::user()->name)[0] }}</span>
                  <i class="mdi mdi-chevron-down"></i> --}}
                  {{-- <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                  </svg> --}}

                  <div class="relative w-10 h-10 ml-2 rounded-full overflow-hidden "
                    style="background-image: url('/images/ux/logged.png'); background-size: cover; background-position: center;">

                    <img class="w-full p-[6px] rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                      alt="{{ Auth::user()->name }}">
                  </div>

                </div>
              </button>
              <div
                class="w-96 h-[402px] absolute top-[90px] -right-14 bg-white rounded-[10px] shadow-[0px_0px_4px_0px_rgba(0,0,0,0.10)] "
                @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">


                <div class="flex flex-row items-center border-b-[0.5px]  border-[#E3E3E3] h-[102px] w-full ">
                  <div class="h-[50px] w-[50px] rounded-full overflow-hidden ml-[26px]">
                    <img class="w-full  rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                      alt="{{ Auth::user()->name }}">
                  </div>
                  <div class="flex flex-row  ">

                    <div class="ml-4">


                      <p
                        class="w-56 h-5 justify-center text-[#292929] text-base font-semibold font-PlusJakartaSans_Regular ">
                        {{ Auth::user()->name }}</p>
                      <p
                        class="w-56 h-5 justify-center text-[#292929] text-base font-normal font-PlusJakartaSans_Regular">
                        {{ Auth::user()->email }}</p>
                    </div>

                  </div>
                </div>
                <div class="flex flex-col  h-[138px] w-full border-b-[0.5px]  border-[#E3E3E3] pt-[26px]">

                  <div class="flex flex-row items-center gap-5  ml-[26px]">
                    <img src="/images/ux/Group 3623.png" alt="" class="h-[22px] w-[22px]">
                    <div class="w-56 h-5 justify-center text-zinc-800 text-base font-semibold font-plus_jakarta">Uso de
                      puntos</div>

                  </div>

                  <div class="flex flex-row justify-between px-[26px] mt-[15px]">
                    <div className="w-28 h-5 justify-center text-zinc-800 text-base font-normal font-plus_jakarta">
                      Consumidos</div>
                    <div
                      className="w-40 h-5 text-right justify-center text-zinc-800 text-base font-normal font-plus_jakarta">
                      Total de puntos {{ Auth::user()->points }}</div>
                  </div>
                  <div class="px-[26px] mt-[8px]">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">
                      <div class="bg-[#FF8555] h-2.5 rounded-full" style="width: 45%"></div>
                    </div>
                  </div>


                </div>



                @if (Auth::user()->hasRole('Admin'))
                  <div class="h-[81px] w-full border-b-[0.5px]  border-[#E3E3E3]">
                    <div class="flex flex-row px-[26px] items-center  h-full">
                      <a class='flex flex-row gap-[17px]' href="{{ route('Admin/Sales.jsx') }}"
                        @click="open = false" @focus="open = true" @focusout="open = false">
                        <img src="/images/ux/user(28)1.svg" alt="">
                        <div class="w-56 h-5 justify-center text-zinc-800 text-base font-semibold font-plus_jakarta">
                          Dashboard Admin</div>
                      </a>
                    </div>
                  </div>
                @else
                  <div class="h-[81px] w-full border-b-[0.5px]  border-[#E3E3E3]">
                    <div class="flex flex-row px-[26px] items-center  h-full">
                      <a class='flex flex-row gap-[17px]' href="{{ route('Dashboard.jsx') }}" @click="open = false"
                        @focus="open = true" @focusout="open = false">
                        <img src="/images/ux/user(28)1.svg" alt="">
                        <div class="w-56 h-5 justify-center text-zinc-800 text-base font-semibold font-plus_jakarta">
                          Cuenta</div>
                      </a>
                    </div>
                  </div>
                @endif



                <div class="h-[81px] w-full border-b-[0.5px]  border-[#E3E3E3]">

                  <div class="flex flex-row px-[26px] items-center h-full w-full gap-[17px] ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 30 30"
                      fill="none">
                      <path d="M15 5V15" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path
                        d="M10 8.5C8.39456 9.57268 7.17664 11.1332 6.52614 12.9512C5.87564 14.7691 5.82704 16.7481 6.38751 18.5958C6.94799 20.4435 8.08782 22.062 9.63867 23.2122C11.1895 24.3624 13.0692 24.9833 15 24.9833C16.9308 24.9833 18.8105 24.3624 20.3613 23.2122C21.9122 22.062 23.052 20.4435 23.6125 18.5958C24.173 16.7481 24.1244 14.7691 23.4739 12.9512C22.8234 11.1332 21.6054 9.57268 20 8.5"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <button type="submit" class=" text-zinc-800 text-base font-semibold font-plus_jakarta"
                        @click.prevent="$root.submit(); open = false">
                        {{ __('Cerrar sesión') }}
                      </button>
                    </form>
                  </div>

                </div>





              </div>
            </div>

          @endif

        </div>
        <div id="open-cart" class="cursor-pointer relative">
          <span id="itemsCount"
            class="bg-[#FF8555] h-6 w-6 text-xs font-medium text-white text-center px-[7px] py-[2px] rounded-full absolute  left-[5px] bottom-[12px] ml-3"
            style="z-index:10">0</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="31" height="25" viewBox="0 0 31 25" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M29.3609 8.50475C29.4119 8.19734 29.324 7.88284 29.1229 7.64484C28.9203 7.40825 28.6242 7.27084 28.3125 7.27084H2.81255C2.50088 7.27084 2.2048 7.40825 2.00221 7.64484C1.80105 7.88284 1.71321 8.19734 1.76421 8.50475C1.76421 8.50475 3.21205 17.3504 3.92463 21.7123C4.23346 23.5965 5.86121 24.9792 7.76946 24.9792H23.3556C25.2639 24.9792 26.8916 23.5965 27.2005 21.7123L29.3609 8.50475ZM27.0616 9.39584L25.1024 21.3695C24.9621 22.2252 24.2226 22.8542 23.3556 22.8542C19.43 22.8542 11.695 22.8542 7.76946 22.8542C6.90246 22.8542 6.16296 22.2252 6.02271 21.3695L4.06346 9.39584H27.0616Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M24.9734 7.7865L20.7234 0.703168C20.4216 0.200251 19.7685 0.0373343 19.2656 0.339084C18.7627 0.640834 18.5998 1.29392 18.9015 1.79683L23.1515 8.88017C23.4533 9.38308 24.1064 9.546 24.6093 9.24425C25.1122 8.9425 25.2751 8.28942 24.9734 7.7865Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M7.97337 8.88017L12.2234 1.79683C12.5251 1.29392 12.3622 0.640834 11.8593 0.339084C11.3564 0.0373343 10.7033 0.200251 10.4015 0.703168L6.15154 7.7865C5.84979 8.28942 6.01271 8.9425 6.51562 9.24425C7.01854 9.546 7.67162 9.38308 7.97337 8.88017Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M14.5 13.2917V18.9583C14.5 19.5448 14.976 20.0208 15.5625 20.0208C16.149 20.0208 16.625 19.5448 16.625 18.9583V13.2917C16.625 12.7052 16.149 12.2292 15.5625 12.2292C14.976 12.2292 14.5 12.7052 14.5 13.2917Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M8.8335 13.2917V18.9583C8.8335 19.5448 9.3095 20.0208 9.896 20.0208C10.4825 20.0208 10.9585 19.5448 10.9585 18.9583V13.2917C10.9585 12.7052 10.4825 12.2292 9.896 12.2292C9.3095 12.2292 8.8335 12.7052 8.8335 13.2917Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M20.167 13.2917V18.9583C20.167 19.5448 20.643 20.0208 21.2295 20.0208C21.816 20.0208 22.292 19.5448 22.292 18.9583V13.2917C22.292 12.7052 21.816 12.2292 21.2295 12.2292C20.643 12.2292 20.167 12.7052 20.167 13.2917Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M29.7293 7.27084H1.396C0.809496 7.27084 0.333496 7.74684 0.333496 8.33334C0.333496 8.91984 0.809496 9.39584 1.396 9.39584H29.7293C30.3158 9.39584 30.7918 8.91984 30.7918 8.33334C30.7918 7.74684 30.3158 7.27084 29.7293 7.27084Z"
              fill="black" />
          </svg>
        </div>








      </div>



    </div>

    <div class="flex flex-row md:hidden pl-[20px] items-center  ">
      <div id="menu-burguer" class="md:hidden z-10  w-30 cursor-pointer" onclick="show()">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
            <path
              d="M4.375 9.375H25.625C26.6608 9.375 27.5 8.53577 27.5 7.5C27.5 6.46423 26.6608 5.625 25.625 5.625H4.375C3.33923 5.625 2.5 6.46423 2.5 7.5C2.5 8.53577 3.33923 9.375 4.375 9.375Z"
              fill="black" />
            <path
              d="M25.625 13.125H4.375C3.33923 13.125 2.5 13.9642 2.5 15C2.5 16.0358 3.33923 16.875 4.375 16.875H25.625C26.6608 16.875 27.5 16.0358 27.5 15C27.5 13.9642 26.6608 13.125 25.625 13.125Z"
              fill="black" />
            <path
              d="M25.625 20.625H4.375C3.33923 20.625 2.5 21.4642 2.5 22.5C2.5 23.5358 3.33923 24.375 4.375 24.375H25.625C26.6608 24.375 27.5 23.5358 27.5 22.5C27.5 21.4642 26.6608 20.625 25.625 20.625Z"
              fill="black" />
          </svg>
        </div>
      </div>

      <div class="flex md:hidden w-[140px] h-[48px] ml-[20px]">
        <a href="/" class=" mt-1">
          <img src="/images/ux/headermobil.svg" alt="">

        </a>
      </div>

      <div class="flex flex-row items-center ml-[13px] gap-4 justify-start">

        <div class="relative inline-flex" x-data="{ openSearch: false }">


          <div class="cursor-pointer flex items-center" aria-haspopup="true"
            @click.prevent="openSearch = !openSearch" :aria-expanded="openSearch">

            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 25 25"
              fill="none">
              <g clip-path="url(#clip0_105_118)">
                <path
                  d="M24.6945 23.222L17.5852 16.1127C18.9623 14.4117 19.7915 12.2502 19.7915 9.89612C19.7915 4.43992 15.3519 0.000366211 9.8957 0.000366211C4.43951 0.000366211 0 4.43987 0 9.89607C0 15.3523 4.43956 19.7918 9.89575 19.7918C12.2499 19.7918 14.4113 18.9627 16.1123 17.5856L23.2216 24.6949C23.4248 24.898 23.6914 25.0001 23.9581 25.0001C24.2248 25.0001 24.4915 24.898 24.6946 24.6949C25.1019 24.2876 25.1019 23.6293 24.6945 23.222ZM9.89575 17.7085C5.58745 17.7085 2.08333 14.2044 2.08333 9.89607C2.08333 5.58776 5.58745 2.08365 9.89575 2.08365C14.2041 2.08365 17.7082 5.58776 17.7082 9.89607C17.7082 14.2044 14.204 17.7085 9.89575 17.7085Z"
                  fill="black" />
              </g>
              <defs>
                <clipPath id="clip0_105_118">
                  <rect width="25" height="25" fill="white" />
                </clipPath>
              </defs>
            </svg>
          </div>


          <div
            class="w-96 h-[237px] absolute top-[53px] right-[-8.2rem] bg-white rounded-b-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.10)]"
            @click.outside="openSearch = false" @keydown.escape.window="openSearch = false" x-show="openSearch">

            {{-- version Movil --}}
            <div
              class="flex flex-row items-center justify-between border-b-[0.5px] border-[#E3E3E3] h-[52px] w-full px-[24px]">
              <input type="text" placeholder="¿Qué buscas?" id="buscarproducto"
                class="h-[31px] outline-none border-none focus:outline-none focus:ring-0">
              <div class="cursor-pointer" @click.prevent="openSearch = !openSearch">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                  fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M4.96049 18.596C4.53745 19.0191 4.53751 19.705 4.96062 20.1281C5.38373 20.5511 6.06965 20.5511 6.49268 20.1279L12.5434 14.0762L18.5945 20.1274C19.0176 20.5504 19.7035 20.5504 20.1266 20.1274C20.5496 19.7044 20.5496 19.0184 20.1266 18.5954L14.0753 12.5441L20.1262 6.49215C20.5491 6.06905 20.5491 5.38312 20.1259 4.96009C19.7029 4.53705 19.0169 4.53712 18.5939 4.96022L12.5431 11.012L6.49194 4.96074C6.06888 4.53768 5.38295 4.53768 4.95988 4.96074C4.53681 5.38382 4.53681 6.06974 4.95988 6.49282L11.0113 12.5442L4.96049 18.596Z"
                    fill="#292929" />
                </svg>
              </div>

            </div>

            <div
              class="flex flex-col h-[184px] w-full border-b-[0.5px] border-[#E3E3E3] pt-[11px] overflow-y-auto overflow-hidden font-dm_sans text-[16px] "
              id="resultados2">


            </div>




          </div>

        </div>



        <div class="cursor-pointer">
          @if (Auth::user() == null)
            <a class="flex" href="{{ route('login') }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25" viewBox="0 0 23 25"
                fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M11.0623 9.83333C13.0989 9.83333 14.7498 8.18238 14.7498 6.14583C14.7498 4.10929 13.0989 2.45833 11.0623 2.45833C9.02573 2.45833 7.37484 4.10929 7.37484 6.14583C7.37484 8.18238 9.02573 9.83333 11.0623 9.83333ZM11.0623 12.2917C14.4566 12.2917 17.2082 9.54008 17.2082 6.14583C17.2082 2.75159 14.4566 0 11.0623 0C7.66809 0 4.9165 2.75159 4.9165 6.14583C4.9165 9.54008 7.66809 12.2917 11.0623 12.2917Z"
                  fill="black" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M7.375 17.2083C4.6596 17.2083 2.45833 19.4096 2.45833 22.125V23.3542C2.45833 24.033 1.90801 24.5833 1.22917 24.5833C0.550323 24.5833 0 24.033 0 23.3542V22.125C0 18.0519 3.3019 14.75 7.375 14.75H14.75C18.8231 14.75 22.125 18.0519 22.125 22.125V23.3542C22.125 24.033 21.5747 24.5833 20.8958 24.5833C20.217 24.5833 19.6667 24.033 19.6667 23.3542V22.125C19.6667 19.4096 17.4654 17.2083 14.75 17.2083H7.375Z"
                  fill="black" />
              </svg>
            </a>
          @else
            <div class="relative  flex " x-data="{ open: false }">
              <button class=" py-5 inline-flex justify-center items-center group" aria-haspopup="true"
                @click.prevent="open = !open" :aria-expanded="open">
                <div class="flex items-center truncate">
                  {{-- <span id="username"
                    class="truncate ml-2  font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                    {{ explode(' ', Auth::user()->name)[0] }}</span>
                  <i class="mdi mdi-chevron-down"></i> --}}
                  {{-- <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                  </svg> --}}

                  <div class="relative w-9 h-9  rounded-full overflow-hidden "
                    style="background-image: url('/images/ux/logged.png'); background-size: cover; background-position: center;">

                    <img class="w-full p-[6px] rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                      alt="{{ Auth::user()->name }}">
                  </div>

                </div>
              </button>
              <div
                class="w-[calc(100vw-20px)]  h-[402px] absolute top-[90px] -right-12 bg-white rounded-[10px] shadow-[0px_0px_4px_0px_rgba(0,0,0,0.10)] "
                @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">


                <div class="flex flex-row items-center border-b-[0.5px]  border-[#E3E3E3] h-[102px] w-full ">
                  <div class="h-[50px] w-[50px] rounded-full overflow-hidden ml-[26px]">
                    <img class="w-full  rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                      alt="{{ Auth::user()->name }}">
                  </div>
                  <div class="flex flex-row  ">

                    <div class="ml-4">


                      <p
                        class="w-56 h-5 justify-center text-[#292929] text-base font-semibold font-PlusJakartaSans_Regular ">
                        {{ Auth::user()->name }}</p>
                      <p
                        class="w-56 h-5 justify-center text-[#292929] text-base font-normal font-PlusJakartaSans_Regular">
                        {{ Auth::user()->email }}</p>
                    </div>

                  </div>
                </div>
                <div class="flex flex-col  h-[138px] w-full border-b-[0.5px]  border-[#E3E3E3] pt-[26px]">

                  <div class="flex flex-row items-center gap-5  ml-[26px]">
                    <img src="/images/ux/Group 3623.png" alt="" class="h-[22px] w-[22px]">
                    <div class="w-56 h-5 justify-center text-zinc-800 text-base font-semibold font-plus_jakarta">Uso de
                      puntos</div>

                  </div>

                  <div class="flex flex-row justify-between px-[26px] mt-[15px]">
                    <div className="w-28 h-5 justify-center text-zinc-800 text-base font-normal font-plus_jakarta">
                      Consumidos</div>
                    <div
                      className="w-40 h-5 text-right justify-center text-zinc-800 text-base font-normal font-plus_jakarta">
                      Total de puntos {{ Auth::user()->points }}</div>
                  </div>
                  <div class="px-[26px] mt-[8px]">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">
                      <div class="bg-[#FF8555] h-2.5 rounded-full" style="width: 45%"></div>
                    </div>
                  </div>


                </div>
                <div class="h-[81px] w-full border-b-[0.5px]  border-[#E3E3E3]">
                  <div class="flex flex-row px-[26px] items-center gap-[17px] h-full">
                    <img src="/images/ux/user(28)1.svg" alt="">
                    @if (Auth::user()->hasRole('Admin'))
                      <a class="w-56 h-5 justify-center text-zinc-800 text-base font-semibold font-plus_jakarta"
                        href="{{ route('orders') }}" @click="open = false" @focus="open = true"
                        @focusout="open = false">Dashboard Admin</a>
                    @else
                      <a class="w-56 h-5 justify-center text-zinc-800 text-base font-semibold font-plus_jakarta"
                        href="{{ route('Dashboard.jsx') }}" @click="open = false" @focus="open = true"
                        @focusout="open = false">Cuenta</a>
                    @endif


                  </div>
                </div>
                <div class="h-[81px] w-full border-b-[0.5px]  border-[#E3E3E3]">

                  <div class="flex flex-row px-[26px] items-center h-full w-full gap-[17px] ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 30 30"
                      fill="none">
                      <path d="M15 5V15" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path
                        d="M10 8.5C8.39456 9.57268 7.17664 11.1332 6.52614 12.9512C5.87564 14.7691 5.82704 16.7481 6.38751 18.5958C6.94799 20.4435 8.08782 22.062 9.63867 23.2122C11.1895 24.3624 13.0692 24.9833 15 24.9833C16.9308 24.9833 18.8105 24.3624 20.3613 23.2122C21.9122 22.062 23.052 20.4435 23.6125 18.5958C24.173 16.7481 24.1244 14.7691 23.4739 12.9512C22.8234 11.1332 21.6054 9.57268 20 8.5"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <button type="submit" class=" text-zinc-800 text-base font-semibold font-plus_jakarta"
                        @click.prevent="$root.submit(); open = false">
                        {{ __('Cerrar sesión') }}
                      </button>
                    </form>
                  </div>

                </div>





              </div>
            </div>

          @endif


        </div>
        <div id="open-cart" class="cursor-pointer relative">
          <span id="itemsCount"
            class="bg-[#FF8555] h-6 w-6 text-xs font-medium text-white text-center px-[7px] py-[2px] rounded-full absolute  left-[5px] bottom-[12px] ml-3"
            style="z-index:10">0</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="31" height="25" viewBox="0 0 31 25" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M29.3609 8.50475C29.4119 8.19734 29.324 7.88284 29.1229 7.64484C28.9203 7.40825 28.6242 7.27084 28.3125 7.27084H2.81255C2.50088 7.27084 2.2048 7.40825 2.00221 7.64484C1.80105 7.88284 1.71321 8.19734 1.76421 8.50475C1.76421 8.50475 3.21205 17.3504 3.92463 21.7123C4.23346 23.5965 5.86121 24.9792 7.76946 24.9792H23.3556C25.2639 24.9792 26.8916 23.5965 27.2005 21.7123L29.3609 8.50475ZM27.0616 9.39584L25.1024 21.3695C24.9621 22.2252 24.2226 22.8542 23.3556 22.8542C19.43 22.8542 11.695 22.8542 7.76946 22.8542C6.90246 22.8542 6.16296 22.2252 6.02271 21.3695L4.06346 9.39584H27.0616Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M24.9734 7.7865L20.7234 0.703168C20.4216 0.200251 19.7685 0.0373343 19.2656 0.339084C18.7627 0.640834 18.5998 1.29392 18.9015 1.79683L23.1515 8.88017C23.4533 9.38308 24.1064 9.546 24.6093 9.24425C25.1122 8.9425 25.2751 8.28942 24.9734 7.7865Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M7.97337 8.88017L12.2234 1.79683C12.5251 1.29392 12.3622 0.640834 11.8593 0.339084C11.3564 0.0373343 10.7033 0.200251 10.4015 0.703168L6.15154 7.7865C5.84979 8.28942 6.01271 8.9425 6.51562 9.24425C7.01854 9.546 7.67162 9.38308 7.97337 8.88017Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M14.5 13.2917V18.9583C14.5 19.5448 14.976 20.0208 15.5625 20.0208C16.149 20.0208 16.625 19.5448 16.625 18.9583V13.2917C16.625 12.7052 16.149 12.2292 15.5625 12.2292C14.976 12.2292 14.5 12.7052 14.5 13.2917Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M8.8335 13.2917V18.9583C8.8335 19.5448 9.3095 20.0208 9.896 20.0208C10.4825 20.0208 10.9585 19.5448 10.9585 18.9583V13.2917C10.9585 12.7052 10.4825 12.2292 9.896 12.2292C9.3095 12.2292 8.8335 12.7052 8.8335 13.2917Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M20.167 13.2917V18.9583C20.167 19.5448 20.643 20.0208 21.2295 20.0208C21.816 20.0208 22.292 19.5448 22.292 18.9583V13.2917C22.292 12.7052 21.816 12.2292 21.2295 12.2292C20.643 12.2292 20.167 12.7052 20.167 13.2917Z"
              fill="black" />
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M29.7293 7.27084H1.396C0.809496 7.27084 0.333496 7.74684 0.333496 8.33334C0.333496 8.91984 0.809496 9.39584 1.396 9.39584H29.7293C30.3158 9.39584 30.7918 8.91984 30.7918 8.33334C30.7918 7.74684 30.3158 7.27084 29.7293 7.27084Z"
              fill="black" />
          </svg>
        </div>

      </div>


    </div>

  </div>


  <header class="font-b_classic_regular @if (!request()->is('micuenta*')) sticky @endif top-0" style="z-index:2">







    {{--  @if (request()->is('producto/*'))
      <div
        class="fixed right-1 top-1/2 transform -translate-y-1/2 md:flex justify-center items-center min-w-[38px] rounded-lg shadow-xl ">
        <div id="open-cart" class="relative inline-block cursor-pointer pr-3">
          <span id="itemsCount"
            class="bg-[#EB5D2C] text-xs font-medium text-white text-center px-[7px] py-[2px] rounded-full absolute bottom-0 right-0 ml-3"
            style="z-index:10">0</span>
          <img src="{{ asset('img_donas/iconBlack2.png') }}"
            class="bg-white border border-[#ff7344] rounded-lg p-1 w-[45px] cursor-pointer transform transition-transform duration-300 hover:scale-125"
            style="z-index:3" />
        </div>
      </div>
    @endif --}}
    <div class="flex justify-end relative">
      <div
        class="fixed bottom-[20px] z-[10] right-[4%] md:right-[15px] fixedWhastapp flex flex-col items-end justify-end">
        <div x-data="{ open: true }" x-show="open"
          class="w-[250px] md:w-[267px] h-[72px] bg-[#C1DFCC] flex flex-row gap-4 absolute right-3 bottom-[124px] rounded-md p-4 shadow-lg items-center animate-pulse-slow group">
          <button @click="open = false"
            class="absolute -top-1 -right-1 w-6 h-6 bg-gray-400 hover:bg-gray-500 text-white rounded-full flex items-center justify-center text-xs shadow-md transition-colors">
            ✕
          </button>

          <img src="/images/ux/IconoLD.png" alt="WhatsApp Icon" class="w-[50px] h-[50px]" />
          <span class="font-medium text-sm">Haz tu pedido ahora por WhatsApp</span>
        </div>
        <div class=" cursor-pointer absolute right-2 bottom-[60px]" id='btnWhatsapp'>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50"
            height="50" viewBox="0 0 1219.547 1225.016">
            <path fill="#E0E0E0"
              d="M1041.858 178.02C927.206 63.289 774.753.07 612.325 0 277.617 0 5.232 272.298 5.098 606.991c-.039 106.986 27.915 211.42 81.048 303.476L0 1225.016l321.898-84.406c88.689 48.368 188.547 73.855 290.166 73.896h.258.003c334.654 0 607.08-272.346 607.222-607.023.056-162.208-63.052-314.724-177.689-429.463zm-429.533 933.963h-.197c-90.578-.048-179.402-24.366-256.878-70.339l-18.438-10.93-191.021 50.083 51-186.176-12.013-19.087c-50.525-80.336-77.198-173.175-77.16-268.504.111-278.186 226.507-504.503 504.898-504.503 134.812.056 261.519 52.604 356.814 147.965 95.289 95.36 147.728 222.128 147.688 356.948-.118 278.195-226.522 504.543-504.693 504.543z">
            </path>
            <linearGradient id="a" gradientUnits="userSpaceOnUse" x1="609.77" y1="1190.114"
              x2="609.77" y2="21.084">
              <stop offset="0" stop-color="#20b038"></stop>
              <stop offset="1" stop-color="#60d66a"></stop>
            </linearGradient>
            <path fill="url(#a)"
              d="M27.875 1190.114l82.211-300.18c-50.719-87.852-77.391-187.523-77.359-289.602.133-319.398 260.078-579.25 579.469-579.25 155.016.07 300.508 60.398 409.898 169.891 109.414 109.492 169.633 255.031 169.57 409.812-.133 319.406-260.094 579.281-579.445 579.281-.023 0 .016 0 0 0h-.258c-96.977-.031-192.266-24.375-276.898-70.5l-307.188 80.548z">
            </path>
            <image opacity=".08" width="682" height="639" transform="translate(270.984 291.372)"></image>
            <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF"
              d="M462.273 349.294c-11.234-24.977-23.062-25.477-33.75-25.914-8.742-.375-18.75-.352-28.742-.352-10 0-26.25 3.758-39.992 18.766-13.75 15.008-52.5 51.289-52.5 125.078 0 73.797 53.75 145.102 61.242 155.117 7.5 10 103.758 166.266 256.203 226.383 126.695 49.961 152.477 40.023 179.977 37.523s88.734-36.273 101.234-71.297c12.5-35.016 12.5-65.031 8.75-71.305-3.75-6.25-13.75-10-28.75-17.5s-88.734-43.789-102.484-48.789-23.75-7.5-33.75 7.516c-10 15-38.727 48.773-47.477 58.773-8.75 10.023-17.5 11.273-32.5 3.773-15-7.523-63.305-23.344-120.609-74.438-44.586-39.75-74.688-88.844-83.438-103.859-8.75-15-.938-23.125 6.586-30.602 6.734-6.719 15-17.508 22.5-26.266 7.484-8.758 9.984-15.008 14.984-25.008 5-10.016 2.5-18.773-1.25-26.273s-32.898-81.67-46.234-111.326z">
            </path>
            <path fill="#FFF"
              d="M1036.898 176.091C923.562 62.677 772.859.185 612.297.114 281.43.114 12.172 269.286 12.039 600.137 12 705.896 39.633 809.13 92.156 900.13L7 1211.067l318.203-83.438c87.672 47.812 186.383 73.008 286.836 73.047h.255.003c330.812 0 600.109-269.219 600.25-600.055.055-160.343-62.328-311.108-175.649-424.53zm-424.601 923.242h-.195c-89.539-.047-177.344-24.086-253.93-69.531l-18.227-10.805-188.828 49.508 50.414-184.039-11.875-18.867c-49.945-79.414-76.312-171.188-76.273-265.422.109-274.992 223.906-498.711 499.102-498.711 133.266.055 258.516 52 352.719 146.266 94.195 94.266 146.031 219.578 145.992 352.852-.118 274.999-223.923 498.749-498.899 498.749z">
            </path>
          </svg>
        </div>

      </div>
    </div>


  </header>

@endif

<div id="cart-modal" class="bag !absolute top-0 right-0 w-[606px] cartContainer border shadow-2xl  !rounded-md !p-0"
  style="display: none">
  <div class=" flex flex-col h-[95vh] justify-between gap-2">
    <div class="flex flex-col px-[2.5rem] pt-8">
      <div class="flex justify-between ">
        <h2 class="flex items-center gap-2 font-semibold font-plus_jakarta text-[28px] text-[#151515] pb-5">
          Carrito de Compras

        </h2>
        <div id="close-cart" class="cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke="#272727" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <div class="overflow-y-scroll h-[calc(90vh-250px)] scroll-hidden no-scrollbar">
        <div id="itemsCarrito">
        </div>
      </div>
    </div>
    <div class="bg-[#EEEEEE] w-full h-[245px]">
      <div class="flex flex-col gap-2 pt-2 "
        style="padding-left: 44px; padding-right: 44px; padding-top: 35px; padding-bottom: 36px;">
        <div class="  text-xl flex justify-between items-center">
          <p class="font-plus_jakarta font-bold text-[22px] text-[#454545]">Total</p>
          <p class="font-plus_jakarta font-bold text-[22px] text-[#454545] itemsTotal" id="itemsTotal">S/ 0.00</p>
        </div>
        <div class="flex flex-col gap-2 w-full mt-[35px] mb-[28px]">


          <a href="/carrito"
            style="width: 100%; max-width: 515px; height: 55px; padding: 10px; background: #FF8555; border-radius: 10px; display: flex; justify-content: center; align-items: center; gap: 10px; text-decoration: none;">
            <div
              style="color: white; font-size: 18px; font-weight: bold; font-family: 'Plus Jakarta Sans', sans-serif;">
              Realizar pedido
            </div>
          </a>


        </div>

        <div class="flex flex-col justify-center gap-2 w-full">
          {{-- <div class="font-plus_jakarta"
            style="color: var(--Color-text, #292929);text-align: center;

              font-size: 18px;
              font-style: normal;
              font-weight: 600;
              line-height: normal;
              text-decoration-line: underline;
              text-decoration-style: solid;
              text-decoration-skip-ink: auto;
              text-decoration-thickness: auto;
              text-underline-offset: auto;
              text-underline-position: from-font;">
            Ver carrito de compras
          </div> --}}
        </div>

      </div>

    </div>

  </div>
</div>
<div id="modalFormContactus" class="modal !p-0 rounded-t-sm"
  style="max-width: 500px !important;width: 100% !important;  ">
  <!-- Modal body -->
  <div class="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="bg-[#73B473] rounded-t-2xl px-8 py-6 shadow-lg">
      <h1 class="text-3xl font-bold text-white">Las Doñas Florería</h1>
      {{-- <p class="text-green-50 text-sm mt-1">Flores frescas a domicilio</p> --}}
    </div>
    <div class="bg-white rounded-b-2xl shadow-lg p-8">
      <div class="mb-6">
        <p class="text-[20px] font-semibold text-gray-800">¡Hola! 👋</p>
        <p class="text-gray-600 text-[16px] mt-2">Escríbenos tu nombre, tu número <br> y te contactaremos por WhatsApp
          🎁💐👨🏼‍💻</p>
      </div>

      <div id="successMessage"
        class="hidden mb-6 flex items-center gap-3 bg-green-50 border border-[#73B473] rounded-lg p-4">
        <svg class="w-6 h-6 text-[#73B473]" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
            clip-rule="evenodd" />
        </svg>
        <div>
          <p class="font-semibold text-[#73B473]">¡Gracias!</p>
          <p class="text-sm text-gray-600">Pronto nos comunicaremos</p>
        </div>
      </div>

      <form id="formContactusWhatsapp" name='formContactusWhatsapp' class="space-y-4">
        <input type="text" placeholder="Nombres y Apellidos" required id="nombres"
          class="w-full px-6 py-3 border-2 border-gray-200 rounded-full focus:outline-none focus:border-[#73B473] focus:ring-2 focus:ring-[#73B473]/20 transition-all text-gray-700 placeholder-gray-400" />

        <div
          class="w-full px-4 py-3 border-2 border-gray-200 rounded-full focus-within:border-[#73B473] focus-within:ring-2 focus-within:ring-[#73B473]/20 transition-all flex items-center bg-white">

          <input type="tel" id="telefono" placeholder="Teléfono" required
            class="w-full border-none p-0 focus:ring-0 text-gray-700 placeholder-gray-400 bg-transparent" />
        </div>


        <!-- Tu botón naranja #FF8555 -->
        <button type="submit"
          class="w-full bg-[#FF8555] hover:bg-[#FF7140] active:bg-[#E67335] text-white font-bold py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-lg">
          Contactar
        </button>
      </form>
      <div class='flex flex-row w-full justify-between mt-2'>
        <div class="flex items-center gap-2 w-full">
          <div class="w-3 h-3 bg-[#73B473] rounded-full animate-pulse"></div>
          <span class="text-gray-600 font-medium">Estamos en línea</span>
        </div>
        <span class="text-gray-600 hover:text-[#73B473] transition-colors">Politicas de privacidad </span>
      </div>

    </div>

  </div>

</div>

<!-- Modal para continuar compra -->
<div id="modalContinuarCompra" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 transition-opacity">
  <div class="fixed inset-0 z-50 w-screen overflow-y-auto" onclick="closeModalContinuar(event)">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div
        class="relative font-b_slick_bold transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-[1020px]"
        onclick="event.stopPropagation()">
        <div class="bg-white relative rounded-[10px]">

          <!-- Botón cerrar -->
          <div onclick="closeModalContinuar()"
            class="absolute right-4 top-4 md:right-6 md:top-6 z-10 rounded-sm opacity-70 hover:opacity-100 transition-opacity bg-transparent border-0 p-0 cursor-pointer">
            <svg class="h-6 w-6 md:h-7 md:w-7 text-[#292929]" stroke-width="2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="sr-only">Close</span>
          </div>

          <div class="flex flex-row min-h-[500px]">
            <!-- Left side - Images -->
            <div class="hidden lg:grid grid-rows-1 gap-0 w-[428px]">

              {{-- <img src="/images/ux/ImagenModalopc1.png" alt="Flower arrangement with sunflowers"
                class="w-full h-[392px]  object-cover rounded-tl-[10px]  " /> --}}
              <img src="/images/ux/imagelmodalopc2.png" alt="Flower arrangement with roses"
                class="w-full h-full object-cover rounded-bl-[10px] " />
            </div>

            <!-- Right side - Content -->
            <div class="px-6 py-8 md:px-10 md:py-12 lg:px-12 lg:py-16 flex flex-col w-[592px]">
              <!-- Title -->
              <h1 id="modal-title-points"
                class="text-2xl md:text-3xl lg:text-[36px] font-bold leading-tight lg:leading-[40px] text-[#4B2907] mb-4 md:mb-6">
                ¡Gana <span id="floripuntos-amount">150</span> floripuntos hoy!
              </h1>

              <!-- Subtitle -->
              <p class="text-lg md:text-xl font-bold text-[#292929] mb-6 md:mb-8">
                Regístrate y acumula puntos para canjearlos por complementos gratis en tus próximas compras.
              </p>

              <!-- Benefits list -->
              <div class="space-y-5 md:space-y-2 mb-8 md:mb-10 flex-grow">
                <div class="flex gap-4 items-start">

                  <div class="text-[#454545] leading-relaxed hidden ">
                    <span class="font-bold text-lg">Gana:</span>
                    <span class="font-normal text-base">Por una compra de <span id='totalCompra'>S/150</span>
                      acumulas
                      <span id="floripuntos-amount">150</span> floripuntos que puedes
                      canjear en tu siguiente compra.</span>
                  </div>
                  <div class="text-[#454545] leading-relaxed  ">
                    🎁 Puntos por cada compra
                  </div>
                </div>

                <div class="flex gap-4 items-start">

                  <div class="text-[#454545] leading-relaxed hidden">
                    <span class="font-bold text-lg">Sin vencimiento:</span>
                    <span class="font-normal text-base">Puedes canjear tus floripuntos en cualquier momento.</span>
                  </div>
                  <div class="text-[#454545] leading-relaxed ">
                    ⏱ Sin vencimiento
                  </div>
                </div>

                <div class="flex gap-4 items-start">

                  <div class="text-[#454545] leading-relaxed hidden">
                    <span class="font-bold text-lg">Canjea tus puntos:</span>
                    <span class="font-normal text-base">Úsalos para detalles únicos como globos, chocolates y
                      más.</span>
                  </div>
                  <div class="text-[#454545] leading-relaxed ">
                    💐 Canjeables en complementos
                  </div>
                </div>
              </div>

              <!-- CTA buttons -->
              <div class="space-y-4">
                <button
                  class="w-full bg-[#FF8555] hover:bg-[#FF7645] transition-colors rounded-[10px] py-4 px-6 text-white font-bold text-lg"
                  onclick="handleSubscription()">
                  Suscribirme y ganar puntos
                </button>

                <button
                  class="w-full bg-[#F4F6F8] hover:bg-[#E8EAEC] transition-colors rounded-[10px] py-5 px-6 text-[#292929] font-bold text-lg"
                  onclick="continueToCart()">
                  Continuar como invitado
                </button>
              </div>

              <!-- Terms link -->
              <div class="text-center mt-6">
                <a href="/terminos-y-condiciones"
                  class="text-[#454545] text-lg underline hover:no-underline transition-all">
                  Términos & Condiciones
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '#opensearch', function() {

    // #menu-items
  })
</script>

<script>
  let clockSearch;
  $(document).on('keyup', '#buscarproducto', function() {

    clearTimeout(clockSearch);
    var query = $(this).val().trim();

    if (query !== '') {
      clockSearch = setTimeout(() => {
        $.ajax({
          url: '{{ route('buscar') }}',
          method: 'GET',
          data: {
            query: query
          },
          success: function(data) {

            var resultsHtml = '';
            var url = '{{ asset('') }}';
            data.forEach(function(result) {

              const price = Number(result.precio) || 0
              const discount = Number(result.descuento) || 0

              let imagenUrl = result.images
                .filter(img => img.caratula == 1)
                .map(img => img.name_imagen);


              resultsHtml += `<a href="/producto/${result.slug}">
                <div class="w-full flex gap-2 flex-row py-2 px-[2rem] hover:bg-slate-200 pt-[10px]">
                  
                  <div class="flex flex-col justify-center w-[78%]">
                    <h2 class="text-left">${result.producto}</h2>
                    <p class="text-left text-slate-500 " > ${result.sku}  </p>
                    
                  </div>
                  <div class="flex flex-col justify-center w-[10%]">
                    <p class="text-right w-max">S/ ${discount > 0 ? discount.toFixed(0) : price.toFixed(0)}</p>
                    ${discount > 0 ? `<p class="text-[12px] text-right line-through text-slate-500 w-max">S/ ${price.toFixed(0)}</p>` : ''}
                  </div>
                </div>
              </a>`;
            });

            $('#resultados').html(resultsHtml);
            $('#resultados2').html(resultsHtml);
          }
        });

      }, 300);

    } else {
      $('#resultados').empty();
      $('#resultados2').empty();
    }
  });
</script>
{{-- <script>
  document.addEventListener('click', function(e) {
    const input = document.getElementById('buscarproducto');
    const resultados = document.getElementById('resultados');

    const clickDentroInput = input.contains(e.target);
    const clickDentroResultados = resultados.contains(e.target);

    if (!clickDentroInput && !clickDentroResultados) {
      $('#resultados').empty();
      
    }
  });
</script> --}}

<script>
  // Función para abrir el modal
  function openModalContinuar() {

    window.location.href = '/carrito';
    return;

    @auth
    // Si el usuario está autenticado, redirigir directamente al carrito
  @endauth


  // Calcular los floripuntos basados en el total del carrito
  const general1 = {!! json_encode($general1) !!};
  const total = consultarTotal();
  const floripuntos = Math.floor(total / general1.point_equivalence); // Usar point_equivalence del general1

  // Actualizar el título del modal
  const floripuntosElements = document.querySelectorAll('#floripuntos-amount, [id="floripuntos-amount"]');
  floripuntosElements.forEach(element => {
    element.textContent = floripuntos;
  });

  //agregamos total 
  document.getElementById('totalCompra').textContent = `S/${total.toFixed(2)}`;

  document.getElementById('modalContinuarCompra').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
  }

  // Función para cerrar el modal
  function closeModalContinuar(event) {
    if (!event || event.target === event.currentTarget) {
      document.getElementById('modalContinuarCompra').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
  }

  // Función para manejar la suscripción
  function handleSubscription() {

    // Aquí puedes agregar la lógica para suscripción
    //redireccionar a login

    window.location.href = '/login?ref=carrito';
    closeModalContinuar();
  }

  // Función para continuar al carrito
  function continueToCart() {
    closeModalContinuar();
    window.location.href = '/carrito';
  }

  // Modificar el botón del carrito para mostrar el modal
  $(document).ready(function() {
    // Cambiar el enlace del botón "Realizar pedido" para que abra el modal
    $('a[href="/carrito"]').on('click', function(e) {
      e.preventDefault();
      openModalContinuar();
    });
  });

  // Cerrar modal con tecla ESC
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      closeModalContinuar();
    }
  });
</script>

<script>
  function toggleTipoFlor() {


    if (document.getElementById('itemsTipoFLor').classList.contains('hidden')) {
      document.getElementById('itemsTipoFLor').classList.remove('hidden');
      document.getElementById('flachaRotate1').classList.add('rotate-180');
    } else {
      document.getElementById('itemsTipoFLor').classList.add('hidden');
      document.getElementById('flachaRotate1').classList.remove('rotate-180');
    }
  }
</script>
<script>
  console.log('inizializando js ')
  let iti;

  $(document).ready(function() {
    const input = document.querySelector("#telefono");

    iti = window.intlTelInput(input, {
      initialCountry: "pe", // Perú por defecto
      countryOrder: [
        "us", "es", "cl", "mx", "co", "cr", "ec", "ar",
        "it", "gt", "de", "gb", "au", "ch", "il", "ve",
        "br", "sv", "se", "py"
      ],
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js",
      separateDialCode: true, // Esto muestra el +51 separado, muy parecido a lo que tenías

    });


  });

  $('#formContactusWhatsapp').on('submit', function(e) {
    e.preventDefault();


    let nombres = $('#nombres').val();
    // let telefono = $('#telefono').val()

    let telefonoCompleto = iti.getNumber();

    // Opcional: Validar si el número es correcto antes de enviar
    if (!iti.isValidNumber()) {
      alert("Por favor, ingresa un número válido");
      return;
    }


    let countryCode = $('#countryCode').val()
    let $button = $(this).find('button[type="submit"]');
    let url = window.location.href

    $button.html(`
      <div role="status" class= "flex justify-center">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Loading...</span>
      </div>
    `);

    let succesFail = `
        <div role="status" class= "flex justify-center">Contactar</div>`
    const gclid = localStorage.getItem('gclid');
    const campaign_id = localStorage.getItem('campaign_id')

    console.log(window.location.href)


    $.ajax({
      url: '/api/contactus',
      type: 'POST',
      data: {

        nombres,
        telefono: telefonoCompleto,
        tipo_interaccion: 'whatsapp',
        url,

        ...(gclid ? {
          gclid
        } : {}),
        ...(campaign_id ? {
          campaign_id
        } : {})

      },
      success: function(response) {


        $('#modalFormContactus').modal('hide');
        $('.jquery-modal.blocker.current').click()

        $('#formContactusWhatsapp')[0].reset();
        let whatsappUrl = '';
        let urlProducto = window.location.href;
        if (urlProducto.includes('producto')) {
          isproductUrlWhastapp().then(function(whatsappUrl) {
            window.open(whatsappUrl, '_blank');
            $button.html(succesFail);
          }).catch(function(error) {
            // Manejo de error si lo necesitas
            $button.html(succesFail);
          });
        } else {
          whatsappUrl =
            "https://api.whatsapp.com/send?phone={{ $general1->whatsapp }}&text={{ $general1->mensaje_whatsapp }}";
          window.open(whatsappUrl, '_blank');
          $button.html(succesFail);
        }
        window.open(whatsappUrl, '_blank');
        $button.html(succesFail);

      },
      error: function(error) {
        console.error(error)
        $button.html(succesFail);

      }
    });
  })
</script>

<script>
  const isproductUrlWhastapp = async () => {
    let urlProducto = window.location.href;
    if (urlProducto.includes('producto')) {
      let urlProductoArray = urlProducto.split('/');
      let idProducto = urlProductoArray[urlProductoArray.length - 1];

      return new Promise((resolve, reject) => {
        $.ajax({
          url: '/api/productos/' + idProducto,
          type: 'GET',
          success: function(response) {
            let producto = response.producto[0] ?? '';
            let whatsappUrl =
              `https://api.whatsapp.com/send?phone={{ $general1->whatsapp }}&text=Hola, estoy interesado en este Producto:%0A${producto.producto}%0APrecio: S/ ${producto.preciofiltro}%0AUrl: ${encodeURIComponent(urlProducto)}%0A%0AGracias!`;
            resolve(whatsappUrl);
          },
          error: function(error) {
            reject(error);
          }
        });
      });
    }
    return '';
  };
</script>
<script>
  $('#btnWhatsapp').on('click', function() {

    $('#modalFormContactus').modal({
      show: true,
      fadeDuration: 200,

    })
  })
</script>

{{-- <script>
  $('#eliminarImgDedicatoria') on('click', () => {
    localStorage.removeItem('imageDedicatoria');
    $('#cart-image').attr('src', '');
  });
</script> --}}
<script src="{{ asset('js/storage.extend.js') }}"></script>
{{-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Recupera la imagen del localStorage
    const base64Image = localStorage.getItem('imageDedicatoria');

    // Verifica si la imagen existe en el localStorage
    if (base64Image) {
      // Establece el src de la imagen
      document.getElementById('cart-image').src = base64Image;
    }
  });
</script> --}}
<script>
  $('#productos-link').hover(
    function() {
      // Evento mouseenter
      $('#headerPrincipal').removeClass('sticky').addClass('relative');
    },
    function() {
      // Evento mouseleave
      // $('#headerPrincipal').removeClass('relative').addClass('sticky');
    }
  );

  function runMyFunction() {
    $('#headerPrincipal').removeClass('sticky').addClass('relative');

    // Tu lógica aquí
  }

  function handleOutsideClick() {
    $('#headerPrincipal').removeClass('relative').addClass('sticky');

    // Tu lógica aquí
  }
</script>

<style>
  @keyframes slideInFromRight {
    0% {
      transform: translateX(100%);
      opacity: 0;
    }

    100% {
      transform: translateX(0);
      opacity: 1;
    }
  }

  /* Animación para cerrar el modal hacia la derecha */
  @keyframes slideOutToRight {
    0% {
      transform: translateX(0);
      opacity: 1;
    }

    100% {
      transform: translateX(100%);
      opacity: 0;
    }
  }

  /* Clases para aplicar las animaciones */
  .modal-slide-in {
    animation: slideInFromRight 0.5s forwards;
  }

  .modal-slide-out {
    animation: slideOutToRight 0.5s forwards;
  }

  body.modal-open {
    overflow: auto !important;
  }
</style>
<script>
  let userPoints = {{ $points }};
  const appUrl = "{{ env('APP_URL') }}"
  var articulosCarrito = Local.get('carrito') || [];
  $(document).ready(() => {
    mostrarTotalItems()
    PintarCarrito()

  })


  const puntoosUsados = articulosCarrito.reduce((total, articulo) => {
    if (articulo.usePoints) {
      return total + (articulo.points * articulo.cantidad);
    }
    return total;
  }, 0);

  var puntosRestados = userPoints - puntoosUsados;


  $(document).on('click', '#open-cart', () => {
    $('body').addClass('modal-open');
    $('#cart-modal').addClass('modal-slide-in').removeClass('modal-slide-out').modal({
      showClose: false,
      fadeDuration: 200,
      fadeDelay: 1
    })

    $('#cart-modal').css('z-index', 999999);
  })

  $(document).on('click', '#close-cart', () => {
    // $('.jquery-modal.blocker.current').trigger('click')
    $('#cart-modal').addClass('modal-slide-out').removeClass('modal-slide-in');
    setTimeout(() => {
      $('.jquery-modal.blocker.current').trigger('click')
      $('body').removeClass('modal-open');
    }, 500);

  })

  function mostrarTotalItems() {
    let articulos = Local.get('carrito')
    let contarArticulos = articulos.reduce((total, articulo) => {
      return total + articulo.cantidad;
    }, 0);
    const itemsCountElements = document.querySelectorAll('#itemsCount');

    // $('#itemsCount').text(contarArticulos)
    itemsCountElements.forEach(element => {
      element.textContent = contarArticulos;
    });
  }

  function addOnCarBtn(id) {
    let articulosCarrito = Local.get('carrito') || [];
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id) {

        item.cantidad += 1;
      }
      return item;
    });

    Local.set('carrito', prodRepetido);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteOnCarBtn(id) {
    let articulosCarrito = Local.get('carrito') || [];
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.cantidad > 0) {

        item.cantidad -= 1;
      }
      return item;
    });


    prodRepetido = prodRepetido.filter(item => item.cantidad > 0);


    Local.set('carrito', prodRepetido);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteItem(id) {

    let articulosCarrito = Local.get('carrito') || [];
    let idCount = {};
    let duplicates = [];
    articulosCarrito.forEach(item => {
      if (idCount[item.id]) {
        idCount[item.id]++;
      } else {
        idCount[item.id] = 1;
      }
    });



    for (let id in idCount) {
      if (idCount[id] > 1) {
        duplicates.push(id);
      }
    }

    if (duplicates.length > 0) {

      let index = articulosCarrito.findIndex(item => item.id === id);
      if (index > -1) {
        articulosCarrito.splice(index, 1);
      }
    } else {
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

    }

    // return

    // setCarrito(articulosCarrito)


    Local.set('carrito', articulosCarrito)
    limpiarHTML()
    PintarCarrito()
  }

  function limpiarHTML() {
    //forma lenta 
    /* contenedorCarrito.innerHTML=''; */
    $('#itemsCarrito').html('')
    $('#itemsCarritoCheck').html('')


  }

  function PintarCarrito() {

    let articulosCarrito = Local.get('carrito') || [];

    let itemsCarrito = $('#itemsCarrito')
    let itemsCarritoCheck = $('#itemsCarritoCheck')

    let restPoints = structuredClone(userPoints)


    articulosCarrito.forEach(element => {
      console.log(element)

      if (element.usePoints && restPoints >= (element.points * element.cantidad)) {
        element.precio = 0
        restPoints -= element.points * element.cantidad
      }
      let plantilla = `
        <div class="py-2 overflow-hidden">
          <div class="bg-[#FBF8F2] rounded-[10px] p-4 flex flex-col sm:flex-row gap-4 w-full  sm:h-[221px] font-plus_jakarta items-center ">
            <div class="flex-shrink-0">
              <img 
                src="/${element.imagen}" 
                alt="${element.producto} - ${element.tipo}"
                class="w-full sm:w-[142px] h-[190px] object-cover rounded-[8px]" 
                onerror="this.onerror=null;this.src='/images/img/noimagen.jpg';"
                 style="user-select: none; -webkit-user-drag: none;"
                  oncontextmenu="return false;"
              />
            </div>

            <div class="flex flex-col flex-1 " style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
              <div>
                <div class="flex flex-col sm:flex-row sm:items-start  sm:gap-2 ">
                  <h2 class="text-[18px] h-[26px] font-bold text-[#151515] font-plus_jakarta">
                    ${element.producto}
                  </h2>
                  
                </div>

              <p class="text-sm font-light text-[#454545] mb-1 truncate font-plus_jakarta" 
                style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                ${element.extract || 'Descripción del producto'}
              </p>
              </div>

              <div>
                <div class="flex items-center gap mb-3">
                  <div class="flex flex-col">
                    <p class="text-[16px] font-bold font-plus_jakarta text-[#292929]">
                      S/ ${Number(element.precio)}
                    </p>
                    <span class="text-orange-500 text-sm">${element.usePoints ? 'Usando puntos' : ''}</span>
                  </div>

                  
                  ${element.tipo !== 'Clasica' && element.tipo !== 'Complemento' ? 
                  `<span class="mx-1 text-[16px] font-plus_jakarta text-[#292929]"> -  ${element.tipo}</span>` : ''}

                  
                </div>

                <div class="flex items-center gap-2 ">
                  <button
                    type="button" 
                    onClick="deleteOnCarBtn(${element.id})"
                    class="w-[30px] h-[30px] flex items-center justify-center border border-[#6C7275] bg-white rounded hover:bg-gray-50 transition-colors"
                    aria-label="Decrease quantity"
                  >
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14.5894 9.87894H3.41113C2.92563 9.87894 2.53223 9.48554 2.53223 9.00003C2.53223 8.51452 2.92563 8.12112 3.41113 8.12112H14.5894C15.0749 8.12112 15.4683 8.51452 15.4683 9.00003C15.4683 9.48554 15.0749 9.87894 14.5894 9.87894Z" fill="black"/>
                    </svg>
                  </button>

                  <span class="text-lg font-bold text-[#151515] min-w-[28px] text-center font-plus_jakarta">
                    ${element.cantidad}
                  </span>

                  <button
                    type="button" 
                    onClick="addOnCarBtn(${element.id})"
                    class="w-[30px] h-[30px] flex items-center justify-center border border-[#6C7275] bg-white rounded hover:bg-gray-50 transition-colors"
                    aria-label="Increase quantity"
                  >
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9 15.4681C8.51449 15.4681 8.12109 15.0747 8.12109 14.5892V3.41089C8.12109 2.92538 8.51449 2.53198 9 2.53198C9.48551 2.53198 9.87891 2.92538 9.87891 3.41089V14.5892C9.87891 15.0747 9.48551 15.4681 9 15.4681Z" fill="black"/>
                      <path d="M14.5894 9.87894H3.41113C2.92563 9.87894 2.53223 9.48554 2.53223 9.00003C2.53223 8.51452 2.92563 8.12112 3.41113 8.12112H14.5894C15.0749 8.12112 15.4683 8.51452 15.4683 9.00003C15.4683 9.48554 15.0749 9.87894 14.5894 9.87894Z" fill="black"/>
                    </svg>
                  </button>

                  <button type="button" onClick="deleteItem(${element.id})" class="ml-[21px] text-sm text-[#151515] underline hover:no-underline text-right">
                    Eliminar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>`

      itemsCarrito.append(plantilla)
      itemsCarritoCheck.append(plantilla)

    });

    mostrarTotalItems()
    calcularTotal()
  }

  function calcularTotal() {
    let articulos = Local.get('carrito')

    let total = 0
    let restPoints = structuredClone(userPoints)

    for (const item of articulos) {
      let totalPrice = 0;
      let cantidadGeneral = structuredClone(item.cantidad)
      for (let i = 0; i < item.cantidad; i++) {
        if (restPoints >= item.points) {
          restPoints -= item.points
          cantidadGeneral--
        } else break
      }
      totalPrice = cantidadGeneral * Number(item.precio);
      total += totalPrice
    }

    $('[data-id="txt-user-points"]').text(restPoints)

    // let total = articulos.map(item => {
    //   let total = 0
    //   total += item.cantidad * Number(item.precio)
    //   return total
    // }).reduce((total, elemento) => total + elemento, 0);

    // $('#itemsTotal').text(`S/. ${total} `)
    $('.itemsTotal').text(`S/. ${total} `)
  }

  function consultarTotal() {
    let articulos = Local.get('carrito')

    let total = 0
    let restPoints = structuredClone(userPoints)

    for (const item of articulos) {
      let totalPrice = 0;
      let cantidadGeneral = structuredClone(item.cantidad)
      for (let i = 0; i < item.cantidad; i++) {
        if (restPoints >= item.points) {
          restPoints -= item.points
          cantidadGeneral--
        } else break
      }
      totalPrice = cantidadGeneral * Number(item.precio);
      total += totalPrice
    }
    return total
  }
</script>

<script>
  var menu = new Swiper(".menu", {
    slidesPerView: 5,
    spaceBetween: 10,
    loop: true,
    centeredSlides: false,
    initialSlide: 0,
    allowTouchMove: true,
    autoplay: {
      delay: 5500,
      disableOnInteraction: true,
      pauseOnMouseEnter: true
    },
    breakpoints: {
      0: {
        slidesPerView: 2,
        centeredSlides: false,
        loop: true,
      },
      640: {
        slidesPerView: 3,
        centeredSlides: false,

      },
      1024: {
        slidesPerView: 5,
        centeredSlides: false,

      },
      1280: {
        slidesPerView: 6,
        centeredSlides: false,

      },
    },
  });
</script>

<script>
  window.addEventListener('scroll', function() {
    const headerMid = document.getElementById('header-mid');
    const headerBottom = document.querySelector('.header_bottom');
    const portada = document.getElementById('portada');
    const main = document.querySelector('.main');

    const scrollPosition = window.scrollY;
    const documentHeight = document.documentElement.scrollHeight;
    const viewportHeight = window.innerHeight;


    const scrollPercentage = (scrollPosition / (documentHeight - viewportHeight)) * 100;


    if (scrollPercentage >= 1) {
      // headerMid.classList.add('fixed-header', 'h-[80px]');
      // headerMid.classList.remove('h-[100px]');
      // headerBottom.classList.add('fixed-header', 'shadow-lg', 'shadow-black/40');
      if (portada) {
        portada.classList.add('mt-[150px]');
      }

      //main.classList.add('mt-[128px]'); 
    } else {
      // headerMid.classList.remove('fixed-header', 'h-[80px]');
      // headerMid.classList.add('h-[100px]');
      //headerBottom.classList.remove('fixed-header');
      //portada.classList.remove('mt-[150px]'); 
    }
  });

  function show() {
    document.querySelector(".hamburger").classList.toggle("open");
    document.querySelector(".navigation").classList.toggle("active");
  }
</script>

<script>
  new Swiper('.categories-header', {
    slidesPerView: 4,
    spaceBetween: 10,
    loop: true,
    grab: false,
    centeredSlides: false,
    initialSlide: 0,
    navigation: {
      nextEl: '.swiper-button-next-categories-header',
      prevEl: '.swiper-button-prev-categories-header',
    },
    scrollbar: {
      el: '.swiper-scrollbar-categories-header',
    },
    breakpoints: {
      0: {
        slidesPerView: 2
      },
      1200: {
        slidesPerView: 3
      },
      1350: {
        slidesPerView: 4
      },
    },
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let openSubMenu = null;

    window.toggleSubMenu = function(categoryId) {
      const submenu = document.getElementById(`submenu-${categoryId}`);
      const arrow = document.getElementById(`arrow-${categoryId}`);

      if (openSubMenu && openSubMenu !== submenu) {
        openSubMenu.classList.add('hidden');
        const openArrow = document.querySelector('.rotate-180');
        if (openArrow) {
          openArrow.classList.remove('rotate-180');
        }
      }

      if (submenu.classList.contains('hidden')) {
        submenu.classList.remove('hidden');
        arrow.classList.add('rotate-180');
        openSubMenu = submenu;
      } else {
        submenu.classList.add('hidden');
        arrow.classList.remove('rotate-180');
        openSubMenu = null;
      }
    };
  });
</script>
