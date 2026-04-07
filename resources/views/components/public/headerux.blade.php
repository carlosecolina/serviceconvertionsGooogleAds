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

<div class="navigation shadow-xl font-b_slick_bold" style="z-index: 9999; background-color: #fff !important">
  <button aria-label="hamburguer" type="button" class="hamburger" id="position" onclick="show()">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 2L2 18M18 18L2 2" stroke="#272727" stroke-width="2.66667" stroke-linecap="round" />
    </svg>
  </button>


  <nav class="w-full h-full overflow-y-auto p-8 font-b_slick_bold" x-data="{ openCatalogo: true, openSubMenu: null, openFlor: false }">
    <ul class="space-y-1">
      <li>
        <a href="/"
          class="text-[#272727]  text-lg py-2 px-3 block hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'index' ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this">
            <svg
              class="inline-block w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
            </svg>
            Home
          </span>
        </a>
      </li>
      <li>
        <a href="/nosotros" class="text-[#272727] font-b_slick_bold hover:opacity-75 other-class py-3 px-6">
          <span class="underline-this">Nosotros</span>
        </a>
      </li>

      <li>
        <a @click="openCatalogo = !openCatalogo" href="javascript:void(0)" id="productos-link"
          class="text-[#272727] flex justify-between items-center  text-sm py-2 px-3 hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'catalogo' ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this text-lg font-b_slick_bold">
            <svg
              class="inline-block  w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
              <path
                d="M15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783ZM6 2h6a1 1 0 1 1 0 2H6a1 1 0 0 1 0-2Zm7 5H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Z" />
              <path
                d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
            </svg>
            Catálogo
          </span>
          <span :class="{ 'rotate-180': openCatalogo }"
            class="ms-1 inline-block transform transition-transform duration-300">↓</span>
        </a>
        <ul x-show="openCatalogo" x-transition class="ml-3 mt-1 space-y-1 border-l border-gray-300">
          <li>
            <a href="/catalogo"
              class="text-[#272727] flex items-center text-base py-2 px-3 hover:opacity-75 transition-opacity duration-300">
              <span class="underline-this">
                Todas las categorías
              </span>
            </a>
          </li>


          @foreach ($submenucategorias as $category)
            @if (isset($category->subcategories) && $category->subcategories->isNotEmpty())
              <li>
                <a @click="openSubMenu === {{ $category->id }} ? openSubMenu = null : openSubMenu = {{ $category->id }}"
                  href="javascript:void(0)"
                  class="text-[#272727] flex text-base justify-between items-center py-2 px-3 hover:opacity-75 transition-opacity duration-300">
                  <span class="underline-this">
                    {{ $category->name }}
                  </span>
                  <span :class="{ 'rotate-180': openSubMenu === {{ $category->id }} }"
                    class="ms-1 inline-block transform transition-transform duration-300">↓</span>
                </a>
                <ul x-show="openSubMenu === {{ $category->id }}" x-transition
                  class="ml-3 mt-1 space-y-1 border-l border-gray-300">
                  <li>
                    <a href="/catalogo/{{ $category->slug }}"
                      class="text-[#272727] flex items-center py-2 px-3 hover:opacity-75 transition-opacity duration-300">
                      <span class="underline-this  text-base ">
                        Ver todo {{ $category->name }}
                      </span>
                    </a>
                  </li>
                  @foreach ($category->subcategories as $subcategory)
                    <li>
                      <a href="/catalogo/{{ $category->slug }}?subcat={{ $subcategory->id }}"
                        class="text-[#272727] text-base flex items-center py-2 px-3 hover:opacity-75 transition-opacity duration-300">
                        <span class="underline-this">{{ $subcategory->name }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </li>
            @else
              <li>
                <a href="/catalogo/{{ $category->slug }}"
                  class="text-[#272727] flex items-center text-base py-2 px-3 hover:opacity-75 transition-opacity duration-300">
                  <span class="underline-this">
                    {{ $category->name }}
                  </span>
                </a>
              </li>
            @endif
          @endforeach

        </ul>
      </li>

      <li>
        <a @click="openFlor = !openFlor" href="javascript:void(0)"
          class="text-[#272727] flex justify-between items-center  text-sm py-2 px-3 hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'catalogo' ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this text-lg font-b_slick_bold">
            <svg
              class="inline-block  w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
              <path
                d="M15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783ZM6 2h6a1 1 0 1 1 0 2H6a1 1 0 0 1 0-2Zm7 5H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Z" />
              <path
                d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
            </svg>
            Tipos de Flor
          </span>
          <span :class="{ 'rotate-180': openFlor }"
            class="ms-1 inline-block transform transition-transform duration-300">↓</span>
        </a>
        <ul x-show="openFlor" x-transition class="ml-3 mt-1 space-y-1 border-l border-gray-300">



          @foreach ($tipoFlores as $item)
            <li>
              <a href="/tipoflor?tipo_flor={{ $item->id }}"
                class="flex items-center py-1 px-3 hover:opacity-75 hover:text-white transition-opacity duration-300 normal-case">
                <span class="text-[#272727] underline-this font-b_slick_bold">
                  {{ $item->name }}
                </span>
              </a>
            </li>
          @endforeach

        </ul>
      </li>

      <li>
        <a href="/promociones" class="text-[#272727] font-b_slick_bold hover:opacity-75 other-class py-3 px-6">
          <span class="underline-this">Promociones</span>
        </a>
      </li>




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


<a id="header_top" href="{{ $general1->url_cintillo }}"
  class="bg-[#FFFDF5] h-[82px] text-white flex justify-center  w-full px-[5%] xl:px-[8%] py-[11px] text-base items-center">

  <img class="w-[201px] h-[60px] " src="{{ asset('images/ux/headerLogo.png') }}">



</a>
<div id="header-mid"
  class="h-[83px] shadow-md flex flex-row items-center bg-white !z-10  {{ request()->is('producto/*') ? 'md:hidden' : '' }} ">
  <div
    class="flex flex-row items-center justify-between gap-3 w-full px-[2%] xl:px-[8%]   text-[17px] relative bg-white ">

    <div id="menu-burguer" class="lg:hidden z-10 w-max">
      <img class="h-10 w-10 cursor-pointer" src="{{ asset('img_donas/burguer.svg') }}" alt="menu hamburguesa"
        onclick="show()" />
    </div>

    <div class="text-base font-b_classic_bold ">


      <nav id="menu-items"
        class="text-white tracking-wider text-base flex flex-row gap-5 xl:gap-6 items-center justify-between max-w-4xl mx-auto"
        x-data="{ openCatalogo: false, openSubMenu: null, openFlor2: false }">

        <a href="/" class="font-b_slick_bold hover:opacity-75 other-class py-3 px-6">
          <span class="underline-this">Inicio</span>
        </a>

        <a href="/nosotros" class="font-b_slick_bold hover:opacity-75 other-class py-3 px-6">
          <span class="underline-this">Nosotros</span>
        </a>

        <div x-data="{ openCatalogo: false }" x-init="$el.style.display = 'flex'" style="display: none;"
          @mouseenter="openCatalogo = true" @mouseleave="openCatalogo = false; handleOutsideClick()">
          <ul class="menu flex flex-row justify-center items-center text-center py-3 px-6 ">
            <li><a href="/catalogo" class="font-b_slick_bold">Categorías</a></li>
          </ul>

          <div x-show="openCatalogo" x-init="$watch('openCatalogo', value => { if (value) runMyFunction(); })"
            class="font-b_slick_bold text-white  origin-top-right absolute top-full left-0 w-[100vw] mt-0 bg-[#73B473] p-8 shadow-lg overflow-hidden grid gap-8 grid-cols-12 
               h-[80vh]"
            x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            @click.outside="openCatalogo = false ; handleOutsideClick()"
            @keydown.escape.window="openCatalogo = false;  handleOutsideClick()">

            <div class="col-span-3 overflow-y-auto " style="scrollbar-width: thin">
              <h2 class="px-3 py-1 text-xl tracking-wider font-b_slick_bold">Categorias P</h2>
              <hr class="mx-3 my-3">
              <ul class="col-span-3 font-b_slick_bold tracking-normal">
                @foreach ($submenucategorias as $category)
                  @if ($category->subcategories->isNotEmpty())
                    <li>
                      <a {{-- @click.stop="openSubMenu === {{ $category->id }} ? openSubMenu = null : openSubMenu = {{ $category->id }}" --}} onclick="toggleSubMenu({{ $category->id }})" href="javascript:void(0)"
                        class="flex justify-between items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                        <span class="underline-this">
                          {{ $category->name }}
                        </span>
                        {{-- <span :class="{ 'rotate-180': openSubMenu === {{ $category->id }} }"
                            class="ms-1 inline-block transform transition-transform duration-300">↓</span> --}}
                        <span id="arrow-{{ $category->id }}"
                          class="ms-1 inline-block transform transition-transform duration-300">↓</span>
                      </a>
                      <ul id="submenu-{{ $category->id }}" {{-- x-show="openSubMenu === {{ $category->id }}" x-transition --}}
                        class="ml-3 mt-1 space-y-1 border-l border-white font-b_slick_bold  hidden">
                        <li>
                          <a href="/catalogo/{{ $category->slug }}"
                            class="flex items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                            <span class="underline-this font-b_slick_bold">
                              Ver todo {{ $category->name }}
                            </span>
                          </a>
                        </li>
                        @foreach ($category->subcategories as $subcategory)
                          <li>
                            <a href="/catalogo/{{ $category->slug }}?subcat={{ $subcategory->id }}"
                              class="flex items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                              <span class="underline-this font-b_slick_bold">{{ $subcategory->name }}</span>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    </li>
                  @else
                    <li>
                      <a href="{{ route('Catalogo.jsx', $category->slug) }}"
                        class="flex items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                        <span class="underline-this font-b_slick_bold">
                          {{ $category->name }}
                        </span>
                      </a>
                    </li>
                  @endif
                @endforeach
                <li>
                  <a onclick="toggleTipoFlor()" href="javascript:void(0)"
                    class=" flex justify-between items-center  text-sm py-2 px-3 hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'catalogo' ? 'text-[#FF5E14]' : '' }}">
                    <span class="underline-this text-lg font-b_slick_bold">

                      Tipos de Flor
                    </span>
                    <span id="flachaRotate1"
                      class="ms-1 inline-block transform transition-transform duration-300">↓</span>
                  </a>
                  <ul id="itemsTipoFLor" class="ml-3 mt-1 space-y-1 border-l border-gray-300 hidden">



                    @foreach ($tipoFlores as $item)
                      <li>
                        <a href="/tipoflor?tipo_flor={{ $item->id }}"
                          class="flex items-center py-1 px-3 hover:opacity-75 hover:text-white transition-opacity duration-300 normal-case">
                          <span class=" underline-this font-b_slick_bold">
                            {{ $item->name }}
                          </span>
                        </a>
                      </li>
                    @endforeach

                  </ul>
                </li>
              </ul>
            </div>

            <div class="col-span-9">
              <div class="swiper categories-header">
                <div class="swiper-wrapper mt-2 mb-4">
                  @foreach ($submenucategorias as $category)
                    @if ($category->destacar)
                      <div class="swiper-slide rounded-2xl">
                        <x-category.container :item="$category" />
                      </div>
                    @endif
                  @endforeach
                </div>
                <div class="swiper-scrollbar-categories-header h-2"></div>
                {{-- <div class="mt-4 text-end">
                    <button type="button"
                      class="swiper-button-prev-categories-header text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 ">
                      ←
                    </button>
                    <button type="button"
                      class="swiper-button-next-categories-header text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 ">
                      →
                    </button>
                  </div> --}}
              </div>
            </div>

          </div>
        </div>




        <a href="/promociones" class="font-medium hover:opacity-75  other-class py-3 px-6">
          <span class="underline-this font-b_slick_bold">Promociones</span>
        </a>
        @if (request()->is('producto/*'))
          @if (Auth::user() == null)
            <a class="flex" href="{{ route('login') }}"><img class=" rounded-lg"
                src="{{ asset('img_donas/Group11.png') }}" alt="user" /></a>
          @else
            <div class="relative  hidden md:inline-flex z-30" x-data="{ open: false }">
              <button class="px-3 py-5 inline-flex justify-center items-center group" aria-haspopup="true"
                @click.prevent="open = !open" :aria-expanded="open">
                <div class="flex items-center truncate">
                  <span id="username"
                    class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                    {{ explode(' ', Auth::user()->name)[0] }}</span>
                  <i class="mdi mdi-chevron-down"></i>
                  {{-- <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                  <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                </svg> --}}
                </div>
              </button>
              <div
                class="origin-top-right z-30 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">
                <ul>
                  <li class="hover:bg-gray-100">
                    @if (Auth::user()->hasRole('Admin'))
                      <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                        href="{{ route('orders') }}" @click="open = false" @focus="open = true"
                        @focusout="open = false">Dashboard</a>
                    @else
                      <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                        href="{{ route('Dashboard.jsx') }}" @click="open = false" @focus="open = true"
                        @focusout="open = false">Mi Cuenta</a>
                    @endif
                  </li>

                  <li class="hover:bg-gray-100">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <button type="submit" class="font-medium text-sm text-black flex items-center py-1 px-3"
                        @click.prevent="$root.submit(); open = false">
                        {{ __('Cerrar sesión') }}
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
            <div class="flex justify-center items-center min-w-[38px]">
              <div class="relative inline-block cursor-pointer">
                <a href="/micuenta/puntos"
                  class="bg-[#32B3AD] text-white font-bold px-2 pr-3 pt-[2px] rounded-full flex flex-row gap-1 items-center justify-center">
                  <i class="mdi mdi-dots-hexagon"></i>
                  <span data-id="txt-user-points" class="items-center flex ">{{ Auth::user()->points }}</span>
                  <span class="hidden md:block puntos text-[14px]">Puntos</span>
                </a>
              </div>
            </div>
          @endif

        @endif


      </nav>

    </div>



    <div class="flex justify-end md:w-auto md:justify-center items-center gap-0 lg:gap-2">

      <x-search-products />



      @if (Auth::user() == null)
        <a class="flex" href="{{ route('login') }}"><img class=" rounded-lg"
            src="{{ asset('img_donas/Group11.png') }}" alt="user" /></a>
      @else
        <div class="relative  hidden md:inline-flex z-30" x-data="{ open: false }">
          <button class="px-3 py-5 inline-flex justify-center items-center group" aria-haspopup="true"
            @click.prevent="open = !open" :aria-expanded="open">
            <div class="flex items-center truncate">
              <span id="username"
                class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                {{ explode(' ', Auth::user()->name)[0] }}</span>
              <i class="mdi mdi-chevron-down"></i>
              {{-- <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
              <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
            </svg> --}}
            </div>
          </button>
          <div
            class="origin-top-right z-30 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1"
            @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">
            <ul>
              <li class="hover:bg-gray-100">
                @if (Auth::user()->hasRole('Admin'))
                  <a class="font-medium text-sm text-black flex items-center py-1 px-3" href="{{ route('orders') }}"
                    @click="open = false" @focus="open = true" @focusout="open = false">Dashboard</a>
                @else
                  <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                    href="{{ route('Dashboard.jsx') }}" @click="open = false" @focus="open = true"
                    @focusout="open = false">Mi Cuenta</a>
                @endif
              </li>

              <li class="hover:bg-gray-100">
                <form method="POST" action="{{ route('logout') }}" x-data>
                  @csrf
                  <button type="submit" class="font-medium text-sm text-black flex items-center py-1 px-3"
                    @click.prevent="$root.submit(); open = false">
                    {{ __('Cerrar sesión') }}
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
        <div class="flex justify-center items-center min-w-[38px]">
          <div class="relative inline-block cursor-pointer">
            <a href="/micuenta/puntos"
              class="bg-[#32B3AD] text-white font-bold px-2 pr-3 pt-[2px] rounded-full flex flex-row gap-1 items-center justify-center">
              <i class="mdi mdi-dots-hexagon"></i>
              <span data-id="txt-user-points" class="items-center flex ">{{ Auth::user()->points }}</span>
              <span class="hidden md:block puntos text-[14px]">Puntos</span>
            </a>
          </div>
        </div>
      @endif

      @if (!request()->is('producto/*'))
        <div class="flex justify-center items-center min-w-[38px]">
          <div id="open-cart" class="relative inline-block cursor-pointer pr-3">
            <span id="itemsCount"
              class="bg-[#FF8555] text-xs font-medium text-white text-center px-[7px] py-[2px]  rounded-full absolute bottom-0 right-0 ml-3">0</span>
            <img src="{{ asset('img_donas/iconBlack2.png') }}"
              class="bg-white rounded-lg p-1 w-[45px] cursor-pointer" style="z-index:3" />
          </div>
        </div>
      @endif




    </div>



  </div>

</div>


<header class="font-b_classic_regular @if (!request()->is('micuenta*')) sticky @endif top-0" style="z-index:2">





  @php
    $currentUrl = url()->full();
  @endphp
  @if (
      !request()->is('login') &&
          !request()->is('register') &&
          !request()->is('micuenta*') &&
          !request()->is('register-rev'))
    <div class=" header_bottom hidden 2md:flex h-12 bg-[#32B3AD] px-[5%] lg:px-[8%] 2md:justify-center ">
      <div class="text-base font-b_classic_bold ">


        <nav id="menu-items"
          class="text-white tracking-wider text-base flex flex-row gap-5 xl:gap-6 items-center justify-between max-w-4xl mx-auto"
          x-data="{ openCatalogo: false, openSubMenu: null, openFlor2: false }">

          <a href="/" class="font-b_slick_bold hover:opacity-75 other-class py-3 px-6">
            <span class="underline-this">Inicio</span>
          </a>

          <a href="/nosotros" class="font-b_slick_bold hover:opacity-75 other-class py-3 px-6">
            <span class="underline-this">Nosotros</span>
          </a>

          <div x-data="{ openCatalogo: false }" x-init="$el.style.display = 'flex'" style="display: none;"
            @mouseenter="openCatalogo = true" @mouseleave="openCatalogo = false; handleOutsideClick()">
            <ul class="menu flex flex-row justify-center items-center text-center py-3 px-6 ">
              <li><a href="/catalogo" class="font-b_slick_bold">Categorías</a></li>
            </ul>

            <div x-show="openCatalogo" x-init="$watch('openCatalogo', value => { if (value) runMyFunction(); })"
              class="font-b_slick_bold text-white  origin-top-right absolute top-full left-0 w-[100vw] mt-0 bg-[#73B473] p-8 shadow-lg overflow-hidden grid gap-8 grid-cols-12 
               h-[80vh]"
              x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
              x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
              x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
              @click.outside="openCatalogo = false ; handleOutsideClick()"
              @keydown.escape.window="openCatalogo = false;  handleOutsideClick()">

              <div class="col-span-3 overflow-y-auto " style="scrollbar-width: thin">
                <h2 class="px-3 py-1 text-xl tracking-wider font-b_slick_bold">Categorias P</h2>
                <hr class="mx-3 my-3">
                <ul class="col-span-3 font-b_slick_bold tracking-normal">
                  @foreach ($submenucategorias as $category)
                    @if ($category->subcategories->isNotEmpty())
                      <li>
                        <a {{-- @click.stop="openSubMenu === {{ $category->id }} ? openSubMenu = null : openSubMenu = {{ $category->id }}" --}} onclick="toggleSubMenu({{ $category->id }})"
                          href="javascript:void(0)"
                          class="flex justify-between items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                          <span class="underline-this">
                            {{ $category->name }}
                          </span>
                          {{-- <span :class="{ 'rotate-180': openSubMenu === {{ $category->id }} }"
                            class="ms-1 inline-block transform transition-transform duration-300">↓</span> --}}
                          <span id="arrow-{{ $category->id }}"
                            class="ms-1 inline-block transform transition-transform duration-300">↓</span>
                        </a>
                        <ul id="submenu-{{ $category->id }}" {{-- x-show="openSubMenu === {{ $category->id }}" x-transition --}}
                          class="ml-3 mt-1 space-y-1 border-l border-white font-b_slick_bold  hidden">
                          <li>
                            <a href="/catalogo/{{ $category->slug }}"
                              class="flex items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                              <span class="underline-this font-b_slick_bold">
                                Ver todo {{ $category->name }}
                              </span>
                            </a>
                          </li>
                          @foreach ($category->subcategories as $subcategory)
                            <li>
                              <a href="/catalogo/{{ $category->slug }}?subcat={{ $subcategory->id }}"
                                class="flex items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                                <span class="underline-this font-b_slick_bold">{{ $subcategory->name }}</span>
                              </a>
                            </li>
                          @endforeach
                        </ul>
                      </li>
                    @else
                      <li>
                        <a href="{{ route('Catalogo.jsx', $category->slug) }}"
                          class="flex items-center py-1 px-3 hover:opacity-75 transition-opacity duration-300 normal-case">
                          <span class="underline-this font-b_slick_bold">
                            {{ $category->name }}
                          </span>
                        </a>
                      </li>
                    @endif
                  @endforeach
                  <li>
                    <a onclick="toggleTipoFlor()" href="javascript:void(0)"
                      class=" flex justify-between items-center  text-sm py-2 px-3 hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'catalogo' ? 'text-[#FF5E14]' : '' }}">
                      <span class="underline-this text-lg font-b_slick_bold">

                        Tipos de Flor
                      </span>
                      <span id="flachaRotate1"
                        class="ms-1 inline-block transform transition-transform duration-300">↓</span>
                    </a>
                    <ul id="itemsTipoFLor" class="ml-3 mt-1 space-y-1 border-l border-gray-300 hidden">



                      @foreach ($tipoFlores as $item)
                        <li>
                          <a href="/tipoflor?tipo_flor={{ $item->id }}"
                            class="flex items-center py-1 px-3 hover:opacity-75 hover:text-white transition-opacity duration-300 normal-case">
                            <span class=" underline-this font-b_slick_bold">
                              {{ $item->name }}
                            </span>
                          </a>
                        </li>
                      @endforeach

                    </ul>
                  </li>
                </ul>
              </div>

              <div class="col-span-9">
                <div class="swiper categories-header">
                  <div class="swiper-wrapper mt-2 mb-4">
                    @foreach ($submenucategorias as $category)
                      @if ($category->destacar)
                        <div class="swiper-slide rounded-2xl">
                          <x-category.container :item="$category" />
                        </div>
                      @endif
                    @endforeach
                  </div>
                  <div class="swiper-scrollbar-categories-header h-2"></div>
                  {{-- <div class="mt-4 text-end">
                    <button type="button"
                      class="swiper-button-prev-categories-header text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 ">
                      ←
                    </button>
                    <button type="button"
                      class="swiper-button-next-categories-header text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 ">
                      →
                    </button>
                  </div> --}}
                </div>
              </div>

            </div>
          </div>




          <a href="/promociones" class="font-medium hover:opacity-75  other-class py-3 px-6">
            <span class="underline-this font-b_slick_bold">Promociones</span>
          </a>
          @if (request()->is('producto/*'))
            @if (Auth::user() == null)
              <a class="flex" href="{{ route('login') }}"><img class=" rounded-lg"
                  src="{{ asset('img_donas/Group11.png') }}" alt="user" /></a>
            @else
              <div class="relative  hidden md:inline-flex z-30" x-data="{ open: false }">
                <button class="px-3 py-5 inline-flex justify-center items-center group" aria-haspopup="true"
                  @click.prevent="open = !open" :aria-expanded="open">
                  <div class="flex items-center truncate">
                    <span id="username"
                      class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                      {{ explode(' ', Auth::user()->name)[0] }}</span>
                    <i class="mdi mdi-chevron-down"></i>
                    {{-- <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                  <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                </svg> --}}
                  </div>
                </button>
                <div
                  class="origin-top-right z-30 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                  @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">
                  <ul>
                    <li class="hover:bg-gray-100">
                      @if (Auth::user()->hasRole('Admin'))
                        <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                          href="{{ route('orders') }}" @click="open = false" @focus="open = true"
                          @focusout="open = false">Dashboard</a>
                      @else
                        <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                          href="{{ route('Dashboard.jsx') }}" @click="open = false" @focus="open = true"
                          @focusout="open = false">Mi Cuenta</a>
                      @endif
                    </li>

                    <li class="hover:bg-gray-100">
                      <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" class="font-medium text-sm text-black flex items-center py-1 px-3"
                          @click.prevent="$root.submit(); open = false">
                          {{ __('Cerrar sesión') }}
                        </button>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="flex justify-center items-center min-w-[38px]">
                <div class="relative inline-block cursor-pointer">
                  <a href="/micuenta/puntos"
                    class="bg-[#32B3AD] text-white font-bold px-2 pr-3 pt-[2px] rounded-full flex flex-row gap-1 items-center justify-center">
                    <i class="mdi mdi-dots-hexagon"></i>
                    <span data-id="txt-user-points" class="items-center flex ">{{ Auth::user()->points }}</span>
                    <span class="hidden md:block puntos text-[14px]">Puntos</span>
                  </a>
                </div>
              </div>
            @endif

          @endif


        </nav>

      </div>
    </div>
  @endif

  @if (request()->is('producto/*'))
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
  @endif
  <div class="flex justify-end relative">
    <div
      class="fixed bottom-[20px] z-[10] right-[4%] md:right-[15px] fixedWhastapp flex flex-col items-end justify-end">
      {{-- @if (request()->is('producto/*'))
        <div id="whastappDinamic">


        </div>
      @else --}}
      {{-- <a href="https://api.whatsapp.com/send?phone={{ $general1->whatsapp }}&text={{ $general1->mensaje_whatsapp }}"
          target="_blank" class=""> --}}
      {{-- <img id='btnWhatsapp' src="{{ asset('images/img/WhatsApp.png') }}" alt="whatsapp"
        class="w-20 cursor-pointer" /> --}}
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
      @if (!request()->is('carrito') && !request()->is('pago') && !request()->is('login') && !request()->is('register-rev'))
        <x-my-rewards :general="$general1" />
      @endif

      {{-- </a> --}}
      {{-- </div> --}}
      {{-- <div class="w-20 cursor-pointer" id='btnWhatsapp'>
        <img src="{{ asset('img_donas/whatsapp.png') }}" alt="whatsapp" class="w-20 cursor-pointer" />

      {{-- @endif --}}

    </div>
  </div>


</header>
<div
  class="relative w-full lg:w-80 lg:py-0 border-b lg:border-0 border-[#082252] mr-3  flex lg:hidden font-b_classic_bold">
  <input id="buscarproducto" type="text" placeholder="Buscar..." autocomplete="off"
    class="w-full pl-12 pr-10 py-3 border lg:border-[#F8F8F8] bg-[#F8F8F8] rounded-3xl focus:outline-none focus:ring-0 text-gray-400 placeholder:text-gray-400 focus:border-transparent font-b_slick_thin">
  <span class="absolute inset-y-0 left-0 flex  items-center bg-[#32B3AD] rounded-full my-[7px] px-2 ml-2">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="#32B3AD" xmlns="http://www.w3.org/2000/svg"
      class="">
      <path
        d="M14.6851 13.6011C14.3544 13.2811 13.8268 13.2898 13.5068 13.6206C13.1868 13.9514 13.1955 14.4789 13.5263 14.7989L14.6851 13.6011ZM16.4206 17.5989C16.7514 17.9189 17.2789 17.9102 17.5989 17.5794C17.9189 17.2486 17.9102 16.7211 17.5794 16.4011L16.4206 17.5989ZM15.2333 9.53333C15.2333 12.6814 12.6814 15.2333 9.53333 15.2333V16.9C13.6018 16.9 16.9 13.6018 16.9 9.53333H15.2333ZM9.53333 15.2333C6.38531 15.2333 3.83333 12.6814 3.83333 9.53333H2.16667C2.16667 13.6018 5.46484 16.9 9.53333 16.9V15.2333ZM3.83333 9.53333C3.83333 6.38531 6.38531 3.83333 9.53333 3.83333V2.16667C5.46484 2.16667 2.16667 5.46484 2.16667 9.53333H3.83333ZM9.53333 3.83333C12.6814 3.83333 15.2333 6.38531 15.2333 9.53333H16.9C16.9 5.46484 13.6018 2.16667 9.53333 2.16667V3.83333ZM13.5263 14.7989L16.4206 17.5989L17.5794 16.4011L14.6851 13.6011L13.5263 14.7989Z"
        fill="#ffffff" class="fill-fillAzulPetroleo lg:fill-fillPink" />
    </svg>
  </span>
  <div class="bg-white z-60 shadow-2xl top-12 w-full absolute overflow-y-auto max-h-[200px]" id="resultados2">
  </div>




</div>


<div id="cart-modal"
  class="bag !absolute top-0 right-0 md:w-[450px] cartContainer border shadow-2xl  !rounded-md !p-0"
  style="display: none">
  <div class="p-4 flex flex-col h-[90vh] justify-between gap-2">
    <div class="flex flex-col">
      <div class="flex justify-between ">
        <h2 class="flex items-center gap-2 font-semibold font-Inter_Medium text-[28px] text-[#151515] pb-5">
          Carrito de Compras
          @if (Auth::check())
            <button
              class="bg-[#32B3AD] text-white text-base font-bold px-2 pr-3 pt-[2px] rounded-full h-max w-[80px] ">
              <i class="mdi mdi-dots-hexagon"></i>
              <span data-id="txt-user-points">{{ Auth::user()->points }}</span>
            </button>
          @endif
        </h2>
        <div id="close-cart" class="cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke="#272727" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <div class="overflow-y-scroll h-[calc(90vh-250px)] scroll__carrito">
        <table class="w-full">
          <tbody id="itemsCarrito">
          </tbody>
        </table>
      </div>
    </div>
    <div class="flex flex-col gap-2 pt-2">
      <div class="text-[#32B3AD]  text-xl flex justify-between items-center">
        <p class="font-Inter_Medium font-semibold">Total</p>
        <p class="font-Inter_Medium font-semibold itemsTotal" id="itemsTotal">S/ 0.00</p>
      </div>
      <div class="flex flex-col gap-2">
        <a href="/carrito"
          class="font-normal font-Inter_Medium text-lg bg-[#32B3AD] py-3 px-5 rounded-2xl text-white cursor-pointer w-full 
          inline-block text-center">
          REALIZAR PEDIDO</a>
        <button type="button" id="close-cart"
          class="font-normal font-Inter_Medium text-lg bg-[#32B3AD] py-3 px-5 rounded-2xl text-white cursor-pointer w-full 
          inline-block text-center">
          BUSCAR MÁS OPCIONES
        </button>
      </div>
    </div>
  </div>
</div>
<div id="modalFormContactus" class="modal !p-0 rounded-t-sm"
  style="max-width: 500px !important;width: 100% !important;  ">
  <!-- Modal body -->
  <div class="bg-[#ece5dd]">
    <div class="bg-[#075e55] text-white">
      <h1 class="font-Inter_SemiBold text-[28px]  px-7 py-3"> Las Doñas Florería Online
      </h1>

    </div>
    <form id='formContactusWhatsapp' name='formContactusWhatsapp' class="px-7 py-3">
      <p class="flex flex-col gap-2"><span>!Hola! 👋🏻</span>
        <span>
          Bríndanos tu Nombre para poder ayudarte 🧑🏻‍💻
        </span>
      </p>
      <div class="mb-3 py-3">

        <input type="text"
          class="font-b_slick_thin gap-2 self-stretch px-6 py-4 mt-1 w-full text-sm tracking-wide rounded-2xl border  focus:ring-0 focus:outline-none
           focus:border-[#336234] max-md:px-5 max-md:max-w-full disabled:cursor-not-allowed no-spin"
          id="nombres" name="nombres" placeholder="Nombres y Apellidos " required>
      </div>

      <button type="submit"
        class="text-center flex justify-center items-center gap-2
                          w-full py-4 px-8 bg-[#26d367]  text-white  text-xl font-medium rounded-full transition-colors">
        <img src="/images/img/icons8-whatsapp-50.png" class="w-8" alt="">Contactar</button>
    </form>

  </div>
  <div class="w-full pb-4 flex justify-center items-center text-[18px] gap-2">
    <span class="flex gap-2"> <img src="/images/img/dotgren.png" alt="">Estamos en linea </span> |
    <span class="underline linkTerminos cursor-pointer">Politicas de privacidad </span>
  </div>
</div>



<script>
  function toggleTipoFlor() {
    console.log('cambiando tipo flor')

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
  $('#formContactusWhatsapp').on('submit', function(e) {
    e.preventDefault();

    let nombres = $('#nombres').val();
    let $button = $(this).find('button[type="submit"]');
    $button.html(`
      <div role="status">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Loading...</span>
      </div>
    `);

    let succesFail = `
        <img src="/images/img/icons8-whatsapp-50.png" class="w-8" alt="">Contactar`

    $.ajax({
      url: '/api/contactus',
      type: 'POST',
      data: {

        nombres,
        tipo_interaccion: 'whatsapp'

      },
      success: function(response) {
        console.log('entra success');

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
  console.log(articulosCarrito)

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

      if (element.usePoints && restPoints >= (element.points * element.cantidad)) {
        element.precio = 0
        restPoints -= element.points * element.cantidad
      }

      let plantilla = `<tr class=" font-poppins border-b">
          <td class="p-2">
            <img src="/${element.imagen}" class="block bg-[#F3F5F7] rounded-md p-0 " alt="producto" onerror="this.onerror=null;this.src='/images/img/noimagen.jpg';"  style="width: 100px; height: 75px; object-fit: contain; object-position: center;" />
          </td>
          <td class="p-2">
            <p class="font-semibold text-[14px] text-[#151515] mb-1">
              ${element.producto} - ${element.tipo}
            </p>
            <div class="flex gap-2 items-center">
              <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
                <button type="button" onClick="deleteOnCarBtn(${element.id})" class="w-6 h-6 flex justify-center items-center ">
                  <span  class="text-[20px]">-</span>
                </button>
                <div class="w-6 h-6 flex justify-center items-center">
                  <span  class="font-semibold text-[12px]">${element.cantidad}</span>
                </div>
                <button type="button" onClick="addOnCarBtn(${element.id})" class="w-6 h-6 flex justify-center items-center ">
                  <span class="text-[20px]">+</span>
                </button>
              </div>
              <span class="text-orange-500 text-sm">${element.usePoints ? 'Usando puntos': ''}</span>
            </div>
          </td>
          <td class="p-2 text-end">
            <p class="font-semibold text-[14px] text-[#151515] w-max">
              S/${Number(element.precio)} 
              
            </p>
            <button type="button" onClick="(deleteItem(${element.id} ))" class="w-6 h-6 flex justify-center items-center mx-auto">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#272727" class="w-6 h-6">
                <path stroke="#272727" stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>
            </button>

          </td>
        </tr>`

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
