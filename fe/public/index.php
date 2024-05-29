<?php
$url = 'https://uat.practiceapi.doubtbuddy.com/question';
$options = array(
    'http' => array(
        'method' => 'GET',
        'header' => 'Content-Type: application/json'
    )
);
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$questions = json_decode($response, true);

$totalQuestions = count($questions);
$questionsPerPage = 10;
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>DoubtBuddy-Question</title>
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
    white-space: wrap !important;
    line-height: 0.7 !important;
    word-spacing: 1em !important;
  }
  mjx-assistive-mml math{
    display: none !important;
    white-space: wrap !important;
  }

</style>
</head>

<body class="is-preload" >

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

        <!-- Banner -->
        <section id="banner" class="d-flex justify-content-between">
          <div class="content">
            <header>
              <h1>Hi, I’m DoubtBuddy<br />
                Your Best Study
                Buddy</h1>
              <p>Solve your doubts instantly & available 24/7</p>
            </header>
            <p>DoubtBuddy is an excellent educational platform offering personalized assistance for
              students. Its user-friendly
              interface and vast repository of resources make learning engaging and efficient. With expert
              tutors available 24/7,
              students receive timely help, ensuring they grasp concepts thoroughly and excel
              academically. Perfect for homework help
              and exam preparation!</p>

            <a class="" href="https://play.google.com/store/apps/details?id=com.doubtbuddy.student&amp;pli=1"
              target="_blank" rel="noopener noreferrer"><img class="play-store-btn" src="images/playstore.png"
                alt=""></a>

          </div>
          <span class="image object d-flex justify-content-end">
            <img src="images/dbboy.png" alt="" />
          </span>
        </section>

        <!-- Section -->
        <section>
          <header class="major">
            <h2>Questions</h2>
          </header>
          <div id="questions" class="posts">
            <!-- <?php 
            // if (is_array($questions) && !empty($questions)) {
            //   foreach ($questions as $question) {
            //     $question_id = $question['_id'];
            //     echo "<article id=".$pageNo." style=".$display.">
            //             <h3>{$question['chapter']['name']}</h3>
            //             <p>\({$question['description']['value']}\)</p>
                        
            //             <ul class='actions'>
            //               <li><a href='details.php?id={$question_id}' class='button'>View Solution</a></li>
            //             </ul>
            //           </article>";
            //   }
            // } else {
            //   echo "<p>No questions available at the moment.</p>";
            // }
            ?>  -->
            
            </div>
        </section>

        <section class="py-2">
          <div class="text-center">
            <button onclick="loadMore()" id="load-more">Load More</button>
          </div>
        </section>

        <!-- Section -->
        <section>
          <header class="major">
            <h2>Key Features</h2>
          </header>
          <div class="features">
            <article>
              <!-- <span class="icon fa-gem"></span> -->
              <span class="icon"><img class="" src="images/feature-1.png" alt="" style="width:50%"></span>
              <div class="content">
                <h3>Solve your Doubts Instantly</h3>
                <p>Solve your doubts instantly with DoubtBuddy, where expert tutors and comprehensive
                  resources provide immediate,
                  effective assistance anytime you need.</p>
              </div>
            </article>
            <article>
              <span class="icon"><img class="" src="images/feature-2.png" alt="" style="width:50%"></span>
              <div class="content">
                <h3>Now Practice based on your Aptitude</h3>
                <p>Practice based on your aptitude with DoubtBuddy, offering tailored exercises and
                  quizzes that match your skill level for
                  optimal learning.</p>
              </div>
            </article>
            <article>
              <span class="icon"><img class="" src="images/feature-3.png" alt="" style="width:50%"></span>
              <div class="content">
                <h3>AI Buddy Examine your Solution</h3>
                <p>AI Buddy examines your solutions, providing instant feedback and detailed
                  explanations, ensuring you understand and
                  correct mistakes effectively.</p>
              </div>
            </article>
            <article>
              <span class="icon"><img class="" src="images/feature-4.png" alt="" style="width:50%"></span>
              <div class="content">
                <h3>Get Daily Performance Reporting</h3>
                <p>Receive daily performance reports with DoubtBuddy, offering insights into your
                  progress and highlighting areas for
                  improvement to enhance your lear</p>
              </div>
            </article>
          </div>
        </section>

      <!-- Section -->
								<section>
                  <div class="d-flex foot-cont-details">
                  
                    <div class="w-100" style="margin-right:5em">
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
      </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
    let questions = <?php echo json_encode($questions); ?>;
    let totalQuestions = <?php echo $totalQuestions; ?>;
    let questionsPerPage = <?php echo $questionsPerPage; ?>;
    let currentPage = 0;

    function loadQuestions() {
      let start = currentPage * questionsPerPage;
      let end = start + questionsPerPage;
      let questionsToShow = questions.slice(start, end);

      let questionsContainer = document.getElementById('questions');
      questionsToShow.forEach(question => {
        let questionHTML = `
          <article>
            <h3>${question.chapter.name}</h3>
            <p>\\(${question.description.value}\\)</p>
            <ul class='actions'>
              <li><a href='details.php?slug=${question.slug}' class='button'>View Solution</a></li>
            </ul>
          </article>
        `;
        questionsContainer.insertAdjacentHTML('beforeend', questionHTML);
      });
      
      MathJax.typeset();
      
      if (end >= totalQuestions) {
        document.getElementById('load-more').style.display = 'none';
      }
    }

    function loadMore() {
      currentPage++;
      loadQuestions();
    }

    loadQuestions();
  </script>

</body>

</html>