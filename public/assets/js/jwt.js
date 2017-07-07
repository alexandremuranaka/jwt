$(document).ready(function(){

//masks
$('.cellphone').mask('(00)00000-0000');

token_Auth = '';

//hospital list
function hospitalList(token_Auth){
  console.log("token_Auth "+token_Auth);

  var token = {token:token_Auth};
  $.ajax({
      url: '/api/auth/hospital',
      type: 'POST',
      data:token,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================AUTH==================");
          console.log(data);

      }
  });

}//tuss list
function tussList(token_Auth){
  console.log("token_Auth "+token_Auth);

  var token = {token:token_Auth};
  $.ajax({
      url: '/api/auth/tuss',
      type: 'POST',
      data:token,
      dataType: 'JSON',
      success: function (data) {
      console.log("=================TUSS==================");
          console.log(data);

      }
  });

}

//login
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
            tussList(token_Auth);
          }
      }
  });
})


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
