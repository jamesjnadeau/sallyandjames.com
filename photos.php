<!doctype html>
<html>
    <head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/colorbox.css">
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.3/jquery.colorbox-min.js"></script>
    </head>
    <body >
		<ul>
			<?php
			$files = array_reverse(glob($_SERVER['DOCUMENT_ROOT'].'/assets/img/slider/*.{jpg,JPG}', GLOB_BRACE));
			foreach($files as $index => $file) {
				$filename = array_pop(explode('/', $file));
				echo '<li><a class="gallery" href="/assets/img/slider/'.urlencode($filename).'">'.$filename.'</a></li>';
			}
			?>
		</ul>
        <script>
            $('a.gallery').colorbox({ 
				width:"90%",
				height:"90%",
				transition:"fade",
				open: true,
				rel:'gallery',
				trapFocus: true,
				overlayClose: false,
				closeButton: false,
				//slideshow: true
			});
        </script>
    </body>
</html>