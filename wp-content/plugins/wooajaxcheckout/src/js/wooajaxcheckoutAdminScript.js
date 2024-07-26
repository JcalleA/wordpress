jQuery(document).ready(function ($) {
  const listaIcons = [
    "bi bi-house-check-fill",
    "bi bi-house-door",
    "bi bi-house-heart-fill",
    "bi bi-house",
  ];
  var btnsubtitle = $("#btnsubtitle").val();
  var btntextcolor = $("#btntextcolor").val();
  var btnbordercolor = $("#btnbordercolor").val();
  var btncolor = $("#btncolor").val();
  var btnanimated = $("#btnanimated").val();
  var btnborder = $("#btnborder").val();
  var btnicon = $("#btnicon i").attr("id");

  if (btnanimated) {
    $("#btnSample").addClass("animate-btn_saltar");
  }

  $("#btnSample").css("background-color", btncolor);
  $("#btnSample").css("color", btntextcolor);
  $("#btnSample").css("border-color", btnbordercolor);
  $("#btnSample").css("border-width", btnborder);

  $("#btntitle").on("input", function () {
    $("#btnSample").html(
      $(this).val() +
        ` <br> <span id='btnSampleSubtitle' class= '!text-xs'>  ${btnsubtitle} </span></span><span id="btnicon"> </span>`
    );
    $("#btnicon").html(`<label>
      <input  name='btnicon' class='peer  !hidden' type='radio' value=$btnicon />
      <i id=wooIcon$btnicon class= 'mt-1 peer peer-checked:border-2 peer-checked:border-green-600 peer-checked:rounded-lg ml-2 text-lg ${
        listaIcons[$("#" + btnicon).val() - 1]
      }'></i>
  </label>`);
  });

  $("#btnsubtitle").on("input", function () {
    $("#btnSampleSubtitle").text($(this).val());
  });

  $("#btntextcolor").on("input", function () {
    $("#btnSample").css("color", $(this).val());
    $("#btnSample").css("border-color", $(this).val());
  });

  $("#btnborder").on("input", function () {
    $("#btnSample").css("border-width", $(this).val());
  });

  $("#btnbordercolor").on("input", function () {
    $("#btnSample").css("border-color", $(this).val());
  });

  $("#btncolor").on("input", function () {
    $("#btnSample").css("background-color", $(this).val());
  });

  $("#btnanimated").on("input", function () {
    if ($(this).val() === "true") {
      $("#btnSample").addClass("animate-btn_saltar");
    } else {
      $("#btnSample").removeClass("animate-btn_saltar");
    }
  });

  $(".peer").each(function () {
    $(this).on("input", function () {
      $("#btnicon").html(`<label>
      <input  name='btnicon' class='peer  !hidden' type='radio' value=$btnicon />
      <i id=wooIcon$btnicon class= 'mt-1 peer peer-checked:border-2 peer-checked:border-green-600 peer-checked:rounded-lg ml-2 text-lg ${
        listaIcons[$(this).val() - 1]
      }'></i>
  </label>`);
    });
  });

  $("#" + btnicon).attr("checked", true);

  


  $("#formOfSetings").submit(function (e) {
    e.preventDefault();
    
    $.ajax({
      type: "POST",
      url: WooOfSetings_var.url,
      dataType: "json",
      data: {
        action: WooOfSetings_var.action,
        nonce: WooOfSetings_var.nonce,
        form: $(this).serializeArray(),
      },
      beforeSend: function(){
        $('#wooAjaxCheckLoading').toggleClass('hidden');
        
      },
      complete: function (response) {
        $('#wooAjaxCheckLoading').toggleClass('hidden');
        location.href =location.href
        
        alert('Guardado correctamente')
      },
      error: function (status, error) {
        console.log("====================================");
        console.log(error);
        console.log("====================================");
        console.error(status + ": " + error);
      },
    });
  });

  $("#ofproductinit").on("input", function () {
    location.href =location.href +'&ofproductid='+$(this).val();
  });

  $("#BtnSetingsForm").submit(function (e) {
    e.preventDefault();
    
    $.ajax({
      type: "POST",
      url: WooAdmin_var.url,
      dataType: "json",
      data: {
        action: WooAdmin_var.action,
        nonce: WooAdmin_var.nonce,
        form: $(this).serializeArray(),
      },
      beforeSend: function(){
        $('#wooAjaxCheckLoading').toggleClass('hidden');
        
      },
      complete: function (response) {
        $('#wooAjaxCheckLoading').toggleClass('hidden');
        
        alert('Guardado correctamente')
      },
      error: function (status, error) {
        console.log("====================================");
        console.log(error);
        console.log("====================================");
        console.error(status + ": " + error);
      },
    });
  });
  
});
