$(document).ready(function () {
  $("#registerForm").submit(function (e) {
    e.preventDefault();

    $("#errorMessage").addClass("hidden").text("");
    $("#errorMessageUser").addClass("hidden").text("");

    const password = $("#password").val();

    if (password.length < 6) {
      $("#errorMessage")
        .removeClass("hidden")
        .text("Password must be at least 6 characters long.");
      return;
    }

    $.ajax({
      type: "POST",
      url: "../routes/index.php",
      data: $(this).serialize() + "&action=register",
      success: function (response) {
        try {
          const res = JSON.parse(response);
          if (res.status === "success") {
            Swal.fire({
              position: "center",
              title: "Registered Successfully",
              confirmButtonText: "OK",
              customClass: {
                confirmButton:
                  "bg-blue-500 text-white border-none py-2 px-4 h-full rounded transition duration-200 hover:bg-blue-700",
              },
            }).then(() => {
              window.location.href = "login.php";
            });
          } else if (res.message === "User already exists.") {
            $("#errorMessageUser").removeClass("hidden").text(res.message);
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
            });
          }
        } catch (error) {
          console.error("Error parsing JSON:", error);
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      },
    });
  });

  $("#loginForm").submit(function (e) {
    e.preventDefault();

    $("#errorMessage").addClass("hidden").text("");

    const password = $("#password").val();

    if (password.length < 6) {
      $("#errorMessage")
        .removeClass("hidden")
        .text("Password must be at least 6 characters long.");
      return;
    }
    $.ajax({
      type: "POST",
      url: "../routes/index.php",
      data: $(this).serialize() + "&action=login",
      success: function (response) {
        try {
          const res = JSON.parse(response);
          if (res.status === "success") {
            window.location.href = res.redirect;
          } else {
            $("#errorMessage").removeClass("hidden").text(res.message);
          }
        } catch (error) {
          console.error("Error parsing JSON:", error);
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      },
    });
  });

  $("#onboardForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "../routes/index.php",
      data: $(this).serialize() + "&action=onboard",
      success: function (response) {
        try {
          const res = JSON.parse(response);
          if (res.status === "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Profile has been saved.",
              showConfirmButton: false,
              timer: 1500,
            });
            setTimeout(() => {
              window.location.href = "dashboard.php";
            }, 2000);
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
            });
          }
        } catch (error) {
          console.error("Error parsing JSON:", error);
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      },
    });
  });

  $("#updateProfileForm").submit(function (e) {
    e.preventDefault();

    $("#updateErrorMessage").addClass("hidden").text("");

    $.ajax({
      type: "POST",
      url: "../routes/index.php",
      data: $(this).serialize() + "&action=updateProfile",
      success: function (response) {
        try {
          const res = JSON.parse(response);
          if (res.status === "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Profile updated successfully.",
              showConfirmButton: false,
              timer: 1500,
            });
          } else {
            $("#updateErrorMessage")
              .removeClass("hidden")
              .text(res.message || "Failed to update profile.");
          }
        } catch (error) {
          console.error("Error parsing JSON:", error);
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      },
    });
  });

  $("#changePasswordForm").submit(function (e) {
    e.preventDefault();

    $("#changePasswordError").addClass("hidden").text("");

    $.ajax({
      type: "POST",
      url: "../routes/index.php",
      data: $(this).serialize() + "&action=changePassword",
      success: function (response) {
        const res = JSON.parse(response);
        if (res.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Password changed successfully!",
          });
        } else {
          $("#changePasswordError").removeClass("hidden").text(res.message);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      },
    });
  });

  $("#assignmentForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "../routes/index.php",
      data: $(this).serialize() + "&action=assignTasksToAllStudents",
      success: function (response) {
        try {
          const res = JSON.parse(response);
          if (res.status === "success") {
            Swal.fire({
              icon: "success",
              title: res.message,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: res.message,
            });
          }
        } catch (error) {
          console.error("Error parsing JSON:", error);
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      },
    });
  });

  $(document).on("click", ".mark-done", function () {
    var assignmentId = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "../routes/index.php",
      data: {
        action: "markAssignmentAsDone",
        assignment_id: assignmentId,
      },
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status === "success") {
          Swal.fire({
            icon: "success",
            title: res.message,
            timer: 1500,
          }).then(() => {
            location.reload(); // Reload the page to update the assignments
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: res.message,
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      },
    });
  });
  $(document).ready(function () {
    $("#batchDeleteForm").submit(function (e) {
      e.preventDefault();

      const selectedAssignments = $('input[name="assignment_ids[]"]:checked');
      if (selectedAssignments.length === 0) {
        Swal.fire({
          icon: "warning",
          title: "No assignments selected",
          text: "Please select at least one assignment to delete.",
        });
        return;
      }

      $.ajax({
        type: "POST",
        url: "../routes/index.php",
        data: $(this).serialize() + "&action=batchDeleteAssignments",
        success: function (response) {
          try {
            const res = JSON.parse(response);
            if (res.status === "success") {
              Swal.fire({
                icon: "success",
                title: res.message,
                timer: 1500,
              }).then(() => {
                location.reload(); // Reload the page to reflect changes
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: res.message,
              });
            }
          } catch (error) {
            console.error("Error parsing JSON:", error);
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("AJAX Error:", textStatus, errorThrown);
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        },
      });
    });
  });
});
