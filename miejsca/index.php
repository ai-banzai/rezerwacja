<?php 
$content = '
<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Workstation List</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="workstations" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
						<th>ID</th>
						<th>Name</th>
						<th>Description</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>

<div class="row">
<div class="col-xs-12">
<div class="box">
  <div class="box-header">
	<h3 class="box-title">Equipment List For Workstation 1</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
	<table id="equipment1" class="table table-bordered table-hover">
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
<div class="box">
  <div class="box-header">
	<h3 class="box-title">Equipment List For Workstation 2</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
	<table id="equipment2" class="table table-bordered table-hover">
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
';
include('../master.php');
?>
<script>
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/workstation/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].id+"</td>"+
                "<td>"+data[user].name+"</td>"+
                "<td>"+data[user].description+"</td>"+
                "</tr>";
            }
            $(response).appendTo($("#workstations"));
        }
    });
  });
function ShowEquipment(n, id){
  
    $.ajax({
        type: "GET",
        url: "../api/equipment/read_for_workstation.php?workstation_id=" + n,
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
            $(response).appendTo($(id));
        }
    });
  };

  //onLoad functions
  window.addEventListener("load", function(){
	ShowEquipment(1, "#equipment1");
	ShowEquipment(2, "#equipment2");
  });

  </script>