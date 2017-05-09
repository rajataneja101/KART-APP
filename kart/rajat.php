<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css3/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css3/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css3/style.css" rel="stylesheet">
            <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bus Ticket Booking</title>
        <link rel="stylesheet" type="text/css" href="css3/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css3/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="css3/datepicker.css" />
</head>


<?php
    include('db_login.php');
    session_start();
    $connection = mysql_connect($db_host, $db_username, $db_password);
    if (!$connection)
    {
        die ("Could not connect to the database: <br />". mysql_error());
    }
    mysql_select_db('book');
?>





    <BODY>
        <br /><br /><br />
        <div class="container">
            <div class="row well">
                <div class="span10">
                    <form action="seat.php" method="POST">
                        <center>
                            <label>Date of Journey</label>



                            <div data-date-format="yyyy-mm-dd" data-date="document.write(date())" class="input-append date myDatepicker">
                                <input type="text" value="" name="doj" size="16" class="span2" required>
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>


                            <!--<input type="date" class="span2" name="doj" placeholder="YYYY-MM-DD" required/>-->
                            <br><br>
                            <button type="submit" class="btn btn-info">
                                <i class="icon-ok icon-white"></i> Submit
                            </button>
                            <button type="reset" class="btn">
                                <i class="icon-refresh icon-black"></i> Clear
                            </button>
                            <a href="cancel.php" class="btn btn-danger"><i class="icon-remove icon-white"></i> Cancel Ticket </a>
                        </center>
                    </form>
                </div>
            </div>
        </div>

        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script>window.jQuery || document.write('<script src="js3/jquery-latest.min.js">\x3C/script>')</script>
        <script type="text/javascript" src="js3/bootstrap.js"></script>
        <script type="text/javascript" src="js3/bootstrap-datepicker.js"></script>
        <script>
            $('.myDatepicker').each(function() {
                var minDate = new Date();
                minDate.setHours(0);
                minDate.setMinutes(0);
                minDate.setSeconds(0,0);
                
                var $picker = $(this);
                $picker.datepicker();
                
                var pickerObject = $picker.data('datepicker');
                
                $picker.on('changeDate', function(ev){
                    if (ev.date.valueOf() < minDate.valueOf()){
                        
                        // Handle previous date
                        alert('You can not select past date.');
                        pickerObject.setValue(minDate);
                        
                        // And this for later versions (in case)
                        ev.preventDefault();
                        return false;
                    }
                });
            });                 
        </script>
    </BODY>
</HTML>