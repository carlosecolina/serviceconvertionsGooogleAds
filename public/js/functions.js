const checkbox = document.getElementById("check");
const bag = document.querySelector(".bag");
const bodyModalCarrito = document.querySelector(".body");
let isMenuOpen = false; // Variable para controlar el estado del menú
const card = document.querySelector(".cartContainer");
// checkbox.addEventListener("click", checkboxOnClick);

// Agregar event listener al checkbox para controlar el estado del menú
function checkboxOnClick() {
  // Cambiar el top del carrito
  const scrollTopPosition = window.scrollY;
  card.style.top = scrollTopPosition + "px";

  isMenuOpen = checkbox.checked;
  if (isMenuOpen) {
    bodyModalCarrito.classList.add("dark");
    bodyModalCarrito.classList.add("overflow-hidden");
    // Agregar el event listener al documento cuando se abre el menú
    document.addEventListener("click", handleDocumentClick);
  } else {
    bodyModalCarrito.classList.remove("dark");
    bodyModalCarrito.classList.remove("overflow-hidden");
    // Quitar el event listener del documento cuando se cierra el menú
    document.removeEventListener("click", handleDocumentClick);
  }
}

// Función para manejar el clic en el documento
function handleDocumentClick(event) {
  // Verificar si el menú está abierto y si el clic no ocurrió dentro del nav ni en el checkbox
  if (isMenuOpen && !bag.contains(event.target) && event.target !== checkbox) {
    bag.classList.add("hidden"); // Ocultar el nav
    checkbox.checked = false; // Desmarcar el checkbox
    bodyModalCarrito.classList.remove("dark");
    bodyModalCarrito.classList.remove("overflow-hidden");
    isMenuOpen = false; // Actualizar el estado del menú
    // Quitar el event listener del documento después de cerrar el menú
    document.removeEventListener("click", handleDocumentClick);
  }
}

// Detener la propagación de clics dentro del nav para evitar cerrarlo al hacer clic dentro
bag.addEventListener("click", function (event) {
  event.stopPropagation(); // Evitar que el clic se propague al documento
});




function show() {
  document.querySelector(".hamburger").classList.toggle("open");
  document.querySelector(".navigation").classList.toggle("active");
}


/* --------------------------- CARROUSEL ---------------------------- */
var carrouselTestimonios = new Swiper(".myTestimonios", {
  slidesPerView: 4, //3
  spaceBetween: 25,
  loop: true,
  grabCursor: true,
  centeredSlides: true,
  initialSlide: 0,
  pagination: {
    el: ".swiper-pagination-testimonios",
    clickable: true,
    /* dynamicBullets: true, */
  },
  autoplay: {
    delay: 1500,
    disableOnInteraction: false,
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});

/* ------------------------------------------------------------------ */

var carrouselBeneficios = new Swiper(".myBeneficios", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  grab: false,
  centeredSlides: false,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)
  pagination: {
    el: ".swiper-pagination-beneficios",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
  },
});

/* ------------------------------------------- */

var carrouselCategorias = new Swiper(".categorias", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: false,
  grab: false,
  centeredSlides: true,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)
  pagination: {
    el: ".swiper-pagination-categorias",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
  },
});

/* --------------------------------------------- */

var carrosuelDestacados = new Swiper(".productos-destacados", {
  slidesPerView: 4,
  spaceBetween: 10,
  loop: true,
  grab: false,

  centeredSlides: false,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)
  pagination: {
    el: ".swiper-pagination-productos-destacados",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});

/* --------------------------------------------- */

var carrouselOferta = new Swiper(".productos-oferta", {
  slidesPerView: 4,
  spaceBetween: 10,
  loop: true,
  grab: false,
  centeredSlides: false,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)
  pagination: {
    el: ".swiper-pagination-productos-oferta",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});

/* --------------------------------------------- */

var carrosuelComplementario = new Swiper(".productos-complementarios", {
  slidesPerView: 4,
  spaceBetween: 10,
  loop: true,
  grab: false,
  centeredSlides: false,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)

  pagination: {
    el: ".swiper-pagination-producto-complementario",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});

/* --------------------------------------------- */

var carrouselHeader = new Swiper(".header-slider", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  grab: true,
  centeredSlides: false,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)
  pagination: {
    el: ".swiper-pagination-slider-header",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
  },
});

/* ------------------------------------------ */

var carrosuelProductoSlider = new Swiper(".producto-slider", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  grab: true,
  centeredSlides: false,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)
  pagination: {
    el: ".swiper-pagination-productos",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
  },
});

/* ------------------------------------------ */

var CarrosuelCatalogo = new Swiper(".producto-catalogo", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  grab: true,
  centeredSlides: false,
  initialSlide: 0, // Empieza en el cuarto slide (índice 3)
  pagination: {
    el: ".swiper-pagination-producto-catalogo",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
  },
});



var input = document.querySelector(".input-box");

input.onclick = function() {
this.classList.toggle("open");
let list = this.nextElementSibling;
if (list.style.maxHeight) {
    list.style.maxHeight = null;
    list.style.boxShadow = null;
} else {
    list.style.maxHeight = list.scrollHeight + "px";
    list.style.boxShadow =
    "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
}
};

var rad = document.querySelectorAll(".radio");
rad.forEach((item) => {
item.addEventListener("change", () => {
    input.innerHTML = item.nextElementSibling.innerHTML;
    input.click();
});
});




var inputDistrito = document.querySelector(".input-box-distrito");
inputDistrito.onclick = function () {
  this.classList.toggle("open-distrito");
  let listDistrito = this.nextElementSibling;
  if (listDistrito.style.maxHeight) {
    listDistrito.style.maxHeight = null;
    listDistrito.style.boxShadow = null;
  } else {
    listDistrito.style.maxHeight = listDistrito.scrollHeight + "px";
    listDistrito.style.boxShadow =
      "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
  }
};

var radDistrito = document.querySelectorAll(".radio-distrito");
radDistrito.forEach((item) => {
  item.addEventListener("change", () => {
    inputDistrito.innerHTML = item.nextElementSibling.innerHTML;
    inputDistrito.click();
  });
});




var inputProvincia = document.querySelector(".input-box-provincia");
inputProvincia.onclick = function () {
  this.classList.toggle("open-provincia");
  let listProvincia = this.nextElementSibling;
  if (listProvincia.style.maxHeight) {
    listProvincia.style.maxHeight = null;
    listProvincia.style.boxShadow = null;
  } else {
    listProvincia.style.maxHeight = listProvincia.scrollHeight + "px";
    listProvincia.style.boxShadow =
      "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
  }
};

var radProvincia = document.querySelectorAll(".radio-provincia");
radProvincia.forEach((item) => {
  item.addEventListener("change", () => {
    inputProvincia.innerHTML = item.nextElementSibling.innerHTML;
    inputProvincia.click();
  });
});






var input = document.querySelector(".input-box");

input.onclick = function () {
  console.log("click");
  this.classList.toggle("open");
  let list = this.nextElementSibling;
  if (list.style.maxHeight) {
    list.style.maxHeight = null;
    list.style.boxShadow = null;
  } else {
    list.style.maxHeight = list.scrollHeight + "px";
    list.style.boxShadow =
      "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
  }
};

var rad = document.querySelectorAll(".radio");
rad.forEach((item) => {
  item.addEventListener("change", () => {
    console.log("change");
    input.innerHTML = item.nextElementSibling.innerHTML;
    input.click();
  });
});



 const cuentas = document.querySelectorAll(".cuentas");
 const depositoCuenta = document.querySelector(".deposito__cuenta");
 const radioInputTarjeta = document.querySelector(".inputVoucher");
 cuentas.forEach((cuenta) => {
   cuenta.addEventListener("click", (e) => {
     if (e.target.classList.contains("inputVoucher")) {
       depositoCuenta.classList.remove("hidden");
     } else {
       depositoCuenta.classList.add("hidden");
     }
   });
 });


