<x-authentication-layout>
  <div class="px-[8%] my-[4%]">
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Reestablece tu contraseña') }} ✨</h1>
    @if (session('status'))
      <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
      </div>
    @endif
    <!-- Form -->
    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div>
        <x-label for="email">{{ __('Tu correo Electronico') }} <span class="text-rose-500">*</span></x-label>
        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
      </div>
      <div class="flex justify-end mt-6">
        <x-button>
          {{ __('Enviar Link') }}
        </x-button>
      </div>
    </form>
    <x-validation-errors class="mt-4" />
  </div>

</x-authentication-layout>
