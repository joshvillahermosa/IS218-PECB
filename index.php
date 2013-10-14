<?php
    //echo"Page has successfully loaded.";

    $bankSite = new bankSite();

    class bankSite {

    	function __construct(){
    		$page = 'homepage';
    		$arg = NULL;

    		if (isset($_REQUEST['page'])){
    			$page = $_REQUEST['page'];
    		}
    		if (isset($_REQUEST['arg'])){
    			$arg = $_REQUEST['arg'];
    		}
    		//Test if Vars work
    		//echo "Page is ".$page." and args is ".$arg.".";
    		$page = new $page($arg);
    	}
    }


    /*_________________________________________________________________________________________________________________________________________________________________

    Pages
    __________________________________________________________________________________________________________________________________________________________________*/

    abstract class page{
    	//Variables to create HTML contemt


    	//Will change depending on content
    	public $title;
    	public $contentHeader;
    	public $content;
    	public $headBody;
        public $login = false;
        public $username;
        public $password;
        public $error;

    	//Static Variables
    	public $html;
    	public $head;
    	public $nav;
    	public $body;
    	public $footer;
    	public $libraries;


    	function createHTML(){

    		$this->nav = '
	    		<nav class="navbar navbar-default" role="navigation">
	    			<div class="container">
		            <ul class="nav navbar-nav">
		            	<li><a href="./index.php?page=registerView" title="">Register</a></li>
		                <li><a href="./index.php?page=homepage" title="">Login</a></li>
		                <li><a href="./index.php?page=statementView" title="">View</a></li>
		                <li><a href="./index.php?page=enterCreditsView" title="">Enter</a></li>
		                <li><a href="./index.php?page=lostPasswordView" title="">Retrieve lost account</a></li>
		            </ul>
		            </div>
	        	</nav>
	    	';


    		$this->head = '
	    		<head>
			        <meta charset="utf-8">
			        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			        <title>'.$this->title.'</title>
			        <meta name="description" content="">
			        <meta name="viewport" content="width=device-width">

			        <link rel="stylesheet" href="css/bootstrap.min.css">
			        <style>
			            /*body {
			                padding-top: 60px;
			                padding-bottom: 40px;
			            }*/
			        </style>

			        <!-- CSS Files -->
			        <link rel="stylesheet" href="css/main.css">
			        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
			    </head>
	    	';

	    	$this->footer = '
	    		<footer id="footer" class="footer container">
		            <div class="text-muted">
		                &copy; Joshua John Villahermosa <br>
		                <p>Note: All tools made with the development of this Website are NOT tools created by me and NOT coprtighted by me. They belong to thier respective developers to bring a awesome user expernence. For more information about these tools, <a href="#/tools">click here</a> to visit thier website.</p>
		            </div>
		            <div id="tools"></div>
		        </footer>
	    	';

	    	$this->libraries = '
	    		<!-- JavaScript Libraries -->
		        <script src="js/vendor/jquery-1.10.1.min.js"></script>
		        <script src="js/vendor/bootstrap.min.js"></script>
		        <script src="js/vendor/jquery.cycle.all.js"></script>
		        <script src="js/vendor/underscore-min.js"></script>
		        <script src="js/vendor/backbone-min.js"></script>
		        <script src="js/vendor/handlebars.js"></script>

		        <!-- JavaScript Made Files -->
		        <script src="js/views/viewTools.js"></script>
		        <script src="js/main.js"></script>
	    	';


	    	$this->body = '
	    		 <body>
			        <!--[if lt IE 7]>
			            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
			        <![endif]-->

			        <!-- This code is taken from http://twitter.github.com/Boilerplate/examples/hero.html -->
			        <!-- Content Here -->
			        '.$this->nav.'
			        <div class="container ">
		            	<header id="header" class="">      
		            	'.$this->contentHeader.'
		            	</header><!-- /header -->
		            	<section id="displayZone">
		            	'.$this->content.'
		            	</section>
	       			</div
	       			'.$this->footer.'
	       			'.$this->libraries.'
	       		</body>
	    	';

	    	$this->headBody = $this->head.$this->body;

  			$this->html = '
	    		<!DOCTYPE html>
				<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
				<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
				<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
				<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
                <div id="BG">
				'.$this->headBody.'
                </div>
				</html>
	    	';
    	}


    	function __construct($arg = NULL){
    		if($_SERVER['REQUEST_METHOD'] == 'GET'){
    			$this->get();
    		}else{
    			$this->post();
    		}
    	}

    	function get(){}
    	function post(){}

    	function __destruct (){
    		$this->createHTML();
    		echo $this->html;
    	}
    }

    class homepage extends page {
    	function get (){
    		$this->title = 'Welcome to PECB';
    		$this->contentHeader = '
    			<div class="jumbotron">
        			<h1>Planet Express Capital Bank!</h1>
                    '.$this->error.'
                    <p>Planet Express Capital Bank (PECB) will ensure that you money will always be secure with our diamond-dillion cyber security. Our mission to provide the best quality serive to your money.</p>
                    <div class="row">
                        <img src="./img/display/bender.png" alt="Benders Bank" class="col-lg-3">
                        <div class="form-group col-lg-8">
                            <form name="login" action="index.php" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
                               <label>Username: <input type="text" name="username" placeholder="username"></label>
                               <label>Password: <input type="password" name="password" placeholder="password"></label> <br>
                               <input type="submit" class="btn btn-success" name="submit"></input>
                               <a href="./index.php?page=registerView" class="btn btn-primary">Register</a>
                               <a href="./index.php?page=lostPasswordView" class="btn btn-info" >Forgot Password?</a>
                            </form>
                            <p class="text-muted">PECB is auduted and regulated by DOOPs chief financials. Under the leadership of Zapp Barnigan, all Galatical banks are ordered to follow Braniggans law:12:3.a. For more information <a href="http://google.com" title="Google">click here</a></p>
                        </div>
                    </div>
                </div>
    		';

            
    		return $this->title;
    		return $this->contentHeader;
    	}

       

        function post(){
            if(isset($_POST['username'])){
                $this->username = $_POST['username'];
            }
            if (isset($_POST['password'])){
                $this->password = $_POST['password'];
            }
            if ($this->username == 'PhilipJFry' && $this->password == 'BenderSucks1'){
                
                /*
                $page = 'statementView';
                $this->login = true;
                */
                $session = new session();
                $_SESSION['username'] = $this->username;
                $_SESSION['password'] = $this->password;
                header('location: http://localhost:8080/planetExpressBank/index.php?page=statementView');

            }
            else{
                $this->error = '<h2 style="color: red;">Login Failed Dummy!</h2>';
                header('location: http://localhost:8080/planetExpressBank/index.php?page=homepage');
            }
            /*
            return $page;
            return $this->login;
            
            */
            return $this->error;
        }
    }

    class statementView extends page {
    	function get (){
    		$this->title = 'View your staments';
    		$this->contentHeader = '
    			<h1>Greetings user!</h1>
                <hr>
                <p>Please find your statments below. If you have any questions, please contact out PECB help desk</p>
    		';
    		$this->content = '
    			 <table class="table tabel-condensed">
                    <caption>Statements and balances</caption>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>$$$</th>
                            <th>Balance</th>
                            <th>Decription</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10/3/13</td>
                            <td class="danger">-$1000.00</td>
                            <td>$10.00</td>
                            <td>Transfer funds (Pending)</td>
                        </tr>
                        <tr>
                            <td>10/3/13</td>
                            <td class="danger">-$1000.00</td>
                            <td>$10.00</td>
                            <td>Transfer funds (Pending)</td>
                        </tr>
                        <tr>
                            <td>10/3/13</td>
                            <td class="danger">-$1000.00</td>
                            <td>$10.00</td>
                            <td>Transfer funds (Pending)</td>
                        </tr>
                        <tr>
                            <td>10/3/13</td>
                            <td class="danger">-$1000.00</td>
                            <td>$10.00</td>
                            <td>Transfer funds (Pending)</td>
                        </tr>
                    </tbody>
                </table>
    		';

    		return $this->title;
    		return $this->contentHeader;
    		return $this->content; 
    	}
    }

    class enterCreditsView extends page {
    	function get (){
            session_start();////fdsakljfiowjrowealksfm;a --> Must be added to use the session variable in a freggin class!!!!
            if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        		$this->title = 'Enter your credits';
        		$this->contentHeader = '
        			<h1>Enter Credit Information Portal ()</h1>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in 
                    culpa qui officia deserunt mollit anim id est laborum</p>
                    <hr>
        		';
        		$this->content = '
        			  <form action="" method="post" accept-charset="utf-8" class="form" style="padding: 10px;">
                        <div class="form-group">
                            <label for="">Credits</label>
                            <label>++ <input type="radio" name="addCredit" value=""></label>
                            <label>-- <input type="radio" name="subCredit" value=""></label> <br>
                            <label>$$ Amount $$:  <input type="text" name="creditAmount" value=""></label> <br>
                            <label>Description:  <input type="text" name="creditDesc" value=""></label> <br>
                            <input type="submit" name="submitValue" value="Submit Value" class="btn btn-danger">
                            <input type="reset" name="" value="Reset" class="btn-info">
                        </div>
                    </form>
        		';
        		return $this->title;
        		return $this->contentHeader;
        		return $this->content;
            }else{
                header('location: http://google.com');
            }
        }
    }

    class registerView extends page {
    	function get (){
    		$this->title = 'Sign your bank account here!';
    		$this->contentHeader = '
    			<h1>Thank you for registering for Planet Express Capitol Bank! (PECB)</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                <hr>
    		';
    		$this->content = '
    			   <form action="" method="post" accept-charset="utf-8" class="form" style="padding: 10px;">
                    <label>First Name <br><input type="text" name="fname" value=""></label> <br>
                    <label>Last Name: <br><input type="text" name="lname" value=""></label> <br>
                    <label>Email: <br><input type="email" name="newEmail" value=""></label> <br>
                    <label>Username: <br><input type="text" name="newUser" value=""></label> <br>
                    <label>Password: <br><input type="password" name="newPass" value=""></label> <hr>
                    <input type="submit" name="" value="Submit" class="btn btn-success">
                </form>    		';
    		return $this->title;
    		return $this->contentHeader;
    		return $this->content; 
    	}
    }

     class lostPasswordView extends page {
    	function get (){
    		$this->title = 'Recover your password here....idiot';
    		$this->contentHeader = '
    			<h1>Lost Password?</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                 dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                 <hr>
    		';
    		$this->content = '
    			 <form action="" method="post" accept-charset="utf-8" class="form" style="padding: 10px;">
                    <label>Username: <br><input type="text" name="newUser" value=""></label> <br>
                    <label>Password: <br><input type="password" name="newPass" value=""></label> <hr>
                    <input type="submit" name="" value="Send confirmation email" class="btn btn-success">
                </form>';
    		return $this->title;
    		return $this->contentHeader;
    		return $this->content; 
    	}
    }

    /*_________________________________________________________________________________________________________________________________________________________________

    Sessions
    __________________________________________________________________________________________________________________________________________________________________*/

    class session{
        public function __construct(){
            session_start();
        }
    }

?>
