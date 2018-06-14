<?php
//$q="https://www.facebook.com/940863846094937/videos/940927409421914/";
function getBetween($content,$start,$end){
	$r = explode($start, $content);
	if (isset($r[1])){
		$r = explode($end, $r[1]);
		return $r[0];
	}
	return '';
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Facebook Video Downloader">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Facebook Video Downloader - Nhatkythuthuat.com</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/cover/cover.css" rel="stylesheet">
    <style type="text/css">
    	.video{
    		max-width: 450px;
    		width: 100%;
    	}
    </style>
  </head>

  <body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto text-center">
          <h3><a href="https://nhatkythuthuat.com">Nhatkythuthuat.com</a></h3>
      </header>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Facebook Video Downloader</h1>
       <form action="index.php" method="post" novalidate class="py-2">
			<span class="fa fa-video-camera" aria-hidden="true"></span>
			<input type="text" name="video" size="50" placeholder="Enter video link here..." />
			<input type="submit" value="Get video" />				
		</form>
        <?php 
			if (isset($_POST["video"])) {
				$ch = curl_init($_POST["video"]);
				curl_setopt( $ch, CURLOPT_POST, false );
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
				curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U;   Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
				curl_setopt( $ch, CURLOPT_HEADER, false );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				$data = curl_exec( $ch );
				curl_close($ch );
				$html_encoded = htmlentities($data);

				if (stripos($data,"hd_src_no_ratelimit:")!=false && stripos($data, "aspect_ratio")!=false) {
					$start = "hd_src_no_ratelimit:";
					$end = ",aspect_ratio";
					$videoHD = getBetween($data,$start,$end);
				} else {
					$videoHD = "";
				}

				if (stripos($data,"sd_src_no_ratelimit:")!=false && stripos($data, "aspect_ratio")!=false) {
					$start = "sd_src_no_ratelimit:";
					$end = ",aspect_ratio";
					$videoSD = getBetween($data,$start,$end);
				} else {
					$videoSD = "";
				}
				
			?>
			<div class="row">
				<div class="col-md-6">
					<h3>Video HD</h3>
					<video class="video" controls class="mb-2">
		              <source src=<?=$videoHD?> type="video/mp4">
		              Your browser does not support HTML5 video.
		            </video>
	        	</div>
	        	<div class="col-md-6">
	        		<h3>Video SD</h3>
		            <video class="video" controls class="mb-2">
		              <source src=<?=$videoSD?> type="video/mp4">
		              Your browser does not support HTML5 video.
		            </video>
	        	</div>
	        </div>

			<?php
				}
			?>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
        </div>
      </footer>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>


			