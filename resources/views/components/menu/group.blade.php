 <div>
   <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
     <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
     <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">{{ $title ?? '' }}</span>
   </h3>
   <ul class="mt-3">
     {{ $slot }}
   </ul>
 </div>
