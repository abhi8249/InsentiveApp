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

    <title>Insentive</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container py-4">
            <div class="innerLink">
                <ul class="innerNav d-flex justify-content-between">
                    <li class="item active" style="padding: 10px;"><a href="#employeesalesdetails" id="salesdetails">Lists</a></li>
                    <li><button id="newUserBtn" type="button" class="btn bg-gradient-info m0">New List</button></li>
                </ul>
            </div>

            <div class="detailView">
                <div class="table table-responsive" id="employeesalesdetails">

                    <table class="table table-hover" id="insdetails">
                        <thead>
                            <tr>
                                <th scope="col">Sl no</th>
                                <th scope="col">Sales Target</th>
                                <th scope="col">Incentive Percentage</th>
                                <th scope="col">Bonus</th>
                                <th scope="col">Package</th>
                                <th scope="col">Action</th>
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
        $('.Incentive').addClass('active');

        $(document).ready(function() {
            getInsentiveData();
        });

        function getInsentiveData() {
            var data = new FormData();
            data.append('type', 'getInsentiveData');

            $.ajax({
                url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
                type: "POST",
                data: data,
                processData: false, // Ensure jQuery doesn't process the data
                contentType: false, // Ensure jQuery doesn't add a content-type header
                success: function(response) {
                    console.log(response);
                    $('#insdetails tbody').html(response);
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }



        $(document).on('click', '.update', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
                type: "POST",
                data: {
                    type: 'getInsentiveDetailss',
                    id: id
                },
                success: function(response) {

                    showModalBox('Insentive', 'Edit', response, 'editPackageSubmit', modalSize = '', target = '#popUpModal');
                    var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
                    myModal.show();

                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });


        });
        $(document).on('click', '#editPackageSubmit', function() {
    var formData = new FormData();

    $("#editForm input").each(function(index, element) {
        formData.append($(element).attr("name"), $(element).val());
    });
    formData.append('type', 'editSubmitInsentive'); // Fixed typo: 'editSubmitInsentive'

    $.ajax({
        url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
        type: "POST",
        data: formData,
        processData: false, // Set processData to false for FormData
        contentType: false, // Set contentType to false for FormData
        success: function(response) {
            console.log(response);
            if (response.trim() == 'ok') {
                sweetAlert("Updated");
            } else {
                sweetAlert('Sorry', 'error'); // Fixed typo: 'sorry'
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            sweetAlert('Error', 'error'); // Alert user about the error
        }
    });
});

    </script>
</body>

</html>