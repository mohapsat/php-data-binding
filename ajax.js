$(document).ready(function(event){

  // var timeStamp = Math.floor(Date.now() / 1000);
  console.log('Document ready');
  $('input#btn-insert').on('click',function(){
    console.log('Insert clicked');

      var first_name = $('input#first_name').val();
      var last_name = $('input#last_name').val();
      var bio = $('textarea#bio').val();

//check if data missing
      if(!(first_name) || !(last_name) || !(bio) ){
        alert('data missing');
      } else {

        $.post(
          '/phpmysqli/index.php'
          ,{first_name:first_name,last_name:last_name,bio:bio}
          ,function(data) {
              if(data){
                  $('.alert-success').show();
                  console.log(first_name+' '+last_name+' '+bio);
              }

        })
      }
  })
})
