jQuery(document).ready(function ($) {
  $(".add_to_cart_button").click(function (event) {
    event.preventDefault();

    var product_id = $(this).data("product_id");
    var quantity = $(this).data("quantity");

    var data = {
      action: "add_to_cart",
      product_id: product_id,
      quantity: quantity,
    };

    $.ajax({
      url: "https://wordpress.org/plugins/woo-ajax-add-to-cart/",
      method: "POST",
      data: data,
      success: function (response) {
        if (response.success) {
          alert("Producto agregado al carrito!");

          // Actualizar el fragmento del carrito
          $(document).trigger("wc_fragment_refresh");
        } else {
          alert("Error al agregar producto al carrito.");
        }
      },
    });
  });
});

jQuery(document).ready(function ($) {
  $(".add_to_cart_button").click(function (event) {
    event.preventDefault();

    var product_id = $(this).data("product_id");
    var quantity = $(this).data("quantity");

    var data = {
      action: "add_to_cart",
      product_id: product_id,
      quantity: quantity,
    };

    $.ajax({
      url: "https://wordpress.org/plugins/woo-ajax-add-to-cart/",
      method: "POST",
      data: data,
      success: function (response) {
        if (response.success) {
          alert("Producto agregado al carrito!");

          // Actualizar el fragmento del carrito
          $(document).trigger("wc_fragment_refresh");
        } else {
          alert("Error al agregar producto al carrito.");
        }
      },
    });
  });
});
