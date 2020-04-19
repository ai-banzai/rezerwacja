<?php
  $content = '
  <div class="row">
  <!-- left column -->
  <div class="col-md-12">
  
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Update Reservation</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form id="form_reservations" name="form_reservations" role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="PersonID">Person</label>
            <select class="form-control" id="PersonID" name="person" required placeholder="Enter Person ID">
              <option value="" class="empty" selected="selected">Select Person</option>
            </select>
          </div>
          <div class="form-group">
            <label for="WorkstationID">Workstation</label>
            <select name="workstation" required class="form-control" id="WorkstationID" placeholder="Enter Workstation ID" onChange="ShowEquipment()">
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
              <label for="Date">Date</label>
              <input type="date" class="form-control" id="Date" placeholder="Enter Date" name="dates">
            </div>
            <div class="form-group">
              <label for="TimeStart">Time Start</label>
              <input type="time" class="form-control" id="TimeStart" placeholder="Enter Time Start" name="timestart">
            </div>
          <div class="form-group">
            <label for="exampleInputName1">Time End</label>
            <input type="time" class="form-control" id="TimeEnd" placeholder="Enter Time End" name="timeend">
          </div>
          </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-primary"  value="Submit"></input>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>';
              
  include('../master.php');
?>
<script>
    function FillData(){
        $.ajax({
            type: "GET",
            url: "../api/reservations/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#PersonID').val(data['person_id']);
                $('#WorkstationID').val(data['workstation_id']);
                $('#Date').val(data['date']);
                $('#TimeStart').val(data['time_start']);
                $('#TimeEnd').val(data['time_end']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    };

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

//call the list populating functions
AddWorkstations();
AddPersons();

//on form submit
$('#form_reservations').submit(    function(e){     

//prevent default behavior
e.preventDefault();
var $form = $(this);

////// Form validation code comes here.
// validation agains blank fields
if( document.form_reservations.person.value == "" ) {
        alert( "Please choose a person!" );
        document.form_reservations.person.focus() ;
        return false;
      }
if( document.form_reservations.workstation.value == "" ) {
  alert( "Please choose a workstation!" );
  document.form_reservations.workstation.focus() ;
  return false;
}
if( document.form_reservations.dates.value == "" ) {
  alert( "Please choose a date!" );
  document.form_reservations.dates.focus() ;
  return false;
}
if( document.form_reservations.timestart.value == "" ) {
  alert( "Please choose starting time!" );
  document.form_reservations.timestart.focus() ;
  return false;
}
if( document.form_reservations.timeend.value == "" ) {
  alert( "Please choose ending time!" );
  document.form_reservations.timeend.focus() ;
  return false;
}
// validation checking if date is in the future
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;

if( document.form_reservations.dates.value  < today ) {
  alert( "This date has already passed. Please choose a date in the future!" );
  document.form_reservations.dates.focus() ;
  return false;
}


//Send AJAX Post request
$.ajax(
        {
            type: "POST",
            url: '../api/reservations/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
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
                    alert("Successfully Updated Reservation!");
                    window.location.href = '/rezerwacja/terminy';
                }
                else {
                    alert(result['message']);
                }
            }
        });
});

//onload events
window.addEventListener("load", function(){  
  
  FillData();
  ShowEquipment();
});
</script>
