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
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Type</label>
                          <input type="text" class="form-control" id="type" placeholder="Enter Type of Equipment">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Model</label>
                          <input type="text" class="form-control" id="model" placeholder="Enter Model">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Unique Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Year of Purchase</label>
                          <input type="number" class="form-control" id="year_of_purchase" placeholder="Enter Year of Purchase">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Value</label>
                          <input type="number" class="form-control" id="value" placeholder="Enter Value of Equipment">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Workstation</label>
                          <select required class="form-control" id="WorkstationID" placeholder="Enter Workstation ID" onChange="ShowEquipment()">
                            <option value="" selected="selected" class="empty">Select Workstation</option>
                          </select>
                        </div>
                        </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddEquipment()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
  function AddEquipment(){

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
    }

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
</script>