<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');

$type = $_POST['type'];
if($type =='addnewEmp'){

    $name = $_POST['name'];
    $phno = $_POST['phno'];
    $email = $_POST['Email'];
    $spm = $_POST['spm'];
    $address = $_POST['address'];
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    
    // Check if the phone number and username password combination already exists
    $query_check = "SELECT * FROM employees WHERE phno = '$phno' AND userid = '$userid' AND password = '$password'";
    $result_check = mysqli_query($conDB, $query_check);
    
    if(mysqli_num_rows($result_check) > 0) {
        // If a record with the same phone number and username password combination already exists
        $response = array('status' => 'error', 'message' => 'Record with the same phone number and username password already exists');
    } else {
        // If the record does not exist, proceed with insertion
        $query = "INSERT INTO employees (name, phno, email, spm, address, userid, password) VALUES ('$name', '$phno', '$email', '$spm', '$address', '$userid', '$password')";
        $result = mysqli_query($conDB, $query);
    
        if ($result) {
            // If insertion was successful
            $emp_id = mysqli_insert_id($conDB); // Get the last inserted ID (employee ID)
            
            // Insert default values into employees_incentives table
            $query_incentives = "INSERT INTO employees_incentives (emp_id, name, salary, salary_with_incentive_and_bonus) VALUES ('$emp_id', '$name', '$spm','$spm')"; // Assuming default salary is 0
            $result_incentives = mysqli_query($conDB, $query_incentives);
            
            if ($result_incentives) {
                // If insertion into employees_incentives was successful
                $response = array('status' => 'success', 'message' => 'Data inserted successfully');
            } else {
                // If there was an error inserting into employees_incentives
                $response = array('status' => 'error', 'message' => 'Error inserting data into employees_incentives: ' . mysqli_error($conDB));
            }
        } else {
            // If there was an error inserting into employees
            $response = array('status' => 'error', 'message' => 'Error inserting data: ' . mysqli_error($conDB));
        }
    }
    
    // Send response
    header('Content-Type: application/json');
    echo json_encode($response);
    

}



if ($type == 'getEmployees') {


    // Fetch data from the database
    $query = "SELECT id, name, phno, email, spm, address, userid, password FROM employees"; // Modify this query according to your database structure
    $result = mysqli_query($conDB, $query);

    // Check if the query executed successfully
    if ($result === false) {
        // Query execution failed, handle the error
        $response = array('status' => 'error', 'message' => 'Failed to fetch data from the database: ' . mysqli_error($conDB));
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Stop script execution
    }

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize an empty array to store employee data
        $employees = array();

        // Fetch each row and add it to the $employees array
        while ($row = mysqli_fetch_assoc($result)) {
            $employees[] = $row;
        }

        // Send JSON response with employee data
        header('Content-Type: application/json');
        echo json_encode($employees);
    } else {
        // If no rows found, send an empty JSON array
        header('Content-Type: application/json');
        echo json_encode(array());
    }

}


if($type == 'checkConditions'){

    $query = "SELECT * FROM  employees_incentives ";
    $sql = mysqli_query($conDB,$query);
    if(mysqli_num_rows($sql)>0){
        while($row=mysqli_fetch_assoc($sql)){
         
           $calInsen = calculateIncentive($row['sales_amount']);
           $result = updateInsentiveDetails($conDB,$row['emp_id'],$calInsen['incentive_percentage'],$calInsen['bonus'],$calInsen['holiday_package_eligibility']);
           if($result){
            echo 'ok';
           }
           else{
            echo 'no';
           }
          
        }
    }

}




if($type =='getEmployeesSalesDetails'){
    $sql = "SELECT * FROM  employees_incentives";

// Execute query
$result = $conDB->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Initialize an array to store the employee data
    $employees = array();

    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        // Add each row (employee) to the array
        $employees[] = $row;
    }

    // Send JSON response with the employee data
    header('Content-Type: application/json');
    echo json_encode($employees);
} else {
    // If no rows were returned, send an error response
    header("HTTP/1.1 404 Not Found");
    echo json_encode(array("error" => "No employees found"));
}
}

if ($type == 'salesDetailInGroup') {
    // SQL query with GROUP BY clause
    $sql = "SELECT sales_source, SUM(sales_amount ) AS total_amount FROM employees_incentives GROUP BY sales_source";

    // Execute query
    $result = mysqli_query($conDB, $sql);

    // Check if query was executed successfully
    if ($result === false) {
        // Handle SQL error
        $error_message = mysqli_error($conDB);
        echo json_encode(array("error" => "SQL Error: " . $error_message));
        exit; // Stop further execution
    }

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize an array to store the sales data
        $salesData = array();

        // Loop through each row of the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the array
            $salesData[] = $row;
        }

        // Send JSON response with the sales data
        header('Content-Type: application/json');
        echo json_encode($salesData);
    } else {
        // If no rows were returned, send an error response
        header("HTTP/1.1 404 Not Found");
        echo json_encode(array("error" => "No sales data found"));
    }
}

if($type == 'getAllData'){
    $data = getallRevenue();
    echo json_encode($data);

}
if($type == 'rectentsales'){
    $data = getallSalesDetails();

    $html='';
    foreach($data as $val){
$html.='
<li class="list-group-item px-0 border-0">
<div class="row align-items-center">
    <div class="col-auto">
        <img style="width:40px" src="" alt="">
    </div>
    <div class="col">
        <p class="text-xs font-weight-bold mb-0">Name:</p>
        <h6 class="text-sm mb-0">'.$val['name'].'</h6>
    </div>
    <div class="col text-center">
        <p class="text-xs font-weight-bold mb-0">Total:</p>
        <h6 class="text-sm mb-0">₹ '.$val['sales_amount'].'</h6>
    </div>
</div>
<hr class="horizontal dark mt-3 mb-1">
</li>
';
    }
    echo $html;
}
if($type == 'getInsentiveData'){
    $data =getInsentiveData();
    $html ='';
    $sl=1;
    foreach($data as $val){
        $html.='
        <tr>
        <td scope="row">'.$sl.'</td>
        <td>'.$val['sales_amount'].'</td>
        <td>'.$val['incentive_percentage'].'</td>
        <td>'.$val['bonus'].'</td>
        <td>'.$val['holiday_package_eligibility'].'</td>
        <td width="25%"><a class="tableIcon update bg-gradient-info" id="updateIcon" href="javascript:void(0)" data-id="'.$val['id'].'" data-tooltip-top="Edit"><svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                    <path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                </svg><!-- <i class="far fa-edit"></i> Font Awesome fontawesome.com --></a>
                
        
               
           </td>        
    </tr>
        ';
        $sl++;
    }
    echo $html;
}
if($type == 'getPackageData'){
    $data = getPackageData();
    $html ='';
    $sl=1;
    foreach($data as $val){
        $html.= '
        <tr>
            <td scope="row">'.$sl.'</td>
            <td>'.$val['name'].'</td>
            <td>'.$val['location'].'</td>
            <td>'.$val['amenities'].'</td>
            <td><a class="tableIcon update bg-gradient-info" id="updateIcon" href="javascript:void(0)" data-id="'.$val['id'].'" data-tooltip-top="Edit"><svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                    </svg><!-- <i class="far fa-edit"></i> Font Awesome fontawesome.com --></a> </td>
        </tr>';
        $sl++;
    }
    echo $html;
}
if ($type == 'getPackageDetails') {
    // Assuming you have a function to fetch package details by ID
    $id = $_POST['id'];
    $packageDetails = getPackageData($id);
    // pr($packageDetails);
    $html = '<tr>
    <form id="editForm">
        <input type="hidden" name="id" value="' . $packageDetails[0]['id'] . '">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Package Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="' . $packageDetails[0]['name'] . '">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" name="location" id="location" value="' . $packageDetails[0]['location'] . '">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="amenities">Amenities</label>
                    <input type="text" class="form-control" name="amenities" id="amenities" value="' . $packageDetails[0]['amenities'] . '">
                </div>
            </div>
        </div>
    </form>
</tr>';

echo $html; 

}
if($type == 'getInsentiveDetailss'){
    $id = $_POST['id'];
    $packageDetails = getInsentiveData($id);
    // pr($packageDetails);
    $html = '<tr>
    <form id="editForm" class="row g-3">
        <input type="hidden" name="id" value="' . $packageDetails[0]['id'] . '">
        <td class="col-md-2">
            <label for="sales_amount" class="form-label">Sales Amount</label>
            <input type="text" class="form-control" id="sales_amount" name="sales_amount" value="' . $packageDetails[0]['sales_amount'] . '">
        </td>
        <td class="col-md-2">
            <label for="incentive_percentage" class="form-label">Incentive Percentage</label>
            <input type="text" class="form-control" id="incentive_percentage" name="incentive_percentage" value="' . $packageDetails[0]['incentive_percentage'] . '">
        </td>
        <td class="col-md-2">
            <label for="bonus" class="form-label">Bonus</label>
            <input type="text" class="form-control" id="bonus" name="bonus" value="' . $packageDetails[0]['bonus'] . '">
        </td>
        <td class="col-md-3">
            <label for="holiday_package_eligibility" class="form-label">Holiday Package Eligibility</label>
            <input type="text" class="form-control" id="holiday_package_eligibility" name="holiday_package_eligibility" value="' . $packageDetails[0]['holiday_package_eligibility'] . '">
        </td>
    </form>
</tr>';

echo $html; 
}

if($type == 'updatepackagedetails'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $amenities = $_POST['amenities']; 
    
    $result = setPackage($id, $name, $location, $amenities);
    if($result){
        echo 'ok';
    }
    else{
        echo 'no';
    }

    
}

if($type == 'editSubmitInsentive'){
    $id = $_POST['id'];
    $sales_amount = $_POST['sales_amount'];
    $incentive_percentage = $_POST['incentive_percentage'];
    $bonus = $_POST['bonus']; 
    $holiday_package_eligibility = $_POST['holiday_package_eligibility']; 
    
    $result = setInsenetive($id, $sales_amount, $incentive_percentage, $bonus, $holiday_package_eligibility);
    if($result){
        echo 'ok';
    }
    else{
        echo 'no';
    }

    
}
if($type == 'checkLogin'){
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $result = LoginCheck($username, $pass);
    if($result){
        $data = [
            'error'=>'no',
            'target'=>'success',
            'msg'=>'ok'
        ];
        $_SESSION['login']=1;
    }
    else{
        $data = [
            'error'=>'yes',
            'target'=>'no',
            'msg'=>'not'
        ];
    }
    echo json_encode($data);
}
?>


