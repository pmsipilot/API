$(document).ready(function(){
  $.ajax({
    url: './sidebar.html',
    success: function(data){
      console.log(data);
      $('#sidebar').html(data);
    }
  });
});