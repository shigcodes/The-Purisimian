$(document).ready(function () {
  function containsNumber(inputValue) {
    var regex = /\d/;
    return regex.test(inputValue);
  }

  function validateEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      return false;
    }
    return true;
  }

  function formValidation() {
    var isInvalid = false;
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var email = $("#email").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var zip = $("#zip").val();

    if (firstName == "" || firstName.length < 2 || containsNumber(firstName)) {
      console.log("Invalid First Name");
      $("#firstName").addClass("is-invalid");
      isInvalid = true;
    }

    if (lastName == "" || lastName.length < 3 || containsNumber(lastName)) {
      console.log("Invalid Last Name");
      $("#lastName").addClass("is-invalid");
      isInvalid = true;
    }

    if (!validateEmail(email)) {
      $("#email").addClass("is-invalid");
      isInvalid = true;
    }

    if (city == null) {
      $("#city").addClass("is-invalid");
      isInvalid = true;
    }

    if (state == null) {
      $("#state").addClass("is-invalid");
      isInvalid = true;
    }

    if (zip.length < 4) {
      $("#zip").addClass("is-invalid");
      isInvalid = true;
    }

    if (!$("#terms").prop("checked")) {
      $("#terms").addClass("is-invalid");
      isInvalid = true;
    }

    return isInvalid;
  }

  let isNavOpen = false;
  $("#navButton").click(function (e) {
    e.preventDefault();
    console.log("clicked");
    if (isNavOpen) {
      $(".nav-ul").css("transform", "translateX(-100%)");
      $("#navButtonIcon").removeClass("fa-x");
      $("#navButtonIcon").addClass("fa-bars");
    } else {
      $(".nav-ul").css("transform", "translateX(0)");
      $("#navButtonIcon").removeClass("fa-bars");
      $("#navButtonIcon").addClass("fa-x");
    }
    isNavOpen = !isNavOpen;
  });

  $("#form").submit(function (e) {
    e.preventDefault();
    if (!formValidation()) {
      alert("Form Submitted");
      location.reload();
    }
  });

  $(
    ".input-container input, .input-container select, .input-checkbox input"
  ).on("input change change", function () {
    $(this).removeClass("is-invalid");
  });

  //----

  for (var i = 1; i <= 13; i++) {
    var imageContainer = $("<div class='card single-image-container'>");
    var image = $("<img src='assets/about/" + i + ".jpeg'>");
    var button = $(
      "<button class='btn btn-view-profile'>View Profile</button>"
    );
    $(imageContainer).append(image);
    $(imageContainer).append(button);
    $("#imgContainer").append(imageContainer);
  }
});
