$(function(){
    console.log('delete-btn')
    $("#delete-btn").submit(function(){
      
      console.log('confirm')
      if(window.confirm('本当に削除しますか？')) {
        console.log('true')
        return true;
      } else {
        console.log('false')
        return false;
      }
    });
});