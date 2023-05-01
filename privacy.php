<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: login.php");
  }
require "header.php"; ?>

<body>
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

           <div class="row justify-content-center">
            <div class="col-lg-6">
            <div class="login-form">
            <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/easylearn/logo3.jpg" style="border-radius: 5px;" alt=""> 
            </a>
                <h2 class="pt-5">Eazy Learn Privacy and Policy</h2>
                <form role="form" class="mt-4" action="">
               
                    <div class="input-group mb-3">
                        <p>At Eazy Learn, we value the privacy of our users and are committed to protecting their personal information. This Privacy Policy outlines how we collect, use, and protect the personal information of our users.

Information We Collect:
We collect personal information when users register on our website or use our services. The information we collect may include the user’s name, email address, phone number, date of birth, and location. We also collect information about the user’s device, IP address, and browser information.
<br /><br />

How We Use the Information:
We use the personal information collected to improve our services and provide a better experience for our users. We may use the information to communicate with our users, personalize their experience, and provide them with relevant content. We may also use the information to provide support and respond to user inquiries.<br /><br />

How We Protect the Information:
We take reasonable measures to protect the personal information collected from our users. We use industry-standard security measures to protect against unauthorized access, alteration, or disclosure of the personal information collected. We restrict access to personal information to only authorized personnel who require the information to perform their duties.<br /><br />

Disclosure of Information:
We may disclose personal information to third-party service providers who perform services on our behalf. We may also disclose information to comply with legal obligations, protect our rights or the rights of others, or in response to a request from a law enforcement agency.<br /><br />

Cookies and Tracking Technologies:
We use cookies and tracking technologies to collect information about how our users interact with our website and services. This information is used to improve the user experience, personalize content, and to provide relevant ads. Users can manage their cookie preferences in their browser settings.<br /><br />

Third-Party Websites:
Our website may contain links to third-party websites. We are not responsible for the privacy practices of these websites and encourage our users to review the privacy policies of these websites before providing any personal information.<br /><br />

Children’s Privacy:
Our services are not intended for children under the age of 13. We do not knowingly collect personal information from children under the age of 13. If we become aware that we have collected personal information from a child under the age of 13, we will take steps to delete the information as soon as possible.<br /><br />

Changes to the Privacy Policy:
We may update this Privacy Policy from time to time to reflect changes in our practices or applicable laws. Users will be notified of any material changes to the Privacy Policy via email or by posting a notice on our website.<br /><br />

Contact Us:
If you have any questions or concerns about our Privacy Policy, please contact us at info@eazylearn.com.ng.</p>
                    </div>
                    
                    <div class="form-group text-center">
                        <a href="password.php" id="register_btn" class="form-control getStarted-btn">Agree & Join</a>
                    </div>
                </form>
               
            </div>
            </div>
           </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>
