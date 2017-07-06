$(document).ready(function(){

$('.cellphone').mask('(00)00000-0000');

//cadastro
/*
$("#btn_cadastro").on("click",function(event){
  event.preventDefault();

  formData = $("#form_cadastro").serializeArray();
//  var formData = new FormData($("#form_cadastro"));
  console.log("formData");
  console.log(formData);

  $.ajax({
      url: '/api/auth/register',
      type: 'POST',
      data:formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
          console.log(data);
      }
  });


  var user = {
        _token: $("#form_cadastro input:hidden").val(),
        name: $(".cadastro_name").val(),
        email:$(".cadastro_email").val(),
        password: $("#form_cadastro input:password").val()
    }
    console.log(user);
  $.ajax({
      url: '/api/auth/register',
      type: 'POST',
      data:user,
      dataType: 'JSON',
      success: function (data) {
          console.log(data);
      }
  });



});
  */
//login
token_Auth = '';


function hospitalList(token_Auth){
  console.log("token_Auth "+token_Auth);

  var token = {token:token_Auth};
  $.ajax({
      url: '/api/auth/hospital',
      type: 'POST',
      data:token,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================RECEBIDO==================");
          console.log(data);

      }
  });

}

$("#btn_login").on("click",function(event){
  event.preventDefault();

    login = $("#form_login").serializeArray();
  $.ajax({
      url: '/api/auth/login',
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
          }
      }
  });
})

/*
$("#btn_login").on("click",function(event){
  event.preventDefault();

    login = $("#form_login").serializeArray();
  $.ajax({
      url: 'http://www.api.bymdes.com.br/api/auth/login',
      type: 'POST',
      data:login,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================RECEBIDO==================");
          console.log(data);
          if( data['token'])
          {
            $("#logged").addClass("show");
            tokenAuth = data['token'];
          }
      }
  });
})
*/

// meu usuario com token
$("#btn_user_jwt").on("click",function(){
  console.log(token_Auth);
  var token = {token:token_Auth};
  $.ajax({
      url: '/api/user',
      type: 'GET',
      data:token,
      dataType: 'JSON',
      success: function (data) {
          console.log(data);

      }
  });

});

// lista usuers com token
$("#btn_user_list_jwt").on("click",function(){
  console.log(tokenAuth);
  var token = {token:tokenAuth};
  $.ajax({
      url: '/api/allusers',
      type: 'GET',
      data:token,
      dataType: 'JSON',
      success: function (data) {
          console.log(data);

      }
  });

});



//end of jquery document
});
