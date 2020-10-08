$(document).ready(function(){
 
  $(document).on('change', '#priv_type', function(){
    var pass_type = $(this).val().trim();
    $.ajax({
            url: 'php/pass_application.php', // point to server-side PHP script 
            data: {pass_type : pass_type,chk_max : 1},                         
            type: 'post',
            success: function(data){
                if(data.trim() == "possible"){
                    $('#inner_div_apply_pass').removeClass("disp-none");

                }
                else{
                  $("#div_apply_pass").append(data);
                }
            }
          }); 

  });

  $(document).on('click', '#btn_pass', function(){
    var s = $(".source").val().trim();
    var d = $(".dest").val().trim();
    var one_round = $("#one_round").val().trim();
    var c = 0;
    $('.members').each(function() {
                    if ($(this).is(":checked")) {
                      c++;
                    }
                });
    if(s.length == 0 || d.length == 0 || one_round.length == 0 || c==0){
          alert("All fields are mandatory");
          return;
    }
    var form = document.myform;
    var dataString = $(form).serialize();
    $.ajax({
        type:'POST',
        url:'php/add_pass.php',
        data: dataString,
        success: function(data){
            $('#div_apply_pass').prepend(data);
        }
    });
    return false;
  });
  /*
  $(document).on('click', '.add_pass_row', function(){
    var html = '';
    html += '<tr>';
    html += '<td><select name="pass_nm[]" class="form-control pass_nm">\
                  <option value="">Select Passenger name</option><option>dfgh</option></select></td>';
    html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
    $('#passenger_table').append(html);
  });
  $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
  });*/


 
});
