<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Contact with Map Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	 <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    
	<!--
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	-->
	
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>RSVP <small class="pull-right"> Will you join us for our celebration?</small></h1>
</div>

<!-- Contact with Map - START -->
<div class="container">
    <div class="row">
        <?php 
		if(isset($_REQUEST['rsvp_code'])) 
			echo '<div class="col-md-6">';
		else
			echo '<div class="col-md-12">';
		?>
            <div class="well well-sm">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <?php 
							if(!isset($_REQUEST['rsvp_code'])) { ?>
									<legend class="text-center header">Have your code?</legend>
									<div class="form-group">
										<div class="col-md-10 col-md-offset-1">
											<label for="rsvp_code">RSVP Code</label>
											<input id="rsvp_code" name="rsvp_code" type="text" placeholder="RSVP Code" class="form-control">
										</div>
									</div>
								<div class="form-group">
									<div class="col-md-12 text-center">
										<button type="submit" class="btn btn-primary btn-lg">Submit</button>
									</div>
								</div>
								<?php 
							} else { 
								require $_SERVER['DOCUMENT_ROOT'].'/admin/spreadsheet.php';
								$row = find_by_rsvp_code($_REQUEST['rsvp_code']);
								//echo '<pre>'.print_r($row['values'], true).'</pre>';
						?>
								<legend class="text-center header">Hi!</legend>
								<div class="form-group">
									<div class="col-md-10 col-md-offset-1">
										<label for="first_guest">First Guest</label>
										<input id="first_guest" name="guest1" type="text" placeholder="First Guest" class="form-control" value="<?php echo $row['values']['guest1']?>" >
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-10 col-md-offset-1">
										<label for="second_guest">Second Guest</label>
										<input id="second_guest" name="guest2" type="text" placeholder="Second Guest" class="form-control" value="<?php echo $row['values']['guest2']?>" >
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-10 col-md-offset-1">
										<label for="email">Email</label>
										<input id="email" name="email" type="text" placeholder="Email Address" class="form-control" value="<?php echo $row['values']['email']?>" >
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-12 text-center">
										<input type="hidden" name="rsvp_code" value="<?php echo $_REQUEST['rsvp_code']; ?>" />
										<button type="submit" class="btn btn-primary btn-lg">Submit</button>
									</div>
								</div>
                        <?php } ?>
                    </fieldset>
                </form>
            </div>
        </div>
		<?php 
		if(isset($_REQUEST['rsvp_code'])) { ?>
			<div class="col-md-6">
				<div>
					<div class="panel panel-default">
						<div class="text-center header">ECHO Lake Aquarium and Science Center</div>
						<div class="panel-body text-center">
							<h4>Address</h4>
							<div>
							ECHO Lake Aquarium and Science Center<br />
							1 College St<br />
							Burlington, VT 05401<br />
							<!-- #(703) 1234 1234<br />
							service@company.com<br /> -->
							</div>
							<hr />
							<div id="map1" class="map">
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php 
		} ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/assets/js/modernizr.custom.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
    jQuery(function ($) {
        function init_map1() {
            var myLocation = new google.maps.LatLng(44.4766032, -73.2209637);
            var mapOptions = {
                center: myLocation,
                zoom: 16
            };
            var marker = new google.maps.Marker({
                position: myLocation,
                title: "ECHO Lake Aquarium and Science Center"
            });
            var map = new google.maps.Map(document.getElementById("map1"),
                mapOptions);
            marker.setMap(map);
        }
        init_map1();
    });
</script>

<style>
    .map {
        min-width: 300px;
        min-height: 300px;
        width: 100%;
        height: 100%;
    }

    .header {
        background-color: #F5F5F5;
        color: #36A0FF;
        height: 70px;
        font-size: 27px;
        padding: 10px;
    }
</style>

<!-- Contact with Map - END -->

</div>

</body>
</html>