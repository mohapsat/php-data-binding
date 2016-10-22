  $('#lbl').hide();

$('#myButton').on('click', function () {

  var lbl = $('#lbl').show();

  console.log('Sleeping for 5 seconds');

  var secondsToSleep = 3;

  // The second argument in setTimeout that is the
  // amount of time to sleep should be in miliseconds
  setTimeout(function() {
      console.log('Woke up!!');
        $('#lbl').hide();
  }, secondsToSleep * 1000);



  // console.log('button clicked');
  // var $btn = $('lbl').button('loading');
  // console.log($btn.text());
  // // business logic...
  // $btn.button('reset');
  // console.log('button reset');
});
