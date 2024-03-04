<?php
include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Sales</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container py-4">
            <div class="innerLink">
                <ul class="innerNav d-flex justify-content-between">
                    <li class="item active" style="padding: 10px;"><a href="#employeesalesdetails" id="salesdetails">Lists</a></li>
                </ul>
            </div>

            <div class="detailView">

                <div class="table table-responsive" id="salesdesc">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sl no</th>                            
                                <th scope="col">Sales Source</th>
                                <th scope="col">Sales Amount</th>                              
                             
                            </tr>
                        </thead>
                        <tbody>

                           
                        </tbody>
                    </table>





                </div>
            </div>
        </div>
    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>
    <script>
        $('.linkBtn').removeClass('active');
        $('.SalesLink').addClass('active');
        populateTable();
        function populateTable() {
            $.ajax({
                url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
                type: 'POST',
                data: {
                    type: 'salesDetailInGroup'
                }, // Add a new type to indicate fetching employees
                dataType: 'json',
                success: function(response) {
                    // Clear existing table rows
                    $('#employeedetails tbody').empty();
                    console.log(response);
                    $.each(response, function(index, sales) {
                        var row = $('<tr>');
                        row.append('<td>' + (index + 1) + '</td>'); 
                        row.append('<td>' + sales.sales_source + '</td>'); 
                        row.append('<td>' + sales.total_amount + '</td>');                     
                        $('#salesdesc tbody').append(row);
                    });
                    
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
</body>

</html>