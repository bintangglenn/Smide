<?php session_start() ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap.min.css">
	    <script src="libs/jquery/dist/jquery.min.js"></script>
	    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
	    <style>
	        table {
	            table-layout: fixed;
	        }
	        th {
	            border: 1px solid #ddd !important;
	            text-align: center;
	        }
	        td {
	            border: 1px solid #ddd !important;            
	        }
	   	</style>
	</head>
	<body>
		<nav class="navbar navbar-default">
	  		<div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="index.php">Simide</a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li>
				       <a href="decryptEmail.php">Decrypt Email</a>
				    </li>
				    <li>
				       <a href="decryptFile.php">Decrypt File</a>
				    </li>
			        <li>
				       <a href="encryptFile.php">Encrypt File</a>
				    </li>
			      </ul>
			    </div>
		  	</div>
		</nav>


		<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Digital Signature is a mathematical technique used to validate the authenticity and integrity of a message, software or digital document.</p>
                </div>
                <div class="col-lg-4">
                    <p>Digital signatures are also used extensively to provide proof of authenticity, data integrity and non-repudiation of communications and transactions conducted over the Internet.</p>
                </div>

            </div>
		</div>

	</body>
</html>