$(document).ready(function() {
  $("#updatePassword").click(function(){

    var password_old = $('input[name="password_old"]').val();
    var password_new = $('input[name="password_new"]').val();

    $.ajax({
      type: 'get',
      dataType: "html",
      url: 'plugins/update_profile.php',
      data: {password_old: password_old, password_new: password_new},
      success: function(result) {
        $('#updatePasswordResult').html(result);
      },
    });
  });
});

$(function(){
  var editor = new MediumEditor('.editable');

  $('#phoneMask').mask('9(999) 999-9999');
  $('#TimeMask1').mask('99:99');
  $('#TimeMask2').mask('99:99');
  $('.DateMask').mask('99.99.9999');
});