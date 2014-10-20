<!DOCTYPE html>
<html>
  <head>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Sally And James Are Getting Married!</title>

    <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/soon.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

  </head>
  <!-- START BODY -->
  <body class="nomobile">

    <!-- START HEADER -->
    <section id="header">
        <div class="container" style="background: rgba(138, 73, 107, 0.4);">
            <header>
                <!-- HEADLINE -->
                <h1 data-animated="GoIn" ><b>Yay!</b> We are getting married!</h1>
            </header>
            <!-- START TIMER -->
            <div id="timer" data-animated="FadeIn">
                <p id="message"></p>
                <div id="days" class="timer_box"></div>
                <div id="hours" class="timer_box"></div>
                <div id="minutes" class="timer_box"></div>
                <div id="seconds" class="timer_box"></div>
            </div>
            <!-- END TIMER -->
            <div class="col-lg-4 col-lg-offset-4 mt centered">
				<h4>
					6pm June 20th 2015 
					<br/>@
				</h4>
				<p><a class="btn btn-default" target="_blank" href="http://www.echovermont.org/" >Echo Lake Aquarium</a></p>
				<p><a class="btn btn-primary" target="_blank" href="https://maps.google.com?daddr=One+College+Street+Burlington,+VT+05401" >Get Directions</a></p>
				<p><a class="btn btn-info" href="javascript:void(0)" onclick="alert('Ask for the Norton/Nadeau Wedding Rates'); window.open('http://www.marriott.com/hotels/travel/btvdt-courtyard-burlington-harbor/');">Lodging</a></p>
			</div>
        </div>
        <!-- LAYER OVER THE SLIDER TO MAKE THE WHITE TEXTE READABLE -->
        <div id="layer"></div>
        <!-- END LAYER -->
        <!-- START SLIDER -->
        <div id="slider" class="rev_slider">
            <ul>
              <?php 
				$files = array_reverse(glob($_SERVER['DOCUMENT_ROOT'].'/assets/img/slider/*.{jpg,JPG}', GLOB_BRACE));
				foreach($files as $index => $file) {
					$filename = array_pop(explode('/', $file));
					echo '<li id="slide_'.($index+1).'" data-transition="slideleft" data-slotamount="1" data-thumb="assets/img/slider/'.urlencode($filename).'">';
						echo '<img src="assets/img/slider/'.urlencode($filename).'">';
					echo '</li>';
				}
			?>
            </ul>
        </div>
        <!-- END SLIDER -->
    </section>
    <!-- END HEADER -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/assets/js/modernizr.custom.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="/assets/js/soon/plugins.js"></script>
    <script src="/assets/js/soon/jquery.themepunch.revolution.min.js"></script>
    <script src="/assets/js/soon/custom.js"></script>
    
  </body>
  <!-- END BODY -->
</html>
