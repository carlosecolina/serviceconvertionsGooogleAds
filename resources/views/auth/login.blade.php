<x-authentication-layout>

  <div class="flex h-screen">
    <!-- Primer div -->
    <div class="bg-blue-500 basis-1/2 hidden md:block font-poppins">
      <!-- Imagen ocupando toda la altura y sin desbordar -->
      <div style="background-image: url('{{ asset('images/img/login_decotab.png') }}')"
        class="bg-cover bg-center bg-no-repeat w-full h-full">
        <h1 class="font-medium text-[24px] py-10 bg-black bg-opacity-25 text-center text-white">

        </h1>
      </div>
    </div>

    <!-- Segundo div -->
    <div class="w-full md:basis-1/2 text-[#151515] flex justify-center items-center font-poppins">
      <div class="w-full md:w-4/6 flex flex-col gap-5">
        <div class="px-4 flex flex-col gap-5 text-center md:text-left">
          @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
              {{ session('status') }}
            </div>
          @endif
          <h1 class="font-semibold text-[40px]">Iniciar Sesión</h1>

        </div>
        <div class="">
          <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf
            <div>
              <input type="text" placeholder="Tu nombre de usuario o correo electrónico" name="email"
                id="email" type="email" :value="old('email')" required autofocus
                class="w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-b-[1.5px] border-gray-200" />
            </div>

            <div class="relative w-full">
              <!-- Input -->
              <input type="password" placeholder="Contraseña" id="password" name="password" required
                autocomplete="current-password"
                class="w-full py-5 pl-4 pr-12 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-b-[1.5px] border-gray-200" />
              <!-- Imagen -->
              <img src="./images/svg/pass_eyes.svg" alt="password"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer" />
            </div>

            <div class="flex gap-3 px-4 justify-between">
              <div>
                <input type="checkbox" id="acepto_terminos" class="w-4" />
                <label for="acepto_terminos" class="font-normal text-[16px]">Recuerdame
                </label>
              </div>

              @if (Route::has('password.request'))
                <div>
                  <a href="{{ route('password.request') }}" class="font-semibold text-[16px] text-[#EB5D2C]">¿Olvidaste
                    tu contraseña?</a>
                </div>
              @endif

            </div>

            <div class="px-4">
              <input type="submit" value="Iniciar Sesión"
                class="text-white bg-[#74A68D] w-full py-4 rounded-3xl cursor-pointer" />
            </div>
          </form>
          <x-validation-errors class="mt-4" />
        </div>
      </div>
    </div>
  </div>
</x-authentication-layout>
