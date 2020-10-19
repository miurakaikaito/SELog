$(function(){

  // 質問掲示板のカテゴリ検索用
  $('.category-wrap .btn').on('click', function(){
    var category_id = $(this).attr('id');
    $('#category-val').val(category_id);
    $('#question-search-form').submit();
  });
});