<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 
?>


<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="We have put a lot of efforts to make our pages more responsive and interactive. And this page is designed to show that details of the enhancement we made." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Enhancement On Our Web</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_enhance">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="enhancement-layout">
                <div class="enhancement-welcoming">
                    <h1 class="enhancement-heading">Our Enhancement 2</h1>
                    <p class="enhancement-heading-description">
                        Here, you'll discover the enhancements we've made to our website.
                    </p>
                </div>
                <div class="enhancement-section">
                    <div class="enhancement-section-heading">
                        <h3> Email ( Register & OTP vertification ) </h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/responsivelayout.gif" alt="Responsive Layout Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page:
                                <a href="registration.php">Register Page</a>
                                <a href="forgot_password.php">Forgot Passord Page</a>
                                <a href="reset_password.php">Reset Passord Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://github.com/PHPMailer/PHPMailer">Source 1</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3> Search Module </h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/chatbox.gif" alt="Chatbot Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page:
                                <a href="acknowledgment.php">Acknowledgement Page</a>
                                <a href="andrew.php">Profile Page(Andrew)</a>
                                <a href="aniq.php">Profile Page(Aniq)</a>
                                <a href="assufi.php">Profile Page(Assufi)</a>
                                <a href="care.php">Care Page</a>
                                <a href="classify.php">Classify Page</a>
                                <a href="contribute.php">Contribute Form Page</a>
                                <a href="contribution.php">Contribution Output Page</a>
                                <a href="enhancement.php1">Enhancement1 Page</a>
                                <a href="enquiry.php">Enquiry Page</a>
                                <a href="faiz.php">Profile Page(Faiz)</a>
                                <a href="identify.php">Identify Page</a>
                                <a href="index.php">Homepage</a>
                                <a href="login.php">Login Page</a>
                                <a href="registration.php">Register Page</a>
                                <a href="tools.php">Tools Page</a>
                                <a href="tutorial-introduction.php">Tutorial Introduction Page</a>
                                <a href="tutorial.php">Tutorial Page</a>
                                <a href="profile-introduction.php">Profile Introduction Page</a>
                                <a href="user_view_enquiry.php">Temporary View Enquiry Page</a>
                                <a href="user_profile.php">User Profile Page</a>
                                <a href="edit_user_profile.php">Edit User Profile Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://stackoverflow.com/questions/35752944/php-mysql-search-functionality">Source 1</a>
                                <a href="https://www.w3schools.com/MySQL/mysql_like.asp">Source 2</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3> Identify Module </h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/responsivenavbar.gif" alt="Responsive Navbar Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page:
                                <a href="identify.php">Identify Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://my.plantnet.org/">Source 1</a>
                                <a href="https://stackoverflow.com/questions/50172723/curl-request-from-api-with-php">Source 2</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3> User Management Module (admin) & Generate PDF </h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/buttonhover.gif" alt="Button Hover Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p>

                            </p>
                            <p>
                                Applied Page:
                                <a href="./admin/view_comments.php">View Comments Page</a>
                                <a href="./admin/view_contribute.php">View Contribution Page</a>
                                <a href="./admin/view_enquiry.php">View Enquiry Page</a>
                                <a href="./admin/view_feedback.php">View Feedback Page</a>
                                <a href="./admin/view_login.php">View Login Page</a>
                                <a href="./admin/view_pre_contribute.php">View Pre Contribution Page</a>
                                <a href="./admin/view_register.php">View Register Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://www.youtube.com/watch?v=OJEQaVT45XA&pp=ygUbYWRtaW4gcGFuZWwgaW4gaHRtbCBjc3MgcGhw">Source 1</a>
                                <a href="https://github.com/dompdf/dompdf">Source 2</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3>User Management Module (User) </h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/ratingstar.gif" alt="Rating Star Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page:
                                <a href="user_profile.php">User Profile Page</a>
                                <a href="edit_user_profile.php">Edit User Profile Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://stackoverflow.com/questions/66816782/php-mysql-user-profile-page">Source 1</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3>Remember Me (cookies)</h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/overflow.gif" alt="Overflow Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page:
                                <a href="login.php">Login Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://stackoverflow.com/questions/27499512/how-to-put-remember-me-cookie-in-php">Source 1</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3>Anti-Spam</h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/extend.gif" alt="Extend-box Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page:
                                <a href="enquiry.php">Enquiry Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://stackoverflow.com/questions/20693620/using-sessions-to-store-answer-to-anti-spam-query-for-php-contact-form">Source 1</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3> Upload And Display Module </h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/flip.gif" alt="Flip-box Demo Video">
                            </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page: (Upload)
                                <a href="contribute.php">Contribute Page</a>
                                <a href="edit_user_profile.php">Edit User Page</a>
                                <a href="identify.php">Identify Page</a>
                            </p>
                            <p>
                                Applied Page: (Display)
                                <a href="contribution.php">Contribution Page</a>
                                <a href="user_profile.php">User Profile Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a href="https://www.w3schools.com/php/php_file_upload.asp">Source 1</a>
                                <a href="https://stackoverflow.com/questions/13465929/php-upload-image">Source 2</a>
                            </p>
                        </div> 
                    </div>
                </div>

                <div class="enhancement-section detect-en">
                    <div class="enhancement-section-heading">
                        <h3> Comments (View & Write)</h3>
                    </div>
                    <div class="enhancement-section-description">
                        <div class="enhancement-section-video">
                            <img src="images/changesection&readmore.gif" alt="Changing-Section Navbar & Read More Demo Video">
                        </div>
                        <div class="enhancement-section-description-content">
                            <p></p>
                            <p>
                                Applied Page (write):
                                <a href="contribution.php">Contribution Page</a>
                            </p>
                            <p>
                                Applied Page (view):
                                <a href="user_profile.php">User Profile Page</a>
                                <a href="./admin/view_comments.php">View Comments Page</a>
                            </p>
                            <p>
                                Refer Sources:
                                <a>Figure Up by Ourselves</a>
                            </p>
                        </div> 
                    </div>
                </div>
         
                <figure class='going-up-container'>
                    <a href='#top_enhance'>
                        <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                    </a>
                </figure>

            </div>
        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_enhance'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>
</html>