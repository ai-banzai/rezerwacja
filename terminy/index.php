<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Reservations List</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="reservations" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Reservation ID</th>
                        <th>Person ID</th>
                        <th>Workstation ID</th>
                        <th>Date</th>
                        <th>Start time</th>
                        <th>End Time</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Person</th>
                        <th>Workstation</th>
                        <th>Date</th>
                        <th>Start time</th>
                        <th>End Time</th>
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
        url: "../api/reservations/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].id+"</td>"+
                "<td>"+data[user].person_id+"</td>"+
                "<td>"+data[user].workstation_id+"</td>"+
                "<td>"+data[user].date+"</td>"+
                "<td>"+data[user].time_start+"</td>"+
                "<td>"+data[user].time_end+"</td>"+
                "<td><a href='update.php?id="+data[user].id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#reservations"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Are you sure you want to Delete the Reservation Record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/reservations/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed Reservation!");
                    window.location.href = '/rezerwacja/terminy';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>