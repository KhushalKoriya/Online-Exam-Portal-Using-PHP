<?php
include("database.php");
session_start();
if(isset($_SESSION['start'])) {
    $now = time() - $_SESSION['start'];
    if ($now >= $_SESSION['time']) {
        // session_destroy();
        // echo "<p align='center'>Session has been destoryed!!";
        header("Location: logout.php");
    }
}

$_SESSION['start'] = time(); 

if (!isset($_SESSION['email'])) {
    // header("Location:userI.php");  
    header("Location:logout.php");
}
$marks=$_GET['m'];
$incorrect=$_GET['incorrect'];
$sub=$_GET['sub'];
?>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	  <!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">	
	 <style>
		 @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
        body {
            margin: 0;
            padding: 0;
            font-family: poppins;
            background-image: linear-gradient(to right, #F4F9FC, #EEE0ED, #afbce9);
            /* background-image: url(ee6.jpg);
    background-repeat: no-repeat;
    background-size: cover; */
        }
        /* .container{
    background-image: url(ee1.jpg);
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
  
} */
        
        li {
            font-size: 20px;
            line-height: 1.5;
        }
        
        button {
            background-image: linear-gradient(to right, #afbce9, #ECD3E6);
            /* background: #4292dc; */
            cursor: pointer;
            border-radius: 25px;
            color: black;
            box-shadow: 0 8px 16px 0 blue 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        
        h1 {
            font-size: 30px;
            border-style: outset;
            box-shadow: 3px 5px #888888;
            padding-left: 50px;
            padding-right: 50px;
            text-align: center;
            margin-top: 50px;
			
        }
        
        .wrapper {
            padding: 5px;
            max-width: 960px;
            width: 95%;
            margin: 20px auto;
        }
        
        header {
            padding: 0 15px;
            text-align: center;
            font-size: 21px;
        }
        
        .columns {
            display: flex;
            flex-flow: row wrap;
            justify-content: center;
            margin: 5px 0;
			
        }
        
        .column {
            flex: 1;
            /* border: 2px solid purple; */
            border: transparent;
            border-radius: 20px;
            box-shadow: 5px 5px 5px 5px rgb(168, 86, 164);
            margin: 2px;
            padding: 10px;
			
            background: rgb(190, 238, 175);
			width: fit-content;
			
        }
        
        .column:first-child {
            margin-left: 0;
            background: #ECD3E6;
            background-position: fixed;
            background-repeat: no-repeat;
        }
        
        .column:last-child {
            margin-left: 0;
            background: white;
        }
        
        @media screen and (max-width:980px) {
            .columns .column {
                margin-bottom: 5px;
                flex-basis: 40%;
            }
            .columns .column:last-child {
                margin: 10%;
                flex-basis: 0;
            }
        }
        
        @media screen and (max-width:680px) {
            .columns .column {
                margin: 0 0 5px 0;
                flex-basis: 100%;
            }
        }
    </style>
	<link rel="stylesheet" href="/css/thankyou.css">
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
</head>
<body>
	
	<header class="site-header" id="header">
        <center>

            <h1 style="width: fit-content; background-image: linear-gradient(to right, #afbce9, #ECD3E6);">Result</h1>	
        </center>
	</header>
	<section class="container">
        <center>

            <div class="column">
                <!-- <h2 style="color: blue;"></h2> -->
                <table class="table table-striped table-bordered table-hover" >
                    
                    
                <tr>
                        <th>Subject:</th>
						<td><?php echo $sub ?></td>
					</tr>
					
					<tr>
                        <th>Score:</th>
						<td><?php echo $marks ?></td>
					</tr>
					<tr>
                        <th>correct ans.:</th>
						<td><?php echo $marks ?></td>
					</tr>
					<tr>
                        <th>incorrect ans.:</th>
						<td><?php echo $incorrect ?></td>
					</tr>
                    
					
                </table>
            </div>
        </center>
	
	</section>
	<br>
    <center>
	<h3 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h3>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.</p>
		
	</div>
    <div>
        <a  href="./first.php">Go To First Page</a>
    </div>
	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">© 2022 Scanpoint Geomatics Ltd. All rights reserved.</p>
	</footer>
    </center>
</body>
</html>
