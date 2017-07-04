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
tokenAuth = '';


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
//sem token
$("#btn_no_token").on("click",function(){
  console.log('usando token do formulario');
  var token = {token: $("#form_login input:hidden").val()};
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

// meu usuario com token
$("#btn_user_jwt").on("click",function(){
  console.log(tokenAuth);
  var token = {token:tokenAuth};
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

// lista paginas sem token
$("#btn_page_list").on("click",function(){

  var token =  {token: $("#form_login input:hidden").val()}
  $.ajax({
      url: '/api/pages',
      type: 'GET',
      data:token,
      dataType: 'JSON',
      success: function (data) {
          console.log(data);

      }
  });

});

// lista paginas com token
$("#btn_page_list_jwt").on("click",function(){
  console.log(tokenAuth);
  var token = {token:tokenAuth};
  $.ajax({
      url: '/api/pages',
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
