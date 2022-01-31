<?php include("header.php"); 

if(@$_REQUEST['id']!='')
{
    $id = $_REQUEST['id'];
    $rows = fetch_query("*","expense_type",array("id="=>$id));
    
    $expense_type = $rows['expense_type'];
    $parent_expense = $rows['parent_expense'];
    $sub_expense = $rows['sub_expense'];
    $account_code = $rows['account_code'];
    $description = $rows['description'];
    $parent_id= $rows['parent_id'];
}
else
{
    $expense_type = '';
    $parent_expense = '';
    $sub_expense = '';
    $account_code = '';
    $description='';
    $pagetitle="Add";
    $parent_id='';
}

?>
<style>
    .nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover, .nav-tabs .nav-item.open .nav-link, .nav-tabs .nav-item.open .nav-link:focus, .nav-tabs .nav-item.open .nav-link:hover 
    {
        color: #fff;
        border-color: transparent;
        border-bottom-color: transparent;
        border-bottom-color: #1e9ff2;
        background-color: #1e9ff2;
    }
    #myTab
    {
        margin-left:0px !important;
    }
    .secondtab {
        border: 1px solid #ccc;
        padding: 10px;
    }
    [type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
        position: unset;
        left:unset;
        opacity: unset;
    }
</style>


<?php include("leftpanel.php"); ?>

<div class="content-wrapper">

    <section class="content-header">

        <!--<h1> Customers <?php echo $pagetitle; ?> </h1>-->

    </section>

    <section class="content pb-10">

        <div class="box">

            <div class="box-body">
            
            <?php

                if(isset($_SESSION['suc']))

                { echo session_succ(); }?>

                <div class="alert alert-success" id="error_message" style="display:none;"></div>

                <?php

                if(isset($_SESSION['unsuc']))

                { echo session(); }?>
                <div class="alert alert-danger" id="error_message" style="display:none;"></div>

                <div class="row">
                    <div class="col-12 text-left">
                            <h3> New Expense Type </h3>
                        </div>
                    <div class="col-lg-12">

                        <form method="post" action="" name="bg" id="bg" enctype="multipart/form-data" autocomplete="off" >
                            
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                                    <div class="form-group">
                                        <h5>Expense Type</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="demo-radio-button">
                                        <input type="text" name="expense_type" id="expense_type" class="form-control" value="<?php echo $expense_type; ?>" style="display:inline-block">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                        <input type="checkbox" name="sub_expense" id="sub_expense" value="subexpense" <?php if($sub_expense ==1) echo "checked";?>>
                                        Make this a sub-Expense 
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="div_parent" style="display:none;">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="form-group">
                                        <h5>Parent Expense</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls"> 
                                        <select class="form-control" name="parent_expense" id="parent_expense">
                                            <option value="0">Select Account</option>
                                            <?php
                                            $getData=mysqli_query($dlink,"SELECT * FROM expense_type where sub_expense=0  order by expense_type");
                                            while($s1=mysqli_fetch_array($getData)) {
                                            ?>
                                                <option <?php if($parent_id == $s1['id']) echo "selected";?> value="<?php echo $s1['id']; ?>" ><?php echo $s1['expense_type']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="form-group">
                                        <h5>Account Code</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                        <input type="text" name="account_code" id="account_code" class="form-control" value="<?php echo $account_code; ?>" style="display:inline-block">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="form-group">
                                        <h5>Description</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="controls">
                                        <textarea class="form-control" name="description" id="description"><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            
                         
                            <div class="bt-1 pt-10"> </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <button type="submit" class="btn btn-danger" id="submit" name="submit">Submit</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <button type="button" class="btn btn-danger" id="cancel" name="cancel" onclick="loadPage();">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include("footer.php"); ?>

<?php
    if($sub_expense == 1){
?>
    <script type="text/javascript">
        $('#div_parent').show();
    </script>
<?php
    } 
?>

<script>

function loadPage()
{
    window.location.reload();
}

$(document).ready(function(){ 

    $('#sub_expense').click(function() {
        if($(this).is(':checked'))
            $('#div_parent').show();
        else
           $('#div_parent').hide();    
   });

    $("#submit").click(function()
    { 
        /*if($("#fname").val()=="")
        {
            $("#fname").attr("placeholder", "Please Enter First Name.");
            $("#fname").addClass("error_textbox");
            $("#fname").focus();
            return false;
        }*/
    });
});

</script>
<?php 

if(isset($_POST['submit'])!='')
{
    if(@$_GET['id']!='')
    {
    
        $dt=date('Y-m-d H:i:s');

        $sub_expense=''; $parent_expense='';

        $sub_expense= isset($_POST['sub_expense']) ? 1: 0;

        $parent_expense=($sub_expense == 0) ? null: $_POST['parent_expense'];

        //$rows = fetch_query("*","expense_type",array("id="=>$parent_expense));

        $parent_id=($sub_expense == 0) ? null: $parent_expense;
        

        $arr=array(
            "expense_type"=>ucfirst($_POST['expense_type']),
            "parent_expense"=>$parent_id,
            "sub_expense"=>$sub_expense,
            "parent_id"=>$parent_expense,
            "account_code"=>$_POST['account_code'],
            "description"=>$_POST['description'],
            "recorddate"=>$dt
        );  

        $insert = update_query($arr,"id=".$id,"expense_type");


        if($insert)
        {
            $_SESSION['suc']='Expense Type Updated Successfully...';
        }
        else
        {
            $_SESSION['unsuc']='Expense Type Not Updated... Try Again...';
        }
        header("location:".$site_url."expense-type-listing");
        exit;
    }
    else
    { 
        $dt=date('Y-m-d H:i:s');

        $sub_expense=''; $parent_expense='';

        $sub_expense= isset($_POST['sub_expense']) ? 1: 0;
        $parent_expense=($_POST['parent_expense'] == 0) ? null: $_POST['parent_expense'];

        $rows = fetch_query("*","expense_type",array("id="=>$parent_expense));
        

        $arr=array(
            "expense_type"=>ucfirst($_POST['expense_type']),
            "parent_expense"=>$parent_expense,
            "sub_expense"=>$sub_expense,
            "parent_id"=>$parent_expense,
            "account_code"=>$_POST['account_code'],
            "description"=>$_POST['description'],
            "recorddate"=>$dt
        );  
        $insert = insert_query($arr, "expense_type");
      
        if($insert)
        {
            $_SESSION['suc']='Expense Type Added Successfully...';
        }
        else
        {
            $_SESSION['unsuc']='Expense Type Not Added... Try Again...';
        }
        header("location:".$site_url."expense-type-listing");
        exit;
    }
}
?>