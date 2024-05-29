<?php
if (isset($_GET['id'])) {
    $question_id = $_GET['id'];
   
    // Fetch main question details
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://prodapi.doubtbuddy.com/question/{$question_id}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $question = json_decode($response, true);

    // Fetch similar questions
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://prodapi.doubtbuddy.com/question/similar/{$question_id}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $sim_questions = json_decode($response, true);
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>DoubtBuddy-details</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/terms_policy.css" />
	<link rel="icon" href="images/favicon.png" type="image/png" />

	<!-- Open Graph Meta Tags -->
    <meta property="og:title" content="DoubtBuddy-Question" />
    <meta property="og:description" content="Collection of DoubtBuddy questions" />
    <meta property="og:image" content="images/db-logo2.png" />
    <meta property="og:url" content="https://doubtbuddy-question.web.app/" />
    <meta property="og:type" content="website" />

	<!-- Include MathJax -->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<style>
  mjx-math {
    white-space:wrap !important;
    line-height:0.7 !important;
  }
  mjx-assistive-mml math{
    display: none !important;
    white-space: wrap !important;
  }
</style>
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<div id="main">
			<div class="inner">

				<!-- Header -->
				<header id="header">
					<a href="index.php" class="logo d-flex align-items-center"><img src="images/db-logo2.png" alt=""
							style="width:25px">
						<h2 class="mb-0 ms-2">DoubtBuddy</h2>
					</a>
					<ul class="icons">
						<li><a href="https://twitter.com/doubtbuddy" target="_blank" rel="noreferrer"
								class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://m.facebook.com/doubtbuddy" target="_blank" rel="noreferrer"
								class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com/doubtbuddyapp/" target="_blank" rel="noreferrer"
								class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
					</ul>
				</header>

				<!-- Content -->

				<?php if($question['type']==="SC"){ ?>
				<section>
					<header class="main">
						<?php if (!empty($question)) { ?>
							<h3>Question : <?php echo htmlspecialchars($question['chapter']['name']); ?></h3>
              				<p>\(<?php echo $question['description']['value']; ?>\)</p>
            			<?php } 
						else { ?>
              				<p>Question not available.</p>
            			<?php } ?>
					</header>

					<h3>Solution :</h3>
					<?php if (!empty($question)) { ?>
						<p>\(<?php echo $question['solution']['description']; ?>\)</p>
            		<?php } else { ?>
              			<p>Solution not available.</p>
            		<?php } ?>

					<h3>Answer :</h3>
					<?php if (!empty($question)) { ?>
              			<p><?php echo htmlspecialchars($question['answer']); ?></p>
            		<?php } else { ?>
              			<p>Answer not available.</p>
            		<?php } ?>

					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<pre><code>
i = 0;
while (!deck.isInOrder()) {
  print 'Iteration ' + i;
  deck.shuffle();
  i++;
}
print 'It took ' + i + ' iterations to sort the deck.';

</code></pre>
					</div>
				</section>

				<?php } else if($question['type']==="Subjective") { ?>
					<section>
					<header class="main">
						<?php if (!empty($question)) { ?>
							<h3>Question : <?php echo htmlspecialchars($question['chapter']['name']); ?></h3>
              				<p>\(<?php echo $question['description']['value']; ?>\)</p>
            			<?php } 
						else { ?>
              				<p>Question not available.</p>
            			<?php } ?>
					</header>

					<h3>Solution :</h3>
					<?php if (!empty($question)) { ?>
						<p>\(<?php echo $question['solution']['description']; ?>\)</p>
            		<?php } else { ?>
              			<p>Solution not available.</p>
            		<?php } ?>

					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<pre><code>
i = 0;
while (!deck.isInOrder()) {
  print 'Iteration ' + i;
  deck.shuffle();
  i++;
}
print 'It took ' + i + ' iterations to sort the deck.';

</code></pre>
					</div>
				</section>

				<?php } else if($question['type']==="True False") { ?>
					<section>
					<header class="main">
						<?php if (!empty($question)) { ?>
							<h3>Question : <?php echo htmlspecialchars($question['chapter']['name']); ?></h3>
              				<p>\(<?php echo $question['description']['value']; ?>\)</p>
							<p>Assertion: \(<?php echo $question['description']['assertion']['value']; ?>\)</p>
							<p>Reason : \(<?php echo $question['description']['reason']['value']; ?>\)</p>
            			<?php } 
						else { ?>
              				<p>Question not available.</p>
            			<?php } ?>
					</header>

					<h3>Solution :</h3>
					<?php if (!empty($question)) { ?>
						<p>\(<?php echo $question['solution']['description']; ?>\)</p>
            		<?php } else { ?>
              			<p>Solution not available.</p>
            		<?php } ?>

					<h3>Answer :</h3>
					<?php if (!empty($question)) { ?>
              			<p><?php echo htmlspecialchars($question['answer']); ?></p>
            		<?php } else { ?>
              			<p>Answer not available.</p>
            		<?php } ?>

					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<pre><code>
i = 0;
while (!deck.isInOrder()) {
  print 'Iteration ' + i;
  deck.shuffle();
  i++;
}
print 'It took ' + i + ' iterations to sort the deck.';

</code></pre>
					</div>
				</section>

				<?php } else { ?>
					<p>Another type</p>
				<?php } ?>

					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
						<a href="#">
							<picture>
								<source srcset="https://search-static.byjusweb.com/assets/btla_QnA_Web.webp"
									min-height="140" width="100%">
								<img src="https://search-static.byjusweb.com/assets/btla_QnA_mWeb.webp" alt="Top Banner"
									height="140" width="140">
							</picture>
						</a>
					</div>

					<hr class="major" />

					<header class="major">
						<h2>SIMILAR QUESTIONS</h2>
					</header>
					<div class="posts">
						
            		<?php 
                        if (is_array($sim_questions) && !empty($sim_questions)) {
                            foreach ($sim_questions as $sim_question) {
                                $sim_question_id = $sim_question['_id'];
                                echo "<article>
                                    <h3>{$sim_question['chapter']['name']}</h3>
                                    <p>\({$sim_question['description']['value']}\)</p>
                                    <ul class='actions'>
                                        <li><a href='details.php?id={$sim_question_id}' class='button'>View Solution</a></li>
                                    </ul>
                                </article>";
                            }
                        } else {
                            echo "<p>No similar questions available at the moment.</p>";
                        }
                    ?>
					</div>

				<!-- Section -->
				<section>
                  <div class="d-flex foot-cont-details">
                	<div class="w-100 me-5">
						<header class="major">
							<h2 class="mb-4">Get in touch</h2>
						</header>
						<p style="text-align:justify">DoubtBuddy is the ultimate Doubt-Solving app where students can solve their doubts instantly. We cater to all the different subjects including Physics, Maths, Biology for JEE/NEET Aspirants or any other subject covered by the NCERT. We also provide preparation guides/strategies for any number of competitive exams such as IIT, NIT, IIIT,DTU, DU, AIIMS and many another Government engineering/medical colleges.</p>
                  	</div>

                    <div class="w-100">
                    	<header class="major">
							<h2 class="mb-4">Contact Details</h2>
						</header>
						<ul class="contact">
							<li class="icon solid fa-envelope"><a href="#">community@doubtbuddy.in</a></li>
							<li class="icon solid fa-phone">support@doubtbuddy.com</li>
							<li class="icon solid fa-home">M3M Cosmopolitian, Sector 66 Golf Course Extension Road Gurgaon</li>
                      		<li>
								<!-- <a href="#Contact">Contact</a> -->
                        		<a class="me-4" href="policy.php" target="_blank" rel="noreferrer">Policy</a>
                        		<a href="terms.php" target="_blank" rel="noreferrer">Terms</a>
                      		</li>
						</ul>
                  	</div>
                  </div>
				</section>

				<!-- Footer -->
              	<section class="py-2">
					<footer id="footer" class="text-center">
						<p class="copyright my-0">&copy; DoubtBuddy. All rights reserved. </a>. Website: <a href="https://doubtbuddy.com">DoubtBuddy</a>.</p>
					</footer>
              	</section>
			</div>

			<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>

</html>