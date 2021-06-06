/*レイアウトの調整全般に関係する処理を書くモジュールです。*/

//ショーケースメニューの開閉
$(function(){
  $(document).on("click",".p-docs_item_overflow",function(){
    if($(this).parents(".p-docs__item").hasClass("is-menu_expanded")){
      $(this).parents(".p-docs__item").removeClass("is-menu_expanded");
    } else {
      $(this).parents(".p-docs__item").addClass("is-menu_expanded");
    }
    
  });
  //メニュー個所以外タッチでメニューを閉じる
  $(document).on('click touchend', function(event) {
    if (!$(event.target).closest('.p-docs_item_overflow,.p-docs__menu').length) {
      $(".p-docs__item").each(function(){
        $(this).removeClass("is-menu_expanded");
      });
    }
  });
});



