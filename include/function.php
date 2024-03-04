<?php




function backNavbarUi($backLink='',$title='',$rightHtml='',$leftHtml=''){

    if($backLink == ''){
        $backLink = FRONT_SITE;
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ''){
            $backLink = $_SERVER['HTTP_REFERER'];
        }
    }
    
    
    $html = '
        <div class="row">
            <div class="col-12 my-1">
                <div class="card">
                    <div class="card-body p-0" style="padding-right: 10px !important;">
                        <div class="dFlex jcsb aic">
                            <div class="left dFlex wAuto aic">
                                
                                <a class="py-3 dFlex backBtnA wAuto" href="'.$backLink.'">
                                <div class="backBtn">
                                    <svg viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                        <g class="arrow-head">
                                            <path d="M1 1C4.5 4 5 4.38484 5 4.5C5 4.61516 4.5 5 1 8" stroke="currentColor" stroke-width="2"></path>
                                        </g>
                                        <g class="arrow-body">
                                            <path d="M3.5 4.5H0" stroke="currentColor" stroke-width="2"></path>
                                        </g>
                                    </svg>
                                </div> 
                                </a>

                                <span class="navTitle">'.$title.'</span>
                                '.$leftHtml.'
                            </div>
                            <div class="right">'.$rightHtml.'</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    ';
    return $html;
}
function currentPage()
{
    $page = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $page;
}

function redirect($link)
{
    ob_start();
    header('Location: ' . $link);
    ob_end_flush();
    die();
}

$time = date('Y-m-d h:i:s');

if (isset($_SESSION['HOTEL_ID'])) {
    $hotelId = $_SESSION['HOTEL_ID'];
} else {
    $hotelId = '';
    if (currentPage() != FRONT_SITE . '/login') {
        // redirect(FRONT_SITE.'/login');
    }
}



function pr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}

function calculateIncentive($sales_amount) {
global $conDB;
    
    // Query to get incentive details based on the sales amount
    $query = "SELECT * FROM sales_incentives WHERE sales_amount <= $sales_amount ORDER BY sales_amount DESC LIMIT 1";
    $result = mysqli_query($conDB, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the row containing the incentive details
        $row = mysqli_fetch_assoc($result);    

        // Return the incentive details
        return array(
            'incentive_percentage' => $row['incentive_percentage'],
            'bonus' => $row['bonus'],
            'holiday_package_eligibility' => $row['holiday_package_eligibility'] == 1 ? 'yes' : 'no'
        );
    } else {
        // Error handling if the query fails
        echo "Error: " . mysqli_error($conDB);
      
        return false;
    }
}


function updateInsentiveDetails($conDB, $emp_id, $incentive_percentage, $bonus, $holiday_package_eligibility) {

    $sql = "UPDATE employees_incentives 
            SET incentive_percentage = '$incentive_percentage', 
                bonus = '$bonus', 
                holiday_package_eligibility = '$holiday_package_eligibility' 
            WHERE emp_id = '$emp_id'";


    if ($conDB->query($sql) === TRUE) {
        return true;
    } else {
       return false;
    }

}
function getallRevenue(){
    global $conDB;
    $query = "SELECT SUM(sales_amount) as revenue FROM employees_incentives";

    $sql = mysqli_query($conDB, $query);

    if(mysqli_num_rows($sql)>0){
        $rows= mysqli_fetch_assoc($sql);
            $data['revenue'] = $rows['revenue'];
        
       
    }
    $query2= "SELECT * FROM employees_incentives";
    $sql2 = mysqli_query($conDB, $query2);
    $totalsales=mysqli_num_rows($sql2);
    $data['totalsales']=$totalsales;
    return $data;
}
function getallSalesDetails(){
    global $conDB;
    $query= "SELECT * FROM employees_incentives";
    $sql = mysqli_query($conDB, $query);
    if(mysqli_num_rows($sql)>0){
        while($rows= mysqli_fetch_assoc($sql)){
            $data[]=$rows;
        }
    }


    return $data;
}
function getInsentiveData($id=''){
    global $conDB;
    $query= "SELECT * FROM sales_incentives";
    if($id!=''){
        $query= "SELECT * FROM sales_incentives WHERE id = $id";
    }
    $sql = mysqli_query($conDB, $query);
    if(mysqli_num_rows($sql)>0){
        while($rows= mysqli_fetch_assoc($sql)){
            $data[]=$rows;
        }
    }


    return $data;
}
function getPackageData($id=''){
    global $conDB;
  
    $query= "SELECT * FROM package";
    if($id!=''){
        $query= "SELECT * FROM package WHERE id = $id";
    }
    $sql = mysqli_query($conDB, $query);
    $data=array();
    if(mysqli_num_rows($sql)>0){
        while($rows= mysqli_fetch_assoc($sql)){
            $data[]=$rows;
        }
    }


    return $data;
}
function setPackage($id, $name, $location, $amenities){
    global $conDB;
    $query = "UPDATE package set name = $name, location= $location, amenities=$amenities WHERE id = $id";
    $sql = mysqli_query($conDB, $query);
    if($sql){
        return true;
    }
    else{
        return false;
    }
}
function setInsenetive($id, $sales_amount, $incentive_percentage, $bonus, $holiday_package_eligibility){
    global $conDB;
    $query = "UPDATE sales_incentives set sales_amount = $sales_amount, incentive_percentage= $incentive_percentage, bonus=$bonus, holiday_package_eligibility = $holiday_package_eligibility WHERE id = $id";
    $sql = mysqli_query($conDB, $query);
    if($sql){
        return true;
    }
    else{
        return false;
    }
}
function LoginCheck($name,$password){

    global $conDB;
    $query = "SELECT * FROM admin where username = '$name' and password = '$password'";
    // echo $query;
    $sql = mysqli_query($conDB, $query);
    if($sql){
        return true;
    }
    else{
        return false;
    }
}
?>