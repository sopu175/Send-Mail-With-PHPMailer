##Mobile Number Varification with Regular Expression With Jquery

First Connect the Bootstrap Css and Js cdn

```sh
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

```

###Write Down the form html

```sh
    <form class="contact-form" action="php/contact.php" method="post">
                <div class="row">
                    <div class="col-sm-6 form-group name">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>

                    <div class="col-sm-6 form-group email">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>

                <div class="form-group comment">
                    <textarea class="form-control" name="comment" placeholder="Message"></textarea>
                </div>

                <div class="button-box text-center">
                    <button type="submit" class="btn btn-default progress-button btn-submit">
                        <span class="button-label">Send</span>
                    </button>
                </div>
            </form>
```

Now after click the submit button form action set to another path to send mail. We used ajax for passing data to another page 

```sh
$(document).ready(function () {
        //Contact Form
        function contactForm() {
            $('.btn-submit').on('click', function (e) {
                var $this = $(this);

                e.preventDefault();

                $.ajax({
                    url: 'php/contact.php',
                    type: 'POST',
                    data: $this.closest('.contact-form').serialize(),
                    success: function (data) {
                        if ($(data).is('.send-true')) {
                            $this.addClass('loading').delay(650).queue(function () {
                                $this.addClass('success').addClass('loaded').dequeue();
                            });
                        } else {
                            $this.addClass('success');
                        }

                    }
                });
            });
        }
    });
```

Now Download <a href="https://github.com/PHPMailer/PHPMailer">PhpMailer.zip</a> From Here and paste to project file.

We need to include phpMailer all file indiviualy.And put the correct email password for connect smtp sucessfully 

```sh
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comment'])) {
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'sopu.me';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'saif@sopu.me';                     //SMTP username
    $mail->Password   = '*******';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($_POST['email'], 'Mailer');
    $mail->addAddress('contact@rahadkabir.net', 'Joe User');     //Add a 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_POST['name'];
    // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->Body = '<html>
	<head>
		<title>Your Site Contact Form</title>
	</head>
	<body>
		<h3>Name: <span style="font-weight: normal;">' . $_POST['name'] . '</span></h3>
		<h3>Email: <span style="font-weight: normal;">' . $_POST['email'] . '</span></h3>
		<div>
			<h3 style="margin-bottom: 5px;">Comment:</h3>
			<div>' . $_POST['comment'] . '</div>
		</div>
	</body>
</html>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
	}
} else {
	echo '<span class="text-danger">All fields must be filled!</span>';
}
```