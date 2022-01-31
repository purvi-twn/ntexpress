<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">


            
            <?php 
			if(@$_SESSION['ntexpress_retroadm']!='')
			{ ?>
                <li class="user-profile treeview"><br>
    
                    <a href="<?php echo $site_url; ?>">
    
                        <!-- <img src="upimages/42432297logo.png" alt="NT Express"><span>NT Express</span>-->
                    </a>
    
                    
                </li>

                <li <?php if($page2=='dashboard') { ?> class="active" <?php } ?>>
    
                    <a href="<?php echo $site_url; ?>dashboard">
                        <i class="fas fa-tachometer-alt"></i> <span class="font1">Dashboard</span>
                       
                        
                    </a>
                    
                </li>
                
                <li <?php if($page2=='customer-listing' || $page2=='invoice' || $page2=='new-shipment') { ?> class="treeview active" <?php } else { ?> class="treeview" <?php }?> >
    
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i> <span class="font1">Sales</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                         <li <?php if($page2=='customer-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>customer-listing"><i class="fa fa-circle-thin"></i><span class="font1">Customers</span></a>
                        </li>
                        
                            <li <?php if($page2=='invoice' || $page2=='new-shipment') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>invoice"><i class="fa fa-circle-thin"></i><span class="font1">Invoice</span></a>
                            </li>
                            
                            <li>
                                <a href="<?php echo $site_url; ?>creadit-notes-listing"><i class="fa fa-user"></i><span class="font1">Credit Notes</span> </a>
                            </li>
                        
                    </ul>
    
                </li>
               
                
            
                <li <?php if($page2=='income-expense-report') { ?> class="active" <?php } ?>>
    
                    <a href="<?php echo $site_url; ?>income-expense-report">
                        <i class="fa fa-file"></i> <span class="font1">Reports</span>
                        
                    </a>
    
                </li>
                

                <li <?php if($page2=='vendor-add' || $page2=='vendor-listing') { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fa fa-th"></i> <span class="font1">Expenses</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <!-- <ul class="treeview-menu">
    
                        <li <?php if($page2=='expenses-add') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>expenses-add"><i class="fa fa-circle-thin"></i><span class="font1">Expenses Add</span></a>
                        </li>
    
                        <li <?php if($page2=='expenses-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>expenses-listing"><i class="fa fa-circle-thin"></i><span class="font1">Expenses Listing</span></a>
                        </li>
    
                    </ul> -->

                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo $site_url; ?>vendor-listing"><i class="fa fa-user mr-5"></i><span class="font1">Vendor</span> </a>
                        </li>
                        <li>
                            <a href="<?php echo $site_url; ?>bill-listing"><i class="fa fa-user mr-5"></i><span class="font1">Bill</span> </a>
                        </li>
                        <li>
                            <a href="<?php echo $site_url; ?>expense-type-listing"><i class="fa fa-user mr-5"></i><span class="font1">Expense Type</span> </a>
                        </li>
                        <li>
                            <a href="<?php echo $site_url; ?>record-expense-listing"><i class="fa fa-user mr-5"></i><span class="font1">Record Expense</span> </a>
                        </li>
                    </ul>
    
                </li>

                <?php /*?><li <?php if($page2=='shipment-add' || $page2=='shipment-listing') { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fas fa-ship"></i> <span class="font1">Shipment</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <li <?php if($page2=='shipment-add') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>shipment-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Shipment</span></a>
                        </li>
    
                        <li <?php if($page2=='shipment-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>shipment-listing"><i class="fa fa-circle-thin"></i><span class="font1">Shipment Listing</span></a>
                        </li>
    
                    </ul>
    
                </li><?php */?>
                
                <?php /*?><li <?php if($page2=='customer-add' || $page2=='customer-listing') { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fa fa-users"></i> <span class="font1">Customers</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <li <?php if($page2=='customer-add') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>customer-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Customer</span></a>
                        </li>
    
                        <li <?php if($page2=='customer-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>customer-listing"><i class="fa fa-circle-thin"></i><span class="font1">Customers Listing</span></a>
                        </li>
    
                    </ul>
    
                </li><?php */?>

                <?php /*?><li <?php if($page2=='branch-add' || $page2=='branch-listing') { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fas fa-user-tie"></i> <span class="font1">Branches</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <li <?php if($page2=='branch-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>branch-listing"><i class="fa fa-circle-thin"></i><span class="font1">Branches Listing</span></a>
                        </li>
    
                    </ul>
    
                </li><?php */?>
                <li <?php if($page2=='branch-add' || $page2=='branch-listing') { ?> class="active" <?php } ?>>
    
                    <a href="<?php echo $site_url; ?>branch-listing">
                        <i class="fa fa-file"></i> <span class="font1">Branches</span>
                        
                    </a>
    
                </li>
                <li <?php if($page2=='department-add' || $page2=='department-listing') { ?> class="active" <?php } ?>>
    
                    <a href="<?php echo $site_url; ?>department-listing">
                        <i class="fa fa-file"></i> <span class="font1">Department Listing</span>
                        
                    </a>
    
                </li>
                
                
                <?php /*?><li <?php if($page2=='department-add' || $page2=='department-listing') { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fas fa-user-tie"></i> <span class="font1">Department</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <!-- <li <?php if($page2=='department-add' || $page2=='department-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>department-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Representative Add</span></a>
                        </li> -->
    
                        <li <?php if($page2=='department-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>department-listing"><i class="fa fa-circle-thin"></i><span class="font1">Department Listing</span></a>
                        </li>
    
                    </ul>
    
                </li><?php */?>

                <li <?php if($page2=='staff-add' || $page2=='staff-listing' || $page2=='staff-roles' ) { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fas fa-th-large"></i> <span class="font1">Staff</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <!-- <li <?php if($page2=='staff-add') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>staff-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Department</span></a>
                        </li> -->
    
                        <li <?php if($page2=='staff-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>staff-listing"><i class="fa fa-circle-thin"></i><span class="font1">Staff Listing</span></a>
                        </li>
                         <li <?php if($page2=='staff-roles') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>staff-roles"><i class="fa fa-circle-thin"></i><span class="font1">Roles</span></a>
                        </li>
    
                    </ul>
    
                </li>

                <li <?php if($page2=='shipment-tracking') { ?> class="active" <?php } ?>>
    
                <a href="<?php echo $site_url; ?>shipment-tracking">
                    <i class="fa fa-file"></i> <span class="font1">Shipment Tracking</span>
                    
                </a>

            </li>
            <?php
			}
			else if(@$_SESSION['ntexpress_retroagent']!='')
			{
				$roll=fetch_query("*","staff_roles",array("sid="=>$_SESSION['ntexpress_retroagent']));
				
				?>
                <li class="user-profile treeview">

                <a href="#">

                    <!--<img src="<?php echo $site_url; ?>images/user5-128x128.jpg" alt="user"> <span class="font1">--><?php echo $_SESSION['ntexpress_retrostaff'] ?><!--</span>-->

                   <?php /*?> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span><?php */?>

                </a>

               <?php /*?> <ul class="treeview-menu">

                    <li><a href="<?php echo $site_url; ?>agent-edit-profile"><i class="font1" class="fa fa-user mr-5"></i><span class="font1">Edit Profile</span> </a></li>

                    <li><a href="<?php echo $site_url; ?>agent-change-password"><i class="font1" class="fas fa-lock mr-5"></i><span class="font1">Change Password</span></a></li>

                    <li><a href="<?php echo $site_url ?>logout"><i class="font1" class="fa fa-power-off mr-5"></i><span class="font1">Logout</span></a></li>

                </ul><?php */?>
            </li>

            <li <?php if($page2=='dashboard') { ?> class="active" <?php } ?>>

                <a href="<?php echo $site_url; ?>dashboard">
                    <i class="fas fa-tachometer-alt"></i> <span class="font1">Dashboard</span>
                    
                </a>

            </li>
               <?php /* <li <?php if($page2=='add-department-expenses' || $page2=='expenses-list') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fa fa-th"></i> <span class="font1">Expenses</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

                    <li <?php if($page2=='add-department-expenses') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>add-department-expenses"><i class="fa fa-circle-thin"></i><span class="font1">Add Expenses</span> </a>
                    </li>

                    <li <?php if($page2=='expenses-list') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>expenses-list"><i class="fa fa-circle-thin"></i><span class="font1">Expenses Listing</span></a>
                    </li>

                </ul>

            </li> */
			?>
            <?php
			if($roll['invoice']==1 || $roll['customer']==1)
			{ ?>
                <li <?php if($page2=='invoice' || $page2=='new-shipment' || $page2=='customer-add' || $page2='customer-listing') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fas fa-ship"></i> <span class="font1">Sales</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

                    <?php
					if($roll['invoice']==1)
					{ ?>
                    <li <?php if($page2=='invoice' || $page2=='new-shipment') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>invoice"><i class="fa fa-circle-thin"></i><span class="font1">Invoice</span></a>
                    </li><?php
					}?>
                    <?php
					if($roll['customer']==1)
					{ ?>
					 <li <?php if($page2=='customer-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>customer-listing"><i class="fa fa-circle-thin"></i><span class="font1">Customers</span></a>
                        </li><?php
					}
					?>

                </ul>

            </li> <?php
			}
			if( $roll['report']==1)
			{ 
				?>
				<li <?php if($page2=='income-expense-report') { ?> class="active" <?php } ?>>
    
                    <a href="<?php echo $site_url; ?>income-expense-report">
                        <i class="fa fa-file"></i> <span class="font1">Reports</span>
                        
                    </a>
    
                </li>

				<?php
			}
			if($roll['employee']==1)
			{  ?>
			 <li <?php if($page2=='branch-add' || $page2=='branch-listing') { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fas fa-user-tie"></i> <span class="font1">Branches</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <!-- <li <?php if($page2=='branch-add' || $page2=='branch-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>branch-add"><i class="fa fa-circle-thin"></i>Add Branches</a>
                        </li> -->
    
                        <li <?php if($page2=='branch-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>branch-listing"><i class="fa fa-circle-thin"></i><span class="font1">Branches Listing</span></a>
                        </li>
    
                    </ul>
    
                </li>
                
                <li <?php if($page2=='department-add' || $page2=='department-listing') { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fas fa-user-tie"></i> <span class="font1">Department</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <!-- <li <?php if($page2=='department-add' || $page2=='department-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>department-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Representative Add</span></a>
                        </li> -->
    
                        <li <?php if($page2=='department-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>department-listing"><i class="fa fa-circle-thin"></i><span class="font1">Department Listing</span></a>
                        </li>
    
                    </ul>
    
                </li>

                <li <?php if($page2=='staff-add' || $page2=='staff-listing' || $page2=='staff-roles' ) { ?> class="treeview active" <?php } ?> class="treeview">
    
                    <a href="#">
                        <i class="fas fa-th-large"></i> <span class="font1">Staff</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
    
                    <ul class="treeview-menu">
    
                        <!-- <li <?php if($page2=='staff-add') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>staff-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Department</span></a>
                        </li> -->
    
                        <li <?php if($page2=='staff-listing') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>staff-listing"><i class="fa fa-circle-thin"></i><span class="font1">Staff Listing</span></a>
                        </li>
                         <li <?php if($page2=='staff-roles') { ?> class="active" <?php } ?>>
                            <a href="<?php echo $site_url; ?>staff-roles"><i class="fa fa-circle-thin"></i><span class="font1">Roles</span></a>
                        </li>
    
                    </ul>
    
                </li>

                <?php
                if($roll['shipment_tracking']==1)
                { ?>
                    <li <?php if($page2=='shipment-tracking') { ?> class="active" <?php } ?>>
        
                        <a href="<?php echo $site_url; ?>shipment-tracking">
                            <i class="fa fa-file"></i> <span class="font1">Shipment Tracking</span>
                            
                        </a>

                    </li>
                <?php 
                }

			}
			
			?>
                 
				<?php
			}
			else  if(@$_SESSION['ntexpress_retroaccountant']!='')
			{ ?>
            
            	<li class="user-profile treeview">

                <a href="#">

                    <img src="images/user5-128x128.jpg" alt="user"> <span class="font1">NT Express</span>

                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>

                </a>

                <ul class="treeview-menu">

                    <li><a href="<?php echo $site_url; ?>edit-profile"><i class="fa fa-user mr-5"></i><span class="font1">Edit Profile</span> </a></li>

                    <li><a href="<?php echo $site_url; ?>change-password"><i class="fas fa-lock mr-5"></i><span class="font1">Change Password</span></a></li>

                    <li><a href="<?php echo $site_url ?>logout"><i class="fa fa-power-off mr-5"></i><span class="font1">Logout</span></a></li>

                </ul>
            </li>

            <li <?php if($page2=='dashboard') { ?> class="active" <?php } ?>>

                <a href="<?php echo $site_url; ?>dashboard">
                    <i class="fas fa-tachometer-alt"></i> <span class="font1">Dashboard</span>
                    
                </a>

            </li>
            <li <?php if($page2=='income-expense-report') { ?> class="active" <?php } ?>>

                <a href="<?php echo $site_url; ?>income-expense-report">
                    <i class="fa fa-file"></i> <span class="font1">Income-Expense Report</span>
                    
                </a>

            </li>

            <li <?php if($page2=='vendor-add' || $page2=='vendor-listing') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fa fa-th"></i> <span class="font1">Expenses</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <!-- <ul class="treeview-menu">

                    <li <?php if($page2=='expenses-add') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>expenses-add"><i class="fa fa-circle-thin"></i><span class="font1">Expenses Add</span></a>
                    </li>

                    <li <?php if($page2=='expenses-listing') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>expenses-listing"><i class="fa fa-circle-thin"></i><span class="font1">Expenses Listing</span></a>
                    </li>

                </ul> -->

                <ul class="treeview-menu">
                    <li><a href="<?php echo $site_url; ?>vendor-listing"><i class="fa fa-user mr-5"></i><span class="font1">Vendor</span> </a></li>
                    <li>
                        <a href="<?php echo $site_url; ?>bill-listing"><i class="fa fa-user mr-5"></i><span class="font1">Bill</span> </a>
                    </li>
                </ul>

            </li>

            <li <?php if( $page2=='shipment-listing') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fas fa-ship"></i> <span class="font1">Shipment</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

                    
                    <li <?php if($page2=='shipment-listing') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>shipment-listing"><i class="fa fa-circle-thin"></i><span class="font1">Shipment Listing</span></a>
                    </li>

                </ul>

            </li>
			
            <li <?php if($page2=='customer-listing') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fa fa-users"></i> <span class="font1">Customers</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

                    
                    <li <?php if($page2=='customer-listing') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>customer-listing"><i class="fa fa-circle-thin"></i><span class="font1">Customers Listing</span></a>
                    </li>

                </ul>

            </li>
            
            <li <?php if($page2=='agent-listing') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fas fa-user-tie"></i> <span class="font1">Agent</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

                    

                    <li <?php if($page2=='agent-listing') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>agent-listing"><i class="fa fa-circle-thin"></i><span class="font1">Representative Listing</span></a>
                    </li>

                </ul>

            </li>

            <li <?php if($page2=='department-listing') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fas fa-th-large"></i> <span class="font1">Department</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

                    <li <?php if($page2=='department-listing') { ?> class="active" <?php } ?>>
                        <a href="<?php echo $site_url; ?>department-listing"><i class="fa fa-circle-thin"></i><span class="font1">Department Listing</span></a>
                    </li>

                </ul>

            </li>

            <li <?php if($page2=='shipment-tracking') { ?> class="active" <?php } ?>>
    
                <a href="<?php echo $site_url; ?>shipment-tracking">
                    <i class="fa fa-file"></i> <span class="font1">Shipment Tracking</span>
                    
                </a>

            </li>
            
			<?php }

            else if(@$_SESSION['ntexpress_retrosales']!='')
            { 
                $roll=fetch_query("*","staff_roles",array("sid="=>$_SESSION['ntexpress_retroagent']));
                ?>

                <li class="user-profile treeview">

                    <a href="#">
                        <?php echo $_SESSION['ntexpress_retrosales'] ?>
                    </a>
                </li>

                <li <?php if($page2=='dashboard') { ?> class="active" <?php } ?>>

                    <a href="<?php echo $site_url; ?>dashboard">
                        <i class="fas fa-tachometer-alt"></i> <span class="font1">Dashboard</span>
                        
                    </a>

                </li>

                
                <li <?php if($page2=='invoice' || $page2=='new-shipment' || $page2=='customer-add' || $page2='customer-listing') { ?> class="treeview active" <?php } ?> class="treeview">

                    <a href="#">
                        <i class="fas fa-ship"></i> <span class="font1">Sales</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>

                    <ul class="treeview-menu">

                        <?php
                        /*if($roll['invoice']==1)
                        {*/ ?>
                        <li <?php if($page2=='invoice' || $page2=='new-shipment') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>invoice"><i class="fa fa-circle-thin"></i><span class="font1">Invoice</span></a>
                        </li>
                        <?php
                        //}
                        ?>

                        <?php
                        if($roll['customer']==1)
                        { ?>
                         <li <?php if($page2=='customer-listing') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>customer-listing"><i class="fa fa-circle-thin"></i><span class="font1">Customers</span></a>
                            </li><?php
                        }
                        ?>

                    </ul>

                </li> 

                <li <?php if($page2=='income-expense-report') { ?> class="active" <?php } ?>>
        
                        <a href="<?php echo $site_url; ?>income-expense-report">
                            <i class="fa fa-file"></i> <span class="font1">Reports</span>
                            
                        </a>
        
                </li>

                <?php
                if($roll['employee']==1)
                {  ?>
                 <li <?php if($page2=='branch-add' || $page2=='branch-listing') { ?> class="treeview active" <?php } ?> class="treeview">
        
                        <a href="#">
                            <i class="fas fa-user-tie"></i> <span class="font1">Branches</span>
                            <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                        </a>
        
                        <ul class="treeview-menu">
        
                            <!-- <li <?php if($page2=='branch-add' || $page2=='branch-listing') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>branch-add"><i class="fa fa-circle-thin"></i>Add Branches</a>
                            </li> -->
        
                            <li <?php if($page2=='branch-listing') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>branch-listing"><i class="fa fa-circle-thin"></i><span class="font1">Branches Listing</span></a>
                            </li>
        
                        </ul>
        
                    </li>
                    
                    <li <?php if($page2=='department-add' || $page2=='department-listing') { ?> class="treeview active" <?php } ?> class="treeview">
        
                        <a href="#">
                            <i class="fas fa-user-tie"></i> <span class="font1">Department</span>
                            <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                        </a>
        
                        <ul class="treeview-menu">
        
                            <!-- <li <?php if($page2=='department-add' || $page2=='department-listing') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>department-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Representative Add</span></a>
                            </li> -->
        
                            <li <?php if($page2=='department-listing') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>department-listing"><i class="fa fa-circle-thin"></i><span class="font1">Department Listing</span></a>
                            </li>
        
                        </ul>
        
                    </li>

                    <li <?php if($page2=='staff-add' || $page2=='staff-listing' || $page2=='staff-roles' ) { ?> class="treeview active" <?php } ?> class="treeview">
        
                        <a href="#">
                            <i class="fas fa-th-large"></i> <span class="font1">Staff</span>
                            <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                        </a>
        
                        <ul class="treeview-menu">
        
                            <!-- <li <?php if($page2=='staff-add') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>staff-add"><i class="fa fa-circle-thin"></i><span class="font1">Add Department</span></a>
                            </li> -->
        
                            <li <?php if($page2=='staff-listing') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>staff-listing"><i class="fa fa-circle-thin"></i><span class="font1">Staff Listing</span></a>
                            </li>
                             <li <?php if($page2=='staff-roles') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $site_url; ?>staff-roles"><i class="fa fa-circle-thin"></i><span class="font1">Roles</span></a>
                            </li>
        
                        </ul>
        
                    </li>

                    <?php
                    if($roll['shipment_tracking']==1)
                    { ?>
                        <li <?php if($page2=='shipment-tracking') { ?> class="active" <?php } ?>>
            
                            <a href="<?php echo $site_url; ?>shipment-tracking">
                                <i class="fa fa-file"></i> <span class="font1">Shipment Tracking</span>
                                
                            </a>

                        </li>
                    <?php 
                    }

                }
                
                ?>
               <?php }
                ?>



            <!-- <li <?php if($page2=='vendor-listing') { ?> class="treeview active" <?php } ?> class="treeview">
                <a href="#">
                    <i class="fas fa-cogs"></i> <span class="font1">Expense</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="<?php echo $site_url; ?>vendor-listing"><i class="fa fa-user mr-5"></i><span class="font1">Vendor</span> </a></li>
                </ul>
            </li> -->

            <li <?php if($page2=='terms_condition') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fas fa-cogs"></i> <span class="font1">Terms & Condition</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

                    <li><a href="<?php echo $site_url; ?>payment-terms-condition"><i class="fa fa-user mr-5"></i><span class="font1">Payment Terms List</span> </a></li>

                </ul>

            </li>
            
            <li <?php if($page2=='settings') { ?> class="treeview active" <?php } ?> class="treeview">

                <a href="#">
                    <i class="fas fa-cogs"></i> <span class="font1">Settings</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                </a>

                <ul class="treeview-menu">

					<?php if(!$_SESSION['ntexpress_retroagent']=='')
					{ ?>
                    <li><a href="<?php echo $site_url; ?>agent-edit-profile"><i class="fa fa-user mr-5"></i><span class="font1">Edit Profile</span> </a></li>
					<?php
					}
					else
					{
						?>
						<li><a href="<?php echo $site_url; ?>edit-profile"><i class="fa fa-user mr-5"></i><span class="font1">Edit Profile</span> </a></li>
					
						<?php	
					}
					?>
                    <li><a href="<?php echo $site_url; ?>change-password"><i class="fas fa-lock mr-5"></i><span class="font1">Change Password</span></a></li>

                    <li><a href="<?php echo $site_url ?>logout"><i class="fa fa-power-off mr-5"></i><span class="font1">Logout</span></a></li>

                </ul>

            </li>
            
           

        </ul>

    </section>

</aside>
