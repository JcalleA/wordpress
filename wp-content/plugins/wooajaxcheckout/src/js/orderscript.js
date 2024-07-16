jQuery(document).ready(function ($) {


  $('#WooAjaxForm').submit(function (e) { 
    e.preventDefault();
    var nombre=$('#first_name').val();
    console.log('====================================');
    console.log($(this).serializeArray());
    console.log('====================================');
    $.ajax({
      type: "POST",
      url: OrderScriptVar.url,
      dataType: "json",
      data:{
        action: OrderScriptVar.action,
        nonce:OrderScriptVar.nonce,
        form:$(this).serializeArray(),
      },
      complete: function (response) {
        
        console.log('===============response=====================');
        console.log(response);
        console.log('====================================');
        
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