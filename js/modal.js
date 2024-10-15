//ボタンを押したらモーダルが出現
function buttonClick() {
    $(".modal").fadeIn();
    $("html").addClass("fixed"); // 背景固定させるクラス付与
  }
  
  $(".popup-close").on("click", function () {
    $("html").removeClass("fixed"); // 背景固定させるクラス付与
    $(".modal").fadeOut();
    return false;
  });