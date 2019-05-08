
    <div id="main-wrapper">
        <aside class="left-sidebar pt-20">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">

                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Directory & Breeders List</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">View Ex-Members</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Extract Directory / Mailing Labels</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Litter Listings</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Stud Register</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Administration & Data Management</h3>
                </div>

            </div>
            <div class="container-fluid">
              <div class="row">
                  <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Members</h4>
                            <h6 class="card-subtitle">List of Members</h6>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Kennel</th>
                                            <th>Breeder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $results = $db->query('SELECT * FROM `member`  ORDER BY `lastName` ASC')->fetchAll(); ?>
                                      <?php foreach ($results as $rs) {
                                        ?>
                                        <tr>
                                            <td><?php echo $rs['ID'];?></td>
                                            <td><a href="/wp-admin/admin.php?page=wheaten-club&idmember=<?php echo $rs['ID'];?>"><?php echo $rs['firstName'].' '.$rs['lastName']; ?></a></td>
                                            <td><?php echo $rs['kennel'] ? $rs['kennel'] : '--';?></td>
                                            <td><?php echo $rs['isBreeder'] == 'yes' ? 'Yes' : 'No';?></td>
                                        </tr>
                                        <?php   } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <?php if (isset($_GET['idmember'])): ?>

                      <?php $member = $db->query('SELECT * FROM `member`  WHERE `ID` = '.$_GET['idmember'].'')->fetchArray(); ?>

                      <div class="card card-outline-info">
                        <div class="card-header">
                                <h4 class="m-b-0 text-white"><?php echo $member['firstName'].' '.$member['lastName']; ?></h4>
                            </div>
                            <div class="card-body">


                          <form action="#">
                              <div class="form-body">
                                  <h3 class="card-title">Membership</h3>
                                  <hr>
                                  <div class="row p-t-20">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="control-label">Membership Type</label>
                                          <div class="demo-radio-button">
                                              <input name="membertype" type="radio" id="memberI" class="radio-col-light-blue" <?php echo $member['memberType'] == 'I' ? 'checked="checked"' : ''; ?>/>
                                              <label for="memberI">Individual</label>
                                          </div>
                                          <div class="demo-radio-button">
                                              <input name="membertype" type="radio" id="memberD" class="radio-col-light-blue" <?php echo $member['memberType'] == 'D' ? 'checked' : ''; ?>/>
                                              <label for="memberD">Dual/Household</label>
                                          </div>
                                          <div class="demo-radio-button">
                                              <input name="membertype" type="radio" id="nvAssc" class="radio-col-light-blue" <?php echo $member['memberType'] == 'A' ? 'checked' : ''; ?>/>
                                              <label for="nvAssc">NON-VOTING Associate</label>
                                          </div>
                                          <div class="demo-radio-button">
                                              <input name="membertype" type="radio" id="nvJr" class="radio-col-light-blue" <?php echo $member['memberType'] == 'J' ? 'checked' : ''; ?>/>
                                              <label for="nvJr">NON-VOTING - Junior</label>
                                          </div>
                                          <div class="demo-radio-button">
                                              <input name="membertype" type="radio" id="nvIntl" class="radio-col-light-blue" <?php if ($member['memberType'] == 'N' || $member['memberType'] == 'F') {echo 'checked';}?>/>
                                              <label for="nvIntl">NON-VOTING - Int'l</label>
                                          </div>
                                          <div class="demo-radio-button">
                                              <input name="membertype" type="radio" id="nvHnr" class="radio-col-light-blue" <?php echo $member['memberType'] == 'H' ? 'checked' : ''; ?>/>
                                              <label for="nvHnr">NON-VOTING - Honorary</label>
                                          </div>
                                          <div class="demo-radio-button">
                                              <input name="membertype" type="radio" id="nvLft" class="radio-col-light-blue" <?php echo $member['memberType'] == 'L' ? 'checked' : ''; ?>/>
                                              <label for="nvLft">NON-VOTING - Lifetime</label>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="control-label">Paid/ Current Through</label>
                                          <input type="text" class="form-control"  value="<?php echo $member['paidThru'] ? $member['paidThru'] : ''; ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <h3 class="card-title">Member(s) Information</h3>
                                  <hr>
                                  <div class="row p-t-20">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label class="control-label">First Name</label>
                                              <input type="text" id="firstName" class="form-control" value="<?php echo $member['firstName'] ? $member['firstName'] : ''; ?>">
                                          </div>
                                      </div>
                                      <!--/span-->
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="control-label">Last Name</label>
                                              <input type="text" id="lastName" class="form-control" value="<?php echo $member['lastName'] ? $member['lastName'] : ''; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label class="control-label">Suffix</label>
                                              <input type="text" id="suffix" class="form-control" value="<?php echo $member['suffix'] ? $member['suffix'] : ''; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Year Joined</label>
                                            <input type="text" class="form-control"  value="<?php echo $member['yearJoin'] ? $member['yearJoin'] : ''; ?>">
                                        </div>
                                      </div>
                                      <!--/span-->
                                  </div>
                                  <!--/row-->
                                  <?php if ($member['memberType'] == 'D'): ?>


                                  <div class="row p-t-20">
                                    <div class="col-md-12">
                                      <small class="text-primary">Use for DUAL membership where there are different last names</small>
                                    </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label class="control-label">First Name</label>
                                              <input type="text" id="firstName2" class="form-control" value="<?php echo $member['firstName2'] ? $member['firstName2'] : ''; ?>">
                                          </div>
                                      </div>
                                      <!--/span-->
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="control-label">Last Name</label>
                                              <input type="text" id="lastName2" class="form-control" value="<?php echo $member['lastName2'] ? $member['lastName2'] : ''; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label class="control-label">Suffix</label>
                                              <input type="text" id="suffix2" class="form-control" value="<?php echo $member['suffix2'] ? $member['suffix2'] : ''; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Year Joined</label>
                                            <input type="text" id="joined2" class="form-control"  value="<?php echo $member['yearJoin2'] ? $member['yearJoin2'] : ''; ?>">
                                        </div>
                                      </div>
                                      <!--/span-->
                                  </div>
                                  <!--/row-->
    <?php endif; ?>
    <h3 class="card-title">Mailing Information</h3>
    <hr>
    <div class="row p-t-20">

      <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Mail Wavelengths?</label>
            <div class="demo-radio-button">
                <input name="mailwave" type="radio" id="mailwavey" class="radio-col-light-blue" <?php echo $member['mailWL'] == 'Y' ? 'checked="checked"' : ''; ?>/>
                <label for="mailwavey">Yes</label>
            </div>
            <div class="demo-radio-button">
                <input name="mailwave" type="radio" id="mailwaven" class="radio-col-light-blue" <?php echo $member['mailWL'] == 'N' ? 'checked="checked"' : ''; ?>/>
                <label for="mailwaven">No</label>
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Mail Club Communication?</label>
            <div class="demo-radio-button">
                <input name="mailClub" type="radio" id="mailCluby" class="radio-col-light-blue" <?php echo $member['mailClubComm'] == 'Y' ? 'checked="checked"' : ''; ?>/>
                <label for="mailCluby">Yes</label>
            </div>
            <div class="demo-radio-button">
                <input name="mailClub" type="radio" id="mailClubn" class="radio-col-light-blue" <?php echo $member['mailClubComm'] == 'N' ? 'checked="checked"' : ''; ?>/>
                <label for="mailClubn">No</label>
            </div>
        </div>
      </div>
    </div>

    <h3 class="card-title">Breeder</h3>
    <hr>
    <div class="row p-t-20">
      <div class="col-md-8">
        <div class="form-group">
            <label class="control-label">Kennel Name</label>
            <input type="text" class="form-control"  value="<?php echo $member['kennel'] ? $member['kennel'] : ''; ?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Breeder List?</label>
            <div class="demo-radio-button">
                <input name="brdList" type="radio" id="brdList" class="radio-col-light-blue" <?php echo $member['isBreeder'] == 'yes' ? 'checked="checked"' : ''; ?>/>
                <label for="brdListy">Yes</label>
            </div>
            <div class="demo-radio-button">
                <input name="mbrdList" type="radio" id="brdListn" class="radio-col-light-blue" <?php echo $member['isBreeder'] == 'no' ? 'checked="checked"' : ''; ?>/>
                <label for="brdListn">No</label>
            </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Website URL</label>
            <input type="text" class="form-control"  value="<?php echo $member['url'] ? $member['url'] : ''; ?>">
        </div>
      </div>
    </div>

                                  <!--/row-->
                                  <h3 class="box-title m-t-40">Address</h3>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-12 ">
                                          <div class="form-group">
                                              <label>Street</label>
                                              <input type="text" class="form-control" value="<?php echo $member['addr1a'] ? $member['addr1a'] : ''; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-12 ">
                                          <div class="form-group">
                                              <label>Line 2</label>
                                              <input type="text" class="form-control" value="<?php echo $member['addr1b'] ? $member['addr1b'] : ''; ?>">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>City</label>
                                              <input type="text" class="form-control" value="<?php echo $member['city'] ? $member['city'] : ''; ?>">
                                          </div>
                                      </div>
                                      <!--/span-->
                                      <div class="col-md-6">
                                        <?php if ($member['country'] == "US" || $member['country'] == "USA"): ?>
                                          <label>State</label>
                                          <select class="select2 form-control custom-select" style="width: 100%;">
                                              <option>Choose...</option>
                                              <option value="AL" <?php echo  $member['state1'] == "AL" ? 'selected="selected"' : ''; ?>>Alabama</option>
                                              <option value="AK" <?php echo  $member['state1'] == "AK" ? 'selected="selected"' : ''; ?>>Alaska</option>
                                              <option value="AZ" <?php echo  $member['state1'] == "AZ" ? 'selected="selected"' : ''; ?>>Arizona</option>
                                              <option value="AR" <?php echo  $member['state1'] == "AR" ? 'selected="selected"' : ''; ?>>Arkansas</option>
                                              <option value="CA" <?php echo  $member['state1'] == "CA" ? 'selected="selected"' : ''; ?>>California</option>
                                              <option value="CO" <?php echo  $member['state1'] == "CO" ? 'selected="selected"' : ''; ?>>Colorado</option>
                                              <option value="CT" <?php echo  $member['state1'] == "CT" ? 'selected="selected"' : ''; ?>>Connecticut</option>
                                              <option value="DE" <?php echo  $member['state1'] == "DE" ? 'selected="selected"' : ''; ?>>Delaware</option>
                                              <option value="DC" <?php echo  $member['state1'] == "DC" ? 'selected="selected"' : ''; ?>>District Of Columbia</option>
                                              <option value="FL" <?php echo  $member['state1'] == "FL" ? 'selected="selected"' : ''; ?>>Florida</option>
                                              <option value="GA" <?php echo  $member['state1'] == "GA" ? 'selected="selected"' : ''; ?>>Georgia</option>
                                              <option value="HI" <?php echo  $member['state1'] == "HI" ? 'selected="selected"' : ''; ?>>Hawaii</option>
                                              <option value="ID" <?php echo  $member['state1'] == "ID" ? 'selected="selected"' : ''; ?>>Idaho</option>
                                              <option value="IL" <?php echo  $member['state1'] == "IL" ? 'selected="selected"' : ''; ?>>Illinois</option>
                                              <option value="IN" <?php echo  $member['state1'] == "IN" ? 'selected="selected"' : ''; ?>>Indiana</option>
                                              <option value="IA" <?php echo  $member['state1'] == "IA" ? 'selected="selected"' : ''; ?>>Iowa</option>
                                              <option value="KS" <?php echo  $member['state1'] == "KS" ? 'selected="selected"' : ''; ?>>Kansas</option>
                                              <option value="KY" <?php echo  $member['state1'] == "KY" ? 'selected="selected"' : ''; ?>>Kentucky</option>
                                              <option value="LA" <?php echo  $member['state1'] == "LA" ? 'selected="selected"' : ''; ?>>Louisiana</option>
                                              <option value="ME" <?php echo  $member['state1'] == "ME" ? 'selected="selected"' : ''; ?>>Maine</option>
                                              <option value="MD" <?php echo  $member['state1'] == "MD" ? 'selected="selected"' : ''; ?>>Maryland</option>
                                              <option value="MA" <?php echo  $member['state1'] == "MA" ? 'selected="selected"' : ''; ?>>Massachusetts</option>
                                              <option value="MI" <?php echo  $member['state1'] == "MI" ? 'selected="selected"' : ''; ?>>Michigan</option>
                                              <option value="MN" <?php echo  $member['state1'] == "MN" ? 'selected="selected"' : ''; ?>>Minnesota</option>
                                              <option value="MS" <?php echo  $member['state1'] == "MS" ? 'selected="selected"' : ''; ?>>Mississippi</option>
                                              <option value="MO" <?php echo  $member['state1'] == "MO" ? 'selected="selected"' : ''; ?>>Missouri</option>
                                              <option value="MT" <?php echo  $member['state1'] == "MT" ? 'selected="selected"' : ''; ?>>Montana</option>
                                              <option value="NE" <?php echo  $member['state1'] == "NE" ? 'selected="selected"' : ''; ?>>Nebraska</option>
                                              <option value="NV" <?php echo  $member['state1'] == "NV" ? 'selected="selected"' : ''; ?>>Nevada</option>
                                              <option value="NH" <?php echo  $member['state1'] == "NH" ? 'selected="selected"' : ''; ?>>New Hampshire</option>
                                              <option value="NJ" <?php echo  $member['state1'] == "NJ" ? 'selected="selected"' : ''; ?>>New Jersey</option>
                                              <option value="NM" <?php echo  $member['state1'] == "NM" ? 'selected="selected"' : ''; ?>>New Mexico</option>
                                              <option value="NY" <?php echo  $member['state1'] == "NY" ? 'selected="selected"' : ''; ?>>New York</option>
                                              <option value="NC" <?php echo  $member['state1'] == "NC" ? 'selected="selected"' : ''; ?>>North Carolina</option>
                                              <option value="ND" <?php echo  $member['state1'] == "ND" ? 'selected="selected"' : ''; ?>>North Dakota</option>
                                              <option value="OH" <?php echo  $member['state1'] == "OH" ? 'selected="selected"' : ''; ?>>Ohio</option>
                                              <option value="OK" <?php echo  $member['state1'] == "OK" ? 'selected="selected"' : ''; ?>>Oklahoma</option>
                                              <option value="OR" <?php echo  $member['state1'] == "OR" ? 'selected="selected"' : ''; ?>>Oregon</option>
                                              <option value="PA" <?php echo  $member['state1'] == "PA" ? 'selected="selected"' : ''; ?>>Pennsylvania</option>
                                              <option value="RI" <?php echo  $member['state1'] == "RI" ? 'selected="selected"' : ''; ?>>Rhode Island</option>
                                              <option value="SC" <?php echo  $member['state1'] == "SC" ? 'selected="selected"' : ''; ?>>South Carolina</option>
                                              <option value="SD" <?php echo  $member['state1'] == "SD" ? 'selected="selected"' : ''; ?>>South Dakota</option>
                                              <option value="TN" <?php echo  $member['state1'] == "TN" ? 'selected="selected"' : ''; ?>>Tennessee</option>
                                              <option value="TX" <?php echo  $member['state1'] == "TX" ? 'selected="selected"' : ''; ?>>Texas</option>
                                              <option value="UT" <?php echo  $member['state1'] == "UT" ? 'selected="selected"' : ''; ?>>Utah</option>
                                              <option value="VT" <?php echo  $member['state1'] == "VT" ? 'selected="selected"' : ''; ?>>Vermont</option>
                                              <option value="VA" <?php echo  $member['state1'] == "VA" ? 'selected="selected"' : ''; ?>>Virginia</option>
                                              <option value="WA" <?php echo  $member['state1'] == "WA" ? 'selected="selected"' : ''; ?>>Washington</option>
                                              <option value="WV" <?php echo  $member['state1'] == "WV" ? 'selected="selected"' : ''; ?>>West Virginia</option>
                                              <option value="WI" <?php echo  $member['state1'] == "WI" ? 'selected="selected"' : ''; ?>>Wisconsin</option>
                                              <option value="WY" <?php echo  $member['state1'] == "WY" ? 'selected="selected"' : ''; ?>>Wyoming</option>
                                          </select>

                                        <?php elseif ($member['country'] != "US" || $member['country'] = "USA"): ?>
                                          <div class="form-group">
                                              <label>State</label>
                                              <input type="text" class="form-control" value="<?php echo $member['state1'] ? $member['state1'] : ''; ?>">
                                          </div>
                                        <?php endif; ?>

                                      </div>
                                      <!--/span-->
                                  </div>
                                  <!--/row-->
                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Zipcode</label>
                                            <input type="text" class="form-control" value="<?php echo $member['zip'] ? $member['zip'] : ''; ?>">
                                        </div>
                                      </div>
                                      <!--/span-->
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" value="<?php echo $member['country'] ? $member['country'] : ''; ?>">
                                        </div>
                                      </div>
                                      <!--/span-->
                                  </div>


                                  <h3 class="box-title m-t-40">Alternate Address</h3>
                                  <hr>
                                  <div class="row">
                                    <div class="col-md-12 ">
                                      <div class="demo-checkbox">
                                          <input type="checkbox" id="usemailing" class="chk-col-light-blue" <?php echo $member['mailtoAlt'] != 0 ? 'checked' : ''; ?> />
                                          <label for="usemailing">Use for All Mailing</label>
                                      </div>
                                    </div>

                                      <div class="col-md-12 ">
                                          <div class="form-group">
                                              <label>Street</label>
                                              <input type="text" class="form-control" value="<?php echo $member['addr2a'] ? $member['addr2a'] : ''; ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-12 ">
                                          <div class="form-group">
                                              <label>Line 2</label>
                                              <input type="text" class="form-control" value="<?php echo $member['addr2b'] ? $member['addr2b'] : ''; ?>">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>City</label>
                                              <input type="text" class="form-control" value="<?php echo $member['city2'] ? $member['city2'] : ''; ?>">
                                          </div>
                                      </div>
                                      <!--/span-->
                                      <div class="col-md-6">
                                        <?php if ($member['country2'] == "US" || $member['country2'] == "USA"): ?>
                                          <label>State</label>
                                          <select class="select2 form-control custom-select" style="width: 100%;">
                                              <option>Choose...</option>
                                              <option value="AL" <?php echo  $member['state2'] == "AL" ? 'selected="selected"' : ''; ?>>Alabama</option>
                                              <option value="AK" <?php echo  $member['state2'] == "AK" ? 'selected="selected"' : ''; ?>>Alaska</option>
                                              <option value="AZ" <?php echo  $member['state2'] == "AZ" ? 'selected="selected"' : ''; ?>>Arizona</option>
                                              <option value="AR" <?php echo  $member['state2'] == "AR" ? 'selected="selected"' : ''; ?>>Arkansas</option>
                                              <option value="CA" <?php echo  $member['state2'] == "CA" ? 'selected="selected"' : ''; ?>>California</option>
                                              <option value="CO" <?php echo  $member['state2'] == "CO" ? 'selected="selected"' : ''; ?>>Colorado</option>
                                              <option value="CT" <?php echo  $member['state2'] == "CT" ? 'selected="selected"' : ''; ?>>Connecticut</option>
                                              <option value="DE" <?php echo  $member['state2'] == "DE" ? 'selected="selected"' : ''; ?>>Delaware</option>
                                              <option value="DC" <?php echo  $member['state2'] == "DC" ? 'selected="selected"' : ''; ?>>District Of Columbia</option>
                                              <option value="FL" <?php echo  $member['state2'] == "FL" ? 'selected="selected"' : ''; ?>>Florida</option>
                                              <option value="GA" <?php echo  $member['state2'] == "GA" ? 'selected="selected"' : ''; ?>>Georgia</option>
                                              <option value="HI" <?php echo  $member['state2'] == "HI" ? 'selected="selected"' : ''; ?>>Hawaii</option>
                                              <option value="ID" <?php echo  $member['state2'] == "ID" ? 'selected="selected"' : ''; ?>>Idaho</option>
                                              <option value="IL" <?php echo  $member['state2'] == "IL" ? 'selected="selected"' : ''; ?>>Illinois</option>
                                              <option value="IN" <?php echo  $member['state2'] == "IN" ? 'selected="selected"' : ''; ?>>Indiana</option>
                                              <option value="IA" <?php echo  $member['state2'] == "IA" ? 'selected="selected"' : ''; ?>>Iowa</option>
                                              <option value="KS" <?php echo  $member['state2'] == "KS" ? 'selected="selected"' : ''; ?>>Kansas</option>
                                              <option value="KY" <?php echo  $member['state2'] == "KY" ? 'selected="selected"' : ''; ?>>Kentucky</option>
                                              <option value="LA" <?php echo  $member['state2'] == "LA" ? 'selected="selected"' : ''; ?>>Louisiana</option>
                                              <option value="ME" <?php echo  $member['state2'] == "ME" ? 'selected="selected"' : ''; ?>>Maine</option>
                                              <option value="MD" <?php echo  $member['state2'] == "MD" ? 'selected="selected"' : ''; ?>>Maryland</option>
                                              <option value="MA" <?php echo  $member['state2'] == "MA" ? 'selected="selected"' : ''; ?>>Massachusetts</option>
                                              <option value="MI" <?php echo  $member['state2'] == "MI" ? 'selected="selected"' : ''; ?>>Michigan</option>
                                              <option value="MN" <?php echo  $member['state2'] == "MN" ? 'selected="selected"' : ''; ?>>Minnesota</option>
                                              <option value="MS" <?php echo  $member['state2'] == "MS" ? 'selected="selected"' : ''; ?>>Mississippi</option>
                                              <option value="MO" <?php echo  $member['state2'] == "MO" ? 'selected="selected"' : ''; ?>>Missouri</option>
                                              <option value="MT" <?php echo  $member['state2'] == "MT" ? 'selected="selected"' : ''; ?>>Montana</option>
                                              <option value="NE" <?php echo  $member['state2'] == "NE" ? 'selected="selected"' : ''; ?>>Nebraska</option>
                                              <option value="NV" <?php echo  $member['state2'] == "NV" ? 'selected="selected"' : ''; ?>>Nevada</option>
                                              <option value="NH" <?php echo  $member['state2'] == "NH" ? 'selected="selected"' : ''; ?>>New Hampshire</option>
                                              <option value="NJ" <?php echo  $member['state2'] == "NJ" ? 'selected="selected"' : ''; ?>>New Jersey</option>
                                              <option value="NM" <?php echo  $member['state2'] == "NM" ? 'selected="selected"' : ''; ?>>New Mexico</option>
                                              <option value="NY" <?php echo  $member['state2'] == "NY" ? 'selected="selected"' : ''; ?>>New York</option>
                                              <option value="NC" <?php echo  $member['state2'] == "NC" ? 'selected="selected"' : ''; ?>>North Carolina</option>
                                              <option value="ND" <?php echo  $member['state2'] == "ND" ? 'selected="selected"' : ''; ?>>North Dakota</option>
                                              <option value="OH" <?php echo  $member['state2'] == "OH" ? 'selected="selected"' : ''; ?>>Ohio</option>
                                              <option value="OK" <?php echo  $member['state2'] == "OK" ? 'selected="selected"' : ''; ?>>Oklahoma</option>
                                              <option value="OR" <?php echo  $member['state2'] == "OR" ? 'selected="selected"' : ''; ?>>Oregon</option>
                                              <option value="PA" <?php echo  $member['state2'] == "PA" ? 'selected="selected"' : ''; ?>>Pennsylvania</option>
                                              <option value="RI" <?php echo  $member['state2'] == "RI" ? 'selected="selected"' : ''; ?>>Rhode Island</option>
                                              <option value="SC" <?php echo  $member['state2'] == "SC" ? 'selected="selected"' : ''; ?>>South Carolina</option>
                                              <option value="SD" <?php echo  $member['state2'] == "SD" ? 'selected="selected"' : ''; ?>>South Dakota</option>
                                              <option value="TN" <?php echo  $member['state2'] == "TN" ? 'selected="selected"' : ''; ?>>Tennessee</option>
                                              <option value="TX" <?php echo  $member['state2'] == "TX" ? 'selected="selected"' : ''; ?>>Texas</option>
                                              <option value="UT" <?php echo  $member['state2'] == "UT" ? 'selected="selected"' : ''; ?>>Utah</option>
                                              <option value="VT" <?php echo  $member['state2'] == "VT" ? 'selected="selected"' : ''; ?>>Vermont</option>
                                              <option value="VA" <?php echo  $member['state2'] == "VA" ? 'selected="selected"' : ''; ?>>Virginia</option>
                                              <option value="WA" <?php echo  $member['state2'] == "WA" ? 'selected="selected"' : ''; ?>>Washington</option>
                                              <option value="WV" <?php echo  $member['state2'] == "WV" ? 'selected="selected"' : ''; ?>>West Virginia</option>
                                              <option value="WI" <?php echo  $member['state2'] == "WI" ? 'selected="selected"' : ''; ?>>Wisconsin</option>
                                              <option value="WY" <?php echo  $member['state2'] == "WY" ? 'selected="selected"' : ''; ?>>Wyoming</option>
                                          </select>

                                        <?php elseif ($member['country'] != "US" || $member['country'] = "USA"): ?>
                                          <div class="form-group">
                                              <label>State</label>
                                              <input type="text" class="form-control" value="<?php echo $member['state2'] ? $member['state2'] : ''; ?>">
                                          </div>
                                        <?php endif; ?>

                                      </div>
                                      <!--/span-->
                                  </div>
                                  <!--/row-->
                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Zipcode</label>
                                            <input type="text" class="form-control" value="<?php echo $member['zip2'] ? $member['zip2'] : ''; ?>">
                                        </div>
                                      </div>
                                      <!--/span-->
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" value="<?php echo $member['country2'] ? $member['country2'] : ''; ?>">
                                        </div>
                                      </div>
                                      <div class="col-md-12 ">
                                          <div class="form-group">
                                            <label>Note (ie, APR-MAY)</label>
                                            <textarea class="form-control" rows="3"><?php echo $member['addrNote2'] ? $member['addrNote2'] : ''; ?></textarea>

                                        </div>
                                      </div>


                                          <div class="col-md-12">
                                            <h3 class="box-title m-t-40">Phone</h3>
                                            <hr>


                                    <?php $phones = $db->query('SELECT * FROM `contact`  WHERE `memberID` = '.$member['ID'].' AND `type` = "phone" ')->fetchAll();
                                          $phoneqty = $db->query('SELECT * FROM `contact`  WHERE `memberID` = '.$member['ID'].' AND `type` = "phone" ')->numRows();
                                    ?>
                                    <?php if ($phoneqty > 0): ?>
                                      <?php foreach ($phones as $phone): ?>
                                        <div class="row">
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                              <label>Phone Number</label>
                                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber[]" value="<?php echo $phone['address']  ?  $phone['address'] : ''; ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                              <label>Type</label>
                                              <select class="form-control" id="phoneType" name="phoneType[]">
                                                  <option value="h" <?php echo $phone['location'] == "h" ? 'selected' : ''; ?>>Home</option>
                                                  <option value="c" <?php echo $phone['location'] == "c" ? 'selected' : ''; ?>>Cellphone</option>
                                                  <option value="w" <?php echo $phone['location'] == "w" ? 'selected' : ''; ?>>Work</option>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" id="phoneDesc" name="phoneDesc[]" value="<?php echo $phone['description']  ?  $phone['description'] : ''; ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                          <div class="form-group">
                                              <div class="demo-checkbox publicrad">
                                                  <input type="checkbox" id="publicPhn<?php echo 'xs'.$phone['ID'];?>" name="publicPhn[]" class="chk-col-light-blue " <?php echo $phone['access'] == "public" ?  'checked' : ''; ?> />
                                                  <label for="publicPhn<?php echo 'xs'.$phone['ID'];?>">Public</label>
                                              </div>
                                              <div class="input-group-append pull-rigth pt-28">
                                                <label></label>
                                                  <button class="btn btn-success " type="button" onclick="phone_fields();"><i class="fa fa-plus"></i></button>
                                              </div>
                                          </div>
                                        </div>

                                    </div>
                                      <?php endforeach; ?>

                                      <?php else: ?>
                                        <div class="row">
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                              <label>Phone Number</label>
                                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber[]" value="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                              <label>Type</label>
                                              <select class="form-control" id="phoneType" name="phoneType[]">
                                                  <option value="h">Home</option>
                                                  <option value="c">Cellphone</option>
                                                  <option value="w">Work</option>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" id="phoneDesc" name="phoneDesc[]" value="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                          <div class="form-group">
                                              <div class="demo-checkbox publicrad">
                                                  <input type="checkbox" id="publicPhnxs" name="publicPhn[]" class="chk-col-light-blue " <?php //echo $member['mailtoAlt'] != 0 ? 'checked' : ''; ?> />
                                                  <label for="publicPhn<xs">Public</label>
                                              </div>
                                              <div class="input-group-append pull-rigth pt-28">
                                                <label></label>
                                                  <button class="btn btn-success " type="button" onclick="phone_fields();"><i class="fa fa-plus"></i></button>
                                              </div>
                                          </div>
                                        </div>

                                    </div>
                                      <?php endif; ?>
  <div id="phone_fields"></div>

                                      </div>

                                      <div class="col-md-12">
                                        <h3 class="box-title m-t-40">Email</h3>
                                        <hr>


                                <?php $emails = $db->query('SELECT * FROM `contact`  WHERE `memberID` = '.$member['ID'].' AND `type` = "email" ')->fetchAll();
                                      $emailqty = $db->query('SELECT * FROM `contact`  WHERE `memberID` = '.$member['ID'].' AND `type` = "email" ')->numRows();
                                ?>
                                <?php if ($emailqty > 0): ?>
                                  <?php foreach ($emails as $email): ?>
                                    <div class="row">
                                    <div class="col-sm-6 nopadding">
                                        <div class="form-group">
                                          <label>Email</label>
                                            <input type="text" class="form-control" id="emailNumber" name="emailNumber[]" value="<?php echo $email['address']  ?  $email['address'] : ''; ?>" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" class="form-control" id="emailDesc" name="emailDesc[]" value="<?php echo $email['description']  ?  $email['description'] : ''; ?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 nopadding">
                                      <div class="form-group">
                                          <div class="demo-checkbox publicrad">
                                              <input type="checkbox" id="publicEmail<?php echo 'exs'.$email['ID'];?>" name="publicEmail[]" class="chk-col-light-blue " <?php echo $email['access'] == "public" ?  'checked' : ''; ?> />
                                              <label for="publicEmail<?php echo 'exs'.$email['ID'];?>">Public</label>
                                          </div>
                                          <div class="input-group-append pull-rigth pt-28">
                                            <label></label>
                                              <button class="btn btn-success " type="button" onclick="email_fields();"><i class="fa fa-plus"></i></button>
                                          </div>
                                      </div>
                                    </div>

                                </div>
                                  <?php endforeach; ?>

                                  <?php else: ?>
                                    <div class="row">
                                    <div class="col-sm-6 nopadding">
                                        <div class="form-group">
                                          <label>Email</label>
                                            <input type="text" class="form-control" id="emailNumber" name="emailNumber[]" value="" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" class="form-control" id="emailDesc" name="emailDesc[]" value="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 nopadding">
                                      <div class="form-group">
                                          <div class="demo-checkbox publicrad">
                                              <input type="checkbox" id="publicEmailexs"  name="publicEmail[]"class="chk-col-light-blue " />
                                              <label for="publicEmailexs">Public</label>
                                          </div>
                                          <div class="input-group-append pull-rigth pt-28">
                                            <label></label>
                                              <button class="btn btn-success " type="button" onclick="email_fields();"><i class="fa fa-plus"></i></button>
                                          </div>
                                      </div>
                                    </div>

                                </div>
                                  <?php endif; ?>
                              <div id="email_fields"></div>

                                  </div>

                                      <!--/span-->
                                  </div>
                              </div>
                              <div class="form-actions text-center">
                                  <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                  <a href="/wp-admin/admin.php?page=wheaten-club" class="btn btn-inverse">Close</a>
                              </div>
                          </form>
                            </div>
                      </div>
                    <?php endif; ?>

                  </div>


              </div>

            </div>


        </div>

    </div>



    <script type="text/javascript">
    <?php if ($phoneqty > 0): ?>

      var room = <?php echo $phoneqty ?>;

    <?php else: ?>

    var room = 1;

    <?php endif; ?>


    function phone_fields() {

        room++;
        var objTo = document.getElementById('phone_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + room);
        var rdiv = 'removeclass' + room;
        var rdivr = 'removeclassr' + room;
        divtest.innerHTML = '<div class="row"><div class="col-sm-3 nopadding"><div class="form-group"><label>Phone Number</label><input type="text" class="form-control" id="phoneNumber" name="phoneNumber[]" value="" placeholder=""></div></div><div class="col-sm-3 nopadding"><div class="form-group"><label>Type</label><select class="form-control" id="phoneType" name="phoneType[]"><option value="h">Home</option><option value="c">Cellphone</option><option value="w">Work</option></select></div></div><div class="col-sm-3 nopadding"><div class="form-group"><label>Description</label><input type="text" class="form-control" id="phoneDesc" name="phoneDesc[]" value="" placeholder=""></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="demo-checkbox publicrad"><input type="checkbox" id="publicPhn'+ room + '" class="chk-col-light-blue " /><label for="publicPhn'+ room + '">Public</label></div><div class="input-group-append pull-rigth pt-28"><label></label><button class="btn btn-danger" type="button" onclick="remove_phone_fields(' + room + ');"><i class="fa fa-minus"></i></button></div></div></div></div>';


        objTo.appendChild(divtest)
    }

    function remove_phone_fields(rid) {
              jQuery('.removeclass' + rid).remove();
    }



    <?php if ($emailqty > 0): ?>

      var roomemail = <?php echo $emailqty ?>;

    <?php else: ?>

    var email= 1;

    <?php endif; ?>


    function email_fields() {

        roomemail++;
        var objToemail = document.getElementById('email_fields')
        var divtestemail = document.createElement("div");
        divtestemail.setAttribute("class", "form-group removeclassemail" + roomemail);
        var rdivemail = 'removeclassemail' + roomemail;
        var rdivremail = 'removeclassr' + roomemail;
        divtestemail.innerHTML = '  <div class="row"><div class="col-sm-6 nopadding"><div class="form-group"><label>Email</label><input type="text" class="form-control" id="emailNumber" name="emailNumber[]" value="" placeholder=""></div></div><div class="col-sm-3 nopadding"><div class="form-group"><label>Description</label><input type="text" class="form-control" id="emailDesc" name="emailDesc[]" value="" placeholder=""></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="demo-checkbox publicrad"><input type="checkbox" id="publicEmail'+ roomemail + '" class="chk-col-light-blue " /><label for="publicEmail'+ roomemail + '">Public</label></div><div class="input-group-append pull-rigth pt-28"><label></label><button class="btn btn-danger" type="button" onclick="remove_email_fields(' + roomemail + ');"><i class="fa fa-minus"></i></button></div></div></div></div>';


        objToemail.appendChild(divtestemail)
    }

    function remove_email_fields(ridemail) {
              jQuery('.removeclassemail' + ridemail).remove();
    }

    </script>
