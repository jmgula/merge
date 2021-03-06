<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>USC FW Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css" >

   
    #display_results {
    
    color: black;
    

    background: #CCCCFF;
    }


    </style>
    <script type="text/javascript "src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

    <script type='text/javascript'>

    $(document).ready(function(){

    $("#search_results").slideUp();

    $("#button_find").click(function(event){

    event.preventDefault();

    search_ajax_way();

    });

    $("#search").keyup(function(event){

    event.preventDefault();

    search_ajax_way();

    });

     

    });

     

    function search_ajax_way(){

    $("#search_results").show();

    var search_this=$("#search").val();

    $.post("search.php", {searchit : search_this}, function(data){

    $("#display_results").html(data);

     

    });

    }



    </script>


</head>

<body>

         <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:#78ad49;">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin.html" style="color:yellow;">Admin Panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="settings.html"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="indexv2.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

           <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                         <li>
                            <a href="admin.html"><i class="fa fa-comments fa-fw"></i> Messages</a>
                        </li>
                        <li>
                            <a href="users.php"><i class="fa fa-users fa-fw"></i> User Management</a>
                        </li>

                        <li>
                            <a href="email.html"><i class="fa fa-envelope-o fa-fw"></i> Emails</a>
                        </li>

                        <li>
                            <a href="stats.html"><i class="fa fa-bar-chart-o fa-fw"></i> Statistics</a>
                          
                        </li>     
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-topic-side -->
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!--SEARCH -->
                  


                          <form method="post" id="searchform" class="input-group-btn">
                                <div class="input-group custom-search-form">

                                <input type="text" class="form-control" name="search" id="search" placeholder="Search..." required="required">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                                </div>
                            </form>
                        
                        <div id="display_results">
                                      </div>


                <!--SEARCH -->
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <br>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Management
   
  
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">


                                    <!--DATABASE -->

                                    <?php

                                    $output = NULL;


                                                                     
                                    if(isset($_POST['search'])){


                                    $connection = mysqli_connect("localhost","root","","webapp") or die ("ERROR" .mysqli_error($connection));
                                    $search = $connection->real_escape_string($_POST['search']);


                                     $sql = "SELECT * FROM users WHERE userid LIKE '{$search}%'"; 


                                    $result = mysqli_query ($connection, $sql) or die ("ERROR" .mysqli_error($connection));
                                    
                                    if($result->num_rows > 0){
                                        while ($rows =$result->fetch_assoc())
                                            {
                                               

   

            echo "<tr>";
            echo '<td>' . $rows['userid'] . '</td>';
            echo '<td>' . $rows['firstname'] . '</td>';
            echo '<td>' . $rows['lastname'] . '</td>';
            echo '<td><a href="edit.php?userid=' . $rows['userid'] .'">  <button type="button" class="btn btn-success btn-circle"><i class="fa fa-pencil"></i></button></a>
                      <a href="delete.php?userid='.$rows['userid'] .'">  <button type="button" class="btn btn-warning btn-circle "><i class="fa fa-times"></i></button></a>

            </td>';
                            
                    


                   echo "</tr>";


        }

    
    }else
    {

          
        
    
        Print '<script>alert("No Result!");</script>';
}

} 


?>

                                    

            <thead>
                                        <tr>
                                            <th>ID #</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                        
                                 




                <!-- END DATABASE -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>

     
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
</body>
</html>


