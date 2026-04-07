<li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), [$id ?? ''])) {{ 'bg-slate-900' }} @endif">
  <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), [$id ?? ''])) {{ 'hover:text-slate-200' }} @endif"
    href="{{ $href ?? '' }}" title="{{ $slot }}" tippy>
    <div class="flex items-center justify-between">
      <div class="grow flex items-center">
        <i
          class="shrink-0 {{ $icon ?? 'fas fa-file' }} w-6 h-6 text-lg text-center @if (in_array(Request::segment(2), [$id ?? ''])) {{ 'text-indigo-500' }} @endif"></i>
        <span
          class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ $slot }}</span>
      </div>
      @isset($tag)
        <div class="flex flex-shrink-0 ml-2">
          <span
            class="inline-flex items-center justify-center h-5 text-xs font-medium text-white bg-indigo-500 px-2 rounded">
            {{ $tag }}
          </span>
        </div>
      @endisset
    </div>
  </a>
</li>
