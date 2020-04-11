!function(e){var t={};function a(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,a),r.l=!0,r.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)a.d(n,r,function(t){return e[t]}.bind(null,r));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=0)}([function(e,t,a){a(1),e.exports=a(2)},function(e,t){var a;function n(e){$(".customAlert").show(),$(".customAlert").append("<div class='alert alert-danger alert-dismissible fade show' id='errorAlert' role='alert'><strong>"+e+"</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>"),$(".alert-danger").fadeTo(2e3,1e3).slideUp(1e3,(function(){$(".customAlert").empty(),$(".alert-danger").slideUp(1e3)}))}function r(e){$.each(e.errors,(function(e,t){$(".customAlert").show(),$(".customAlert").append("<div class='alert alert-danger alert-dismissible fade show' id='errorAlert' role='alert'><strong>"+t+"</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>")})),$(".alert-danger").fadeTo(2e3,1e3).slideUp(1e3,(function(){$(".customAlert").empty(),$(".alert-danger").slideUp(1e3)}))}function o(e){Swal.fire({type:"error",title:e,showConfirmButton:!1,timer:1500})}function l(e,t){return 0===e.status?o("Not connected.\nPlease verify your network connection."):404==e.status?o("The requested page not found."):401==e.status?o("Sorry!! You session has expired. Please login to continue access."):500==e.status?o("Internal Server Error."):o("parsererror"===t?"Requested JSON parse failed.":"timeout"===t?"Time out error.":"abort"===t?"Ajax request aborted.":"Unknown error occured. Please try again.")}function s(e,t,a,n,r,o){""!=e?$("#"+e).click((function(e){e.preventDefault(),$("#"+t).text(a),$("#"+n).text(r),$("#action").val(o)})):($("#"+t).text(a),$("#"+n).text(r),$("#action").val(o))}$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),a="lecturerModal",$("."+a).on("hidden.bs.modal",(function(){"lecturerModal"==a&&($("input[name=first_name]").val(""),$("input[name=last_name]").val(""),$("input[name=age]").val(""),$("input[name=gender]").prop("checked",!1))})),$(document).ready((function(){$("#big-query").DataTable({processing:!0,serverSide:!0,ajax:"/dashboard/big-query/dataTables",pagingType:"full_numbers",lengthMenu:[[10,25,50,-1],[10,25,50,"All"]],columns:[{data:"name",name:"name"},{data:"gender",name:"gender"},{data:"frequency",name:"frequency"},{data:"year",name:"year"},{data:"action",className:"text-center",orderable:!1,searchable:!1}],responsive:!0,language:{search:"_INPUT_",searchPlaceholder:"Search records"}}),$("#lecturers").DataTable({processing:!0,serverSide:!0,ajax:"/dashboard/employee/dataTables",pagingType:"full_numbers",lengthMenu:[[10,25,50,-1],[10,25,50,"All"]],columns:[{data:"first_name",name:"first_name"},{data:"last_name",name:"last_name"},{data:"gender",name:"gender"},{data:"age",name:"age"},{data:"updated_at",name:"updated_at"},{data:"action",className:"text-center",orderable:!1,searchable:!1}],responsive:!0,language:{search:"_INPUT_",searchPlaceholder:"Search records"}}),s("lecturerTableBtnAdd","lecturerModalLabel","Add new lecturer","lecturerModalButton","Add new","Add"),$("#lecturerModalButton").click((function(e){if(e.preventDefault(),"Add"==$("#action").val()){var t,a=document.getElementById("first_name").value,o=document.getElementById("last_name").value,s=document.getElementById("age").value,i=$("input[name=gender]:checked").val(),d=document.getElementById("phone_number").value,u=document.getElementById("address").value;$.ajax({url:"/dashboard/employee",method:"POST",data:{first_name:a,last_name:o,age:s,gender:i,phone_number:d,address:u},beforeSend:function(){Swal.fire({title:"Sending....",html:'<span class="text-success">Waiting for data to be sent</span>',timer:1e5,onBeforeOpen:function(){Swal.showLoading(),t=setInterval((function(){Swal.getTimerLeft()}),100)}})},success:function(e){Swal.disableLoading(),e.errors?(Swal.close(),r(e)):e.message?(Swal.close(),n(e.message)):($(".lecturerModal").hide(),Swal.close(),clearInterval(t),Swal.fire({type:"success",title:"Success!",html:'<span class="text-success">Your page will be refreshed shortly.</span>',showConfirmButton:!1,timer:1e3}),window.setTimeout((function(){location.reload()}),1e3))},error:function(e,t,a){l(e,a)}})}if("Edit"==$("#action").val()){var c,m=document.getElementById("id").value;a=document.getElementById("first_name").value,o=document.getElementById("last_name").value,s=document.getElementById("age").value,i=$("input[name=gender]:checked").val(),d=document.getElementById("phone_number").value,u=document.getElementById("address").value;$.ajax({url:"/dashboard/employee/update",method:"PUT",data:{id:m,first_name:a,last_name:o,age:s,gender:i,phone_number:d,address:u},beforeSend:function(){Swal.fire({title:"Sending....",html:'<span class="text-success">Waiting for data to be sent</span>',timer:1e5,onBeforeOpen:function(){Swal.showLoading(),c=setInterval((function(){Swal.getTimerLeft()}),100)}})},success:function(e){Swal.disableLoading(),e.errors?(Swal.close(),r(e)):e.message?(Swal.close(),n(e.message)):($(".lecturerModal").hide(),Swal.close(),clearInterval(c),Swal.fire({type:"success",title:"Success!",html:'<span class="text-success">Your page will be refreshed shortly.</span>',showConfirmButton:!1,timer:1e3}),window.setTimeout((function(){location.reload()}),1e3))},error:function(e,t,a){l(e,a)}})}}))})),$(document).on("click",".lecturerEdit",(function(e){e.preventDefault();var t,a=$(this).parent(".lecturerParent"),n=$(a).find(".id").val();$.ajax({url:"/dashboard/employee/edit",method:"GET",dataType:"JSON",data:{id:n},beforeSend:function(){Swal.fire({title:"Sending....",html:'<span class="text-success">Waiting for data to be sent</span>',showConfirmButton:!1,timer:1e5,onBeforeOpen:function(){Swal.showLoading(),t=setInterval((function(){Swal.getTimerLeft()}),100)}})},success:function(e){Swal.disableLoading(),s("","lecturerModalLabel","Updating Lecturer","lecturerModalButton","Update","Edit"),$("#id").val(n),$.each(e,(function(e,a){$("input[value='"+a.gender+"']").prop("checked",!0),$("input[name=first_name]").val(a.first_name),$("input[name=last_name]").val(a.last_name),$("input[name=age]").val(a.age),$("input[name=address]").val(a.address),$("input[name=phone_number]").val(a.phone_number),Swal.close(),$(".lecturerModal").modal("show"),clearInterval(t)}))},error:function(e,t,a){l(e,a)}})})),$(document).on("click",".lecturerRemove",(function(e){e.preventDefault();var t=$(this).parent(".lecturerParent"),a=$(t).find(".id").val();Swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(e){e.value?$.ajax({url:"/dashboard/employee/destroy",method:"DELETE",data:{id:a,_token:$("input[name=_token]").val()},beforeSend:function(){Swal.fire({title:"Sending....",html:'<span class="text-success">Waiting for data to be sent</span>',timer:1e5,onBeforeOpen:function(){Swal.showLoading()}})},success:function(e){Swal.disableLoading(),e.message?Swal.fire({type:"error",title:"Oops!!!",html:'<span class="text-danger">'+e.message+"</span>",showConfirmButton:!1,timer:1e3}):(Swal.fire({type:"success",title:"Successfully delete data!",html:'<span class="text-success">Your page will be refreshed shortly.</span>',showConfirmButton:!1,timer:1e3}),window.setTimeout((function(){location.reload()}),1e3))},error:function(e,t,a){l(e,a)}}):e.dismiss===Swal.DismissReason.cancel&&Swal.fire({type:"info",title:"Your data is safe!",showConfirmButton:!1,timer:1500})}))}))},function(e,t){}]);