<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Equipment List</h3>
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
            </div>';
  include('../master.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/equipment/read.php",
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
                "<td><a href='update.php?id="+data[user].id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#equipment"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Are you sure you want to Delete the equipment Record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/equipment/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed equipment!");
                    window.location.href = '/rezerwacja/wyposażenie';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>