@php
  use SoDe\Extend\Text;
@endphp

<footer class=" p-[23px] sm:p-[7%] md:p-[5%] lg:p-[5%] font-PlusJakartaSans_Regular !tracking-wider text-white"
  style="background :#C89B6E">
  <div class="footer_main pb-10 border-b h-fit">
    <div class="flex flex-col md:flex-row justify-center gap-8">
      <div class="md:w-[255px] md:h-[169px] md:ml-[146px] flex items-center justify-center">
        <img class="md:w-[166px] md:h-[169px]" src="{{ asset('images/ux/logo_sello_blanco.svg') }}">
      </div>
      <div class="w-full flex flex-col justify-center md:ml-6">

        <span class="text-white text-[17px] font-medium mt-4 pl-2 block opacity-70 font-dm_sans text-center">
          En Las Doñas, somos artesanas floristas apasionadas por transformar emociones en arte floral. Cada creación es
          una obra única que refleja nuestra dedicación y amor por lo que hacemos. Conectamos corazones a través de
          flores y detalles que hablan un lenguaje propio, haciendo que esa ocasión especial sea inolvidable. Nos
          inspiran la belleza, la creatividad y la pasión por compartir lo mejor con quienes nos eligen.
        </span>
      </div>

    </div>
  </div>

  <div class="footer_bottom ">

    <div
      class="flex flex-col md:flex-row gap-16 justify-center md:justify-start items-center md:items-start p-[23px] md:pl-[215px] md:pt-[49px]">

      <div class="flex flex-col w-full md:w-[120px] items-center md:items-start">
        <h2 class="mb-[24px] font-PlusJakartaSans_Bold">Empresa</h2>
        <div
          class="flex flex-col gap-[14px] self-stretch opacity-70 justify-start text-white text-base font-normal font-PlusJakartaSans_Regular leading-6 items-center md:items-start">
          <a class="h-[26px]" href="/">Inicio</a>
          <a class="h-[26px]" href="/nosotros">Nosotros</a>
          <a class="h-[26px]" href="/catalogo">Categorias</a>
          <a class="h-[26px]" href="/promociones">Promociones</a>
        </div>
      </div>

      <div class="flex flex-col w-full md:w-[120px] items-center md:items-start">
        <div class="text-white sm:col-span-3 lg:col-span-3">
          <nav class="items-center md:items-start flex flex-col">
            <h2 class="text-lg mb-[24px] font-PlusJakartaSans_Bold">Categorías</h2>
            <div class="text-base opacity-70 gap-[14px] flex flex-col items-center md:items-start">
              @foreach ($categories as $item)
                <a class="h-[26px]" href="/catalogo/{{ $item->id }}">{{ Text::toTitleCase($item->name) }}</a>
              @endforeach
            </div>
          </nav>
        </div>
      </div>

      <div class="flex flex-col w-[261px] items-center md:items-start">

        <h2 class="text-lg mb-[24px] font-PlusJakartaSans_Bold">Legales</h2>

        <div class="w-12 h-0 opacity-50 outline outline-[0.50px] outline-offset-[-0.25px] outline-white md:hidden">
        </div>
        <a href="/terminos-y-condiciones"
          class="w-full md:w-48  h-[43px] text-white text-base font-normal font-PlusJakartaSans_Regular leading-relaxed flex items-end justify-center md:justify-start">
          Términos y condiciones
        </a>
        <div class="w-12 h-0 opacity-50 outline outline-[0.50px] outline-offset-[-0.25px] outline-white md:hidden">
        </div>

        <a href="/politicas-de-devolucion"
          class="w-full md:w-64  h-[43px] text-white text-base font-normal font-PlusJakartaSans_Regular leading-relaxed flex items-end justify-center md:justify-start">
          Políticas de envío y devoluciones
        </a>

        <h2 class="text-lg mb-4 font-PlusJakartaSans_Bold mt-6">Siguenos</h2>
        <span class="opacity-70  md:text-left">Síguenos y descubre nuestras novedades florales cada
          día.</span>

        <div class="flex flex-row gap-[34px] mt-4 justify-center md:justify-start">
          <a href="{{ $datosgenerales->youtube }}">
            <img class="w-8 h-8" src="{{ asset('images/ux/youtube color.1.svg') }}" />
          </a>
          <a href="{{ $datosgenerales->instagram }}">
            <img class="w-8 h-8" src="{{ asset('images/ux/instagram black.1.svg') }}" />
          </a>
          <a href="{{ $datosgenerales->facebook }}">
            <img class="w-8 h-8" src="{{ asset('images/svg/facebook-176-svgrepo-com.svg') }}" />
          </a>
          <a href="{{ $datosgenerales->tiktok }}">
            <div class="w-8 h-8">
              <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 2859 3333"
                class="w-full h-full" preserveAspectRatio="xMidYMid meet" fill="white">
                <path
                  d="M2081 0c55 473 319 755 778 785v532c-266 26-499-61-770-225v995c0 1264-1378 1659-1932 753-356-583-138-1606 1004-1647v561c-87 14-180 36-265 65-254 86-398 247-358 531 77 544 1075 705 992-358V1h551z" />
              </svg>
            </div>

          </a>



        </div>


      </div>

      <div class="flex flex-col w-[260px] items-center md:items-start">




        <div class="w-full font-PlusJakartaSans_Bold text-base ">

          <h2 id="contacto-titulo" class="sr-only mb-[24px]">Información de contacto</h2>
          <h2 class="text-lg mb-[24px] font-PlusJakartaSans_Bold">Contáctanos</h2>

          <p>
            {{-- <strong class="text-lg mb-[24px] font-PlusJakartaSans_Bold ">:</strong><br> --}}
            <a class="opacity-70" href="tel:+51015978881">(01) 597-8881</a> <br>
            <a class="opacity-70" href="tel:+51987829046">+51 987 829 046</a> <br>
            <a class="opacity-70" href="mailto:admin@lasdonas.pe">admin@lasdonas.pe</a>
          </p>

          <p class="mt-2">
            <strong>Horarios:</strong><br>
            <time datetime="Mo-Sa 08:00-19:00" class="opacity-70">
              Lunes a Sábados <br> 08:00am – 07:00pm
            </time>
          </p>

        </div>

        <div class="w-full font-PlusJakartaSans_Bold text-base  mt-4">
          <h4 class="text-base "> CORPORACION FLORAL S.A.C - RUC : 20613680277</h4>
        </div>
      </div>

    </div>

    <div class="flex w-full flex-col justify-center items-center py-2 px-[23px] md:px-[90px]">
      <div class="flex flex-col md:flex-row   justify-center items-center">
        <div
          className="w-full md:w-96 text-[21px] md:text-[28px] h-8 justify-start text-white  font-medium font-dm_sans text-center">
          Recibe nuestras novedades
        </div>

        <div class="relative w-full mt-[14px] gap-2">
          <input
            class="w-full md:w-[510px] h-12 pl-4 pr-20 rounded-[4px] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
            type="email" placeholder="Ingresa tu email" />
          <button
            class="mt-2 md:mt-0 md:ml-4 right-1 top-1 bg-[#FF8555] text-white px-4 py-2 rounded-[4px] hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
            Suscríbete ahora
          </button>

        </div>
      </div>

    </div>

    <div class="w-full">

      <div class=" flex flex-row   mt-5 gap-6 justify-between md:px-[90px]">
        <div class="hidden md:block">
          <img src="/images/ux/isotipo.svg" alt="">
        </div>

        <div class="flex flex-col md:flex-row w-full gap-[1.6rem] md:gap-10 items-center justify-center mt-4">
          <div class="flex flex-col md:flex-row gap-4 items-center justify-center ">
            <img src="/images/ux/libroR.png" alt="" class="w-[93px] h-[73px]">
            <a href="/libro-de-reclamaciones"
              class="w-full md:w-48 text-center md:h-[53px] text-white text-base font-normal font-PlusJakartaSans_Regular leading-relaxed flex items-end">
              Libro de reclamaciones
            </a>
          </div>





        </div>

        <div class="hidden md:block">
          <img src="/images/ux/isotipo.svg" alt="">
        </div>




      </div>
    </div>

    <div class="py-10">
      <div class="flex flex-row items-center justify-center  lg:col-span-5 mt-4">
        <img src="{{ asset('img_donas/pagos.svg') }}" />
      </div>
    </div>

    <div class="py-10 border-t mt-10">

      <div class="lg:col-span-7 flex justify-center">
        <p class="text-sm   text-white w-full text-center px-[15%]">
          © 2024 Las Doñas. Todos los derechos reservados. Las imágenes, textos y diseños florales son propiedad
          exclusiva de Las Doñas. Prohibida su reproducción total o parcial sin autorización previa por escrito.</p>
      </div>


    </div>

    {{--  <div class="text-white sm:col-span-3 lg:col-span-4">
      <nav>
        <h2 class="text-lg ">Políticas</h2>
        <ul class="  space-y-1 mt-2 flex flex-col ">
          <a class="linkTerminos" id="linkTerminos">Términos y Condiciones</a>
          <a href="/politicas-de-devolucion" id="linkPoliticas">Políticas de Envío y Devoluciones</a>
          <a id="bioseguridad">Políticas de Fidelización FloriPuntos</a>
          <a href="{{ route('librodereclamaciones') }}"><img class="w-24"
              src="{{ asset('images/img/reclamaciones.png') }}" /></a>
        </ul>
      </nav>
    </div> --}}


  </div>

  <div id="modalTerminosCondiciones" class="modal" style="max-width: 900px !important;width: 100% !important;  ">

    <div class="p-4 ">
      <h1 class="font-Inter_SemiBold">Terminos y condiciones</h1>
      <div class="   grid grid-cols-1 ">{!! $terminos->content ?? '' !!}</div>
    </div>
  </div>
  <div id="modalPoliticasDev" class="modal relative" style="max-width: 900px !important; width: 100% !important;  ">
    <!-- Modal body -->
    <div class="p-4 ">
      <h1 class="font-Inter_SemiBold">Politicas de Envio y Devoluciones</h1>
      {{-- <i id="close-modal" class="bg-gray-200 cursor-pointer"> close Modal</i> --}}


      <div class="   grid grid-cols-1  ">{!! $politicas->content ?? '' !!}</div>


    </div>
  </div>
  <div id="modaBioseguridad" class="modal" style="max-width: 900px !important; width: 100% !important;  ">
    <!-- Modal body -->
    <div class="p-4 ">
      <h1 class="font-Inter_SemiBold">Políticas de Fidelización FloriPuntos
      </h1>

      <div class="   grid grid-cols-1 ">{!! $bioseguridad->content ?? '' !!}</div>


    </div>
  </div>


</footer>

<script>
  $(document).ready(function() {


    $(document).on('click', '.linkTerminos', function() {
      $('#modalTerminosCondiciones').modal({
        show: true,
        fadeDuration: 200,

      })
    })
    /* $(document).on('click', '#linkPoliticas', function() {
      $('#modalPoliticasDev').modal({
        show: true,
        fadeDuration: 200,



      })
      $('#linkPoliticas').show();
    }) */
    $(document).on('click', '#bioseguridad', function() {
      $('#modaBioseguridad').modal({
        show: true,
        fadeDuration: 200,


      })
    })

    $(document).on('click', '#close-modal', function() {
      console.log($(this).closest('.modal'))
      $(this).closest('.modal')[0].style.display = 'none'
      $('.jquery-modal.blocker.current').remove();
    })
  })
</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js" defer></script> --}}
