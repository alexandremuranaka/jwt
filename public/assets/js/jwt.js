$(document).ready(function(){

//masks
$('.cellphone').mask('(00)00000-0000');
$('.date').mask('00-00-0000');

token_Auth = '';
user_id ;
//hospital list
function hospitalList(token_Auth){
  console.log("token_Auth "+token_Auth);

  var token = {token:token_Auth};
  $.ajax({
      url: 'http://api.bymeds.com.br//api/auth/hospital',
      type: 'POST',
      data:token,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================AUTH==================");
          console.log(data);
          $.each(data, function(k,v){
            var hospital = '<option value="'+v['id']+'">'+v['name']+'</option>';
            $(hospital).appendTo($("#hospital_id"));
          });

      }
  });

}//tuss list
function tussList(token_Auth){
  console.log("token_Auth "+token_Auth);

  var token = {token:token_Auth};
  $.ajax({
      url: 'http://api.bymeds.com.br//api/auth/tuss',
      type: 'POST',
      data:token,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================TUSS==================");
      console.log(data);
        $.each(data, function(k,v){
          var tuss = '<option value="'+v['id']+'">'+v['description']+'</option>';
          $(tuss).appendTo($("#tuss_id"));
        });
      console.log($("#tuss_id").children().length);

      }
  });

}

//login
$("#btn_login").on("click",function(event){
  event.preventDefault();

  login = $("#form_login").serializeArray();
  $.ajax({
      url: 'http://api.bymeds.com.br//api/auth/login',
      type: 'POST',
      data:login,
      dataType: 'JSON',
      success: function (data) {
          console.log(data);
          if( data['token']){
            $("#logged").addClass("show");

            token_Auth = data['token'];

            user_data = data['user'];
            user_id = user_data['id'];
            user_name = user_data['name'];
            user_email = user_data['email'];
            user_cellphone = user_data['cellphone'];
            user_photo = user_data['photo'];

            user = '<p><img src="'+user_photo+'" alt="'+user_id+'"/><br/>'+user_name+'<br/>'+user_email+'<br/>'+user_cellphone+'</p>';
            $("#user_data").html(user);
            hospitalList(token_Auth);
            tussList(token_Auth);
            $("#user_id").val(user_id);
            $("#token").val(token_Auth);
          }
      }
  });
})


//procedure register
$("#btn_procedure").on("click",function(){
  event.preventDefault();
  var form_procedure = $("#form_procedure").serializeArray();

  $.ajax({
      url: 'http://api.bymeds.com.br//api/auth/procedures/store',
      type: 'POST',
      data:form_procedure,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================Procedures==================");
        console.log(data);
        alert(data[0]);

      }
  });


});
//procedure list
$("#btn_procedure_list").on("click",function(){
  event.preventDefault();
    var token = {token:token_Auth};
  $.ajax({
      url: 'http://api.bymeds.com.br//api/auth/procedures/'+user_id+'/list',
      type: 'POST',
      data: token,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================Procedures==================");
        console.log(data);

        $(".procedures_list_content").empty();
        $.each(data,function(k,v){
          var procedures = '<tr><td>'+v["user_id"]+'</td><td>'+v["hospital_id"]+'</td><td>'+v["date"]+'</td><td>'+v["tuss_id"]+'</td><td>'+v["member_id"]+'</td><td>'+v["medical_insurance"]+'</td><td>'+v["insurance_type"]+'</td><td>'+v["patient_name"]+'</td><td>'+v["register_number"]+'</td><td>'+v["procedured_number"]+'</td><td>'+v["procedured_comment"]+'</td></tr>';
          $(procedures).appendTo($(".procedures_list_content"));

        });

      }
  });


});

$("#btn_tuss").on("click",function(){

  event.preventDefault();
  var token = {token:token_Auth};
  $.ajax({
      url: 'http://api.bymeds.com.br/api/auth/tuss/a123213123/show',
      type: 'POST',
      data: token,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================TUSS FIND==================");
        console.log(data);


      }
  });

});




//end of jquery document
});
