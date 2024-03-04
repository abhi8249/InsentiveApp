<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');


// checkLoginAuth();
if(!isset( $_SESSION['login'])){
    header('Location: login.php');
    die();
}

$currentDate = date('m/d/Y');
$nextDate = date('m/d/Y', strtotime("+1 day"));


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Booking Engine</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">



    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">




        <div class="container py-4">


            <div class="row">
                <?php
                $navHtml = '<form action="">
                                    <input type="text" id="startPicker" value="' . $currentDate . '">
                                    <input type="text" id="endPicker" value="' . $nextDate . ' ">
                                    <button type="submit">Submit</button>
                                </form>';
                echo backNavbarUi('', 'Booking Engine', $navHtml);
                ?>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-7 text-start">
                                    <p class="text-sm mb-1 text-capitalize font-weight-bold">Revenue</p>
                                    <h5 class="font-weight-bolder mb-0" id="revenue">
                                        
                                    </h5>
                                </div>
                                <div class="col-5">
                                    <div class="dropdown text-end">
                                        <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="text-xs text-secondary"><?= date('d M', strtotime($currentDate)) ?> - <?= date('d M', strtotime($nextDate)) ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-7 text-start">
                                    <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Sales</p>
                                    <h5 class="font-weight-bolder mb-0" id="totalsales">
                                        
                                    </h5>
                                </div>
                                <div class="col-5">
                                    <div class="dropdown text-end">
                                        <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="text-xs text-secondary"><?= date('d M', strtotime($currentDate)) ?> - <?= date('d M', strtotime($nextDate)) ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-7 text-start">
                                    <p class="text-sm mb-1 text-capitalize font-weight-bold">Visitor</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format(100) ?>
                                    </h5>

                                </div>
                                <div class="col-5">
                                    <div class="dropdown text-end">
                                        <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="text-xs text-secondary"><?= date('d M', strtotime($currentDate)) ?> - <?= date('d M', strtotime($nextDate)) ?></span>
                                        </a>
                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Total Products</h6>
                                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="See traffic channels">
                                    <i class="fas fa-info" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body pb-0 p-3 mt-4">
                            <div class="row">
                                <div class="col-7 text-start">
                                    <div class="chart">
                                        <canvas id="chart-pie" class="chart-canvas" height="200" width="272" style="display: block; box-sizing: border-box; height: 200px; width: 272.7px;"></canvas>
                                    </div>
                                </div>
                                <div class="col-5 my-auto">
                                    <?php
                                    $colorArry = ['bg-info', 'bg-primary', 'bg-dark', 'bg-secondary'];
                                    $roomarr =[
                                        'id'=>'2',
                                        'header'=>'3'
                                    ];

                                        echo '
                                                <span class="badge badge-md badge-dot me-4 d-block text-start">
                                                    <i class="bg-info"></i>
                                                    <span class="text-dark text-xs">test</span>
                                                </span>
                                            ';
                                  

                                    ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Revenue</h6>
                                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="See which ads perform better">
                                    <i class="fas fa-info" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-md badge-dot me-4">
                                    <i class="bg-primary"></i>
                                    <span class="text-dark text-xs">Amounts</span>
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300" style="display: block; box-sizing: border-box; height: 300px; width: 1025.3px;" width="1025"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Revenue By Days</h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-bar" class="chart-canvas" height="300" width="1025" style="display: block; box-sizing: border-box; height: 300px; width: 1025.3px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Recent bookings</h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group list-group-flush list my--3" id="rectentsales">
                                    
                             


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>


    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>



    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>



    <?php


    // if(checkBEStatus('e5740') == 'Improper'){
    //     echo '<script> configurationForm(); </script>';
    // }


    ?>
    <script>
        $('.linkBtn').removeClass('active');
        $('.homeLink').addClass('active');

        $('#startPicker,#endPicker').datepick({
            onSelect: customRange,
            showTrigger: '#calImg'
        });
          $(document).ready(function() {
              getheadData();
              rectentsales();
            });
function rectentsales(){
    var data = new FormData();
    data.append('type', 'rectentsales');

    $.ajax({
        url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
        type: "POST",
        data: data,
        processData: false,  // Ensure jQuery doesn't process the data
        contentType: false,  // Ensure jQuery doesn't add a content-type header
        success: function(response) {
            console.log(response);
            $('#rectentsales').html(response);
        },
        error: function(error) {
            console.error("Error:", error);
        }
    });
}
function getheadData() {
    var data = new FormData();
    data.append('type', 'getAllData');

    $.ajax({
        url: "<?php echo FRONT_SITE ?>/include/ajax/Employee.php",
        type: "POST",
        data: data,
        processData: false,  // Ensure jQuery doesn't process the data
        contentType: false,  // Ensure jQuery doesn't add a content-type header
        success: function(response) {
            console.log(response);
            var res = JSON.parse(response);
            var revenue = res.revenue;
            var totalsales = res.totalsales;
            $('#revenue').html(revenue);
            $('#totalsales').html(totalsales);
        },
        error: function(error) {
            console.error("Error:", error);
        }
    });
}

        function customRange(dates) {
            if (this.id == 'startPicker') {
                $('#endPicker').datepick('option', 'minDate', dates[0] || null);
            } else {
                $('#startPicker').datepick('option', 'maxDate', dates[0] || null);
            }
        }


        var ctx1 = document.getElementById("chart-line").getContext("2d");
        var ctx2 = document.getElementById("chart-pie").getContext("2d");
        var ctx3 = document.getElementById("chart-bar").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        // Line chart
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ['day1','day2'],
                datasets: [{
                    label: "Total Amount",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#cb0c9f",
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [1000,2000],
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7'
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10
                        }
                    },
                },
            },
        });


        // Pie chart
        new Chart(ctx2, {
            type: "pie",
            data: {
                labels: ['date1','date2'],
                datasets: [{
                    label: "Projects",
                    weight: 9,
                    cutout: 0,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: ['red','pink'],
                    data: [5,10],
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });

        // Bar chart
        new Chart(ctx3, {
            type: "bar",
            data: {
                labels: ['16-20', '21-25', '26-30', '31-36', '36-42', '42+'],
                datasets: [{
                    label: "Sales by age",
                    weight: 5,
                    borderWidth: 0,
                    borderRadius: 4,
                    backgroundColor: '#3A416F',
                    data: [15, 20, 12, 60, 20, 15],
                    fill: false
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7'
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10
                        }
                    },
                },
            },
        });
    </script>

</body>

</html>