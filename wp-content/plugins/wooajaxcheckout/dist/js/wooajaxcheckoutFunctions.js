let r,l,i;jQuery(document).ready(function(e){e(".single_add_to_cart_button").each(function(){e(this).html('Compra Ahora </br><span class="  !text-xs" >Paga En Casa</span><i class=" ml-2 text-lg bi bi-house-heart-fill"></i>'),e(this).removeAttr("type"),e(this).addClass("leading-3 "),e(this).click(function(t){t.preventDefault(),e("#wooajaxcheckout").toggleClass("hidden")})}),e("#btnCloseCheckout").click(function(t){t.preventDefault(),e("#wooajaxcheckout").toggleClass("hidden")}),e("#btnSample").click(function(t){t.preventDefault(),e("#wooajaxcheckout").toggleClass("hidden")});function s(){let t=e("#WooFormDepartment").val(),o=e("#countrySelect").val();if(t!="Seleccionar Departamento"&&i[o][t]){let n='<select required name="Ciudad" id="WooFormCitie" class=" checkoutInpuSelect text-center " ><option value="Seleccionar Pais" >Seleccionar Ciudad</option>';for(let c=0;c<i[o][t].length;c++){const a=i[o][t][c];n+=`<option key=${a} value=${a}>${a}</option>`}n+="</select>",e("#WooFormCities").html(n)}else t==="Seleccionar Departamento"?e("#citiesSelect").html('<select required id="WooFormCitie" name="Ciudad" class=" checkoutInpuSelect text-center " ></select>'):e("#citiesSelect").html('<input id="WooFormCitie" class="checkoutInpuSelect text-center " required type="text" placeholder="Cuidad" name="Ciudad"  />')}e.ajax({url:pro_checkout_var.url,type:"GET",dataType:"json",data:"action="+pro_checkout_var.action+"&nonce="+pro_checkout_var.nonce,method:"GET",cache:!1,success:function(t){l=t.states,i=t.places},error:function(t,o){console.log("===================================="),console.log(o),console.log("===================================="),console.error(t+": "+o)}});function u(){let t=e("#countrySelect").val();if(t!="Seleccionar Pais"&&l[t]){r=Object.keys(l[t]);let o='<select required name="Departamento" id="WooFormDepartment" text-center "  class=" checkoutInpuSelect w-[100%] text-center rounded-md" ><option value="Seleccionar Departamento" >Seleccionar Departamento</option>';for(let n=0;n<r.length;n++){const c=r[n],a=l[t][c];o+=`<option key=${a} value=${r[n]}>${a}</option>`}o+="</select>",e("#WooFormDepartments").html(o),e("#WooFormDepartment").change(function(n){n.preventDefault(),s()})}else t==="Seleccionar Pais"?(e("#WooFormDepartments").html('<select required name="Departamento" " class=" checkoutInpuSelect text-center " ></select>'),e("#WooFormCities").html('<select required name="Ciudad" " class=" checkoutInpuSelect text-center " ></select>')):(e("#WooFormDepartments").html('<input id="WooFormDepartment" class="checkoutInpuSelect text-center " required type="text" placeholder="Departamento" name="Departamento"  />'),e("#WooFormCities").html('<input id="WooFormCitie" class="checkoutInpuSelect text-center" required type="text" placeholder="Cuidad" name="Ciudad"  />'))}e("#countrySelect").change(function(t){t.preventDefault(),u()}),e(".radioCheckout").each(function(t){t===0&&(e("#SubTotal").text(e("#radio1").text()),e(this).attr("checked",!0),e(this).parent().addClass("border-4 border-green-600 bg-slate-300"),e(this).change(function(o){o.preventDefault(),e(".rarioContainer").each(function(){e(this).removeClass("border-4 border-green-600 bg-slate-300")}),e(this).parent().addClass("border-4 border-green-600 bg-slate-300")})),e(this).change(function(o){o.preventDefault(),e(".rarioContainer").each(function(){e(this).removeClass("border-4 border-green-600 bg-slate-300"),e("#SubTotal").text(e("#radio2").text())}),e(this).parent().addClass("border-4 border-green-600 bg-slate-300")})})});
