<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Equipment</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="form_equipment" id="form_equipment">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="type">Type</label>
                          <input type="text" name="type" class="form-control" id="type" placeholder="Enter Type of Equipment">
                        </div>
                        <div class="form-group">
                          <label for="model">Model</label>
                          <input type="text" name="model" class="form-control" id="model" placeholder="Enter Model">
                        </div>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" id="name" placeholder="Enter Unique Name">
                        </div>
                        <div class="form-group">
                          <label for="year_of_purchase">Year of Purchase</label>
                          <input type="number" name="year_of_purchase" class="form-control" id="year_of_purchase" placeholder="Enter Year of Purchase">
                        </div>
                        <div class="form-group">
                          <label for="value">Value</label>
                          <input type="number" name="value" class="form-control" id="value" placeholder="Enter Value of Equipment">
                        </div>
                        <div class="form-group">
                          <label for="WorkstationID">Workstation</label>
                          <select required name="WorkstationID" class="form-control" id="WorkstationID" placeholder="Enter Workstation ID" onChange="ShowEquipment()">
                            <option value="" selected="selected" class="empty">Select Workstation</option>
                          </select>
                        </div>
                        </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
 //populates the list of workstations
    function AddWorkstations(){
  
  $.ajax({
      type: "GET",
      url: "../api/workstation/read.php",
      dataType: 'json',
      success: function(data) {
          var response="";
          for(var user in data){
              response +=
              "<option value=" +data[user].id+">"+data[user].name+"</option>";
          }
          
          
          $(response).appendTo($("#WorkstationID"));
      }
  });
};
window.addEventListener("load", function(){
    AddWorkstations();
  });


////////on form submit
$('#form_equipment').submit(    function(e){     

//prevent default behavior
e.preventDefault();
var $form = $(this);

////// Form validation code comes here.
// validation agains blank fields
if( document.form_equipment.type.value == "" ) {
        alert( "Please choose a type!" );
        document.form_equipment.type.focus() ;
        return false;
      }
if( document.form_equipment.model.value == "" ) {
  alert( "Please choose a model!" );
  document.form_equipment.model.focus() ;
  return false;
}
if( document.form_equipment.name.value == "" ) {
  alert( "Please choose a name!" );
  document.form_equipment.name.focus() ;
  return false;
}
if( document.form_equipment.year_of_purchase.value == "" ) {
  alert( "Please choose year of purchase!" );
  document.form_equipment.year_of_purchase.focus() ;
  return false;
}
if( document.form_equipment.value.value == "" ) {
  alert( "Please choose value!" );
  document.form_equipment.value.focus() ;
  return false;
}
if( document.form_equipment.WorkstationID.value == "" ) {
  alert( "Please choose Workstation!" );
  document.form_equipment.value.focus() ;
  return false;
}
//Send AJAX Post request
$.ajax(
        {
            type: "POST",
            url: '../api/equipment/create.php',
            dataType: 'json',
            data: {
                type: $("#type").val(),
                model: $("#model").val(),        
                name: $("#name").val(),
                year_of_purchase: $("#year_of_purchase").val(),
                value: $("#value").val(),
                workstation_id: $("#WorkstationID").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New equipment!");
                    window.location.href = '/rezerwacja/wyposażenie';
                }
                else {
                    alert(result['message']);
                }
            }
        });
});
   
</script>