<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<!-- SCRIPTS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- SCRIPTS END-->
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jade Delight</title>
    
    <!-- JAVASCRIPT START -->
    <script language = "javascript">

        $(document).ready(function(){
            $("input[type='submit']").click(
            function() {
                validate();
            }
                
                $('#time').val(time);
            ); // end input type submit
            
            
            $("input[value = 'delivery']").click(
            function() {
                show(1);  
            }
            ); //end delivery
            
            $("input[value = 'pickup']").click(
            function() {
                show(0);
            }
            ); //end pickup
        }
        ); //END SUBMIT BUTTON 
        
        /***************************************************/
        
        // does: goes through form validation
        function validate()
        {
            var radios = jQuery("input[type='radio']");
            var x = radios.filter(":checked").val();
            var time = gettime(x);


            var num = document.getElementsByName("phone")[0].value;
            var split_num = num.split("-");
            var correct = true;
            
            // checks if last name is entered
            correct = check_lastname();
            
            // checks the format of phone number
            correct = check_phone(split_num);
            if (correct = false){
                    correct = check_phone(split_num);               
            }

            // form validation if delivery is selected
            if (x == "delivery") {                
                correct = check_delivery();
            }
            
            // checks if there was an order placed 
            if ((correct = true) && document.getElementById("total").value == 0) {
                alert("please select at least one item!")
                return;
            }
            
            // if everything is correct, proceed
            if (correct = true){
                if (x == "delivery") {
                    alert("thank you for ordering! the total is $" + document.getElementById("total").value + " expect your delivery at " + time + "!");
                } else {
                    alert("thank you for ordering! the total is $" + document.getElementById("total").value + "." + " please pick up your order at "  + time + "!");
            
                }
            }
        }
        
        /***************************************************/
        
        function check_lastname(){
            if (document.getElementsByName("lname")[0].value.trim() == "") {
                alert("please enter your last name!")
                correct = false;
            }
        }
        
        /***************************************************/
        
        function check_phone(string) {
            var split_num = string;
            if ((split_num.length != 3) || (split_num[0].length != 3 || isalpha(split_num[0])) || 
                (split_num[1].length != 3 || isalpha(split_num[1])) || (split_num[2].length != 4 || isalpha(split_num[2]))) {
                alert("please enter your phone number! make sure to follow the format.")
                correct = false;
            }
        }
        
        /***************************************************/
        
        function check_delivery() {
            
            // checks if street name is entered
            if (document.getElementsByName("street")[0].value.trim() == "") {
                alert("please enter your street name!");
                correct = false;
            }
                
            // checks if city is entered
            if (document.getElementsByName("city")[0].value.trim() == ""){
                alert("please enter your city name!");
                correct = false;
            }
        }
        
        /***************************************************/
        
        function print_values() {
            var x = document.getElementsByTagName("select");
            var costs = document.getElementsByName("cost");
            for (i = 0; i < x.length; i++) {
                var item_total =  x[i].value * menuItems[i].cost.toFixed(2);
                costs[i].value = total.toFixed(2);
            }

            var subtotal = 0;
            for (i = 0; i < menuItems.length; i++) {
                subtotal += parseFloat(costs[i].value);
            }
            document.getElementById("subtotal").value = subtotal;
            document.getElementById("tax").value = parseFloat(subtotal * 0.0625).toFixed(2);
            document.getElementById("total").value = parseFloat(subtotal * 1.0625).toFixed(2);
        }
        
        /***************************************************/
        
        function show(x) {
            if (x == 0) {
                document.getElementsByName("street")[0].style.display = 'none';
                document.getElementsByName("city")[0].style.display = 'none';

            } else {
                document.getElementsByName("street")[0].style.display = 'inline';
                document.getElementsByName("city")[0].style.display = 'inline';
            }
        }
        
        
        /***************************************************/
        
        function gettime(x) {
            var add_min;
            if (x == "delivery"){
                add_min = 30;
            } else {
                add_min = 15;
            }

            var date = new Date();
            var hours = 0;
            var minutes = parseInt(date.getMinutes()) + add_min;
            
            if (minutes >= 60) {
                hours += 1;
                minutes = minutes % 60;
                
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }
            }
            
            hours = (hours + date.getHours()) % 24;
            return hours + ":" + minutes;
        }
        
        /***************************************************/
            
        function isalpha(str) {
            for (var i = 0 ; i < str.length;i++) {
                if (str[i] < '0' || str[i] > '9')
                return true;
            }
            
            return false;
        }
        
    </script>
    <!--JAVASCRIPT END-->

</head>

<body style="background-color: #F8F6F2; 
             font-family: didot; 
             margin-left: 30px;
             margin-right: 30px;
             margin-top: 30px;">
    
    <script language="javascript">
                
    function MenuItem(name, cost)
    {
        this.name = name;
        this.cost=cost;
    }

    menuItems = new Array(
            new MenuItem("Chicken Chop Suey", 4.5),
            new MenuItem("Sweet and Sour Pork", 6.25),
            new MenuItem("Shrimp Lo Mein", 5.25),
            new MenuItem("Moo Shi Chicken", 6.5),
            new MenuItem("Fried Rice", 2.35)
    );

    function makeSelect(name, minRange, maxRange)
    {
        var t= "";
        t = "<select name='" + name + "' size='1'>";
        for (j=minRange; j<=maxRange; j++)
            t += "<option>" + j + "</option>";
        t+= "</select>"; 
        return t;
        }
        
    
    </script>

    <h1 style = "color: #00432b; font-size: 50px">Jade Delight</h1>
    
    <!-- FORM FORM FORM FORM FORM FORM FORM -->
    <form method = "post" action = "order_details.php">

        <p>First Name: <input type="text"  name='fname' /></p>
        <p>Last Name*:  <input type="text"  name='lname' /></p>
        <p>Street: <input type="text"  name='street' /></p>
        <p>City: <input type="text"  name='city' /></p>
        <p>Phone*: <input type="text"  name='phone' placeholder="xxx-xxx-xxxx"/></p>
        <p>Email*: <input type="text"  name='email'/></p>
        
        
        <script>
            document.getElementsByName("street")[0].style.display = 'none';
            document.getElementsByName("city")[0].style.display = 'none';
        </script>
        
        
        <p> <input type="radio"  name="p_or_d" value = "pickup" checked="checked"/>Pickup  
            <input type="radio"  name='p_or_d' value = 'delivery'/> Delivery</p><br>
        
        <table border="1" cellpadding="7" style= "border-color: #657c5a;">
            <tr>
                <th>Select Item</th>
                <th>Item Name</th>
                <th>Cost Each</th>
                <th>Total Cost</th>
            </tr>
            
            <script language="javascript">
                var s = "";
                for (i=0; i< menuItems.length; i++)
                {
                    s += "<tr><td>";
                    s += makeSelect("quan" + i, 0, 10);
                    s += "</td><td>" + menuItems[i].name + "</td>";
                    s += "<td> $ " + menuItems[i].cost.toFixed(2) + "</td>";
                    s += "<td>$<input type='text' name='cost"+ i + "'" + "/></td></tr>";
                }
                
                document.writeln(s);
            </script>
                    
            <script>
                var x = document.getElementsByTagName("select");
                var y = document.getElementsByName("cost");
                for (i = 0; i < x.length; i++) {
                    x[i].setAttribute("onchange", "print_values()");
                    y[i].setAttribute("value", "");
                }
            </script>
        </table>
        
        <br><br><hr>
        <p style = "color: #657c5a; font-weight: 700">ORDER RECEIPT</p>
        <p>Subtotal: 
           $ <input style = "font-family: times;" type="text"  name='subtotal' id="subtotal" value = ""/>
        </p>
        <p>Mass tax 6.25%:
          $ <input style = "font-family: times;" type="text"  name='tax' id="tax" value = ""/>
        </p>
        <p>Total: $ <input style = "font-family: times;" type="text"  name='total' id="total" value = "" />
        </p>

        <br>
        <input style = "background-color: #86ae72; 
                        font-family: didot; 
                        padding: 5px 18px; 
                        border-color:#657c5a;" 
               type = "submit" value = "Submit Order" />
        
        <input type="hidden" name="chopsuey" value="4.50">
        <input type="hidden" name="sspork" value="4.50">
        <input type="hidden" name="lomein" value="4.50">
        <input type="hidden" name="moochicken" value="4.50">
        <input type="hidden" name="friedrice" value="4.50">
                 
    </form>
    
    
    
</body>
