<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>order reciept</title>
</head>
    
<body style="background-color: #F8F6F2; 
             font-family: didot; 
             margin-left: 30px;
             margin-right: 30px;
             margin-top: 30px;">
    
    <h1> ORDER RECIEPT </h1>
    <?php
        extract ($_POST);
        echo $_POST["quan0"] . " Chicken Chop Suey  = $" . $quan0*4.5 . "<br>";
        echo $_POST["quan1"] . " Sweet and Sour Pork  = $" . $quan1*6.25 . "<br>";
        echo $_POST["quan2"] . " Shrimp Lo Mein  = $" . $quan2*5.25 . "<br>";
        echo $_POST["quan3"] . " Moo Shi Chicken  = $" . $quan3*6.5 . "<br>";
        echo $_POST["quan4"] . " Fried Rice  = $" . $quan4*2.35 . "<br>";
    
        echo "<hr>";

        echo "Subtotal: $$subtotal <br>"; 
        echo "Tax: $$tax <br>";
        echo "Total: $$total <br>";
    
        echo "<hr>";

        $method = $p_or_d;
        echo "You selected <strong> $method! </strong><br>";
        date_default_timezone_set("America/New_York");

        if ($method == "pickup")
        {
            $selectedTime = date("h:i:sa");
            $endTime = strtotime("+15 minutes", strtotime($selectedTime));
            echo "Your order will be ready at " . date('h:ia', $endTime) . ".";
        }
        else
        {
            $selectedTime = date("h:i:sa");
            $endTime = strtotime("+30 minutes", strtotime($selectedTime));
            echo "Your order will be delivered at " . date('h:ia', $endTime) . ".";
        }

        /////// EMAIL
        echo "<hr> Thank you for your order! A confirmation email has been sent to $email.";

        $msg = "Thank you for ordering! The total is $$total! \nYour method of order is $method and will be completed at " . date('h:ia', $endTime) . "!";

        $msg = wordwrap($msg,70);

        mail("$email", "Your Order", $msg);
    ?>
    
</body>
</html>
