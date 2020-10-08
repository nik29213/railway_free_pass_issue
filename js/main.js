$(document).ready(function(){
  $("#add_new_mem").click(function(){
    	var add_new_block = '<div class="container-fluid" id="new_div" style = "box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); padding:15px;">\
                <div class = "row">\
                  <h3><span class="txt-blk">&nbsp;&nbsp;&nbsp;Enter member details</span></h3><br />\
                    <div class = "col-sm-6">\
                      <input type ="text" id = "txt_new_mem_nm" class = "form-control txt-blk" name="Full name" placeholder="Full name" style = "background : #fff;"/><br />\
                      <input type ="text" id = "txt_new_mem_age" class = "form-control txt-blk" name="Age" placeholder="Age" style = "background : #fff;"/></div>\
                    <div class = "col-sm-6">\
                      <input type ="text" id = "txt_new_mem_relation" class = "form-control txt-blk" name="Relationship" placeholder="Relationship" style = "background : #fff;"/><br />\
                    </div>\
                </div>\
                <div class="row">\
                  <h3><span class="txt-blk">&nbsp;&nbsp;&nbsp;Upload Files</span></h3><br />\
                    <div class="col-sm-6">\
                      <span class="txt-blk"><b>Id Proof</b></span>\
                      <span href="#" data-toggle="tooltip" title="files must be in pdf format">&nbsp;<i class="fa fa-info-circle"></i></span>\
                      <input type ="file" id = "txt_new_mem_id" accept="application/pdf" name="Id Proof" class = "form-control txt-blk" style = "background : #fff; font-size:12px;"/>\
                    </div>\
                    <div class="col-sm-6">\
                      <span class="txt-blk"><b>Medical Proof</b></span>\
                      <span href="#" data-toggle="tooltip" title="files must be in pdf format">&nbsp;<i class="fa fa-info-circle"></i></span>\
                      <input type ="file" id = "txt_new_mem_med" accept="application/pdf" name="Medical Proof" class = "form-control txt-blk" style = "background : #fff; font-size:12px;"/>\
                    </div>\
                </div>\
                <div class="row">\
                  <br />\
                  <div class="col-sm-3">\
                  </div>\
                    <div class ="col-sm-6">\
                        <center>\
                        <a class="btn btn-danger" id = "btn_new_mem_cancel"><i class="fa fa-times"></i></a>\
                        <a class="btn btn-success" id = "btn_new_mem_save"><i class="fa fa-save"></i></a>\
                        </center>\
                    </div>\
                  <div class="col-sm-3">\
                  </div>\
              </div>';
     $("#all_mem_div").prepend(add_new_block);
  });

    $("#all_mem_div").on('click', '#btn_new_mem_cancel', function() {
      $("#new_div").remove();
    });

    $("#all_mem_div").on('click', '#btn_new_mem_save', function() {
      var mem_nm = $("#txt_new_mem_nm").val().trim();
      var mem_age = $("#txt_new_mem_age").val().trim();
      var mem_rlsn = $("#txt_new_mem_relation").val().trim();
      var mem_id = $("#txt_new_mem_id").val().trim();
      var mem_med = $("#txt_new_mem_med").val().trim();

      if(mem_nm.length == 0 || mem_rlsn.length == 0 || mem_age.length == 0 || mem_id.length == 0 || mem_med.length == 0){
          alert("All fields are mandatory");
          return;
      }
          var file_data_id = $('#txt_new_mem_id').prop('files')[0];   
          var file_data_med = $('#txt_new_mem_med').prop('files')[0];   

          var form_data = new FormData();  
                
          form_data.append('file_id', file_data_id);
          form_data.append('file_med', file_data_med);
          form_data.append('mem_nm', mem_nm);
          form_data.append('mem_age', mem_age);
          form_data.append('mem_rlsn', mem_rlsn);
          
          //alert(form_data);                             
          $.ajax({
              url: 'php/upload.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                alert(php_script_response); // display response from the PHP script, if any
                location.reload();
            }
         });

    });

  $(".btn_mem_edit").click(function(){
    var id = $(this).attr("mem_edit_id");
    $(this).addClass("disp-none");
    $('div[mem_id= "'+id+'"] .btn_mem_save').removeClass("disp-none");
    $('div[mem_id= "'+id+'"] .btn_mem_refresh').removeClass("disp-none");
    $('div[mem_id= "'+id+'"] .txt_mem_id').removeClass("disp-none");
    $('div[mem_id= "'+id+'"] .txt_mem_med').removeClass("disp-none");
    $('div[mem_id= "'+id+'"] input').removeAttr("disabled");
  });

  $(".btn_mem_save").click(function(){
    var id = $(this).attr("mem_save_id");
      var mem_nm = $('div[mem_id= "'+id+'"] .txt_mem_nm').val().trim();
      var mem_age = $('div[mem_id= "'+id+'"] .txt_mem_age').val().trim();
      var mem_rlsn = $('div[mem_id= "'+id+'"] .txt_mem_rlsn').val().trim();
      var mem_id = $('div[mem_id= "'+id+'"] .txt_mem_id').val().trim();
      var mem_med = $('div[mem_id= "'+id+'"] .txt_mem_med').val().trim();

      if(mem_nm.length == 0 || mem_rlsn.length == 0 || mem_age.length == 0){
          alert("All fields are mandatory");
          return;
      }

      var form_data = new FormData();
      form_data.append('mem_nm', mem_nm);
      form_data.append('mem_age', mem_age);
      form_data.append('mem_rlsn', mem_rlsn);
      form_data.append('fid', id);
     
      if(mem_id.length != 0){
          var file_data_id = $('div[mem_id= "'+id+'"] .txt_mem_id').prop('files')[0]; 
          form_data.append('file_id', file_data_id);
      }
      if(mem_med.length != 0){
          var file_data_med = $('div[mem_id= "'+id+'"] .txt_mem_med').prop('files')[0]; 
          form_data.append('file_med', file_data_med);        
      }
       $.ajax({
            url: 'php/edit_member.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                alert(php_script_response); // display response from the PHP script, if any
                location.reload();
            }
         }); 

  });
 

  $(".btn_mem_refresh").click(function(){
    location.reload();
  });
  $(".btn_mem_del").click(function(){
    var id = $(this).attr("mem_del_id");
    if(confirm("are you sure to delete member records?")){
      
      //post request to delete
      $.post("php/del_member.php",{del_id:id}).done(function(data){
        if(data.trim() == "success"){
          var str = "<div class='alert alert-success'>\
                      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>\
                      <strong>Successfully</strong> deleted member details.\
                    </div>";

          $("#all_mem_div").prepend(str);
          $('div[mem_id= "'+id+'"]').hide();

        }else{
          alert("unable to delete");
        }
      }).error(function(err,msg){
        alert(err);
      });
      //end of post request
    }
    return false;
  }); 
});
