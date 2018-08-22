

<?php
require_once './vendor/autoload.php';

$helperLoader = new SplClassLoader('Helpers', './vendor');
$mailLoader   = new SplClassLoader('SimpleMail', './vendor');

$helperLoader->register();
$mailLoader->register();

use Helpers\Config;
use SimpleMail\SimpleMail;

$config = new Config;
$config->load('./config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email   = stripslashes(trim($_POST['form-email']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';
    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);


    if ($email && $emailIsValid) {
        $mail = new SimpleMail();
        $mail->setTo($config->get('emails.to'));
        $mail->setFrom($config->get('emails.from'));
        $mail->setSenderEmail($email);
        $body = "
                <p><strong>{$config->get('fields.email')}:</strong> {$email}</p>";
        //TODO Fix this som bitch...
        //$mail->setHtml($body);
        mail('Tyler.Felde@gmail.com', 'My Subject', $body);
        $mail->send();
        $emailSent = true;
    } else {
        $hasError = true;
        }
}?> 
<!DOCTYPE html>
<!-- Website Created By: Tyler Ryan Felde 
    I have spent far to much time creating this I hope you guys like it,
    I wish the best of luck for your band hopefully you guys make it big, 
    if so hopefully I could get tickets for my hardword on your website

First Website I have created... twas the best of times and the worst of times lol...

Contact Information:
    Tyler.Felde@gmail.com
    (304)376-9902

Band name: Marjorie Gardens
Domaine:   WWW.MarjorieGardens.com (hopefully) 
--->
<html>
    <!--Prevent default scaling-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta charset="utf-8">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- css links -->
        <link href="Styles.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="custom.css">
        <script type="text/javascript" src="script.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <div id="desktop">
            <div class="vertical-menu">
                <!--Music -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20Music%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Music%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Music%201.png '"
                            height="25"width="50"></div></a>
                <!--Video -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20Videos%201.png"   
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Videos%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Videos%201.png '"    
                            height="25"width="50"> </div></a>
                <!--About Us -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20About%20Us%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20About%20Us%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20About%20Us%201.png '"     
                            height="25"width="80"> </div></a>
                <!--Contact Us -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20Follow%20Us%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Follow%20Us%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Follow%20Us%201.png '"
                            height="25"width="80"> </div></a>
                
            
            </div>
            <!--Email Form -->
            <div class = "formBox">
               <?php if(!empty($emailSent)): ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success text-center"><?php echo $config->get('messages.success'); ?></div>
        </div>
    <?php else: ?>
        <?php if(!empty($hasError)): ?>
        <div class="col-md-5 col-md-offset-4">
            <div class="alert alert-danger text-center"><?php echo $config->get('messages.error'); ?></div>
        </div>
        <?php endif; ?>

    <div class="col-md-6 col-md-offset-3">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="application/x-www-form-urlencoded" id="contact-form" class="form-horizontal" method="post">
            <div class="form-group">
                <label for="form-email" class="col-lg-2 control-label"><?php echo $config->get('fields.email'); ?></label>
                <div class="col-lg-10">
                    <input type="email" class="form-control" id="form-email" name="form-email" placeholder="<?php echo $config->get('fields.emailPrompt'); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default"><?php echo $config->get('fields.btn-send'); ?></button>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <script type="text/javascript" src="public/js/contact-form.js"></script>
    <script type="text/javascript">
        new ContactForm('#contact-form');
    </script> 
             </div>        
            <div class="socialMediaContainer">
                    <div class ="overlayFacebook">
                        <a href="https://www.facebook.com/MarjorieGardens/"
                                                target="https://www.facebook.com/MarjorieGardens/" 
                                                     class="fa fa-facebook">
                        </a></div>
                    <div class ="overlayYoutube">
                        <a href="https://www.youtube.com/channel/UC3RSweoP1wxAfyGTLtHtpUg/featured?view_as=subscriber" 
                                                    target="_blank"
                                                    class="fa fa-youtube">
                        </a></div> 
                    <div class ="overlayInsta">
                        <a href="https://www.instagram.com/marjoriegardensband/?hl=en" class="fa fa-instagram">
                        
                        </a></div>
                </div>
            <div id="bandContainer"> <img class="band"                       src="photos/BandName.png"height="50"width="350"/>
            </div>
        <body>
            <div id = topWrapper>
                <div class= "wrapperContainerA">
                    <iframe 
                     src="https://www.youtube.com/embed/qYZWg9pbjUk">
                    </iframe>
                </div>
                    <!--Info at Top -->
                <div class= "wrapperContainerB">
                            Born from the notorious party town of Morgantown West Virginia Marjorie Gardens consistently pumps out a high energy in your face hard hitting yet grooving brand of rock n roll. With its four band members, each bringing diverse musical backgrounds to the table, the band pulls influence from various bands that span generations. Anywhere from Black Sabbath and The Rolling Stones to Queens of The Stone Age and Red Hot Chili Peppers.
                    <p> </p>
                                    <p>Wade Marshall – Vocals</p>    
                                    <p>Guitar Dean Marshall – Bass</p>
                                    <p>Austin Waugaman – Lead Guitar</p> 
                                    <p>Frank Witt - Drums</p>
                </div>
                        
            </div>            
            <h2><img src="photos/Marjorie%20Gardens%20Videos%201.png"   
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Videos%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Videos%201.png '"    
                     height="10%"width="10%"></h2>
                  <!--First Video in section -->
                  <div class="videosContainer">
                   <iframe src="https://www.youtube.com/embed/H3R4SOswdTc" 
                         allowfullscreen class="videos"></iframe>  
                  <!--Second Video in Section -->
                      <iframe src="https://www.youtube.com/embed/jqCFNa5K34o" 
                         allowfullscreen class="videos"></iframe></div>
                    <!--TODO like to youtube --> 
                                
            <div id="arrowLink">
                <a href="http://google.com">VIEW ALL VIDEOS &#8594;</a>
                 
            </div>
            
            <h3><img src="photos/Marjorie%20Gardens%20About%20Us%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20About%20Us%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20About%20Us%201.png '"     
                            height="5%"width="11%"></h3>       
            <h3><img src="photos/Marjorie%20Gardens%20Follow%20Us%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Follow%20Us%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Follow%20Us%201.png '"
                            height="5%"width="11%">
                    <!--Twitter -->
                    <div class="newsContainer">
                   <a class="twitter-timeline" data-lang="en" data-theme="dark" data-link-color="#2B7BB9" href="https://twitter.com/MarjorieGardens?ref_src=twsrc%5Etfw">Tweets by MarjorieGardens</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </h3>
        </body>
    </div>
    <!--Tablet verison-->
    <div id="Tablet">
        <div id="menu"><div class ="titleMenu"></div>
        <table>
            <tr>
                <th><span style="
                        font-size:2.0em;
                        cursor:pointer;
                        float:left;
                        padding-top: 5%;" 
                    onclick="openNav()">&#9776;</span>
                </th>
                <th>
                    <div class ="navClose"></div><div id="menuBand"><img class="navBand" src="photos/Marjorie%20Gardens%20Text%20Only.png"/></div>
                </th>
            </tr>
       </table>
    </div>
        <!--Navigation Menu at Top -->
        <div id="myNav" class="overlay">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><div class ="navClose"> </div>
            
            <div class="overlay-content">
                <!--Band Title--->
                <div id="navBand"><img class="navBand"     src="photos/Marjorie%20Gardens%20Text%20Only.png"height="500"/></div>
                <!--Music -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20Music%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Music%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Music%201.png '"
                            height="25"width="50"></div></a>
                <!--Video -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20Videos%201.png"   
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Videos%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Videos%201.png '"    
                            height="25"width="50"> </div></a>
                <!--About Us -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20About%20Us%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20About%20Us%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20About%20Us%201.png '"     
                            height="25"width="80"> </div>
                
                </a>
                <!--Contact Us -->
                <a href="#"><div class="navWords">
                    <img src="photos/Marjorie%20Gardens%20Follow%20Us%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Follow%20Us%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Follow%20Us%201.png '"
                            height="25"width="80"> </div></a>
                <div class = "formBox">
               <?php if(!empty($emailSent)): ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success text-center"><?php echo $config->get('messages.success'); ?></div>
        </div>
    <?php else: ?>
        <?php if(!empty($hasError)): ?>
        <div class="col-md-5 col-md-offset-4">
            <div class="alert alert-danger text-center"><?php echo $config->get('messages.error'); ?></div>
        </div>
        <?php endif; ?>

    <div class="col-md-6 col-md-offset-3">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="application/x-www-form-urlencoded" id="contact-form" class="form-horizontal" method="post">
            <div class="form-group">
                <label for="form-email" class="col-lg-2 control-label"><?php echo $config->get('fields.email'); ?></label>
                <div class="col-lg-10">
                    <input type="email" class="form-control" id="form-email" name="form-email" placeholder="<?php echo $config->get('fields.emailPrompt'); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default"><?php echo $config->get('fields.btn-send'); ?></button>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <script type="text/javascript" src="public/js/contact-form.js"></script>
    <script type="text/javascript">
        new ContactForm('#contact-form');
    </script> 
                    </div>
            <!--form -->   
            </div>
                    <!--TODO FIll empty Links -->
                    <div class ="overlayFacebook"><a href="#" class="fa fa-facebook"></a></div>
                    <div class ="overlayYoutube"><a href="#" class="fa fa-youtube"></a></div> 
                    <div class ="overlayInsta"><a href="#" class="fa fa-instagram"></a></div>
        </div>
        <!--JS for Navigation Menu at Top -->
        <script>
            function openNav() {
    document.getElementById("myNav").style.height = "450px";
}
            function closeNav() {
    document.getElementById("myNav").style.height = "0%";
}
        </script>
        <body>
            <!--First Video the one at the top -->
            <h1>
                <div id = topWrapper>
                <div class= "wrapperContainerA">
                    <iframe 
                            src="https://www.youtube.com/embed/qYZWg9pbjUk">
                    </iframe>
                </div>
                
                            
                
            
                <!-- information for first video-->
                <div class= "wrapperContainerB">
                            Born from the notorious party town of Morgantown West Virginia Marjorie Gardens consistently pumps out a high energy in your face hard hitting yet grooving brand of rock n roll. With its four band members, each bringing diverse musical backgrounds to the table, the band pulls influence from various bands that span generations. Anywhere from Black Sabbath and The Rolling Stones to Queens of The Stone Age and Red Hot Chili Peppers.
                    <p> </p>
                                    <p>Wade Marshall – Vocals</p>    
                                    <p>Guitar Dean Marshall – Bass</p>
                                    <p>Austin Waugaman – Lead Guitar</p> 
                                    <p>Frank Witt - Drums</p>
                </div>
                </div>
            </h1>
            <!--Videos Section -->
            <h2>
            
                <img src="photos/Marjorie%20Gardens%20Videos%201.png"   
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Videos%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Videos%201.png '"    
                     height="10%"width="20%">
                
                <div id = videoWrapper>
                <div class= "wrapperContainerC">
                    <iframe 
                            src="https://www.youtube.com/embed/qYZWg9pbjUk">
                    </iframe>
                </div>
                    <div class= "wrapperContainerD">
                    <iframe 
                            src="https://www.youtube.com/embed/qYZWg9pbjUk">
                    </iframe>
                </div>
                </div>
                <div id="arrowLink">
                <a href="http://google.com">VIEW ALL VIDEOS &#8594;</a>
                 
            </div>
            </h2>    
            <!--Follow us Section -->
            <h3>
                <img src="photos/Marjorie%20Gardens%20Follow%20Us%201.png"
                        onmouseover="this.src='photos/Marjorie%20Gardens%20Follow%20Us%202.png '"
                        onmouseout="this.src= 'photos/Marjorie%20Gardens%20Follow%20Us%201.png '"
                            height="10%"width="20%">
                
                <div class="newsContainer">
                   <a class="twitter-timeline" data-lang="en" data-theme="dark" data-link-color="#2B7BB9" href="https://twitter.com/MarjorieGardens?ref_src=twsrc%5Etfw"max-height: 450px;>Tweets by MarjorieGardens</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
           
            </h3>
            <!--TODO fill empty links && center icons -->
            <h5></h5>
        </body>
     </div>
</html>
