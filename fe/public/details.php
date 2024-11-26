<?php

include("env.php");

if (isset($_GET['slug'])) {
    $question_slug = $_GET['slug'];

    // Fetch main question details
    $url = $baseUrl."question/" . $question_slug;
    $options = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'Content-Type: application/json'
        )
    );
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $question = json_decode($response, true);
    
    // Fetch similar questions
    $urls = $baseUrl."question/similar/" . $question_slug;
    $response = file_get_contents($urls, false, $context);
    $sim_questions = json_decode($response, true);
} else {
    header('Location: index.php');
    exit();
}
?>

<?php
// Fetch advertisement
// $url = 'https://uat.practiceapi.doubtbuddy.com/advertisement';
$url = 'https://prodapi.doubtbuddy.com/advertisement';
$options = array(
    'http' => array(
        'method' => 'GET',
        'header' => 'Content-Type: application/json'
    )
);
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$advertise = json_decode($response, true);

$imageUrl = $advertise[0]['imageUrl'];
$linkUrl = $advertise[0]['linkUrl'];
$advertiseType = $advertise[0]['type'];
?>

<?php function replaceSingleDollarSigns($text) {
    // return str_replace('$', '$$', $text);
    return preg_replace('/(?<!\$)\$(?!\$)/', '$$', $text);
} 

$question_opt = $question['options'];
$question_ans = $question['answer'];
$question_img = $question['description']['image'];
$solution_img = $question['solution']['image'];
$correctAnswers = explode(',', $question['answer']);
// $answersString = trim($question['answer']);
// $correctAnswers = array_filter(array_map('trim', explode(',', $answersString)));
// var_dump($question_ans);

?>
<?php
    $question_opt_a = $question['options']['a']['value'];
    $question_option_a = replaceSingleDollarSigns($question_opt_a);

    $question_opt_b = $question['options']['b']['value'];
    $question_option_b = replaceSingleDollarSigns($question_opt_b);

    $question_opt_c = $question['options']['c']['value'];
    $question_option_c = replaceSingleDollarSigns($question_opt_c);

    $question_opt_d = $question['options']['d']['value'];
    $question_option_d = replaceSingleDollarSigns($question_opt_d);
?>

<!-- <?php echo "<script>console.log('".$imageUrl."');</script>"; ?> -->
<!-- <?php echo "<script>console.log('".$linkUrl."');</script>"; ?> -->


<!DOCTYPE HTML>
<html>

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-497CNZ1NQJ"></script>
   <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-497CNZ1NQJ');
   </script>
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
    <meta property="og:url" content="https://doubtbuddy.com/question/" />
    <meta property="og:type" content="website" />

    <!-- Include MathJax -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>


    <style>
        mjx-math {
            white-space: wrap !important;
            display:inline !important;
        }
        
        mjx-container[jax="CHTML"][display="true"] {
            display: inline !important;
            /* line-height:2 !important; */
        }

        .correct-ans{
            position:absolute;
            top:-12px;
            right:3%;
            background-color:white;
            color:#68C721;
            padding:0 5px;
            display:none;
        }
        .f-14{
            font-size:14px;
        }
        .f-12{
            font-size:12px;
        }
        .f-w-5{
            font-weight:500;
        }
        .f-w-6{
            font-weight:600;
        }
        .them-color{
            color:#2454DD;
        }
        .option-div{
            width:500px;
            font-size:14px;
        }
        .option{
            display:flex;
            align-items:center;
            position:relative;
            margin:15px 0;
            padding:15px; 
            border-radius:5px; 
            gap:15px;
        }
        .option .choice{
            background-color: #F3F3F3; 
            width:30px; 
            height:30px;
            padding:10px; 
            border-radius:20px;
            /* text-align:center; */
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .solution-div{
            background-color:#F1F4FD; 
            padding:15px; 
            border-radius:5px;
            width:500px;
            margin-bottom:25px;
        }
        /* .helpful-div{
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:15px;
            width:500px;
        }
        .helpful-div .yes{
            color:#68C721; 
            border:1px solid #68C721; 
            padding:7px; 
            border-radius:20px; 
            cursor:pointer;
        }
        .helpful-div .no{
            color:#EF426F; 
            border:1px solid #EF426F; 
            padding:7px; 
            border-radius:20px; 
            cursor:pointer;
        } */
        .type{
            display:flex;
            align-items:center;
            justify-content:space-between;
            width:100%;
        }
        .question-det{
            font-size:16px;
        }
        .solution-det{
            font-size:14px;
        }
        .type-head{
            font-size:16px;
        }
        .solution-head{
            font-size:14px;
        }
        .chapter-head{
            font-weight:600; 
            font-size:16px;
        }
        
        @media screen and (max-width: 736px) {
            .contact{
                font-size:14px;
            }
            .option-div{
                width:100%;
                font-size:12px;
            }
            .option .choice{
                padding:15px;
                width:25px;
                height:25px;
            }
            .solution-div{
                width:100%;
            }
            .helpful-div{
                width:100%;
            }
            .type{
                width:100%;
            }
            .question-det{
                font-size:14px;
            }
            .solution-det{
                font-size:12px;
            }
            .type-head{
                font-size:14px;
            }
            .solution-head{
                font-size:12px;
            }
            .chapter-head{
                font-size:14px;
            }
            .question-des{
                font-size:14px;
            }
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
                <a href="https://doubtbuddy.com/question" class="logo d-flex align-items-center"><img src="images/db-logo2.png" alt=""
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

            <?php if ($question['type'] === "Single Choice") { ?>
                <section>
                    <div class="type"><h3 class="type-head" style="color:#666666;">Single Choice</h3><h3><img src="images/type.png" alt=""></h3></div>
                    <?php if ($question_img) { ?>
                        <img src="<?php echo htmlspecialchars($question_img); ?>" alt="" width="50%">
                    <?php } ?>
                    <?php
                        $question_desc = $question['description']['value'];
                        $question_description = replaceSingleDollarSigns($question_desc);
                    ?>

                    <p class="question-det f-w-5"><?php echo $question_description ?></p>

                    <?php if ($question_opt) { ?>
                        <!-- <h3>Options : </h3> -->
                        <div class="option-div">
                        <div class="option" style="border:1px solid <?php
                            echo $question['answer'] == 1 ? '#68C721' : '#F3F3F3';
                            ?>; "><span class="choice">A</span><span><?php echo $question_option_a ?></span>
                            <div class="correct-ans" style="display:<?php
                            echo $question['answer'] == 1 ? 'block' : 'none';
                            ?>;">Correct Answer</div>
                            </div>
                            
                        <div class="option" style="border:1px solid <?php
                            echo $question['answer'] == 2 ? '#68C721' : '#F3F3F3';
                            ?>; "><span class="choice">B</span><span class=""><?php echo $question_option_b ?></span>
                            <div class="correct-ans" style="display:<?php
                            echo $question['answer'] == 2 ? 'block' : 'none';
                            ?>;">Correct Answer</div>
                            </div>

                        <div class="option" style="border:1px solid <?php
                            echo $question['answer'] == 3 ? '#68C721' : '#F3F3F3';
                            ?>; "><span class="choice">C</span><span class=""><?php echo $question_option_c ?></span>
                            <div class="correct-ans" style="display:<?php
                            echo $question['answer'] == 3 ? 'block' : 'none';
                            ?>;">Correct Answer</div>
                            </div>

                        <div class="option" style="border:1px solid <?php
                            echo $question['answer'] == 4 ? '#68C721' : '#F3F3F3';
                            ?>; "><span class="choice">D</span><span><?php echo $question_option_d ?></span>
                            <div class="correct-ans" style="display:<?php
                            echo $question['answer'] == 4 ? 'block' : 'none';
                            ?>;">Correct Answer</div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <p></p>
                    <?php } ?>

                    <div class="solution-div">
                        <h3 class="solution-head them-color">Solution</h3>
                        <?php
                            $question_solution = $question['solution']['description'];
                            $solution_description = replaceSingleDollarSigns($question_solution);
                        ?>
                        <?php if ($solution_img) { ?>
                            <img src="<?php echo htmlspecialchars($solution_img); ?>" alt="">
                        <?php } ?>
                        <p class="solution-det mb-0"><?php echo $solution_description; ?></p>
                    </div>

                    <!-- <div class="helpful-div"><span style="font-weight:600;">Was this helpful?</span> <div class="d-flex" ><span class="yes me-4 d-flex align-items-center"><img class="me-1" src="images/yes.png" alt=""> Yes</span> <span class="no d-flex align-items-center"><img class="me-1" src="images/no.png" alt=""> No</span></div></div> -->

                </section>

            <?php } else if ($question['type'] === "Multiple Choice") { ?>
                <section>
                    <div class="type"><h3 class="type-head" style="color:#666666;">Multiple Choice</h3><h3><img src="images/type.png" alt=""></h3></div>
                    <?php if ($question_img) { ?>
                        <img src="<?php echo htmlspecialchars($question_img); ?>" alt="" width="50%">
                    <?php } ?>
                     <?php
                        $question_desc = $question['description']['value'];
                        $question_description = replaceSingleDollarSigns($question_desc);
                    ?>

                    <p class="question-det f-w-5"><?php echo $question_description ?></p>

                    <?php $correctAnswers = explode(',', $question['answer']); ?>

                    <?php if ($question_opt) { ?>
                        <!-- <h3>Options : </h3> -->
                        <div class="option-div f-12">
                            <div class="option" style="border:1px solid <?php
                                echo in_array(1, $correctAnswers) ? '#68C721' : '#F3F3F3';
                                ?>;"><span class="choice">A</span><span><?php echo $question_option_a ?></span>
                                <div class="correct-ans" style="display:<?php
                                echo in_array(1, $correctAnswers) ? 'block' : 'none';
                                ?>;">Correct Answer</div>
                            </div>
                            
                            <div class="option" style="border:1px solid <?php
                                echo in_array(2, $correctAnswers) ? '#68C721' : '#F3F3F3';
                                ?>;"><span class="choice">B</span><span><?php echo $question_option_b ?></span>
                                <div class="correct-ans" style="display:<?php
                                echo in_array(2, $correctAnswers) ? 'block' : 'none';
                                ?>;">Correct Answer</div>
                            </div>

                            <div class="option" style="border:1px solid <?php
                                echo in_array(3, $correctAnswers) ? '#68C721' : '#F3F3F3';
                                ?>;"><span class="choice">C</span><span><?php echo $question_option_c ?></span>
                                <div class="correct-ans" style="display:<?php
                                echo in_array(3, $correctAnswers) ? 'block' : 'none';
                                ?>;">Correct Answer</div>
                            </div>

                            <div class="option" style="border:1px solid <?php
                                echo in_array(4, $correctAnswers) ? '#68C721' : '#F3F3F3';
                                ?>;"><span class="choice">D</span><span><?php echo $question_option_d ?></span>
                                <div class="correct-ans" style="display:<?php
                                echo in_array(4, $correctAnswers) ? 'block' : 'none';
                                ?>;">Correct Answer</div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <p></p>
                    <?php } ?>

                    <div class="solution-div">
                        <h3 class="solution-head them-color">Solution</h3>
                        <?php
                            $question_solution = $question['solution']['description'];
                            $solution_description = replaceSingleDollarSigns($question_solution);
                        ?>
                        <?php if ($solution_img) { ?>
                            <img src="<?php echo htmlspecialchars($solution_img); ?>" alt="">
                        <?php } ?>
                        <p class="mb-0" solution-det><?php echo $solution_description; ?></p>
                    </div>
                    <!-- <div class="helpful-div"><span style="font-weight:600;">Was this helpful?</span> <div class="d-flex" ><span class="yes me-4 d-flex align-items-center"><img class="me-1" src="images/yes.png" alt=""> Yes</span> <span class="no d-flex align-items-center"><img class="me-1" src="images/no.png" alt=""> No</span></div></div> -->
                </section>

            <?php } else if ($question['type'] === "Subjective") { ?>
                <section>
                    <div class="type"><h3 class="type-head" style="color:#666666;">Subjective Type</h3><h3><img src="images/type.png" alt=""></h3></div>
                    <?php if ($question_img) { ?>
                        <img src="<?php echo htmlspecialchars($question_img); ?>" alt="" width="50%">
                    <?php } ?>
                     <?php
                        $question_desc = $question['description']['value'];
                        $question_description = replaceSingleDollarSigns($question_desc);
                    ?>

                    <p class="question-det f-w-5"><?php echo $question_description ?></p>
                    
                    <div class="solution-div">
                        <h3 class="solution-head them-color">Solution</h3>
                        <?php
                            $question_solution = $question['solution']['description'];
                            $solution_description = replaceSingleDollarSigns($question_solution);
                        ?>
                        <?php if ($solution_img) { ?>
                            <img src="<?php echo htmlspecialchars($solution_img); ?>" alt="">
                        <?php } ?>

                        <p class="mb-0" solution-det><?php echo $solution_description; ?></p>
                    </div>
                    <!-- <div class="helpful-div"><span style="font-weight:600;">Was this helpful?</span> <div class="d-flex" ><span class="yes me-4 d-flex align-items-center"><img class="me-1" src="images/yes.png" alt=""> Yes</span> <span class="no d-flex align-items-center"><img class="me-1" src="images/no.png" alt=""> No</span></div></div> -->
                </section>

            <?php } else if ($question['type'] === "True False") { ?>
                <section>
                    <div class="type"><h3 class="type-head" style="color:#666666;">True / False</h3><h3><img src="images/type.png" alt=""></h3></div>
                    <?php if ($question_img) { ?>
                        <img src="<?php echo htmlspecialchars($question_img); ?>" alt="" width="50%">
                    <?php } ?>
                    <?php
                        $question_desc = $question['description']['value'];
                        $question_description = replaceSingleDollarSigns($question_desc);
                    ?>

                    <p class="question-det f-w-5"><?php echo $question_description ?></p>

                    <?php if ($question_opt) { ?>
                        <!-- <h3>Options : </h3> -->
                        <div class="option-div f-12">
                            <div class="option" style="border:1px solid <?php
                                echo $question['answer'] == 1 ? '#68C721' : '#F3F3F3';
                                ?>; "><span class="choice">A</span><span><?php echo $question_option_a ?></span>
                                <div class="correct-ans" style="display:<?php
                                echo $question['answer'] == 1 ? 'block' : 'none';
                                ?>;">Correct Answer</div>
                            </div>

                            <div class="option" style="border:1px solid <?php
                                echo $question['answer'] == 2 ? '#68C721' : '#F3F3F3';
                                ?>; "><span class="choice">B</span><span><?php echo $question_option_b ?></span>
                                <div class="correct-ans" style="display:<?php
                                echo $question['answer'] == 2 ? 'block' : 'none';
                                ?>;">Correct Answer</div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <p></p>
                    <?php } ?>

                    <div class="solution-div">
                        <h3 class="solution-head them-color">Solution</h3>
                        <?php
                            $question_solution = $question['solution']['description'];
                            $solution_description = replaceSingleDollarSigns($question_solution);
                        ?>
                        <?php if ($solution_img) { ?>
                            <img src="<?php echo htmlspecialchars($solution_img); ?>" alt="">
                        <?php } ?>
                        <p class="mb-0 solution-det"><?php echo $solution_description; ?></p>
                    </div>
                    <!-- <div class="helpful-div"><span style="font-weight:600;">Was this helpful?</span> <div class="d-flex" ><span class="yes me-4 d-flex align-items-center"><img class="me-1" src="images/yes.png" alt=""> Yes</span> <span class="no d-flex align-items-center"><img class="me-1" src="images/no.png" alt=""> No</span></div></div> -->
                </section>

            <?php } else { ?>
                <p></p>
            <?php } ?>

            <!-- Advertise area -->
            <?php if ($advertise) { ?>
                <?php if ($advertiseType == "image") { ?>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="<?php echo $linkUrl; ?>" target="_blank">
                            <picture>
                                <!-- <source srcset="<?php echo $imageUrl; ?>" min-height="140px" width="100%"> -->
                                <img src="<?php echo $imageUrl; ?>" alt="" height="20%" width="100%">
                            </picture>
                        </a>
                    </div>
                <?php } else if ($advertiseType == "video") { ?>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="<?php echo $linkUrl; ?>">
                            <video width="50%" controls>
                                <source src="<?php echo $imageUrl; ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                    </div>
                <?php } else { ?>
                    <!-- <p></p> -->
                <?php } ?>

            <?php } else { ?>
                <!-- <p></p> -->
            <?php } ?>

            <hr class="major" />
            <?php
            // if (is_array($sim_questions) && !empty($sim_questions)) {
            //     echo "<header class='major'>
            //         <h2>SIMILAR QUESTIONS</h2>
            //     </header>";
            // } 
            ?>
            <header class='major'>
                <h2>SIMILAR QUESTIONS</h2>
            </header>

            <div class="posts">
                <?php
                if (is_array($sim_questions) && !empty($sim_questions)) {
                    foreach ($sim_questions as $sim_question) {
                        $sim_question_desc = $sim_question['description']['value'];
                        $sim_question_description = replaceSingleDollarSigns($sim_question_desc);
                        $sim_question_slug = $sim_question['slug'];
                        echo "<article>
                                    <h3 class='chapter-head'>{$sim_question['chapter']['name']}</h3>
                                    <p class='question-des'>{$sim_question_description}</p>
                                    <ul class='actions'>
                                        <li><a href='${sim_question_slug}' class='button'>View Solution</a></li>
                                    </ul>
                                </article>";
                    }
                } else {
                    // echo "<p></p>";
                }
                ?>
            </div>

            <!-- Footer -->
            <section>
                <div class="d-flex foot-cont-details">
                    <!-- <div class="w-100" style="margin-right:5em">
                        <header class="major">
                            <h2 class="mb-4">Get in touch</h2>
                        </header>
                        <p style="text-align:justify">DoubtBuddy is the ultimate Doubt-Solving app where students can solve their doubts instantly. We cater to all the different subjects including Physics, Maths, Biology for JEE/NEET Aspirants or any other subject covered by the NCERT. We also provide preparation guides/strategies for any number of competitive exams such as IIT, NIT, IIIT,DTU, DU, AIIMS and many another Government engineering/medical colleges.</p>
                    </div> -->

                    <div class="">
                        <header class="major">
                            <h2 class="mb-4">Contact Details</h2>
                        </header>
                        <ul class="contact">
						    <li class="icon solid fa-envelope"><a href="mailto:community@doubtbuddy.in">community@doubtbuddy.in</a></li>
						    <!-- <li class="icon solid fa-phone"><a href="tel:9897940807">+91 9897940807</a></li> -->
						    <li class="icon solid fa-home">M3M Cosmopolitian, Sector 66, Golf Course Extension Road, Gurgaon</li>
                            <li class="ps-0">
                                <a class="me-4 ms-1" href="https://doubtbuddy.com/privacy-policy" target="_blank" rel="noreferrer">Policy</a>
                                <a href="https://doubtbuddy.com/tnc" target="_blank" rel="noreferrer">Terms</a>
                            </li>
					    </ul>     
                    </div>
                </div>
            </section>
            
            <section class="py-2">
                <footer id="footer" class="text-center">
                    <p class="copyright my-0">&copy; DoubtBuddy. All rights reserved. </a> Website: <a
                    href="https://doubtbuddy.com">DoubtBuddy.com</a>.</p>
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
