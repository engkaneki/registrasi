<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER DUKCAPIL</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hiind&display=swap">
    <script src="js/jquery.min.js" charset="utf-8"></script>
    <script src="js/sweetalert2.all.min.js"></script>

</head>

<body>
    <div class="login-form">
        <div class="logo"><img src="images/logo.png" alt="" srcset=""></div>

        <h6>
            <center>
                register dukcapil
            </center>
        </h6>

        <form action="scripts/verif-login.php" method="POST">
            <div class="textbox">
                <input type="text" name="username" id="" placeholder="Username">
                <span class="check-message hidden">Required</span>
            </div>

            <div class="textbox">
                <input type="password" name="password" id="" placeholder="Password">
                <span class="check-message hidden">Required</span>
            </div>

            <input type="submit" value="LOGIN" class="login-btn" disabled>
        </form>
    </div>

    <script type="text/javascript">
        $(".textbox input").focusout(function() {
            if ($(this).val() == "") {
                $(this).siblings().removeClass("hidden");
                $(this).css("background", "#554343");
            } else {
                $(this).siblings().addClass("hidden");
                $(this).css("background", "#484848");
            }
        });

        $(".textbox input").keyup(function() {
            var inputs = $(".textbox input");
            if (inputs[0].value != "" && inputs[1].value) {
                $(".login-btn").attr("disabled", false);
                $(".login-btn").addClass("active");
            } else {
                $(".login-btn").attr("disabled", true);
                $(".login-btn").removeClass("active");
            }
        });
    </script>
</body>

</html>