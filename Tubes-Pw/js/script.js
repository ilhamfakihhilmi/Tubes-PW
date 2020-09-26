$(document).ready(function () {


  // event ketika keyword ditulis
  $('#keyword').on('keyup', function () {
    $('#container').load('ajax/pelanggan.php?keyword=' + $('#keyword').val());
  });

});