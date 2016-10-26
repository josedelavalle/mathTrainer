<?php 
    @session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Math Trainer</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
        <link href="assets/css/candlestick.min.css" rel="stylesheet">
        <link href="assets/css/TimeCircles.css" rel="stylesheet">
        <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
        
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">
                    
					<!-- Inner -->
						<div class="inner vcenter">
						    
							<header>
                            
							<div id="scoreDialog">
							     <h2 id="thisTime">&nbsp;</h2>&nbsp;&nbsp;
                                 
							</div>
                            <div id="highScore">&nbsp;</div>
							<div id="loginDialog">
                                <form onsubmit="return false"> 
                                    <input id="username" name="username" type="text" placeholder="User Name" /><br />
                                         
                                    <input id="password" name="password" type="password" placeholder="Password" /><br />
                                    
                                    <!--Remember me?&nbsp;&nbsp;&nbsp;<input id="rememberMe" name="rememberMe" type="checkbox"><br /><br />-->
                                    <div id="loginResult"></div>
                                    
                                    
                                </form> 
                                
                            </div>
                            <div id="registerDialog">
                                <form onsubmit="return false"> 
                                    <input id="username_reg" name="username_reg" type="text" placeholder="User Name"/><br />
                                         
                                    <input id="password_reg" name="password_reg" type="password" placeholder="Password"/><br />
                                    
                                    <input id="confirm_password_reg" name="confirm_password_reg" type="password" placeholder="Confirm Password"/><br />
                                    <input id="email_reg" name="email_reg" type="text" placeholder="Email">
                                    <div id="registerResult"></div>
                                    
                                </form> 
                                
                            </div>
							
                             
                                <div id="notLoggedIn">
                                <?php 
                                

                                if(!isset($_COOKIE['id']) || $_COOKIE['id'] == '') {
                                    echo "Login to track time";
                                    $loggedIn = false;
                                } else {
                                    echo "Welcome back";
                                    $loggedIn = true;
                                }
                                    


                                ?>
                                </div>

                                   <div id="time"></div>
                                   <div id="divProgress"></div><br />
                                    <div id="info">
                                        <a name="math"></a>
                                        <input class="correctBox" type="checkbox" value="" id="correctBox">
                                        
                                    </div>
                                    <div id="numbers">
                                        <p id="num1" style="display:none"></p>
                                        <p id="num2" style="display:none"></p>
                                        <div id="method">
                                            <h1></h1>
                                        </div>
				                    </div>
								<hr />
				                
                                    <input type="number" id="answer" />
                                                                
                                  
                                <a href="#math" id="goButton" class="button circled scrolly">Go</a>
                                
                                
							</header>
							
							<footer>
								<!-- BEGIN # BOOTSNIP INFO -->

                                <div id="curve_chart" style="width: 400px; height: 200px"></div>

								

							</footer>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="javascript:location.reload();">Restart</a></li>
								<li>
									<a href="#">Difficulty</a>
									
									<ul>
    									<li><a href="#">Addition</a><ul>
                                            <li><a href="?digits=1+" id="1dig+">1 Digit</a></li>
                                            <li><a href="?digits=2+" id="2dig+">2 Digits</a></li>
                                            <li><a href="?digits=3+" id="3dig+">3 Digits</a></li>
                                        </ul></li>

										<li><a href="#">Subtraction</a><ul>
                                            <li><a href="?digits=1-" id="1dig-">1 Digit</a></li>
                                            <li><a href="?digits=2-" id="2dig-">2 Digits</a></li>
                                            <li><a href="?digits=3-" id="3dig-">3 Digits</a></li>
                                        </ul></li>
									</ul>
								</li>
                                <?php  
                                    if ($loggedIn === true) {
                                        echo '<li id="loginLink" style="display:none;"><a href="JavaScript:void(0)" id="openLogin">Login</a></li>';
                                        echo '<li id="logoutLink"><a href="JavaScript:void(0)" id="openLogout">Logout</a>';
                                    } else {
                                        echo '<li id="loginLink"><a href="JavaScript:void(0)" id="openLogin">Login</a></li>';
                                        echo '<li id="logoutLink" style="display:none;"><a href="JavaScript:void(0)" id="openLogout">Logout</a>';
                                    }
                                ?>
                               </li>
							</ul>
						</nav>

				</div>

			

		</div>

		<!-- Scripts -->
		    
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<!--<script src="assets/js/jquery.onvisible.min.js"></script>-->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/CircularLoader-v1.2.js"></script>   
			<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/main.js"></script>
			
			<script src="assets/js/candlestick.min.js"></script>
            <script type="text/javascript" src="assets/js/TimeCircles.js"></script>

			<script type="text/javascript" >
            $(document).ready(function() {
                var z = 0, min = 1, limit = 2, thisTime, max = 10, numCorrect = 0, numInCorrect = 0, 
                    digits = getParameterByName('digits'), scores, defaultscore = "0,0,0,0,0,0";

                if (digits === null) digits = "1+";
                var method = digits.substr(digits.length - 1),
                    isCorrect;
                score_cat = digits.substr(0,1);
                switch (score_cat) {
                    case "2":
                        max = 100;
                        break;
                    case "3":
                        max = 1000;
                        break;
                    default:
                        digits = 1;
                }
                if (method != "+" && method != "-") method = "+";
                if (method == "-") score_cat = parseInt(score_cat) + 3;
                score_cat = score_cat - 1;
                
                $('#method').replaceWith("<h1 id='method' style='display:none'>" + method + "</h1>");
                $('#method').fadeIn(3000);
                // $(window).on('resize',function(){location.reload();});
                                
                function getParameterByName(name, url) {
                    if (!url) url = window.location.href;
                    name = name.replace(/[\[\]]/g, "\\$&");
                    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                        results = regex.exec(url);
                    if (!results) return null;
                    if (!results[2]) return '';
                    return decodeURIComponent(results[2].replace(/\+/g, " "));
                }

                function getCookie(cname) {
                    var name = cname + "=";
                    var ca = document.cookie.split(';');
                    for(var i = 0; i <ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0)==' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) === 0) {
                            return c.substring(name.length,c.length);
                        }
                    }
                    return "";
                }
                if (getCookie("id") !== "") {
                    showCircles();
                    
                }

                function readCookie(name) { 
                    var nameEQ = name + "="; 
                    var ca = document.cookie.split(';'); 
                    for(var i=0;i < ca.length;i++) { 
                        var c = ca[i]; 
                        while (c.charAt(0)==' ') c = c.substring(1,c.length); 
                        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length); 
                    } 
                    return null; }

                function rtrim(str){
                    return str.replace(/\s+$/, '');
                }
                function replaceNumbers() {
                    x = Math.floor(Math.random() * (max - min)) + min;
                    y = Math.floor(Math.random() * (max - min)) + min;
                    if (y > x) {y = [x, x = y][0];}
                    
                    $('#num1').fadeOut('slow', function() {
                        $('#num1').replaceWith("<h1 id='num1' style='display:none'>" + x + "</h1>");
                        $('#num1').fadeIn('slow');
                    });
                    
                    z = y;
                    //alert(x.toString().length);
                    while (x.toString().length > z.toString().length ) {
                        //alert(z.toString().length);
                        z = "0" + z;
                    }
                    $('#num2').fadeOut('slow', function() {
                        
                        $('#num2').replaceWith("<h1 id='num2' style='display:none'>" + z + "</h1>");
                        $('#num2').fadeIn('slow');
                    });
                }
                $('#loginDialog').dialog({
                        draggable: true, // Set true by default
                        resizable: false, // Set true by default
                        title: 'Login',
                        // You can use minWidth, minHeight, maxWidth, maxHeight
                        height: 300, // Defined in pixels
                        width: 350,
                        // If set true the user can't do anything until the
                        // dialog is closed
                        modal: true,
                        // Position the dialog with my and define the browser
                        // position with at
                        // 1st: left, right, center
                        // 2nd: top, center, bottom
                        position: {
                          //my: 'center top',
                          at: 'center'// bottom',
                          // You can also target to place based on an element
                          // on the screen (center under the link)
                          //of: "#openDialog"
                        },
                        // Define a delay for showing or hiding it
                        show: 1000,
                        hide: '1000',
                        autoOpen: false, // Open true by default
                        // create buttons for the dialog
                        buttons : {
                            "Login" : function() {
                                doLogin();
                            },
                            "Register" : function() {
                                $('#loginDialog').dialog("close");
                                $('#registerDialog').dialog("open");
                            },
                            "Cancel" : function(){

                                $(this).dialog("close");
                            },

                        }
                      });

                      // open the login dialog box
                      $('#openLogin').click(function() {
                        $('#loginDialog').dialog("open");
                         
                      });
                
                    $('#registerDialog').dialog({
                        draggable: true, // Set true by default
                        resizable: false, // Set true by default
                        title: 'Register',
                        // You can use minWidth, minHeight, maxWidth, maxHeight
                        height: 400, // Defined in pixels
                        width: 350,
                        // If set true the user can't do anything until the
                        // dialog is closed
                        modal: true,
                        // Position the dialog with my and define the browser
                        // position with at
                        // 1st: left, right, center
                        // 2nd: top, center, bottom
                        position: {
                          //my: 'center top',
                          at: 'center'// bottom',
                          // You can also target to place based on an element
                          // on the screen (center under the link)
                          //of: "#openDialog"
                        },
                        // Define a delay for showing or hiding it
                        show: 1000,
                        hide: '1000',
                        autoOpen: false, // Open true by default
                        // create buttons for the dialog
                        buttons : {
                            "Login" : function() {
                                $('#registerDialog').dialog("close");
                                $('#loginDialog').dialog("open");
                                $('#notLoggedIn').hide();
                            },
                            "Register" : function() {
                                $("#registerResult").html(doRegister());
                            },
                            "Cancel" : function(){

                                $(this).dialog("close");
                            },
                        }
                      });
                        
                    $('#scoreDialog').dialog({
                        draggable: true, // Set true by default
                        resizable: false, // Set true by default
                        title: 'Results',
                        // You can use minWidth, minHeight, maxWidth, maxHeight
                        height: 250, // Defined in pixels
                        width: 350,
                        // If set true the user can't do anything until the
                        // dialog is closed
                        modal: true,
                        // Position the dialog with my and define the browser
                        // position with at
                        // 1st: left, right, center
                        // 2nd: top, center, bottom
                        position: {
                          //my: 'center top',
                          at: 'center'// bottom',
                          // You can also target to place based on an element
                          // on the screen (center under the link)
                          //of: "#openDialog"
                        },
                        // Define a delay for showing or hiding it
                        show: 1000,
                        hide: '1000',
                        autoOpen: false, // Open true by default
                        // create buttons for the dialog
                        buttons : {
                          "Restart" : function(){

                            location.reload();
                          },

                        }
                      });
                
                      // Displays the dialog box on click
                      
                
                    $('#openLogout').click(function() {
                        $('#loginLink').show();
                        $('#logoutLink').hide();
                        $('#notLoggedIn').show();
                        $('#highScore').html("&nbsp;");
                        userId = 0;
                        $('#time').TimeCircles().destroy();
                        $.ajax({
                            type: "POST",
                            url: "logout.php",
                            
                            
                        });
                        location.reload();
                    });
       
                var userId = readCookie("id");
                var highscore = readCookie("highscore");
                
                <?php
                    //$connect = mysqli_connect("localhost", "root", "root", "jdelaval_mathdb");
                $connect = mysqli_connect("localhost", "jdelaval_root", "d3l4v4ll3", "jdelaval_mathdb");
                    $sql = "SELECT highscore FROM user WHERE id = '".$_COOKIE['id']."'";
                    $result = mysqli_query($connect, $sql);
                    
                    $row = mysqli_fetch_array($result);
                    $highscore = $row["highscore"];
                    mysqli_close($connect);
                ?>
                highscore = '<?php echo $highscore;?>';
                
                if (highscore !== null) {
                    
                    highscore = highscore.replace(/%2C/gi,",");
                    scores = highscore.split(",");
                    

                } else {
                    scores = defaultscore.split(",");
                    
                }

                
                    function doLogin() {
                        var sendu = $("#username").val();
                        var sendp = $("#password").val();
                        
                        $.ajax({
                            type: "POST",
                            url: "login.php",
                            data: "username="+sendu+"&password="+sendp,
                            dataType: "json",
                            success: function(msg,string,jqXHR) {

                                if (msg.id === null) { 
                                    $("#loginResult").html("Username and/or password incorrect");
                                } else {
                                    //setHighScore(scores);
                                    //userId = msg.id;
                                    
                                    location.reload();
                                }
                            }
                            
                        });
                    
                    }
                    function setHighScore(thisHighScore) {
                        
                        
                        if (thisHighScore >= 0 && thisHighScore != "") {
                            
                            $("#highScore").html("Fastest Time: " + thisHighScore);
                        }
                    }
                    function updateScore(thisHighScore) {
                        
                        
                        var updateData = {};
                        updateData['id'] = userId;
                        updateData['newhighscore'] = thisHighScore;
                        $.ajax({
                            type: "POST",
                            url: "update.php",
                            data: updateData,
                            success: function(msg) {
                                $("#notLoggedIn").html(msg);
                                
                            }
                            
                        });
                    
                    }
                    function showCircles() {
                        $("#time").TimeCircles({time: {
                            Days: {show: false},
                            Hours: {show: false},
                            Seconds: {color: '#6cc9c9'},
                        }});
                    }
                
                    function validateEmail(email) {
                        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        return re.test(email);
                    }
                
                    function doRegister() {
                        //Check first for valid entries
                        var sendu_reg = $("#username_reg").val();
                        if (!sendu_reg) {
                            
                            $("#username_reg").focus();
                            return "UserName Required";
                        }
                        
                        var sende_reg = $("#email_reg").val();
                        if (!sende_reg) {
                            $("#email_reg").focus();
                            return "Email Required";
                        } else {
                            if (!validateEmail(sende_reg)) {
                                //Invalid email entered
                                $("#email_reg").focus();
                                return "Invalid Email";
                            }

                        }

                        var sendp_reg = $("#password_reg").val();
                        if (!sendp_reg) {
                            $("#password_reg").focus();
                            return "Password Required";
                        }

                        var confirm_sendp_reg = $("#confirm_password_reg").val();
                        if (!confirm_sendp_reg) {
                            $("#confirm_password_reg").focus();
                            return "Confirm Password Required";
                        }

                        if (sendp_reg != confirm_sendp_reg) {
                            $("#password_reg").text("");
                            $("#confirm_password_reg").text("");
                            $("#password_reg").focus();
                            return "Passwords Do Not Match";
                        } else {
                            
                            $.ajax({
                                type: "POST",
                                url: "register.php",
                                data: "username="+sendu_reg+"&password="+sendp_reg+"&email="+sende_reg,
                                success: function(msg) {
                                        
                                        if (msg == "Success") {
                                            location.reload();
                                        } else {
                                            $("#registerResult").html(msg);
                                        }
                                }
                                
                            });
                            //return msg
                        }
                    }

                    $("#divProgress").circularloader({
                        backgroundColor: "transparent",//background colour of inner circle
                        fontColor: "#ffffff",//font color of progress text
                        fontSize: "25px",//font size of progress text
                        radius: 30,//radius of circle
                        progressBarBackground: "#60686F",//background colour of circular progress Bar
                        progressBarColor: "#6cc9c9",//colour of circular progress bar
                        progressBarWidth: 8,//progress bar width
                        progressPercent: 0,//progress percentage out of 100
                        progressValue:0,//diplay this value instead of percentage
                        showText: true//show progress text or not
                        //title: "Any Title",//show header title for the progress bar
                    });
              
                    $(document).keypress(function(e) {
                        if(e.which == 13) {
                             $('#goButton').click(); 
                        }
                    });
                    
                    replaceNumbers();
                    setHighScore(scores[score_cat]);
                    $('#goButton').click(function() {

                        z = $('#answer').val();
                        if ($.isNumeric(z)) {
                            if (method == "+") {
                                if (x + y == z) isCorrect = true; else isCorrect = false;
                            } else {
                                if (x - y == z) isCorrect = true; else isCorrect = false;
                            }
                            if (isCorrect) {

                                numCorrect = numCorrect + 1;
                                $("#divProgress").circularloader({
                                    progressPercent: (100 / limit) * numCorrect,
                                    progressValue: numCorrect
                                });
                                /*$('#numCorrect').fadeOut('slow', function() {
                                    $('#numCorrect').replaceWith("<h2 id='numCorrect' class='infoNum' style='display:none'>" + numCorrect + "</div>");
                                    $('#numCorrect').fadeIn('slow');
                                });*/

                                if (numCorrect == limit && userId > 0) {
                                    
                                    $("#time").TimeCircles().stop();
                                    thisTime = $("#time").TimeCircles().getTime();
                                    thisTime = thisTime * -1;
                                    
                                    $('#thisTime').text("Time: " + thisTime);
                                    highScore = rtrim($("#highScore").text());
                                    
                                    if (thisTime < scores[score_cat] || scores[score_cat] == "0") {
                                        $("#highScore").text("Fastest Time: " + thisTime);
                                        
                                        if (userId > 0) {
                                            //alert('logged in');
                                            scores[score_cat] = thisTime;
                         
                                            highscore = scores.toString();
                                    
                                            
                                            updateScore(highscore);
                                        } else {
                                           // alert("not logged in");
                                        }
                                    }
                                    //numCorrect = 0;
                                    
                                    
                                    
                                    $('#scoreDialog').dialog("open");
                                }
                                    
                                replaceNumbers();
                                
                                $("#correctBox").candlestick('on');
                            } else {
                                /*numInCorrect = numInCorrect + 1;
                                    $('#numInCorrect').fadeOut('slow', function() {
                                        $('#numInCorrect').replaceWith("<h2 id='numInCorrect' class='infoNum' style='display:none'>" + numInCorrect + "</div>");
                                        $('#numInCorrect').fadeIn('slow');
                                    });*/
                                $("#correctBox").candlestick('off');
                            }

                        } else {
                            $("#correctBox").candlestick('off');


                        }
                        $('#answer').val('');
                        $('#answer').focus();
                    });


                    



                     



                    $('#answer').focus();

                    $("#correctBox").candlestick();
                    $("#correctBox").candlestick({


                      // options or contents
                      'mode': 'options',

                      'contents': {
                          'left': 'Left',
                          'middle': 'Middle',
                          'right': 'Right',
                          'swipe': false
                      },

                      // for on value
                      'on': '1',

                      // for off value
                      'off': '0',

                      // for non value
                      'default': '',

                      // enable touch swipe
                      // requires hammer.js and jquery hammer.js plugin
                      //'swipe': false,

                      // lg, md (default), sm, xs
                      'size': 'md',

                      // callbacks
                      afterAction: function() {},
                      afterRendering: function() {},
                      afterOrganization: function() {},
                      afterSetting: function() {}

                    });

                    jQuery(function($) {
                    $(".js-candlestick").candlestick();
                    $('.with-after-setting').candlestick({
                        afterSetting: function(input, wrapper, value) {
                            alert('The new value is :"' + value + '"');
                        }
                    });

                   

                });
                
                
            });
            </script>
            

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);
                  var today = new Date();
                  var dd = today.getDate();
                  var mm = today.getMonth()+1; //January is 0!
                  var yyyy = today.getFullYear();

                  if(dd<10) {
                      dd='0'+dd;
                  } 

                  if(mm<10) {
                      mm='0'+mm;
                  } 

                  today = mm+'/'+dd+'/'+yyyy;
                  
                  scoreArray = [['Date', 'Times'],
                      [today,  1000],
                      [today,  1170],
                      [today,  660],
                      [today,  1030]];

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable(
                        scoreArray  
                    );

                    var options = {
                      title: 'Your Scores',
                      legend: { position: 'bottom' }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                    chart.draw(data, options);
                  }
                </script>
          
	</body>
</html>