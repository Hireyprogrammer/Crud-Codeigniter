$("#saveUser").click(function () {
  var formData = {
    name: $("#username").val(),
    email: $("#email").val(),
    phone: $("#phone").val(),
  };

  $.ajax({
    url: "/users/save",
    type: "POST",
    data: formData,
    success: function (response) {
      if (response.success) {
        alert("User saved successfully!");
        $("#userModal").modal("hide");
        $("#userForm")[0].reset();
      } else {
        alert("Error saving user: " + response.message);
      }
    },
    error: function () {
      alert("Error occurred while saving user");
    },
  });
});
