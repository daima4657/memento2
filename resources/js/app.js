/*コントローラーとのやり取りを書くモジュールです。*/

import Vue from 'vue'
import dio from './components/dio'
import bookcell from './components/bookcell'

/*vueコンポーネント設定*/

Vue.component('sample-like', require('./components/SampleLike').default);

const app = new Vue({
  el: '#app',
  components: {
    dio,
    bookcell,
  }
})

const app_book = new Vue({
  el: '#app',
  components: {
    bookcell,
  }
})


require('./bootstrap');






/*共通設定*/
var meta_csrf = document.getElementsByName ('csrf-token').item(0).content;/*csrfトークンをコピる*/




/*ショーケースの追加ボタンを押した時*/

$(document).on('click','.js-create_showcase_button',function(){
  loadingStart();
  var form = $('#createShowCaseForm').get()[0];

  var ary_lists ={
    message: "ショーケースを作成しました！",
  }
 
  ajaxSetter('/ajax_showcase_add',form,ary_lists,"showcase").then(function (value) {
  }).catch(function (error) {
  }).finally(function (error) {
    loadingEnd();
  });
});

/*ショーケースの削除ボタンを押した時*/

$(document).on('click','.js-ajax_delete_showcase',function(event){
  console.log("delete");
  event.preventDefault();
  var id = $(this).data('id');
  var res = confirm("選択したアイテムを削除しますか？");
  if(res == true){
    ajaxRemover('/ajax_remove_showcase','ty',id);
  } else {
  }
  //
});



/*Showcaseエリアのリフレッシュ*/
function reflesh_showcases(){
  return new Promise(function(callback){
  var user_id = $("#current_status").data("user_id");
  var showcase_name = $("#current_status").data("showcase_name");
  　$.ajaxSetup({
  　　headers: {
  　　　'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  　　}
  　});
    var jqxhr;
    if (jqxhr) {
      jqxhr.abort();
    }
    $.ajax({
        type: 'POST',
        data: {
            id: user_id,
            name: showcase_name,
        },
        url: '/ajax_get_showcase',
        dataType: 'json'
    })
    .done(function( data ) {
      var count = data[0].length;
      var output = "";
      $(".p-docs__wrapper").empty();
      for (var i = 0; i < count; i++) {
        var additional_item = document.createElement('div');
        additional_item.className = 'p-docs__item';
        additional_item.innerHTML = `
            <a href="/users/${data[0][i]['user_id']}/${data[0][i]['name']}" class="u-cover"></a>
            ${data[0][i]['name']}
          </div>
          <div class="p-docs_item_overflow">
            <div class="p-three_dots">
              <span class="__dot"></span><span class="__dot"></span><span class="__dot"></span>
            </div>
          </div>
          <div class="p-docs__menu">
            <div class="p-docs__menu__item">
              <span class="js-ajax_delete_showcase" data-id="${data[0][i]['id']}">ショーケースを削除する</span>
            </div>
        `
        $(".p-docs__wrapper").append(additional_item);
        /*挿入するDOMの内容を指定*/

      }

      
      //$('#users_list_book').html(output);
      //fixedMessage(message);
    })
    .fail(function( data ) {

       console.log('error happend');
       console.log(data);
    })
    .always(function( data ) {
      callback(data);
    });
  });
}



/*メモリーの追加ボタンを押した時*/

$(document).on('click','.js-ajax_button',function(){
  loadingStart();
  var form = $('#createDataForm').get()[0];
  //var ttl = $('#input-book-ttl').val();
  //var review = $('#input-book-review').val();
  //console.log(form);
  //form.append("book-create-image", $("input[name='book-create-image']").prop('files')[0]);
  
  var ary_lists ={
    /*ttl: $('#input-book-ttl').val(),
    review: $('#input-book-review').val(),
    form:form,*/
    message: "メモリーを追加しました！",
  }
	ajaxSetter('/apply_new_item',form,ary_lists,"memory").then(function (value) {
  }).catch(function (error) {
      // 非同期処理失敗。呼ばれない
      console.log("本の記録の追加失敗");
      console.log(error);
  }).finally(function (error) {
      console.log(error);
    loadingEnd();
  });
});

$(function(){
  $(document).on('change','input[type="file"]',function(){
    var file = this.files[0];
    console.log(file);
    //$(this).parents('label').nextAll('.formFileName').text(file.name);
  });
});

/*メモリーの更新ボタンを押した時*/

$(document).on('click','.js-ajaxUpdate',function(){
  loadingStart();
  var form = $('#updateDataForm').get()[0];

  //var id = $('.bl_navBlock').attr('data-id');
  //var ttl = $('#detail-ttl').val();
  //var review = $('#detail-desc').val();
  
  var ary_lists ={
    /*id: $('.bl_navBlock').attr('data-id'),
    ttl: $('#detail-ttl').val(),
    review: $('#detail-desc').val(),*/
    message: "メモリーを更新しました！",
  }
  ajaxSetter('/ajax_edit_showcase_item',form,ary_lists,"memory").then(function (value) {
      // 非同期処理成功
    var target_id = $('input#edit-item-id').val();
    //ajaxGetter('/ajax_getData_by_id',target_id);//表示する情報の取得
  }).catch(function (error) {
      // 非同期処理失敗。呼ばれない
      console.log("本の記録を更新失敗");
      console.log(error);
  }).finally(function (error) {
    loadingEnd();
  });


});

/*本の記録を削除ボタンを押した時*/

$(document).on('click','.js-ajax_delete',function(event){
  event.preventDefault();
  var id = $(this).data('id');
  var res = confirm("選択したアイテムを削除しますか？");
  if(res == true){
    ajaxRemover('/ajax_remove_showcase_item','ty',id);
  } else {
  }
  //
});

/*固定メッセージの表示処理*/

function fixedMessage(text){
  $('#fixedMessage').html(text).addClass('js-open');
  setTimeout(function(){
    $('#fixedMessage').removeClass('js-open');
  },5000);
}


function reflesh_showcaseItem(message,reload_order) {
  return new Promise(function(callback) {
    setTimeout(function() {

      var url = "";
      //reload_orderの値に応じてリフレッシュ時に呼び出す情報を切り替える
      if(reload_order === "showcase"){
        var url = "/ajaxgetdata";
      }else if(reload_order === "memory"){
        var url = "/get_memory";
      } else {
      }

      var user_id = $("#current_status").data("user_id");
      var showcase_name = $("#current_status").data("showcase_name");
    　$.ajaxSetup({
    　　headers: {
    　　　'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    　　}
    　});
      var jqxhr;
      if (jqxhr) {
        jqxhr.abort();
      }
      $.ajax({
          type: 'POST',
          data: {
              user_id: user_id,
              showcase_name: showcase_name,
          },
          url: url,
          dataType: 'json'
      })
      .done(function( data ) {
        var count = data[0].length;
        var output = "";
        if($(".muuri").length){
          var removeGridItems = grid.remove(grid.getItems(), { removeElements: true });
        }
        for (var i = 0; i < count; i++) {
          var additional_item = document.createElement('div');
          additional_item.className = 'p-table_block__tr --cell';
          additional_item.dataset.id = data[0][i]['id'];
          /*挿入するDOMの内容を指定*/
          var image_url = data[0][i]['image_path'] == "notset" ? "/image/noimage.jpg" : "https://daima-test.s3-ap-northeast-1.amazonaws.com/bookimage/"+data[0][i]['image_path'];
          additional_item.innerHTML = `
            
              <div class="p-table_block__tr__wrapper js-submenu_toggle" data-submenu_type="edit">
                <div class="p-table_block__image">
                  <div class="p-table_block__image__wrapper">
                    <img src="${image_url}">
                  </div>
                </div>
                <div class="p-table_block__th">${data[0][i]['title']}</div>
              </div>
              <form method="post" name="form1" action="/result-delete"><input type="hidden" name="_token" value="${meta_csrf}">
                <input type="hidden" name="id" value="${data[0][i]['id']}">
                <div class="el_deleteButton js-ajax_delete" data-id="${data[0][i]['id']}">
                  
                </div>
              </form>
          `
          console.log(additional_item);
        if($(".muuri").length){
          grid.add(additional_item);
        }
          
          /*ちょっと間置いてからmuuri.jsの再整列を行う*/
          /*setTimeout(function(){
            grid.refreshItems();
            grid.layout(function(items, hasLayoutChanged){
              console.log(items);
              console.log(hasLayoutChanged);
            });
          }, 1000);*/
        }

        
        //$('#users_list_book').html(output);
        if(message){
          fixedMessage(message);
        }
        
      })
      .fail(function( data ) {

         console.log('error happend');
         console.log(data);
      })
      .always(function( data ) {
        callback(data);
      });


      
    }, 0);
  });
}

//muuri.js適用下のメインエリアに要素を追加する関数
function addGridItem(item){
  //javascript上で要素を作成して追加
  var _item = document.createElement('div');
  _item.innerHTML = '' +
      '<div class="item">' +
        '<div class="item-content">' +
          'アイテム5' +
        '</div>' +
      '</div>';

  var elem5 = _item.firstChild;

  grid.add(item);
}

//ajaxでデータベースに情報を追加する

function ajaxSetter(url,form,ary_lists,reload_order){
  return new Promise(function (resolve, reject) {
    setTimeout(function () {
    // 成功
      $.ajaxSetup({
    　　headers: {
    　　　'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    　　}
    　});
      var formData = new FormData( form );
      console.log(formData);

      JSON.stringify(ary_lists);
        var jqxhr;
        if (jqxhr) {
          jqxhr.abort();
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            /*data: {
                form:form,
                //ary_lists:ary_lists_get,
            },*/
            //processData: false, // jQueryがデータを処理しないよう指定
            //contentType: false,  // jQueryがcontentTypeを設定しないよう指定
            //dataType: 'json'
        })
        .done(function( data ) {
          //location.reload();
          console.log("データベースへの追加が成功しました");
          form.reset(); //処理が終わったフォームの入力内容をクリア
          reflesh_showcaseItem(ary_lists.message,reload_order);
          if($("#dashboard").length){
            reflesh_showcases();
          }
          
        })
        .fail(function( data ) {
          console.log("データベースへの追加が失敗しました");
          console.log(data);
        })
        .always(function( data ) {
          //データの更新が完了してから次の処理へ。
          resolve('ajax setter done');
        });
        //console.log(jqxhr);
    }, 0);
  });
}

//ajaxでデータベースから情報を削除する

function ajaxRemover(directly,target,id_get){

  　$.ajaxSetup({
  　　headers: {
  　　　'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  　　}
  　});
    var jqxhr;
    if (jqxhr) {
      jqxhr.abort();
    }
    $.ajax({
        type: 'POST',
        data: {
            id: id_get,
        },
        url: directly,
        dataType: 'json'
    })
    .done(function( data ) {
      //console.log(data);
      //location.reload();
      if($("#dashboard").length){
        reflesh_showcases();
        reflesh_showcaseItem('メモリーを削除しました！','showcase');
      } else {
        reflesh_showcaseItem('メモリーを削除しました！','memory');
      }
      

    })
    .fail(function( data ) {
       console.log('error happend');
    })
    .always(function( data ) {
            // ...
    });
    //console.log(jqxhr);
}

//ajaxでID情報を元にデータを取得する

function ajaxGetter(directly,target){
  console.log(target);
  　$.ajaxSetup({
  　　headers: {
  　　　'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  　　}
  　});
    var jqxhr;
    if (jqxhr) {
      jqxhr.abort();
    }
    $.ajax({
        type: 'POST',
        data: {
            id: target,
        },
        url: directly,
        dataType: 'json'
    })
    .done(function( data ) {
      console.log(data);
      rewriteDetailData(data);
    })
    .fail(function( data ) {
      console.log(data);
       console.log('error happend');
    })
    .always(function( data ) {
            // ...
    });
    //console.log(jqxhr);
}

//Showcase_itemの詳細情報のリライト
function rewriteDetailData(data){
  var image_url = data[0][0]['image_path'] == "notset" ? "/image/noimage.jpg" : "https://daima-test.s3-ap-northeast-1.amazonaws.com/bookimage/"+data[0][0]['image_path'];
  $('#detail-ttl').val(data[0][0]['title']);
  $('#detail-desc').val(data[0][0]['memo']);
  $('#dropzone2 .bl_imageDrop_icon').remove();
  if($('#dropzone2 .bl_imageDrop_wrapper > img').length == 0){
    $('#dropzone2 .bl_imageDrop_wrapper').append('<img class="op_thumbnail" src="'+image_url+'">');
  } else {
    $('#dropzone2 .bl_imageDrop_wrapper > img').attr('src',image_url);
  }
  $('.p-side_area__data__lastupdate__date').html(data[0][0]['last_update_date']);
}


$(function() {
  
  $('#dropzone').on('dragover', function() {
    $(this).addClass('hover');
  });
  
  $('#dropzone').on('dragleave', function() {
    $(this).removeClass('hover');
  });
  
  $('#dropzone input').on('change', function(e) {
    var file = this.files[0];

    $('#dropzone').removeClass('hover');
    
    if (this.accept && $.inArray(file.type, this.accept.split(/, ?/)) == -1) {
      return alert('この形式のファイルはアップロードできません.');
    }
    
    $('#dropzone').addClass('dropped');
    $('#dropzone img').remove();
    
    if ((/^image\/(gif|png|jpeg)$/i).test(file.type)) {
      var reader = new FileReader(file);

      reader.readAsDataURL(file);
      
      reader.onload = function(e) {
        var data = e.target.result,
            $img = $('<img />').attr('src', data).fadeIn();
        
        $('#dropzone div').html($img);
      };
    } else {
      var ext = file.name.split('.').pop();
      
      $('#dropzone div').html(ext);
    }
  });
});





//dropzone
$(function() {
  
  $('#dropzone2').on('dragover', function() {
    $(this).addClass('hover');
  });
  
  $('#dropzone2').on('dragleave', function() {
    $(this).removeClass('hover');
  });
  
  $('#dropzone2 input').on('change', function(e) {
    var file = this.files[0];

    $('#dropzone2').removeClass('hover');
    
    if (this.accept && $.inArray(file.type, this.accept.split(/, ?/)) == -1) {
      return alert('この形式のファイルはアップロードできません.');
    }
    
    $('#dropzone2').addClass('dropped');
    $('#dropzone2 img').remove();
    
    if ((/^image\/(gif|png|jpeg)$/i).test(file.type)) {
      var reader = new FileReader(file);

      reader.readAsDataURL(file);
      
      reader.onload = function(e) {
        var data = e.target.result,
            $img = $('<img />').attr('src', data).fadeIn();
        
        $('#dropzone2 div').html($img);
      };
    } else {
      var ext = file.name.split('.').pop();
      
      $('#dropzone2 div').html(ext);
    }
  });
});


Dropzone.options.updateDataForm = {
    autoProcessQueue: false,

    init: function (e) {

        var myDropzone = this;

        $('#btn_upload').on("click", function() {
            myDropzone.processQueue(); // Tell Dropzone to process all queued files.
        });

        // Event to send your custom data to your server
        myDropzone.on("sending", function(file, xhr, data) {

            // First param is the variable name used server side
            // Second param is the value, you can add what you what
            // Here I added an input value
            data.append("your_variable", $('#your_input').val());
        });

    }
};


/*Sortable*/


//var el = document.getElementById("users_list_book");
//var sortable = Sortable.create(el);


/*muuri*/

if($("#users_list_book").length){
  var grid = new Muuri('#users_list_book', {
    dragEnabled: false,
    layout: {
      fillGaps: true
    }
  });


  muuriOvserver();
  //定期的にmuuri.jsのレイアウトチェックを実行
  function muuriOvserver(){
    setTimeout(function(){
      grid.refreshItems();
      grid.layout(function(items, hasLayoutChanged){
        //console.log(items);
        //console.log(hasLayoutChanged);
      });
      muuriOvserver();
    },1000);
  }
}




//var removedItemsA = grid.remove(grid.getItems());


//grid.destroy(true);


//var elem = document.querySelector('#users_list_book .p-table_block_tr.--cell:nth-child(2)');
//console.log(elem);
//grid.remove([elem], {removeElements: true});


/*var grid2 = new Muuri('.grid', {
  dragEnabled: true,
  layout: {
    fillGaps: true
  }
});*/

// When all items have loaded refresh their
// dimensions and layout the grid.
/*window.addEventListener('load', function () {
  grid.refreshItems().layout();
  // For a little finishing touch, let's fade in
  // the images after all them have loaded and
  // they are corrertly positioned.
  document.body.classList.add('images-loaded');
});*/

//var grid = new Muuri('.js-muuri');

//var grid = new Muuri('.grid');

/*document.addEventListener('DOMContentLoaded', function () {
  var grid = null,
      wrapper = document.querySelector('.grid-wrapper'),
      searchField = wrapper.querySelector('.search-field'),
      filterField = wrapper.querySelector('.filter-field'),
      sortField = wrapper.querySelector('.sort-field'),
      gridElem = wrapper.querySelector('.js-muuri'),
      searchAttr = 'data-title',
      filterAttr = 'data-color',
      searchFieldValue,
      filterFieldValue,
      sortFieldValue,
      dragOrder = [];

  // Init the grid layout
  grid = new Muuri(gridElem, {
    dragEnabled: true
  });
  
  // Set inital search query, active filter, active sort value and active layout.
  searchFieldValue = searchField.value.toLowerCase();
  filterFieldValue = filterField.value;
  sortFieldValue = sortField.value;

  // Search field event binding
  searchField.addEventListener('keyup', function () {
    var newSearch = searchField.value.toLowerCase();
    if (searchFieldValue !== newSearch) {
      searchFieldValue = newSearch;
      filter();
    }
  });

  // Filter field event binding
  filterField.addEventListener('change', filter);
  
  // Sort field event binding
  sortField.addEventListener('change', sort);

  // Filtering
  function filter() {
    filterFieldValue = filterField.value;
    grid.filter(function (item) {
      var element = item.getElement(),
          isSearchMatch = !searchFieldValue ? true : (element.getAttribute(searchAttr) || '').toLowerCase().indexOf(searchFieldValue) > -1,
          isFilterMatch = !filterFieldValue ? true : (element.getAttribute(filterAttr) || '') === filterFieldValue;
      return isSearchMatch && isFilterMatch;
    });
  }
  
  // Sorting
  function sort() {
    // Do nothing if sort value did not change.
    var currentSort = sortField.value;
    if (sortFieldValue === currentSort) {
      return;
    }

    // If we are changing from "order" sorting to something else
    // let's store the drag order.
    if (sortFieldValue === 'order') {
      dragOrder = grid.getItems();
    }

    // Sort the items.
    grid.sort(
      currentSort === 'title' ? compareItemTitle :
      currentSort === 'color' ? compareItemColor :
      dragOrder
    );
    sortFieldValue = currentSort;
  }
  
  // Compare data-title
  function compareItemTitle(a, b) {
    var aVal = a.getElement().getAttribute(searchAttr) || '';
    var bVal = b.getElement().getAttribute(searchAttr) || '';
    return aVal < bVal ? -1 : aVal > bVal ? 1 : 0;

  }

  // Compare data-color
  function compareItemColor(a, b) {
    var aVal = a.getElement().getAttribute(filterAttr) || '';
    var bVal = b.getElement().getAttribute(filterAttr) || '';
    return aVal < bVal ? -1 : aVal > bVal ? 1 : compareItemTitle(a, b);
  }
});*/



/*開閉系の処理*/

console.log("karz");

/*クリックを防ぐ*/
function enable_click_privent(){
  $('body').addClass('js-enable_click_privent');
}

function disable_click_privent(){
  $('body').removeClass('js-enable_click_privent');
}


/*開閉コンテンツ処理*/

$(document).on('click','.js-toggle_open',function(){
  $(this).siblings('.js-toggle_content').slideToggle("fast");
  if( $(this).parent('.bl_toggleBlock').hasClass('js-open')){
    $(this).parent('.bl_toggleBlock').removeClass('js-open');
  } else {
    $(this).parent('.bl_toggleBlock').addClass('js-open');
  }
});

/*ローディング*/

var loadingControl = {
  switch:function(){
  if(this.state){
    console.log("loadin on");
    $(".p-loading").removeClass("is-active");
    this.state = false;
  } else {
    $(".p-loading").addClass("is-active");
    this.state = true;
  }
  },
  state:false,
};

//ローディング開始
function loadingStart(){
  loadingControl.switch();
}

//ローディング終了
function loadingEnd(){
  loadingControl.switch();
  if(humburgerControl.state){
    humburgerControl.switch();
  }
}



/*ハンバーガーメニュー*/

$(document).on('click touch','.js-submenu_toggle',function(e){
  e.preventDefault();
  humburgerControl.switch();

  var type = $(this).data('submenu_type');
  $('#submenu').attr('data-type',type);
  if(type === 'edit'){
    var target_id = $(this).parent(".p-table_block__tr").data('id');
    $('input#edit-item-id').val(target_id);
    ajaxGetter('/ajax_getData_by_id',target_id);//表示する情報の取得
  }

});
var humburgerControl = {
  switch:function(){
  if(this.state){
    $("body").removeClass("is-submenu_active");
    this.state = false;
  } else {
    $("body").addClass("is-submenu_active");
    this.state = true;
  }
  },
  state:false,
};
//function filtered_search_button()

//Close filterd-search if clicked external area.
$(document).on('click touchend', function(event) {
  console.log(event.target);
  if (!$(event.target).closest('#submenu,.js-submenu_toggle,.p-loading').length && humburgerControl.state) {
    humburgerControl.switch();
  }
});



//MENU
$(function(){

  var focusFlag = false;

  $(document).on('click','.js-toggle_edit',function(){
    scrollBlocker(true);
    $('body').addClass('is-side_area_edit_open');
    enable_click_privent();

    var target_id = $(this).parent(".p-table_block__tr").data('id');
    $('input#detail-id').val(target_id);
    //console.log( $('input#detail-id').val());

    $('#detail-id').attr('value',target_id);

    $('.p-side_area.__edit').attr('data-id',target_id);
    ajaxGetter('/ajax_getData_by_id',target_id);//表示する情報の取得
    setTimeout(function(){
      focusFlag = true;
    },200);
  });

  $(document).on('click','.bl_navBlock_close',function(){
    focusFlag = false;
    scrollBlocker(false);
    $('body').removeClass('is-side_area_edit_open');
    disable_click_privent();
  });
  //MENU以外の場所をクリックした時にメニューを閉じる
  $(document).on('click touchend', function(event) {
    if (!$(event.target).closest('.p-side_area,.js-nav_button').length && focusFlag) {
      focusFlag = false;
      scrollBlocker(false);
      $('#dropzone2 > .bl_imageDrop_wrapper > img').remove();
      $('input[type=file]').val('');
      console.log($('#update-book-image').prop('files')[0]);
      $('body').removeClass('is-side_area_edit_open');
      disable_click_privent();
    }
  });
})

//新規アイテムの追加用パネルの開閉
$(function(){

  var focusFlag = false;

  $(document).on('click','.js-open_add_item',function(){
    scrollBlocker(true);
    $('body').addClass('is-side_area_add_open');
    enable_click_privent();
    setTimeout(function(){
      focusFlag = true;
    },200);
  });

  $(document).on('click','.js-close_add_item',function(){
    focusFlag = false;
    scrollBlocker(false);
    $('body').removeClass('is-side_area_add_open');
    disable_click_privent();
  });
  //MENU以外の場所をクリックした時にメニューを閉じる
  $(document).on('click touchend', function(event) {
    if (!$(event.target).closest('.p-add_items,.p-side_area').length && focusFlag) {
      focusFlag = false;
      scrollBlocker(false);
      $('#dropzone2 > .bl_imageDrop_wrapper > img').remove();
      $('input[type=file]').val('');
      console.log($('#update-book-image').prop('files')[0]);
      $('body').removeClass('is-side_area_add_open');
      disable_click_privent();
    }
  });
})

/*Privent scrolling*/
var scrollBlockerFlag;
var scrollpos;

function scrollBlocker(flag){
  if(flag){
    scrollpos = $(window).scrollTop();
    $('body').addClass('js-fixed js-fixed_' + scrollpos).css({'top': -scrollpos});
    scrollBlockerFlag = true;
  } else {
    $('body').removeClass('js-fixed').css({'top': 0});
    $('body').removeClass('js-fixed_' + scrollpos);
    window.scrollTo( 0 , scrollpos );
    scrollBlockerFlag = false;
  }
}



$(function(){

  $(document).on('click touch','.js-docs_add',function(e){
  e.preventDefault();
  fSearchInOut.switch();

  });
  var fSearchInOut = {
    switch:function(){
    if(this.state){
      scrollBlocker(false);
      //disable_click_privent();
      $("body").removeClass("is-add_showcase_active");
      
      this.state = false;
    } else {
      scrollBlocker(true);
      //enable_click_privent();
       $("body").addClass("is-add_showcase_active");
       this.state = true;
    }
    },
    state:false,
  };

  //MENU以外の場所をクリックした時にメニューを閉じる
  /*$(document).on('click touchend', function(event) {
    if (!$(event.target).closest('.p-side_area,.js-nav_button').length && focusFlag) {
      focusFlag = false;
      scrollBlocker(false);
      $('body').removeClass('is-add_showcase_active');
      disable_click_privent();
    }
  });*/

  //function filtered_search_button()
});




//更新時や再読み込み時など、ページの内容を更新したい場合に
function pageReflesh(){
  if(document.getElementById('dashboard')){
    loadingStart();
    reflesh_showcases().then(function(data) {
      loadingEnd();
    });
  } else if(document.getElementById('showcase_detail')) {
    loadingStart();
    //console.log('mudada');

    reflesh_showcaseItem('','memory').then(function(data) {
      loadingEnd();
    });

  }

}

pageReflesh();

//ブラウザバック時に強制再読み込みする

window.onpageshow = function(event) {
  if (event.persisted) {
    console.log('orara');
  }
};
