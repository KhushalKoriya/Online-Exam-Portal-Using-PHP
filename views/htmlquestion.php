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

$sql = "SELECT * from qhtml ORDER BY id ASC";
$stmt = $db->prepare($sql);
$stmt->execute();
// $res = pg_query($db, $sql);
// echo $_SESSION['sub'];   

?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online Exam </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />



    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!-- quiz style -->
    <!-- <link rel="stylesheet" href="css/quiz.css"> -->


    <!-- Modernizr JS -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- <script src="js/modernizr-2.6.2.min.js"></script> -->
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <style>
        .pagination span {
            color: black;
            float: left;
            align-items: center;
            background-color: linear-gradient(to right, #d9ecf8, #f0c7ed, #a0b1f0);
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        /* .container1 {
            height: 100%;
            width: 100%;

            overflow: hidden;
            position: relative;
        } */

        /* .container2 {
            position: absolute;
            top: 0px;
            bottom: 0px;
            left: 0px;
            right: -15px;

            overflow: hidden;
        } */

        /* html,
        body {
            height: 100%;

            overflow: hidden;
        } */

        .pagination span.active {
            background-color: dodgerblue;
            color: white;
        }

        .pagination span:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
    <style>
        body {
            /* height: 100vh; */
            background-color: bisque;
            /* padding: 10px; */
            font-family: "Open Sans", Arial, sans-serif;
            font-size: 20px;
            background-image: linear-gradient(to right, #d9ecf8, #f0c7ed, #a0b1f0);
            background-repeat: repeat;
            background-position: center;
            color: #191c24;
            font-weight: 300;
        }

        button {
            background-image: linear-gradient(to right, #afbce9, #ECD3E6);
            /* background: #4292dc; */
            cursor: pointer;
            border-radius: 25px;
            color: black;
            box-shadow: 0 8px 16px 0 blue 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }


        .container {
            margin: 30px auto;
            background: linear-gradient(to right, #d9ecf8, #f0c7ed, #a0b1f0);
            padding: 20px 15px;
            /* text-align:center; */
        }

        .main {
            height: 100%;
            overflow: scroll;
            /* display: none ; */
        }

        /* label.box {
            display: flex;
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #000000;
        } */

        .box {
            margin-top: 10px;
            /* display: flex; */
            border-radius: 5px;
            padding: 10px 12px;
            border: 1px solid #000000;
        }
    </style>
</head>

<body>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Add User Form Start-->
                <!------ <div class="col-lg-12 grid-margin stretch-card"> --------->
                <div class="card">
                    <div class="card-body">
                        <!-- <button type="button" class="btn btn-danger" style="float: right;" id="close"
                            data-dismiss="modal">×</button><br> -->
                        <center>
                            <h4 style="margin: 50px;">For Start the Exam CLICK the button</h4>
                            <!-- <button class="btn btn-primary" id="start" style="margin: 25px;">Start</button> -->
                            <button type="submit" id="start" class="button-34" style="width:300px;height:40px;font-size: 20px;"><b>Attempt
                                    Exam Now</b></button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="front" class="main container1" style="display: none;">

        <div id="fh5co-wrapper" class="container2">
            <div id="fh5co-page">
                <div class="container myclass" id="screen" style="  background-color: linear-gradient(to right, #d9ecf8,#f0c7ed ,#a0b1f0);">
                    <div class="col-lg-12">
                        <p class="h1" style="text-align: end; justify-content: center; color:  linear-gradient(to right, #d9ecf8,#f0c7ed ,#a0b1f0); ">
                            QUIZ</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="h1" id="count" style="text-align: end; justify-content: center; color:  linear-gradient(to right, #d9ecf8,#f0c7ed ,#a0b1f0); ">
                        </div>
                    </div>
                    <form id="exitForm" name="exitForm" method="POST" action="submithtml.php">
                        <table id="mytable" style="padding-left: 200px;">
                            <h1 style="text-align: center;">HTML QUIZ</h1>
                            <tr></tr>
                            <?php $i = 1; ?>
                              <?php while($row = $stmt->fetch(PDO::FETCH_NUM)) {   ?>
                            <!-- <% for(let i=0; i<question.length; i++){ let id=question[i].id; let
                                que=question[i].question; let opt1=question[i].op1; let opt2=question[i].op2; let
                                opt3=question[i].op3; let opt4=question[i].op4; %> -->
                            <tr>
                                <td style="background-color: linear-gradient(to right, #d9ecf8,#f0c7ed ,#a0b1f0);">
                                    <div class="col-12" class="box">
                                        <div style="margin-bottom: 30px;" class="box fifth w-100">
                                            <h3 class="fw-bold mt-5" style="color:  linear-gradient(to right, #d9ecf8,#f0c7ed ,#a0b1f0);">
                                                <?php echo $i ?>
                                                &nbsp;
                                                <?php echo $row[0]?>
                                            </h3>

                                            <div class="row" style="color: rgb(0, 0, 0);">
                                                <div class="col-md-6">
                                                    <label for="five%= id%>">
                                                        <div class="course">A
                                                            <input type="radio" name="que<?php echo $i?>" id="<?php echo $i?>" value="A" style="height:25px; width:25px; vertical-align: middle;" />
                                                            <span class="circle"></span>
                                                            <span class="subject">
                                                            <?php echo $row[1]?>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="six%= id%>">
                                                        <div class="course">B
                                                            <input type="radio" name="que<?php echo $i?>" id="<?php echo $i?>" value="B" style="height:25px; width:25px; vertical-align: middle;" />
                                                            <span class="circle"></span>
                                                            <span class="subject">
                                                            <?php echo $row[2]?>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="seven%= id%>">
                                                        <div class="course">C
                                                            <input type="radio" name="que<?php echo $i?>" id="<?php echo $i?>" value="C" style="height:25px; width:25px; vertical-align: middle;" />
                                                            <span class="circle"></span> <span class="subject">
                                                            <?php echo $row[3]?>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="eight%= id%>">
                                                        <div class="course">D
                                                            <input type="radio" name="que<?php echo $i?>" id="<?php echo $i?>" value="D" style="height:25px; width:25px; vertical-align: middle;" />
                                                            <span class="circle"></span>
                                                            <span class="subject">
                                                            <?php echo $row[4]?>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </table>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="pagination-container">
                                    <input type="text" name="html" value="HTML"/ hidden>

                                    <button class="btn btn-warning " type="submit" id="exit" style="border-radius: 10px;font-size: 30px;float:right;color:red;">Exit</button>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg" id="pgnext">
                                            <li data-page="next" id="prev" onclick="pgnext()">
                                                <span class="btn  btn-info " style="float: left;font-weight: bold;margin-right: 100px;">Next ->
                                                </span>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                            <div class="col-md-6"></div>
                            <!-- <div class="col-md-3" >
                                <form id="exitForm" name="exitForm" href="/thankyou">
                                    <button class="btn btn-warning btn-lg" type="submit" id="exit" style="border-radius: 10px;font-size: 30px;float:left;color:red;">Exit</button>
                                </form>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <!-- END fh5co-page -->


        </div>
    </div>


    <!-- END fh5co-wrapper -->

    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>






    <script>
        // $('#start').click(
        //     $('.main').css('display','block')
        // );
    </script>
    <script>
        let myTab;
        // myTab = window.open('http://localhost:3000/question' + drdow2 + '?exam=1&Applying_for2=on', "newWin", 'height=' + screen.height,
        //             'width=' + screen.width,
        //             'fullscreen=yes');
        $(document).ready(function() {
            $('#myModal').modal('show');
            let btnClose = document.querySelector('#close');
            btnClose.addEventListener('click', () => {
                window.close()
            });

            //         $("button").click(function(){  
            //     $("").fadeOut();  
            //     $("#div2").fadeOut("slow");  
            //     $("#div3").fadeOut(3000);  
            // }); 
            // $('#start').click(()=>{

            //     $('#front').css('display','block');
            // });


            window.onkeydown = function(event) {
                if (event.keyCode == 27) {
                    console.log('yeah')
                    if (myTab) myTab.close();
                }
            };


        });
        $('#start').click(() => {
            $('#myModal').modal('hide');
            $('#front').css('display', 'block')
            var elem = document.getElementById('front');
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
                setTimeout(() => {
                    window.close()
                }, 60000); //1 min is = 60000misec
            }
        })
        $('#exit').click(() => {
            document.getElementById('exitForm').action = './submithtml.php'
            return true;
        })

        // countdown
        // Set the date we're counting down to
        var countDownDate = new Date().getTime() + 1 * 60 * 1000;

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="count"
            document.getElementById("count").innerHTML =
                ` <a style="color:red;font-weight:bold;size:200px">Remaining Time:</a> ${minutes}:${seconds}`

            // hours + ":"+

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                // document.getElementById("count").innerHTML = "Time Out";
                // $(location).attr('href', '/thankyou')
                document.getElementById('exitForm').action = './submithtml.php';
                document.getElementById('exitForm').submit();

            }
        }, 1000);
    </script>
    <script>
        getPagination('#mytable');
        //getPagination('.table-class');
        //getPagination('table');

        /*					PAGINATION 
        - on change max rows select options fade out all rows gt option value mx = 5
        - append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
        - each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
        - fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
        - fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows 
        */


        function getPagination(table) {
            var lastPage = 1;

            $(document)
                .ready(function(evt) {
                    //$('.paginationprev').html('');						// reset pagination

                    lastPage = 1;
                    $('.pagination')
                        .find('li')
                        .slice(1, -1)
                        .remove();
                    var trnum = 0; // reset tr counter
                    var maxRows = 5; // get Max Rows from select option

                    if (maxRows == 5000) {
                        $('.pagination').hide();
                    } else {
                        $('.pagination').show();
                    }

                    var totalRows = $(table + ' tbody tr').length; // numbers of rows
                    $(table + ' tr:gt(0)').each(function() {
                        // each TR in  table and not the header
                        trnum++; // Start Counter
                        if (trnum > maxRows) {
                            // if tr number gt maxRows

                            $(this).hide(); // fade it out
                        }
                        if (trnum <= maxRows) {
                            $(this).show();
                        } // else fade in Important in case if it ..
                    }); //  was fade out to fade it in
                    if (totalRows > maxRows) {
                        // if tr total rows gt max rows option
                        var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
                        //	numbers of pages
                        // end for i
                    } // end if row count > max rows
                    //$('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
                    $('.pagination li').on('click', function(evt) {
                        // on click each page
                        evt.stopImmediatePropagation();
                        evt.preventDefault();
                        var pageNum = $(this).attr('data-page'); // get it's number

                        var maxRows = parseInt(5); // get Max Rows from select option

                        /*if (pageNum == 'prev') {
                            if (lastPage == 1) {
                                return;
                            }
                            pageNum = --lastPage;
                        }*/
                        if (pageNum == 'next') {
                            if (lastPage == $('.pagination li').length - 2) {
                                return;
                            }
                            pageNum = ++lastPage;
                        }

                        lastPage = pageNum;
                        var trIndex = 0; // reset tr counter
                        //$('.pagination li').removeClass('active'); // remove active class from all li
                        $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
                        // $(this).addClass('active');					// add active class to the clicked
                        limitPagging();
                        $(table + ' tr:gt(0)').each(function() {
                            // each tr in table not the header
                            trIndex++; // tr index counter
                            // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                            if (
                                trIndex > maxRows * pageNum ||
                                trIndex <= maxRows * pageNum - maxRows
                            ) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            } //else fade in
                        }); // end of for each tr in table
                    }); // end of on click pagination list
                    limitPagging();
                })
                .val(5)
                .change();

            // end of on select change

            // END OF PAGINATION
        }

        function limitPagging() {
            // alert($('.pagination li').length)
            // console.log($('.pagination li').length);
            if ($('.pagination li').length > 7) {
                if ($('.pagination li.active').attr('data-page') <= 3) {
                    $('.pagination li:gt(5)').hide();
                    $('.pagination li:lt(5)').show();
                    $('.pagination [data-page="next"]').show();
                }
                if ($('.pagination li.active').attr('data-page') > 3) {
                    $('.pagination li:gt(0)').hide();
                    $('.pagination [data-page="next"]').show();
                    for (let i = (parseInt($('.pagination li.active').attr('data-page')) - 2); i <= (parseInt($('.pagination li.active').attr('data-page')) + 2); i++) {
                        $('.pagination [data-page="' + i + '"]').show();

                    }

                }
            }
        }
    </script>
    <script>
        var count = 0;

        function pgnext() {

            count++;
            console.log(count);
            if (count > 3) {
                document.getElementById('prev').style.display = 'none';
            }
            // document.getElementById('exitForm').action = '/submitPost'
            // return true;
        }
    </script>
</body>

</html>