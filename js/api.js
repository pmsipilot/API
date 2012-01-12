$(document).ready(function(){
  $.ajax({
    url: './sidebar.html',
    success: function(data){
      $('#sidebar').html(data);
    }
  });
});
