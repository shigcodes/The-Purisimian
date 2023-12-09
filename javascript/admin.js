$(document).ready(function () {
    const alert = (alertType, message) => {
      $(".alert")
        .css("display", "block")
        .html("<h6>" + message + "</h6>")
        .addClass(alertType);
      setTimeout(() => {
        $(".alert").css("display", "none").html("").removeClass(alertType);
      }, 1000);
    };
  
    //   Add New Article
    $("#openAddArticleModal").click(function (e) {
      $("#AddModal").modal("show");
      e.preventDefault();
    });
  
    $("#frmAddNewArticle").submit(function (e) {
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        type: "POST",
        url: "endpoints/form-submit.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "200") {
            alert("alert-success", "Article Added!");
            $("#AddModal").modal("hide");
            window.location.reload();
          } else {
            alert("alert-danger", response);
          }
        },
      });
    });
  
    //   Edit Article
    $(".btnEdit").click(function (e) {
      e.preventDefault();
      $("#EditArticleCategory").val($(this).data("category"));
      $("#EditArticleTitle").val($(this).data("title"));
      $("#EditArticle").val($(this).data("article"));
      $("#articleId").val($(this).data("id"));
      $("#EditModal").modal("show");
    });
  
    $("#frmEditArticle").submit(function (e) {
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        type: "POST",
        url: "endpoints/form-submit.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);
          if (response == "200") {
            alert("alert-success", "Article Edited!");
            $("#EditModal").modal("hide");
            window.location.reload();
          } else {
            alert("alert-danger", response);
          }
        },
      });
    });
  
    //   Delete Article
    $(".btnDelete").click(function (e) {
      e.preventDefault();
      $("#deleteModal").modal("show");
      $("#btnConfirmDelete").data("id", $(this).data("id"));
    });
  
    $("#btnConfirmDelete").click(function (e) {
      e.preventDefault();
      var id = $(this).data("id");
      $("#deleteModal").modal("hide");
      $.ajax({
        type: "POST",
        url: "endpoints/form-submit.php",
        data: {
          submitType: "DeleteArticle",
          id: id,
        },
        success: function (response) {
          console.log(response);
          if (response == "200") {
            alert("alert-success", "Article Deleted!");
            window.location.reload();
          } else {
            alert("alert-danger", "Something went wrong!");
          }
        },
      });
    });
  });
  