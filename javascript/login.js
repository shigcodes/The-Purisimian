$(document).ready(function () {
    $("#frmLogin").submit(function (e) {
      e.preventDefault();
      var username = $("#username").val();
      var password = $("#password").val();
      $.ajax({
        type: "POST",
        url: "endpoints/form-submit.php",
        data: {
          submitType: "Login",
          username: username,
          password: password,
        },
        success: function (response) {
          console.log(response);
          if (response == "200") {
            window.location.href = "admin.php";
          } else {
            $(".alert").css("display", "block").html("<h5>Login Failed!</h5>");
            setTimeout(function () {
              $(".alert").css("display", "none").html("");
            }, 1000);
          }
        },
      });
    });
  });
  