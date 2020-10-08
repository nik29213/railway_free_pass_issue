$(document).ready(function(){

  setTimeout(function(){

    $("#btn_applied").click();
  },1);

  $("#btn_applied").click(function(){
    $('.btn_passes').removeClass("btn-success");
    $('.btn_passes').addClass("btn-primary");
    $(this).removeClass("btn-primary");
    $(this).addClass("btn-success");
    var pass_action = $(this).attr("action");
    $("#show_passes").empty();
    $.ajax({
            url: '../admin/disp_passes.php', // point to server-side PHP script 
            data: {pass_action:pass_action},                         
            type: 'post',
            success: function(data){
              $("#show_passes").append(data);    
            }
          }); 
  }); 
  $("#btn_approved").click(function(){
    $('.btn_passes').removeClass("btn-success");
    $('.btn_passes').addClass("btn-primary");
    $(this).removeClass("btn-primary");
    $(this).addClass("btn-success");
    var pass_action = $(this).attr("action");
    $("#show_passes").empty();
    $.ajax({
            url: '../admin/disp_passes.php', // point to server-side PHP script 
            data: {pass_action:pass_action},                         
            type: 'post',
            success: function(data){
              $("#show_passes").append(data);    
            }
          }); 
  });
  $("#btn_rejected").click(function(){
    $('.btn_passes').removeClass("btn-success");
    $('.btn_passes').addClass("btn-primary");
    $(this).removeClass("btn-primary");
    $(this).addClass("btn-success");
    var pass_action = $(this).attr("action");
    $("#show_passes").empty();
    $.ajax({
            url: '../admin/disp_passes.php', // point to server-side PHP script 
            data: {pass_action:pass_action},                         
            type: 'post',
            success: function(data){
              $("#show_passes").append(data);    
            }
          }); 
  });
  $(".reject_approve").click(function(){
    var pass_action = $(this).attr("action");
    var pid = $(this).attr("pass");
    $.ajax({
            url: '../admin/update_pass_status.php', // point to server-side PHP script 
            data: {pass_action:pass_action,pid:pid},                         
            type: 'post',
            success: function(data){
              $("#alert_status").prepend(data);    
            }
          }); 
  });
  
});
