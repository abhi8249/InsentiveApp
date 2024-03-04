
<nav id="topNavBar" class="navbar navbar-main navbar-expand-lg"
    id="navbarBlur" data-scroll="true">
    <div class="container py-1 px-3">
        
        <div aria-label="breadcrumb" class="navFlex">

            <div class="logo"><img src="" alt=""></div>

            <div class="mainNavbar">
                <ul class="mainNav">
                    <li><a class="homeLink linkBtn" href="<?php echo FO_FRONT_SITE.'/dashboard.php' ?>">Dashboard</a></li>
                    <li><a class="EmployeesLink linkBtn" href="<?php echo FO_FRONT_SITE.'/Employees.php' ?>">Employees</a></li>
                    <li><a class="SalesLink linkBtn" href="<?php echo FO_FRONT_SITE.'/Sales.php' ?>">Sales</a></li>

                    <li><a class="PackageLink linkBtn" href="<?= FO_FRONT_SITE.'/Package.php'?>">Package</a></li>
                    <li> <a class="IncentiveLink linkBtn" href="<?= FO_FRONT_SITE.'/Incentive.php'?>">Incentive</a></li>
                </ul>
            </div>

          

        </div>

    </div>
</nav>


<!-- <div class="profileSec">
    <div class="bg"></div>
    <div class="content">
        <div class="close"><span>X</span></div>
        <div class="mainCon">
            <div class="profileArea">
                <div class="accountInfo">
                    <img src="" alt="">
                    <h4></h4>

                </div>
            </div>
            <div class="actionArea">
                <div class="quickAction"></div>
                <div class="needHelp"></div>
                <div class="otherNews"></div>
            </div>
        </div>
    </div>
</div> -->

<div class="modal" id="addOrganisationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Organisation</h5>
                    <button type="button" class="closeOrganisation" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="organisationbody" style="margin:0 auto;"></div>
                <div class="modal-footer">
                    <button type="button" id="submitOrganisation" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="addTravelAgentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Travel Agent</h5>
                    <button type="button" class="closeTravelAgent" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="TravelAgentbody" style="margin:0 auto;">

                    <div class="travelaagent-modal-body">
                        <form action="" id="travelagent-add-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" placeholder="Travel Agent Name" class="form-control" name="travelagentname">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" placeholder="Travel Agent Email" class="form-control" name="travelagentemail">

                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Address</label>
                                        <input type="text" placeholder="Address" name="travelagentAddress" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">City</label>
                                        <input type="text" placeholder="City" name="travelagrntCity" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">State</label>
                                        <input type="text" placeholder="State" name="travelagentState" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Country</label>
                                        <input type="text" name="travelagentCountry" placeholder="Country" class="form-control">
                                    </div>   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <laabel class="control-label">Post Code</laabel>
                                        <input type="text" name="travelagentPostCode" placeholder="Post Code" class="form-control">
                                    </div>   
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Phone Number</label>
                                        <input type="text" name="travelagentPhoneno" placeholder="eg:+91 ***** *****" class="form-control">
                                    </div>
                                </div>
                              
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="" class="control-label">GST Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Your Gst Number" name="travelagentGstNo">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Commission</label>
                                        <input type="number" name="travelagentcommission" value=0 class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">GST On Commission</label>
                                        <input type="number" class="form-control" value=0 name="travelaaagentGstonCommision">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">TCS</label>
                                        <input type="number" class="form-control" value=0 name="travelaaagentTcs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">TDS</label>
                                        <input type="number" class="form-control" value=0 name="travelaaagentTds">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="" class="control-label">Notes</label>
                                    <input type="text" class="form-control" placeholder="Enter Note" name="travelagentNote">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="submitTravelAgent" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

