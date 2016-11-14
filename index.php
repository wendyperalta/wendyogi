<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Wendy's Cloud</title>
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body id="top" ng-app="portfolioApp">
  <header>
    <div id="nav-content">
      <div class="default">
        <nav class="group">
          <div id="logo">
            <img src="img/wendys_cloud_white.svg" width="100"alt="Wendy's Cloud Logo">
          </div>
          <div id="hamburger-icon">
            <div id="bar-container">
              <i class="fa fa-bars fa-lg"></i>
            </div>
          </div>
          <div id="extended-nav">
            <div id="ul-container">
              <ul>
                <li><a href="#portfolio">PORTFOLIO</a></li>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#contact">CONTACT</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <div id="dropdown">
        <ul>
          <li><a href="#portfolio">PORTFOLIO</a></li>
          <li><a href="#about">ABOUT</a></li>
          <li><a href="#contact">CONTACT</a></li>
        </ul>
      </div>
    </div>
    <div id="header-content">
      <div class="default">
        <div id="headshot">
          <div id="circle">
          </div>
        </div>
        <div id="name">
          <h1>WENDY PERALTA</h1>
        </div>
        <div class="divider">
          <div class="dots">
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
          </div>
          <i class="fa fa-cloud fa-2x"></i>
          <div class="dots">
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
          </div>
        </div>
        <div id="title">
          <p>Front-End Web Developer</p>
        </div>
      </div>
    </div>
  </header>
  <main>
    <section id="portfolio" name="portfolio-head">
      <div class="default">
        <h2>PORTFOLIO</h2>
          <div class="divider">
            <div class="dots">
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
            </div>
            <i class="fa fa-cloud fa-2x"></i>
            <div class="dots">
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
            </div>
          </div>
          <div id="sites" ng-controller="MainController">
            <div class="site" ng-repeat="site in sites">
              <a ng-href="{{site.link}}" target="_blank">
                <div id="{{site.name}}">
                  <img ng-src="{{site.img}}" alt="{{name.description}}">
                </div>
              </a>
            </div>
          </div>
      </div>
    </section>
    <section id="about">
      <div class="default">
        <h2>ABOUT</h2>
          <div class="divider">
            <div class="dots">
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
            </div>
            <i class="fa fa-cloud fa-2x"></i>
            <div class="dots">
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
              <i class="fa fa-circle"></i>
            </div>
          </div>
        <div id="description">
          <div class="two-col"><p>Hello World! My name is Wendy Peralta and I am a Front-End Web Developer located in Los Angeles. When I'm not building websites, I like to exercise, practice Yoga, and dance.</p></div>
          <div class="two-col"><p>Wendy's Cloud is the home to my most treasurable creations. Please feel free to look around or contact me if you are interested in chatting at wendy@wendyscloud.com</p></div>
        </div>
      </div>
    </section>
    <section id="contact" class="default">
      <h2>CONTACT ME</h2>
        <div class="divider">
          <div class="dots">
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
          </div>
          <i class="fa fa-cloud fa-2x"></i>
          <div class="dots">
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
            <i class="fa fa-circle"></i>
          </div>
        </div>
      <div id="form" class="default">
        <form id="ajax-form" method="post" action="form.php">
          <div><input type="text" name="name" placeholder="Name" class="floatlabel_2" required></div>
          <div><input type="email" name="email" placeholder="Email Address" class="floatlabel_2" required></div>
          <div><input type="tel" pattern="\d{3}[\-]\d{3}[\-]\d{4}" name="phone" placeholder="xxx-xxx-xxxx" class="floatlabel_2 floatlabel_3" data-label="Phone Number" required></div>
          <div><textarea name="message" rows="5" placeholder="Message" class="floatlabel_2" required></textarea></div>
          <div class="group"><input type="submit" value="Send"></div>
        </form>
        <div id="form-confirm">
          <div class="outline">
            <div>
              <i class="fa fa-check fa-lg"></i>
            </div>
          </div>
          <div id="confirm">
            <p>Thanks! I'll get back to you very soon.</p>
          </div>
        </div>
        <div id="form-error">
          <div class="outline">
            <div>
              <i class="fa fa-times fa-lg"></i>
            </div>
          </div>
          <div id="fail-submit">
            <p>Sorry, the message could not be sent. Please try again later.</p>
          </div>
        </div>
      </div>
    </section>
    <div class="clear"></div>
  </main>
  <footer>
    <div id="footer-content">
      <div class="default">
        <div id="location">
          <h3>INFO</h3>
          <span><a href="mailto:wendy@wendyscloud.com">wendy@wendyscloud.com</a></span>
          <span>561-654-4006</span>
        </div>
        <div id="social">
          <h3>AROUND THE WEB</h3>
          <div id="social-media">
            <ul>
              <a href="https://www.linkedin.com/in/wendyperalta" target="_blank">
                <li>
                  <div class="outline">
                    <div>
                      <i class="fa fa-linkedin fa-lg"></i>
                    </div>
                  </div>
                </li>
              </a>
              <a href="https://twitter.com/wendyscloud" target="_blank">
                <li>
                  <div class="outline">
                    <div>
                      <i class="fa fa-twitter fa-lg"></i>
                    </div>
                  </div>
                </li>
              </a>
              <a href="https://www.facebook.com/wendyscloud" target="_blank">
                <li>
                  <div class="outline">
                    <div>
                      <i class="fa fa-facebook fa-lg"></i>
                    </div>
                  </div>
                </li>
              </a>
              <a href="https://github.com/wendyperalta" target="_blank">
                <li>
                  <div class="outline">
                    <div>
                      <i class="fa fa-github-alt fa-lg"></i>
                    </div>
                  </div>
                </li>
              </a>
            </ul>
          </div>
        </div>
      </div>
      <div id="copyright">
        <span>Copyright &copy; wendyscloud.com 2016</span>
      </div>
    </div>
  </footer>
  <div id="top-button">
    <div id="button-container">
      <a href="#top"><i class="fa fa-arrow-circle-up fa-3x"></i></a>
    </div>
  </div>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular.min.js"></script>
<script src="js/app.js" type="text/javascript"></script>
<script src="js/controllers/MainController.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/floatlabels.js" type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
</body>
</html>
