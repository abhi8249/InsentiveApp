<?php
include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
if(!isset( $_SESSION['login'])){
    header('Location: login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Employee</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>
    <!-- <div id="popUpModal"></div> -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container py-4">
            <div class="innerLink">
                <ul class="innerNav d-flex justify-content-between">
                    <li class="item active" style="padding: 10px;"><a href="#employeesalesdetails" id="salesdetails">Lists</a></li>
                    <li class="item" style="padding: 10px;"><a href="#employeedetails" id="empdetails">Employee details</a></li>
                    <li><button id="newEmpBtn" type="button" class="btn bg-gradient-info m0">Add New Employee</button></li>
                </ul>
            </div>

            <div class="detailView">
                <div class="table table-responsive" id="employeesalesdetails">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sl no</th>
                                <th scope="col">Name</th>
                                <th scope="col">Sales Amount</th>
                                <th scope="col">Incentive Percentage</th>
                                <th scope="col">eligibility for a holiday package</th>
                                <th scope="col">Bonus</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Salary with Incentive and Bonus</th>
                                <!-- <th scope="col">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                    

                        </tbody>
                    </table>





                </div>
                <div class="table table-responsive hide" id="employeedetails">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sl no</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">SPM</th>
                                <th scope="col">Address</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Password</th>
                                <!-- <th scope="col">Action</th> -->
                            </tr>
                        </thead>
                        <tbody id="empldetailsbody">



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
        $('.EmployeesLink').addClass('active');
        $(document).on('click', '#empdetails', function() {
            $('#employeesalesdetails').addClass('hide');
            $('#employeedetails').removeClass('hide');
        });
        $(document).on('click', '#salesdetails', function() {
            $('#employeesalesdetails').removeClass('hide');
            $('#employeedetails').addClass('hide');
        });
        $(document).on('click', '.item', function() {
            $('.item').removeClass('active');
            $(this).addClass('active');
        });
        $(document).on('click', '#newEmpBtn', function() {
            var html = `<form id="newEmpForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="name"> Name</label>
                                        <input name="name" id="name" type="text" class="form-control" value="" required="">
                                    </div>
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="phno">Phone Number</label>
                                        <input name="phno" id="phno" type="number" class="form-control" value="" required="">
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="name"> Email</label>
                                        <input name="Email" id="Email" type="email" class="form-control" value="" required="">
                                    </div>
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="spm">Salay/Month</label>
                                        <input name="spm" id="spm" type="number" class="form-control" value="" required="">
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="address"> Address</label>
                                        <input name="address" id="address" type="text" class="form-control" value="" required="">
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="userid"> UserId</label>
                                        <input name="userid" id="userid" type="text" class="form-control" value="" required="">
                                    </div> 
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="password">Password</label>
                                        <input name="password" id="password" type="text" class="form-control" value="" required="">
                                    </div>                                   
                                </div>
                            </form>`;
            showModalBox('Add New Employee', 'Add', html, 'addempSubmit', modalSize = '', target = '#popUpModal');
            var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
            myModal.show();
        });
        $(document).on('click', '#addempSubmit', function() {
            console.log('r');
            var formData = new FormData($('#newEmpForm')[0]);
            formData.append('type', 'addnewEmp');
            $.ajax({
                url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        $('#popUpModal').modal('hide');
                        sweetAlert(response.message);
                        populateTable();
                        createEmployeeTableRow();
                        updateDetails();
                    } else {
                        sweetAlert(response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });

        function populateTable() {
            $.ajax({
                url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
                type: 'POST',
                data: {
                    type: 'getEmployees'
                }, // Add a new type to indicate fetching employees
                dataType: 'json',
                success: function(response) {
                    // Clear existing table rows
                    $('#employeedetails tbody').empty();

                    // Loop through the response data and populate the table
                    $.each(response, function(index, employee) {
                        var row = $('<tr>');
                        row.append('<td>' + (index + 1) + '</td>'); // Sl no
                        row.append('<td>' + employee.name + '</td>'); // Name
                        row.append('<td>' + employee.phno + '</td>'); // Phone Number
                        row.append('<td>' + employee.email + '</td>'); // Email
                        row.append('<td>' + employee.spm + '</td>'); // SPM
                        row.append('<td>' + employee.address + '</td>'); // Address
                        row.append('<td>' + employee.userid + '</td>'); // User ID
                        row.append('<td>' + employee.password + '</td>'); // Password (not recommended for security reasons)
                        // Assuming you don't want to display the password in the table
                        // row.append('<td><a class="tableIcon update bg-gradient-info" id="updateIcon" href="javascript:void(0)" data-id="' + employee.id + '" data-tooltip-top="Edit"><svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path></svg><!-- <i class="far fa-edit"></i> Font Awesome fontawesome.com --></a> <a class="tableIcon delete bg-gradient-danger" id="deleteIcon" href="javascript:void(0)" data-id="' + employee.id + '" data-tooltip-top="Delete"><svg class="svg-inline--fa fa-trash-alt fa-w-14" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"></path></svg><!-- <i class="far fa-trash-alt"></i> Font Awesome fontawesome.com --></a></td>');
                        $('#employeedetails tbody').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function createEmployeeTableRow() {


            $.ajax({
                url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
                type: 'POST',
                data: {
                    type: 'getEmployeesSalesDetails'
                }, // Add a new type to indicate fetching employees
                dataType: 'json',
                success: function(response) {
                    $.each(response, function(index, employee) {
                    var row = $('<tr>');
                    row.append('<td scope="row">' + employee.id + '</td>'); // Employee ID
                    row.append('<td>' + employee.name + '</td>'); // Name
                    row.append('<td>' + employee.sales_amount + '</td>'); // Sales Amount
                    row.append('<td>' + employee.incentive_percentage + '</td>'); // Incentive Percentage
                    row.append('<td>' + employee.holiday_package_eligibility+ '</td>'); // Eligibility for holiday package
                    row.append('<td>' + employee.bonus + '</td>'); // Bonus
                    row.append('<td>' + employee.salary + '</td>'); // Salary
                    row.append('<td>' + employee.salary_with_incentive_and_bonus + '</td>'); // Salary with Incentive and Bonus

                    // Action icons

                    // row.append(actions);
                    $('#employeesalesdetails tbody').append(row);
                    });
                },
                error: function(err) {

                }
            });
        }

        function updateDetails(){
            $.ajax({
               
                url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
                type: 'POST',
                data: {
                    type: 'checkConditions'
                }, // Add a new type to indicate fetching employees
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                },
                error :function(){

                }
            });
        }

        populateTable();
        createEmployeeTableRow();
        updateDetails();




    </script>
</body>

</html>