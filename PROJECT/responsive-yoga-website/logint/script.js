$(document).ready(function () {
  $(".veen .rgstr-btn button").click(function () {
    $(".veen .wrapper").addClass("move");
    $(".body").css("background", "linear-gradient(to right, #7657f1, #c892d6)");
    $(".veen .login-btn button").removeClass("active");
    $(this).addClass("active");
  });
  $(".veen .login-btn button").click(function () {
    $(".veen .wrapper").removeClass("move");
    $(".body").css("background", "linear-gradient(to right, #c892d6, #7657f1)");
    $(".veen .rgstr-btn button").removeClass("active");
    $(this).addClass("active");
  });
});
