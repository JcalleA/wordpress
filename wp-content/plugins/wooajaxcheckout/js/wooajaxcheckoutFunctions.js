let countryKeys;
let countryList;
let citiesList;
let citiesKeys

jQuery(document).ready(function ($) {
  $.ajax({
    url: pro_checkout_var.url,
    type: "GET",
    dataType: "json",
    data:
      "action=" + pro_checkout_var.action + "&nonce=" + pro_checkout_var.nonce,
    method: "GET",
    timeout: 3000,
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
        '<select required id="citySelected" class=" checkoutInpuSelect w-[87%] text-center rounded-md" ><option value="Seleccionar Departamento" >Seleccionar Departamento</option>';

      for (let index = 0; index < countryKeys.length; index++) {
        const element = countryKeys[index];
        const elem = countryList[country][element];
        options += `<option key=${elem} value=${countryKeys[index]}>${elem}</option>`;
      }
      options += "</select>";

      $("#citiesOptions").html(options);
      $("#citySelected").change(function (e) {
        e.preventDefault();
        loadOptions2();
      });
    } else if (country === "Seleccionar Pais") {
      $("#citiesOptions").html(
        '<select required " class=" checkoutInpuSelect w-[87%] text-center rounded-md" ></select>'
      );
    } else {
      $("#citiesOptions").html(
        '<input class="checkoutInpuSelect w-[87%] text-center rounded-md" required type="text" placeholder="Departamento" name="Ciudad"  />'
      );
      $("#citiesSelect").html(
        '<input class="checkoutInpuSelect w-[87%] text-center rounded-md" required type="text" placeholder="Cuidad" name="Ciudad"  />'
      );
    }
  }

  $("#countrySelect").change(function (e) {
    e.preventDefault();
    loadOptions();
  });

  function loadOptions2() {
    
    let city = $("#citySelected").val();
    let country = $("#countrySelect").val();
    console.log('====================================');
      console.log(citiesList[country][city]);
      console.log('====================================');

    if (city != "Seleccionar Departamento" && citiesList[country][city]) {
      
      let options =
        '<select required id="citySelected" class=" checkoutInpuSelect w-[87%] text-center rounded-md" ><option value="Seleccionar Pais" >Seleccionar Ciudad</option>';

      for (let index = 0; index < citiesList[country][city].length; index++) {
        const element = citiesList[country][city][index];
        
        options += `<option key=${element} value=${element}>${element}</option>`;
      }
      options += "</select>";

      $("#citiesSelect").html(options);
    } else if (city === "Seleccionar Departamento") {
      $("#citiesSelect").html(
        '<select required " class=" checkoutInpuSelect w-[87%] text-center rounded-md" ></select>'
      );
    } else {
      
      $("#citiesSelect").html(
        '<input class="checkoutInpuSelect w-[87%] text-center rounded-md" required type="text" placeholder="Cuidad" name="Ciudad"  />'
      );
    }
  }

  



});
