<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Darbocite.</title>

<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="assets/css/main.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/animate-custom.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/modernizr.custom.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body data-spy="scroll" data-offset="0" data-target="#navbar-main">
<div id="navbar-main"> 
  <!-- Fixed navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="#home">Darbocite</a> </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#home" class="smoothScroll">Home</a></li>
          <li> <a href="#about" class="smoothScroll"> About</a></li>
          <li> <a href="#services" class="smoothScroll"> Services</a></li>
      
          <li> <a href="#team" class="smoothScroll"> Team</a></li>
          <li> <a href="#contact" class="smoothScroll"> Contact</a></li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
  </div>
</div>

<!-- ==== HEADERWRAP ==== -->

<?php

//ORCID API CREDENTIALS - replace these values with your API credentials
////////////////////////////////////////////////////////////////////////

define('OAUTH_CLIENT_ID', 'APP-5IFRVJEU1R9F0P7Q');//client ID
define('OAUTH_CLIENT_SECRET', '9f06c835-0e1d-443e-bf41-400b64ab7295');//client secret
define('OAUTH_REDIRECT_URI', 'http://www.darbocite.com/orcauth');//redirect URI

//ORCID API ENDPOINTS
////////////////////////////////////////////////////////////////////////

//Sandbox - Member API
//define('OAUTH_AUTHORIZATION_URL', 'https://sandbox.orcid.org/oauth/authorize');//authorization endpoint
//define('OAUTH_TOKEN_URL', 'https://api.sandbox.orcid.org/oauth/token'); //token endpoint

//Sandbox - Public API
//define('OAUTH_AUTHORIZATION_URL', 'https://sandbox.orcid.org/oauth/authorize');//authorization endpoint
//define('OAUTH_TOKEN_URL', 'https://pub.sandbox.orcid.org/oauth/token');//token endpoint

//Production - Member API
//define('OAUTH_AUTHORIZATION_URL', 'https://orcid.org/oauth/authorize');//authorization endpoint
//define('OAUTH_TOKEN_URL', 'https://api.orcid.org/oauth/token'); //token endpoint

//Production - Public API
define('OAUTH_AUTHORIZATION_URL', 'https://orcid.org/oauth/authorize');//authorization endpoint
define('OAUTH_TOKEN_URL', 'https://orcid.org/oauth/token');//token endpoint

//EXCHANGE AUTHORIZATION CODE FOR ACCESS TOKEN
////////////////////////////////////////////////////////////////////////

//If an authorization code exists, fetch the access token
if (isset($_GET['code'])) {

	//Build request parameter string
	$params = "client_id=" . OAUTH_CLIENT_ID . "&client_secret=" . OAUTH_CLIENT_SECRET . "&grant_type=authorization_code&code=" . $_GET['code'] . "&redirect_uri=" . OAUTH_REDIRECT_URI;


	//Initialize cURL session
	$ch = curl_init();

	//Set cURL options
	curl_setopt($ch, CURLOPT_URL, OAUTH_TOKEN_URL);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);//Turn off SSL certificate check for testing - remove this for production version!
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);//Turn off SSL certificate check for testing - remove this for production version!
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

	//Execute cURL command
	$result = curl_exec($ch);

	//Close cURL session
	curl_close($ch);

	//Transform cURL response from json string to php array
	$response = json_decode($result, true);

} else {
	//If an authorization code doesn't exist, throw an error
	echo "Unable to connect to ORCID";
}

?>		

<div class="container">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li><a href="https://orcid-create-on-demand.herokuapp.com/">Home</a></li>
          <li><a href="https://orcid.org" target="_blank">About ORCID</a></li>
          <li><a href="https://orcid.org/help/contact-us" target="_blank">Contact ORCID</a></li>
        </ul>
        <h3 class="muted">ORCID @ State University</h3>
      </div>

      <hr>

      <div class="jumbotron">
      <h1>Thanks, <?php echo $response['name']; ?>!</h1>
      <br>
      <p class="lead">Your ORCID <img src="https://orcid.org/sites/default/files/images/orcid_16x16.png" class="logo" width='16' height='16' alt="iD"/> is <?php echo $response['orcid']; ?></p>
      <p class="lead">The access token we're storing in our database so that we can update your ORCID record in the future is <b><?php echo $response['access_token']; ?></b></p>
      <p>(for demo purposes only - don't show access tokens in live apps!)</p>
      <br> <br>
      <a class="btn btn-large"  href="<?php echo ENV; ?>/my-orcid" target="_blank">Go to your ORCID record</a>
  </div>
  
  
  
<!-- container -->

<div id="footerwrap">
  <div class="container">
    <div class="row">
      <div class="col-md-8"> <span class="copyright">Copyright &copy; 2015 
		  Darbocite. Design by <a href="http://www.templategarden.com" rel="nofollow">TemplateGarden</a></span> </div>
      <div class="col-md-4">
        <ul class="list-inline social-buttons">
          <li><a href="#"><i class="fa fa-twitter"></i></a> </li>
          <li><a href="#"><i class="fa fa-facebook"></i></a> </li>
          <li><a href="#"><i class="fa fa-google-plus"></i></a> </li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/retina.js"></script> 
<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="assets/js/smoothscroll.js"></script> 
<script type="text/javascript" src="assets/js/jquery-func.js"></script>
</body>
</html>
