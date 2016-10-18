$(document).ready(function(){

  // var timeStamp = Math.floor(Date.now() / 1000);
  console.log('Document ready');

// display data table START

$('#id-datatable').dataTable({
  // some parameters for jquery ui
  "bJQueryUI": true,
  "sPaginationType": "full_numbers"
});

// display data table END

//check button click event
  $('input#btn-insert').on('click',function(){
    console.log('Insert clicked');

      var first_name = $('input#first_name').val();
      var last_name = $('input#last_name').val();
      var bio = $('textarea#bio').val();

//check if data missing
      if(!(first_name) || !(last_name) || !(bio) ){
        alert('data is missing');
      } else {

        $.post(
          '/phpmysqli/index.php'
          ,{first_name:first_name,last_name:last_name,bio:bio}
          ,function(data) {
              if(data){
                  $('.alert-success').show();
                  console.log(first_name+' '+last_name+' '+bio);
              }

        });
      }
  });

});
