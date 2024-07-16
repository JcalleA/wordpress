let countryKeys;
let countryList;
let citiesList;
let citiesKeys;

jQuery(document).ready(function ($) {
  $(".single_add_to_cart_button").each(function () {
    $(this).html(
      'Compra Ahora </br><span class="  !text-xs" >Paga En Casa</span><i class=" ml-2 text-lg bi bi-house-heart-fill"></i>'
    );
    $(this).removeAttr("type");
    $(this).addClass("leading-3 ");
    $(this).click(function (e) {
      e.preventDefault();

      $("#wooajaxcheckout").toggleClass("hidden");
    });
  });

  $("#btnCloseCheckout").click(function (e) {
    e.preventDefault();

    $("#wooajaxcheckout").toggleClass("hidden");
  });

  function loadOptions2() {
    let department = $("#WooFormDepartment").val();
    let country = $("#countrySelect").val();

    if (
      department != "Seleccionar Departamento" &&
      citiesList[country][department]
    ) {
      let options =
        '<select required name="Ciudad" id="WooFormCitie" class=" checkoutInpuSelect text-center " ><option value="Seleccionar Pais" >Seleccionar Ciudad</option>';

      for (
        let index = 0;
        index < citiesList[country][department].length;
        index++
      ) {
        const element = citiesList[country][department][index];

        options += `<option key=${element} value=${element}>${element}</option>`;
      }
      options += "</select>";

      $("#WooFormCities").html(options);
    } else if (department === "Seleccionar Departamento") {
      $("#citiesSelect").html(
        '<select required id="WooFormCitie" name="Ciudad" class=" checkoutInpuSelect text-center " ></select>'
      );
    } else {
      $("#citiesSelect").html(
        '<input id="WooFormCitie" class="checkoutInpuSelect text-center " required type="text" placeholder="Cuidad" name="Ciudad"  />'
      );
    }
  }

  $.ajax({
    url: pro_checkout_var.url,
    type: "GET",
    dataType: "json",
    data:
      "action=" + pro_checkout_var.action + "&nonce=" + pro_checkout_var.nonce,
    method: "GET",
    cache: false,

    success: function (response) {
      countryList = response["states"];
      citiesList = response["places"];
    },
    error: function (status, error) {
      console.log("====================================");
      console.log(error);
      console.log("====================================");
      console.error(status + ": " + error);
    },
  });

  function loadOptions() {
    let country = $("#countrySelect").val();

    if (country != "Seleccionar Pais" && countryList[country]) {
      countryKeys = Object.keys(countryList[country]);

      let options =
        '<select required name="Departamento" id="WooFormDepartment" text-center "  class=" checkoutInpuSelect w-[100%] text-center rounded-md" ><option value="Seleccionar Departamento" >Seleccionar Departamento</option>';

      for (let index = 0; index < countryKeys.length; index++) {
        const element = countryKeys[index];
        const elem = countryList[country][element];
        options += `<option key=${elem} value=${countryKeys[index]}>${elem}</option>`;
      }
      options += "</select>";

      $("#WooFormDepartments").html(options);

      $("#WooFormDepartment").change(function (e) {
        e.preventDefault();
        loadOptions2();
      });
    } else if (country === "Seleccionar Pais") {
      $("#WooFormDepartments").html(
        '<select required name="Departamento" " class=" checkoutInpuSelect text-center " ></select>'
      );
      $("#WooFormCities").html(
        '<select required name="Ciudad" " class=" checkoutInpuSelect text-center " ></select>'
      );
    } else {
      $("#WooFormDepartments").html(
        '<input id="WooFormDepartment" class="checkoutInpuSelect text-center " required type="text" placeholder="Departamento" name="Departamento"  />'
      );
      $("#WooFormCities").html(
        '<input id="WooFormCitie" class="checkoutInpuSelect text-center" required type="text" placeholder="Cuidad" name="Ciudad"  />'
      );
    }
  }

  $("#countrySelect").change(function (e) {
    e.preventDefault();
    loadOptions();
  });

  $(".radioCheckout").each(function (index) {
    if (index === 0) {
      $("#SubTotal").text($('#radio1').text());
      $(this).attr("checked", true);
      $(this).parent().addClass("border-4 border-green-600 bg-slate-300");
      $(this).change(function (e) {
        e.preventDefault();
        $(".rarioContainer").each(function () {
          $(this).removeClass("border-4 border-green-600 bg-slate-300");
          
        });
        $(this).parent().addClass("border-4 border-green-600 bg-slate-300");
      });
    }
    $(this).change(function (e) {
      e.preventDefault();
      $(".rarioContainer").each(function () {
        $(this).removeClass("border-4 border-green-600 bg-slate-300");
        $("#SubTotal").text($('#radio2').text());
      });
      $(this).parent().addClass("border-4 border-green-600 bg-slate-300");
    });
  });
});
