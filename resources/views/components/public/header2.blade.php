{{-- <img src="{{ asset('img_donas/Carrito.png') }}" class="absolute top-0 left-0 w-full z-[99999] opacity-30"></img> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<header>
  <div class="header_top bg-rosalasdonas w-full h-12 text-white flex flex-row items-center justify-center"> Producto |
    Categoría <span class="ml-1 font-bold"> más vendida </span> <img class="w-6 ml-2"
      src="{{ asset('img_donas/spa.svg') }}">
  </div>
  <div class="header_middle grid grid-cols-12 h-28 md:border-b">
    <div class="block_left col-span-3 flex items-center justify-center ">
      <div class="md:hidden">
        <button class="hamburger" onclick="show()">
          <div id="bar1" class="bar"></div>
          <div id="bar2" class="bar"></div>
          <div id="bar3" class="bar"></div>
        </button>
      </div>
      <a href="/"><img class="w-48" src="{{ asset('images/ux/headerLogo.png ') }}" /></a>
    </div>
    <div class="block_center col-span-4 flex items-center justify-center ">

    </div>


    <div class="block_right col-span-4 flex flex-row items-center justify-center pl-2 ">
      <div
        class="flex flex-auto gap-4 items-center p-2 text-base font-bold whitespace-nowrap bg-stone-50 rounded-[40px] text-zinc-400 w-[306px] h-[40px]">
        <img loading="lazy" src="{{ asset('img_donas/Group9.png') }}"
          class="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" alt="" />
        <label for="searchInput" class="sr-only">Search</label>
        <input type="text" id="searchInput" placeholder="Buscar..."
          class="flex-1 shrink self-stretch my-auto  bg-transparent border-none focus:outline-none outline-none h-3" />
      </div>

      <div class="rounded-full p-2 hidden md:block">
        <img class="w-10 p-1" src=" {{ asset('img_donas/Group11.png') }}" />
      </div>

      {{-- <div class="bg-rosalasdonas rounded-full p-2">
        <img class="w-6" src="{{ asset('/public/img_donas/cart.svg') }}" />
      </div> --}}
      <div class="flex justify-center items-center ">
        <div id="open-cart" class="relative inline-block cursor-pointer   rounded-full p-2">
          <span id="itemsCount"
            class="bg-[#336234] text-xs font-medium text-white text-center px-[7px] py-[2px]  rounded-full absolute bottom-0 -right-3 ml-3">0</span>
          <img src="{{ asset('img_donas/Group10.png') }}" class=" rounded-lg p-1 w-10 h-auto cursor-pointer" />
        </div>
        {{-- <input type="checkbox" class="bag__modal" id="check" /> --}}

      </div>


    </div>
  </div>
  <div class="header_bottom  md:px-[5%] lg:px-[10%] h-12 py-3 hidden md:block bg-[#336234]">
    <div class="text-colorgris font-medium text-base">
      <nav>
        <ul class="menu flex flex-row justify-between">
          @foreach ($submenucategorias->take(7) as $item)
            <li><a href="/catalogo/{{ $item->id }}">{{ $item->name }}</a></li>
          @endforeach

        </ul>
      </nav>
    </div>
  </div>
</header>
<div id="cart-modal"
  class="bag !absolute top-0 right-0 md:w-[450px] cartContainer border shadow-2xl  !rounded-md !p-0 !z-30"
  style="display: none">
  <div class="p-4 flex flex-col h-[90vh] justify-between gap-2">
    <div class="flex flex-col">
      <div class="flex justify-between ">
        <h2 class="font-semibold font-Inter_Medium text-[28px] text-[#151515] pb-5">Carrito</h2>
        <div id="close-cart" class="cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke="#272727" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <div class="overflow-y-scroll h-[calc(90vh-200px)] scroll__carrito">
        <table class="w-full">
          <tbody id="itemsCarrito">
          </tbody>
        </table>
      </div>
    </div>
    <div class="flex flex-col gap-2 pt-2">
      <div class="text-[#336234]  text-xl flex justify-between items-center">
        <p class="font-Inter_Medium font-semibold">Total</p>
        <p class="font-Inter_Medium font-semibold" id="itemsTotal">S/ 0.00</p>
      </div>
      <div>
        <a href="/carrito"
          class="font-normal font-Inter_Medium text-lg bg-[#336234] py-3 px-5 rounded-2xl text-white cursor-pointer w-full inline-block text-center">Ver
          Carrito</a>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/storage.extend.js') }}"></script>

<script>
  const appUrl = "{{ env('APP_URL') }}"
  var articulosCarrito = Local.get('carrito') || [];
  $(document).ready(() => {
    mostrarTotalItems()
    PintarCarrito()
  })
  $('#open-cart').on('click', () => {
    $('#cart-modal').modal({
      showClose: false,
      fadeDuration: 100
    })
  })
  $('#close-cart').on('click', () => {
    $('.jquery-modal.blocker.current').trigger('click')
  })

  function mostrarTotalItems() {
    let articulos = Local.get('carrito')
    let contarArticulos = articulos.reduce((total, articulo) => {
      return total + articulo.cantidad;
    }, 0);

    $('#itemsCount').text(contarArticulos)
  }

  function addOnCarBtn(id, isCombo) {
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.isCombo == isCombo) {

        item.cantidad += 1;
      }
      return item;
    });

    Local.set('carrito', articulosCarrito);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteOnCarBtn(id, isCombo) {
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.isCombo == isCombo && item.cantidad > 0) {

        item.cantidad -= 1;
      }
      return item;
    });

    Local.set('carrito', articulosCarrito);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteItem(id, isCombo) {

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

      let index = articulosCarrito.findIndex(item => item.id === id && item.isCombo == isCombo);
      if (index > -1) {
        articulosCarrito.splice(index, 1);
      }
    } else {
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

    }

    // return

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

    articulosCarrito.forEach(element => {

      let plantilla = `<tr class=" font-poppins border-b">
          <td class="p-2">
            <img src="${appUrl}/${element.imagen}" class="block bg-[#F3F5F7] rounded-md p-0 " alt="producto" onerror="this.onerror=null;this.src='/images/img/noimagen.jpg';"  style="width: 100px; height: 75px; object-fit: contain; object-position: center;" />
          </td>
          <td class="p-2">
            <p class="font-semibold text-[14px] text-[#151515] mb-1">
              ${element.producto} - ${element.tipo}
            </p>
            <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
              <button type="button" onClick="(deleteOnCarBtn(${element.id}))" class="w-6 h-6 flex justify-center items-center ">
                <span  class="text-[20px]">-</span>
              </button>
              <div class="w-6 h-6 flex justify-center items-center">
                <span  class="font-semibold text-[12px]">${element.cantidad}</span>
              </div>
              <button type="button" onClick="(addOnCarBtn(${element.id}))" class="w-6 h-6 flex justify-center items-center ">
                <span class="text-[20px]">+</span>
              </button>
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
    let total = articulos.map(item => {
      let total = 0
      total += item.cantidad * Number(item.precio)
      /*  if (item.complementos.length > 0) {
         item.complementos.forEach(complemento => {
           total += Number(complemento.preciofiltro)
         })
       } */
      return total


    }).reduce((total, elemento) => total + elemento, 0);

    // const suma = total.

    $('#itemsTotal').text(`S/. ${total} `)

  }
</script>
