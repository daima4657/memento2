
/*共通設定*/
var meta_csrf = document.getElementsByName ('csrf-token').item(0).content;/*csrfトークンをコピる*/


/*開閉コンテンツ処理*/

$(document).on('click','.js_toggleOpen',function(){
  $(this).siblings('.js_toggleContent').slideToggle("fast");
  if( $(this).parent('.bl_toggleBlock').hasClass('js_open')){
    $(this).parent('.bl_toggleBlock').removeClass('js_open');
  } else {
    $(this).parent('.bl_toggleBlock').addClass('js_open');
  }
});

/*本の記録を追加ボタンを押した時*/

$(document).on('click','.js_ajaxButton',function(){
  var form = $('#createDataForm').get()[0];

  //var ttl = $('#input-book-ttl').val();
  //var review = $('#input-book-review').val();
  //console.log(form);
  //form.append("book-create-image", $("input[name='book-create-image']").prop('files')[0]);
  
  ary_lists ={
    /*ttl: $('#input-book-ttl').val(),
    review: $('#input-book-review').val(),
    form:form,*/
    message: "メモリーを追加しました！",
  }
	ajaxSetter('/ajaxbookadd',form,ary_lists);
});

/*本の記録を更新ボタンを押した時*/

$(document).on('click','.js_ajaxUpdate',function(){
  var form = $('#updateDataForm').get()[0];

  //var id = $('.bl_navBlock').attr('data-id');
  //var ttl = $('#detail-ttl').val();
  //var review = $('#detail-desc').val();
  
  ary_lists ={
    /*id: $('.bl_navBlock').attr('data-id'),
    ttl: $('#detail-ttl').val(),
    review: $('#detail-desc').val(),*/
    message: "メモリーを更新しました！",
  }

  ajaxSetter('/ajaxupdate',form,ary_lists).then(function (value) {
      // 非同期処理成功
    target_id = $('#updateDataForm input[name="user_id"]').val();
    ajaxGetter('/ajax_getData_by_id',target_id);//表示する情報の取得
  }).catch(function (error) {
      // 非同期処理失敗。呼ばれない
      console.log(error);
  });


});

/*本の記録を削除ボタンを押した時*/

$(document).on('click','.js_ajaxDelete',function(event){
  event.preventDefault();
  var id = $(this).data('id');
  ajaxRemover('/ajaxbookremove','ty',id);
});

/*固定メッセージの表示処理*/

function fixedMessage(text){
  $('#fixedMessage').html(text).addClass('js_open');
  setTimeout(function(){
    $('#fixedMessage').removeClass('js_open');
  },5000);
}

/*サイドナビの開閉処理*/

var scrollBlockerFlag;
var scrollpos;

function scrollBlocker(flag){
  if(flag){
    scrollpos = $(window).scrollTop();
    $('body').addClass('js_fixed js_fixed_' + scrollpos).css({'top': -scrollpos});
    scrollBlockerFlag = true;
  } else {
    $('body').removeClass('js_fixed').css({'top': 0});
    $('body').removeClass('js_fixed_' + scrollpos);
    window.scrollTo( 0 , scrollpos );
    scrollBlockerFlag = false;
  }
}


//MENU
$(function(){

  var focusFlag = false;

  $(document).on('click','.js_navButton',function(){
    scrollBlocker(true);
    $('body').addClass('js_navOpen');

    var target_id = $(this).parent(".bl_tableBlock_tr").data('id');
    $('input#detail-id').val(target_id);
    console.log( target_id);
    //console.log( $('input#detail-id').val());

    $('#detail-id').attr('value',target_id);

    $('.bl_navBlock').attr('data-id',target_id);
    ajaxGetter('/ajax_getData_by_id',target_id);//表示する情報の取得
    setTimeout(function(){
      focusFlag = true;
    },200);
  });

  $(document).on('click','.bl_navBlock_close',function(){
    focusFlag = false;
    scrollBlocker(false);
    $('body').removeClass('js_navOpen');
  });
  //MENU以外の場所をクリックした時にメニューを閉じる
  $(document).on('click touchend', function(event) {
    if (!$(event.target).closest('.bl_navBlock,.js_navButton').length && focusFlag) {
      focusFlag = false;
      scrollBlocker(false);
      $('#dropzone2 > .bl_imageDrop_wrapper > img').remove();
      $('input[type=file]').val('');
      console.log($('#update-book-image').prop('files')[0]);
      $('body').removeClass('js_navOpen');
    }
  });
})



/*dbから情報を引っぱって、それを非同期更新したいときに使う関数*/
function ajaxReload(message){
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
            id: 1,
            ttl: 'hoge',
            review: 'huga',
        },
        url: '/ajaxgetdata',
        dataType: 'json'
    })
    .done(function( data ) {
      var count = data[0].length;
      var output = "";
      for (var i = 0; i < count; i++) {
        /*挿入するDOMの内容を指定*/
        var image_url = data[0][i]['image_path'] == "notset" ? "image/noimage.jpg" : "https://daima-test.s3-ap-northeast-1.amazonaws.com/bookimage/"+data[0][i]['image_path'];
        output+= `
          <div class="bl_tableBlock_tr" data-id="${data[0][i]['id']}">
            <div class="bl_tableBlock_tr_wrapper js_navButton">
              <div class="bl_tableBlock_image">
                <div class="bl_tableBlock_image_wrapper" style="background-image:url('${image_url}');"></div>

              </div>
              <div class="bl_tableBlock_th">${data[0][i]['title']}</div>
              <div class="bl_tableBlock_td">${data[0][i]['memo']}</div>
            </div>
            <form method="post" name="form1" action="/result-delete"><input type="hidden" name="_token" value="${meta_csrf}">
              <input type="hidden" name="id" value="${data[0][i]['id']}">
              <div class="el_deleteButton js_ajaxDelete" data-id="${data[0][i]['id']}">
                削除
              </div>
            </form>
          </div>
        `;
      }
      
      $('#users_list_book').html(output);
      fixedMessage(message);
    })
    .fail(function( data ) {

       console.log('error happend');
    })
    .always(function( data ) {
            // ...
    });
}

//ajaxでデータベースに情報を追加する

function ajaxSetter(url,form,ary_lists){
  console.log(form);
    return new Promise(function (resolve, reject) {
        setTimeout(function () {
            // 成功

      　$.ajaxSetup({
      　　headers: {
      　　　'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      　　}
      　});
      var formData = new FormData( form );
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
          form.reset(); //処理が終わったフォームの入力内容をクリア

          ajaxReload(ary_lists.message);

        })
        .fail(function( data ) {
          console.log(data);
           console.log('error happend');
        })
        .always(function( data ) {
          console.log("hogehoge");
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
      ajaxReload('メモリーを削除しました！');
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

//詳細情報個所を再描画する
function rewriteDetailData(data){
  var image_url = data[0][0]['image_path'] == "notset" ? "image/noimage.jpg" : "https://daima-test.s3-ap-northeast-1.amazonaws.com/bookimage/"+data[0][0]['image_path'];
  $('#detail-ttl').val(data[0][0]['title']);
  $('#detail-desc').val(data[0][0]['memo']);
  $('#dropzone2 .bl_imageDrop_icon').remove();
  if($('#dropzone2 .bl_imageDrop_wrapper > img').length == 0){
    $('#dropzone2 .bl_imageDrop_wrapper').append('<img class="op_thumbnail" src="'+image_url+'">');
  }
  $('.bl_navBlock_data_lastupdate_date').html(data[0][0]['last_update_date']);
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
