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

    <title>Package</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container py-4">
            <div class="innerLink">
                <ul class="innerNav d-flex justify-content-between">
                    <li class="item active" style="padding: 10px;"><a href="#employeesalesdetails" id="salesdetails">Lists</a></li>
                   
                    <li ><button id="newUserBtn" type="button" class="btn bg-gradient-info m0">New List</button></li>
                </ul>
            </div>

            <div class="detailView">

                <div class="table table-responsive" id="salesdesc">

                    <table class="table table-hover" id="getPackageData">
                        <thead>
                            <tr>
                                <th scope="col">Sl no</th>
                                <th scope="col">Name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Night/Amenities</th>                                
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
        $('.PackageLink').addClass('active');
        $(document).ready(function() {
            getPackageData();
            });

        function getPackageData(){
            var data = new FormData();
    data.append('type', 'getPackageData');

    $.ajax({
        url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
        type: "POST",
        data: data,
        processData: false,  // Ensure jQuery doesn't process the data
        contentType: false,  // Ensure jQuery doesn't add a content-type header
        success: function(response) {
            console.log(response);
            $('#getPackageData tbody').html(response);
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
        data: { type: 'getPackageDetails', id: id }, // Pass the id to PHP
        success: function(response) {

            showModalBox('Package', 'Edit', response, 'editPackageSubmit', modalSize = '', target = '#popUpModal');
            var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
            myModal.show();

        },
        error: function(error) {
            console.error("Error:", error);
        }
    });
});
$(document).on('click','#editPackageSubmit',function(){
    var data = $('#editForm').serialize();
   data = data + '&type=updatepackagedetails'; // Append the parameter using &

   $.ajax({
        url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
        type: "POST",
        data: data, 
        success: function(response) {
            if(response.trim()=='ok'){
                sweetAlert("UPDATED")
            }
            else{
                sweetAlert('Sorry Something went Wrong!','error');
            }

        },
        error: function(error) {
            console.error("Error:", error);
        }
    });
});

    </script>
</body>

</html>