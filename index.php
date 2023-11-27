<?php
include './conn.php'

?>

<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Tanaman Sawi </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            function table() {
                $.ajax({
                    url: 'api/getdata.php',
                    type: 'GET',
                    success: 
                        function(response) {
                        var table = $('#myTable');
                        var i = 1;

                        table.find("tr:gt(0)").remove();

                        $.each(response, function(index, item) {
                            var date = new Date(item.updated_at);  
                            var humidity =  Math.round(Math.abs(((item.sensor1 / 1024) * 100)-100));
                            var condition, pump;
    
                            if (item.sensor1 <=550) {
                                $kondisi = "BASAH";
                            }
                            else $kondisi = "KERING";
    
                            if (item.sensor1 <=550) {
                                $pump = "OFF";
                            }
                            else $pump = "ON";
    
                            var row = '<tr>'+
                            '<td>' + i + '</td>'+
                            '<td>' + date.toLocaleString() + '</td>' +
                            '<td>' + humidity + '%' + '</td>' +
                            '<td>' + $kondisi + '</td>' +
                            '<td>' + $pump + '</td>' +
                            '</tr>';
                            table.append(row);
                            console.log(row);
                            i++;
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            setInterval(function() {
                table();
            }, 500);
            });
    </script>
</head>
<body>
    <div class="container pt-5">
        <table class="table mx-auto my-auto w-75 text-center" id="myTable">
          <thead class="table-secondary table-success">
            <th>No.</th>
            <th>WAKTU</th>
            <th>KELEMBABAN</th>
            <th>KONDISI TANAH</th>
            <th>POMPA</th>
          </thead>
          <tbody>
            <!-- diisi oleh jquery ajax -->
          </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>