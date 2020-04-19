 
<?php 
  $content = '
  
  
  
  <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Reservation</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form name="form_reservations" role="form" onsubmit = "return(validate());">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="person">Person</label>
                          <select class="form-control" id="PersonID" name="person" placeholder="Enter Person ID">
                            <option value="" class="empty" selected="selected">Select Person</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Workstation</label>
                          <select required class="form-control" id="WorkstationID" placeholder="Enter Workstation ID" onChange="ShowEquipment()">
                            <option value="" selected="selected" class="empty">Select Workstation</option>
                          </select>
                        </div>
               <div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Equipment List For Chosen Workstation</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="equipment" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Model</th>
                        <th>Name</th>
                        <th>Year of Purchase</th>
                        <th>Value</th>
                        <th>Workstation ID</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Model</th>
                        <th>Name</th>
                        <th>Year of Purchase</th>
                        <th>Value</th>
                        <th>Workstation ID</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
                   
            <div class="form-group">
                            <label for="exampleInputPassword1">Date</label>
                            <input type="date" class="form-control" id="Date" placeholder="Enter Date" name="dates">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Time Start</label>
                            <input type="time" class="form-control" id="TimeStart" placeholder="Enter Time Start" name="time">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Time End</label>
                          <input type="time" class="form-control" id="TimeEnd" placeholder="Enter Time End" name="time">
                        </div>
                        </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddReservation()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>

          function ShowEquipment(){
  
    $.ajax({
        type: "GET",
        url: "../api/equipment/read_for_workstation.php?workstation_id=" + $("#WorkstationID").val(),
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].id+"</td>"+
                "<td>"+data[user].type+"</td>"+
                "<td>"+data[user].model+"</td>"+
                "<td>"+data[user].name+"</td>"+
                "<td>"+data[user].year_of_purchase+"</td>"+
                "<td>"+data[user].value+"</td>"+
                "<td>"+data[user].workstation_id+"</td>"+
                "<td><a href='../wyposażenie/update.php?id="+data[user].id+"'>Edit</a> | <a href='../wyposażenie/' onClick=Remove('"+data[user].id+"')>Remove</a></td>"+
                "</tr>";
            }
            
            
            $("#equipment tbody tr").remove();
            $(response).appendTo($("#equipment"));
        }
    });
  };

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

//populates the list of persons
function AddPersons(){
  
  $.ajax({
      type: "GET",
      url: "../api/person/read.php",
      dataType: 'json',
      success: function(data) {
          var response="";
          for(var user in data){
              response +=
              "<option value=" +data[user].id+">"+data[user].name+" "+data[user].surname+" (ID: "+data[user].id+")</option>";
          }
          
          
          $(response).appendTo($("#PersonID"));
      }
  });
};

//onload functions
  window.addEventListener("load", function(){
    ShowEquipment();
    AddWorkstations();
    AddPersons();
  });


//Add reservation when submitted
 function AddReservation(){

        $.ajax(
        {
            type: "POST",
            url: '../api/reservations/create.php',
            dataType: 'json',
            data: {
                person_id: $("#PersonID").val(),
                workstation_id: $("#WorkstationID").val(),   
                date: $("#Date").val(),     
                time_start: $("#TimeStart").val(),
                time_end: $("#TimeEnd").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Reservation!");
                    window.location.href = '/rezerwacja/terminy';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }


   // Form validation code will come here.
   function validate() {
    if( document.form_reservations.person.value == "" ) {
            alert( "Please choose a person!" );
            document.myForm.Name.focus() ;
            return false;
         }
   }
</script>
