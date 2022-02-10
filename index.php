<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>


<div class="main">
    <div class="container">
        <div class="row">
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


        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>

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


</script>

</body>
</html>