<x-authentication-layout>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <div class="py-20 md:py-0">
    <div class="flex flex-row md:h-screen justify-center font-b_slick_bold min-h-[869px]">
      <div class="basis-1/2 hidden md:block ">
        <!-- Imagen ocupando toda la altura y sin desbordar -->
        <div style="background-image: url('{{ asset('/img_donas/login.png') }}')"
          class="bg-cover bg-center bg-no-repeat w-full h-full">
          {{-- <h1 class="font-mediumDisplay text-[24px] py-10 bg-black bg-opacity-25 text-center text-white">
            Doomine
          </h1> --}}
        </div>
      </div>

      <!-- Segundo div -->
      <div class="w-full md:basis-1/2 text-[#151515] flex flex-col justify-center items-center  px-5 md:px-4">
        <div class="w-full md:w-4/6 flex flex-col gap-5 justify-center items-center">
          <div class="px-4 flex flex-col gap-5 text-center md:text-left">
            <h1 class="font-boldDisplay text-text40 xl:text-text44 uppercase">
              Crear Una nueva Cuenta
            </h1>
            <p class="font-regularDisplay text-text16 xl:text-text20">
              ¿Ya tienes una cuenta?
              <a href="{{ route('login') }}" class="font-boldDisplay text-text16 xl:text-text20 text-textBlack">Iniciar
                Sesión</a>
            </p>
          </div>
          <div class="">
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
              @csrf
              <div class=" flex flex-col w-full">
                <label for="email" class="text-sm tracking-wide text-neutral-900 mb-2">Nombre Completo</label>
                <div class="relative w-full py-2 ">
                  <input type="text" placeholder="Nombre completo" id="name" name="name"
                    :value="old('name')" required autofocus autocomplete="name" {{-- class="w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px]  border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]"  --}}
                    class="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " />
                  <i class="fa-regular fa-user-circle  text-[#6C7275] absolute right-6 top-1/2 transform -translate-y-1/2 cursor-pointer"
                    aria-hidden="true"></i>

                </div>

              </div>
              <div class="flex flex-col w-full">
                <label for="email" class="text-sm tracking-wide text-neutral-900">Email</label>
                <div class="relative w-full py-2 ">
                  <input type="email" placeholder="Correo electrónico" id="email" name="email"
                    :value="old('email')" required {{-- class="w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" --}}
                    class="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " />
                  <i
                    class="fa fa-envelope text-[#6C7275] absolute right-6 top-1/2 transform -translate-y-1/2 cursor-pointer"></i>
                </div>
              </div>


              <div class="flex flex-col w-full">


                <!-- Input -->
                <label for="email" class="text-sm tracking-wide text-neutral-900">Contraseña</label>
                <div class="relative w-full py-2">
                  <input type="password" placeholder="Contraseña" id="password" name="password" required
                    autocomplete="new-password" {{-- class="w-full py-5 pl-4 pr-12 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" --}}
                    class="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " />
                  <!-- Imagen -->
                  <img onclick="mostrarContrasena()" src="{{ asset('images/svg/pass_eyes.svg') }}" alt="password"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer" />
                </div>

              </div>


              <div class="flex flex-col w-full">
                <!-- Input -->
                <label for="email" class="text-sm tracking-wide text-neutral-900">Confirmar Contraseña</label>
                <div class= "relative w-full">
                  <input type="password" placeholder="Confirmar contraseña" id="password_confirmation"
                    name="password_confirmation" required autocomplete="new-password" {{--  class="w-full py-5 pl-4 pr-12 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]"  --}}
                    class="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " />
                  <!-- Imagen -->
                  <img onclick="mostrarContrasena2()" src="{{ asset('images/svg/pass_eyes.svg') }}" alt="password"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer" />
                </div>

              </div>


              <div class="flex gap-3 px-4 items-center">
                <input type="checkbox" id="acepto_terminos" class="w-5 h-5" />
                <label for="" class="font-normal text-sm ">Acepto la
                  <span class=" font-bold text-[#006BF6]  cursor-pointer open-modal" data-tipo='PoliticaPriv'>Política
                    de
                    Privacidadddd</span>
                  y los
                  <span class=" font-bold text-[#006BF6] open-modal cursor-pointer open-modal" data-tipo='terminosUso'>
                    Términos de Uso
                  </span>
                </label>
              </div>

              <div class="px-4">
                <input type="submit" value="Crear Cuenta"
                  class="cursor-pointer gap-2 px-6 py-4 w-full whitespace-nowrap
                  bg-green-800 rounded-3xl text-zinc-100" />
                <a href="#"
                  class="flex flex-row gap-2 justify-center items-center px-6 py-3.5 mt-4 w-full rounded-3xl border border-green-800 border-solid min-h-[51px]">
                  <img loading="lazy" src="/img_donas/Google1.png" alt=""
                    class="object-contain shrink-0  my-auto w-6 aspect-square" />
                  <span class=" my-auto">Ingresar con mi cuenta de Google</span>
                </a>
              </div>
            </form>
            <x-validation-errors class="mt-4" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modaalpoliticas" class="modal modalbanner">
    <div class="p-2" id="modal-content">
      <h1 id="modal-title">MODAL POLITICAS</h1>
      <div id="modal-body-content"></div>
    </div>
  </div>

</x-authentication-layout>

<script>
  const politicas = @json($politicas);
  const terminos = @json($terminos);
  $(document).on('click', '.open-modal', function() {

    var tipo = $(this).data('tipo');
    var title = '';
    var content = '';



    if (tipo == 'PoliticaPriv') {
      title = 'Política de Privacidad';
      content = politicas.content ?? '';
    } else if (tipo == 'terminosUso') {
      title = 'Términos y condiciones';
      content = terminos.content;
    }

    $('#modal-title').text(title);
    $('#modal-body-content').html(content);

    $('#modaalpoliticas').modal({
      show: true,
      fadeDuration: 100
    });
  });
  const mostrarContrasena = () => {
    const icon = $('#showhide-icon')
    const input = $('#password')
    const current = input.attr('type')
    if (current == 'text') {
      input.attr('type', 'password')
      icon.removeClass('fa-eye-slash').addClass('fa-eye')
    } else {
      input.attr('type', 'text')
      icon.removeClass('fa-eye').addClass('fa-eye-slash')
    }
  }
  const mostrarContrasena2 = () => {
    const icon = $('#showhide-icon')
    const input = $('#password_confirmation')
    const current = input.attr('type')
    if (current == 'text') {
      input.attr('type', 'password')
      icon.removeClass('fa-eye-slash').addClass('fa-eye')
    } else {
      input.attr('type', 'text')
      icon.removeClass('fa-eye').addClass('fa-eye-slash')
    }
  }
</script>
