jQuery(document).ready(function ($) {


  $('#WooAjaxForm').submit(function (e) { 
    e.preventDefault();
    var nombre=$('#first_name').val();
    
    $.ajax({
      type: "POST",
      url: OrderScriptVar.url,
      dataType: "json",
      data:{
        action: OrderScriptVar.action,
        nonce:OrderScriptVar.nonce,
        form:$(this).serializeArray(),
      },
      beforeSend: function () {
        $("#wooajaxcheckout").toggleClass("hidden");
        $("#wooAjaxCheckLoading").toggleClass("hidden");
      },
      complete: function (response) {
        $("#wooAjaxCheckLoading").toggleClass("hidden");
        var currensy=response.responseJSON.currensy
        var valor=response.responseJSON.valor
        var url=response.responseJSON.url
        var orderid=response.responseJSON.orderid
        var orderkey=response.responseJSON.orderkey
        var productid=response.responseJSON.productid
        try {
          fbq('track', 'Purchase', {
            content_type: 'product',
            value: valor,
            currency: currensy
          });
        } catch (error) {
          window.location.href=`${url}/order-received/${orderid}/?key=${orderkey}`;
        }
        
        window.location.href=`${url}/order-received/${orderid}/?key=${orderkey}`;
        
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
//  function postOrder() {
//   let nombre = $('#first_name').val();
//   let apellido = $('#last_name').val();
//   let pais = $('#countrySelect').val();
//   let departamento = $('#WooFormDepartment').val();
//   let ciudad = $('#WooFormCitie').val();
//   let direccion = $('#address_1').val();
//   let barrio = $('#WooFormBarrio').val();
//   let celular = $('#WooFormCelular').val();
//   let correo = $('#WooFormCorreo').val();
//   $.ajax({
//       url: OrderScriptVar.url,
//       type: "POST",
//       dataType: "json",
//       data: "action=" + OrderScriptVar.action + "&nonce=" + OrderScriptVar.nonce,
//       method: "GET",
//       cache: false,

//       success: function(response) {
//           alert('ok')
//       },
//       error: function(status, error) {
//           console.log("====================================");
//           console.log(error);
//           console.log("====================================");
//           console.error(status + ": " + error);
//       },
//   });
// };