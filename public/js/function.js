 // app,js--------------------------------------------------------
document.addEventListener("DOMContentLoaded", function () {
    onSelectColor();
    onSelectTalla();
  
    const checks = document.querySelectorAll(".onCheck");
  
    checks.forEach((check) => {
      check.addEventListener("click", () => {
        if (check.checked) {
          checks.forEach((otherCheck) => {
            if (otherCheck !== check) {
              otherCheck.checked = false;
            }
          });
  
          // Marcar el check actual
          check.checked = true;
        } else {
          // Desmarcar todos los checks excepto el actual
          check.checked = false;
        }
      });
    });
  });
  
  function onSelectColor() {
    const colors = document.querySelectorAll(".colors");
    colors.forEach((color) => {
      color.addEventListener("click", (e) => {
        if (!e.target.classList.contains("color")) {
          colors.forEach((c) => {
            c.classList.remove("color");
          });
  
          e.target.classList.add("color");
        }
      });
    });
  }

  function onSelectTalla() {
    const tallasombra = document.querySelectorAll(".tallasombreado");
    
    tallasombra.forEach((talla) => {
      talla.addEventListener("click", (e) => {
        if (!e.target.classList.contains("talla")) {
          tallasombra.forEach((c) => {
            c.classList.remove("talla");
          });
  
          e.target.classList.add("talla");
        }
      });
    });
  }
  
  function mostrarContrasena() {
    var campo = document.getElementById("contrasena");
  
    if (campo.type === "password") {
      campo.type = "text";
    } else {
      campo.type = "password";
    }
  }
  
  /* dropdown header */
  const menuCollection = document.querySelector(".menu__desplegable-collection");
  const menuCategorias = document.querySelector(".menu__desplegable-categorias");
  const flechaSVG = document.querySelector(".flecha");
  
  const toggleDropdownCategorias = document.querySelector(
    ".toggleDropdownCategorias"
  );
  
  const toggleDropdownCollection = document.querySelector(
    ".toggleDropdownCollection"
  );
  
  if(toggleDropdownCategorias !== null){
    toggleDropdownCategorias.addEventListener("click", (e) => {
      if (menuCollection.classList.contains("active")) {
        menuCollection.classList.remove("active");
      }
      menuCategorias.classList.toggle("active");
    });
  }
  
  if(toggleDropdownCategorias !== null){ 
    toggleDropdownCollection.addEventListener("click", (e) => {
    if (menuCategorias.classList.contains("active")) {
      menuCategorias.classList.remove("active");
    }
    menuCollection.classList.toggle("active");
  }); }
  
  
  function preventDefaultAction(event) {
    event.preventDefault();
    var url = event.currentTarget.getAttribute("href");
    window.location.href = url;
  }
  
  const bagInput = document.querySelector(".bag__modal");
  if(bagInput !== null){
    bagInput.addEventListener("click", () => {
      menuCategorias.classList.remove("active");
      menuCollection.classList.remove("active");
    });
    
  }
  

 // dropdown,js--------------------------------------------------------

  var input = document.querySelector(".input-box");
  if(input !== null){
    input.onclick = function () {
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
  }



var rad = document.querySelectorAll(".radio");
rad.forEach((item) => {
  item.addEventListener("change", () => {
    input.innerHTML = item.nextElementSibling.innerHTML;
    input.click();
  });
});

 // dropdownDepartment,js--------------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
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
  });


 // dropdownDistrict,js--------------------------------------------------------

  document.addEventListener("DOMContentLoaded", function () {
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
  });

 // dropdownProvince,js--------------------------------------------------------


  document.addEventListener("DOMContentLoaded", function () {
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
  });


 // ebabledDropdown,js--------------------------------------------------------


  document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", () => {
      const depa = document.querySelector(".open");
      const prov = document.querySelector(".open-provincia");
      const dist = document.querySelector(".open-distrito");
  
      const list = document.querySelector(".list");
      const listDistrito = document.querySelector(".list-distrito");
      const listProvincia = document.querySelector(".list-provincia");
  
      if (depa !== null && depa.classList.contains("open")) {
        if (dist) {
          listDistrito.style.maxHeight = null; // Quita la altura
          listDistrito.style.boxShadow = null; // Quita la sombra
          dist.classList.remove("open-distrito"); // Coloca la flecha en su estado inicial
        }
  
        if (prov) {
          listProvincia.style.maxHeight = null;
          listProvincia.style.boxShadow = null;
          prov.classList.remove("open-provincia");
        }
      }
      if (prov !== null && prov.classList.contains("open-provincia")) {
        if (dist) {
          listDistrito.style.maxHeight = null; // Quita la altura
          listDistrito.style.boxShadow = null; // Quita la sombra
          dist.classList.remove("open-distrito"); // Coloca la flecha en su estado inicial
        }
  
        if (depa) {
          list.style.maxHeight = null;
          list.style.boxShadow = null;
          depa.classList.remove("open");
        }
      }
  
      if (dist !== null && dist.classList.contains("open-distrito")) {
        if (prov) {
          listProvincia.style.maxHeight = null; // Quita la altura
          listProvincia.style.boxShadow = null; // Quita la sombra
          dist.classList.remove("open-provincia"); // Coloca la flecha en su estado inicial
        }
  
        if (depa) {
          list.style.maxHeight = null;
          list.style.boxShadow = null;
          depa.classList.remove("open");
        }
      }
    });
  });

 // modalCarrito,js--------------------------------------------------------

  document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.getElementById("check");
    const bag = document.querySelector(".bag");
    const bodyModalCarrito = document.querySelector(".body");
    let isMenuOpen = false; // Variable para controlar el estado del menú
    const card = document.querySelector(".cartContainer");
    checkbox.addEventListener("click", checkboxOnClick);
  
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
      if (
        isMenuOpen &&
        !bag.contains(event.target) &&
        event.target !== checkbox
      ) {
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
  });


 // modalEditar,js--------------------------------------------------------


  document.addEventListener("DOMContentLoaded", function () {
    const openModal = document.querySelectorAll(".mostrar-mas");
    const modal = document.querySelector(".modal-mostrar");
    const closeModal = document.querySelectorAll(".modal__close-mostrar");
    const body = document.querySelector(".body");
  
    openModal.forEach((open) => {
      open.addEventListener("click", (e) => {
        e.preventDefault();
  
        modal.classList.add("modal--show");
        body.classList.add("overflow-hidden");
        modal.style.display = "flex";
      });
    });
  
    closeModal.forEach((close) => {
      close.addEventListener("click", (e) => {
        e.preventDefault();
        modal.classList.remove("modal--show");
        body.classList.remove("overflow-hidden");
      });
    });
  
    // Función para cerrar el modal
    /* function closeModa(event) {
      console.log(event.target);
      if (event.target === modal) {
        modal.classList.remove("modal--show");
        body.classList.remove("overflow-hidden");
      }
    } */
  
    window.addEventListener("click", closeModa);
  });


 // modalFiltro,js--------------------------------------------------------


  document.addEventListener("DOMContentLoaded", function () {
    // Captura el click de abrir
    /*  const openModal = document.querySelector(".mostrar-modal"); */
    // Captura al modal que se quiere mostrar
    const modal = document.querySelector(".modal-filtros");
    //Captura el evento de cierre
    const closeModal = document.querySelector(".modal__close-filtro");
    // Captura el body para bloqueo
    const body = document.querySelector(".body");
  
    const hiddenCategoriaPrecio = document.querySelector(
      ".hidden-categoria-precio"
    );
  
    const open = document.querySelector(".open");
    const showCategoriaPrecio = document.querySelector(".show-categoria-precio");
    const addCategoriaPrecio = document.querySelector(".addCategoriaPrecio");
    let openModal = null;
  
    function getWidth() {
      // Corregir el modal !importante
      let width = window.innerWidth;
      if (width < 768) {
        //Habilita el click para modal
        open.classList.add("mostrar-modal", "cursor-pointer");
        openModal = document.querySelector(".mostrar-modal");
        openModal.addEventListener("click", showModal);
        hiddenCategoriaPrecio.innerHTML = "";
      } else {
        onSelectColor();
        // Quita la opcion de click
        open.classList.remove("mostrar-modal", "cursor-pointer");
        if (openModal) {
          openModal.removeEventListener("click", showModal);
          showCategoriaPrecio.classList.remove("hidden");
  
          /* hiddenCategoriaPrecio.innerHTML = showCategoriaPrecio.innerHTML; */
          hiddenCategoriaPrecio.appendChild(showCategoriaPrecio);
        }
      }
    }
  
    function showModal(e) {
      e.preventDefault();
  
      addCategoriaPrecio.innerHTML = showCategoriaPrecio.innerHTML;
      hiddenCategoriaPrecio.innerHTML = "";
  
      modal.classList.add("modal--show-filtro");
      body.classList.add("overflow-hidden");
  
      modal.style.display = "flex";
      onSelectColor();
    }
  
    getWidth(); // Se ejecuta por primera vez
    window.addEventListener("resize", getWidth);
  
    closeModal.addEventListener("click", (e) => {
      e.preventDefault();
      modal.classList.remove("modal--show-filtro");
      body.classList.remove("overflow-hidden");
    });
  
    // Función para cerrar el modal
    function closeModa(event) {
      if (event.target === modal) {
        modal.classList.remove("modal--show-filtro");
        body.classList.remove("overflow-hidden");
  
        /* hiddenCategoriaPrecio.innerHTML = addCategoriaPrecio.innerHTML; */
      }
    }
  
    function onSelectColor() {
      const colors = document.querySelectorAll(".colors");
      colors.forEach((color) => {
        color.addEventListener("click", (e) => {
          if (!e.target.classList.contains("color")) {
            colors.forEach((c) => {
              c.classList.remove("color");
            });
  
            e.target.classList.add("color");
          }
        });
      });
    }
  
    window.addEventListener("click", closeModa);
  
    /* COLORES */
  });
  
 // sliderProductos,js--------------------------------------------------------


  document.addEventListener("DOMContentLoaded", () => {
    var sliderProductos = new Swiper(".slider-productos", {
      slidesPerView: 4,
      spaceBetween: 20,
      loop: true,
      grab: true,
      centeredSlides: false,
      initialSlide: 0, // Empieza en el cuarto slide (índice 3) */
  
      //allowSlideNext: false,  //Bloquea el deslizamiento hacia el siguiente slide
      //allowSlidePrev: false,  //Bloquea el deslizamiento hacia el slide anterior
      allowTouchMove: true, // Bloquea el movimiento táctil
      /* autoplay: {
        delay: 1500,
        disableOnInteraction: false,
      }, */
      breakpoints: {
        0: {
          slidesPerView: 2,
          centeredSlides: true,
        },
        768: {
          slidesPerView: 3,
          centeredSlides: false,
        },
        1024: {
          slidesPerView: 4,
          centeredSlides: false,
        },
      },
    });
  });