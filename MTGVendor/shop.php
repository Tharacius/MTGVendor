

<?php

session_start();
$product_ID = array();


//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){

        //keeps track of how many products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);

        //create sequential array for matching array keys to products id's
        $product_ID = array_column($_SESSION['shopping_cart'], 'id');

        //product already exists, increase quantity
        //match array key to id of the product being added to the cart
        for ($i = 0; $i < count($product_ID); $i++){
            if ($product_ID[$i] == filter_input(INPUT_GET, 'id')){
                //add item quantity to the existing product in the array
                $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity'); //Adds quantity
            }
        }
    }


    { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session array keys so they match with $product_ID numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION);



function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>MTGVendor Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="cart.css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

</head>
<body background="./images/wallpaper.jpg">
<div class="container">
    <?php

    $connect = mysqli_connect('localhost', 'root', '', 'admin');
    $product = 'SELECT * FROM products ORDER by id ASC';
    $result = mysqli_query($connect, $product);

    if ($result):
        if(mysqli_num_rows($result)>0):
            while($product = mysqli_fetch_assoc($result)):
                ?>

                <div class="col-sm-4 col-md-3" >
                    <form method="post" action="shop.php?action=add&id=<?php echo $product['id']; ?>">
                        <div class="products">
                            <img src="<?php echo $product['image']; ?>" class="img-responsive" />
                            <h4 class="text-info"><?php echo $product['name']; ?></h4>
                            <h4>$ <?php echo $product['price']; ?></h4>
                            <input type="text" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info"
                                   value="Add to Cart" />
                        </div>

                    </form>
                </div>
            <?php
            endwhile;
        endif;
    endif;
    ?>
    <div style="clear:both"></div>
    <br />
    <div class="table-responsive">
        <table class="table">
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>
            <tr>
                <th width="40%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>

            <form action='insert.php' method='post'
                  accept-charset='UTF-8' onsubmit="window.open('checkout.html','print_popup','width=1000,height=800');"
            >
                <fieldset>
                    <legend>Please fill out your order:</legend>
                    <input type='hidden' name='submitted' id='submitted' value='1' class="form-control"/>
                    <label for='name' >First Name: </label>
                    <!--name--> <input type="text" name="first_name" id="firstName" maxlength="15" class="form-control" placeholder="Enter your first name" required />
                    <label for='name' >Last Name: </label>
                    <!--name--> <input type="text" name="last_name" id="LasttName" maxlength="15" class="form-control" placeholder="Enter your last name" required />
                    <label for='email' >Email Address:</label>
                    <!--email--> <input type="email" name="email" id="emailAddress" maxlength="50" class="form-control" placeholder="Enter your email" required /> <br/>
                    <label for='datebirth' >Birth date:</label>
                    <!--datebirth-->   <select name="datebirth" class ="form-control" size="1" required>
                        <option value="">Select</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>
                        <option value="1993">1993</option>
                        <option value="1992">1992</option>
                        <option value="1991">1991</option>
                        <option value="1990">1990</option>
                        <option value="1989">1989</option>
                        <option value="1988">1988</option>
                        <option value="1987">1987</option>
                        <option value="1986">1986</option>
                        <option value="1985">1985</option>
                        <option value="1984">1984</option>
                        <option value="1983">1983</option>
                        <option value="1982">1982</option>
                        <option value="1981">1981</option>
                        <option value="1980">1980</option>
                        <option value="1979">1979</option>
                        <option value="1978">1978</option>
                        <option value="1977">1977</option>
                        <option value="1976">1976</option>
                        <option value="1975">1975</option>
                        <option value="1974">1974</option>
                        <option value="1973">1973</option>
                        <option value="1972">1972</option>
                        <option value="1971">1971</option>
                        <option value="1970">1970</option>
                        <option value="1969">1969</option>
                        <option value="1968">1968</option>
                        <option value="1967">1967</option>
                        <option value="1966">1966</option>
                        <option value="1965">1965</option>
                        <option value="1964">1964</option>
                        <option value="1963">1963</option>
                        <option value="1962">1962</option>
                        <option value="1961">1961</option>
                        <option value="1960">1960</option>
                        <option value="1959">1959</option>
                        <option value="1958">1958</option>
                        <option value="1957">1957</option>
                        <option value="1956">1956</option>
                        <option value="1955">1955</option>
                        <option value="1954">1954</option>
                        <option value="1953">1953</option>
                        <option value="1952">1952</option>
                        <option value="1951">1951</option>
                        <option value="1950">1950</option>
                    </select>
                    <label for='country' >Country:</label>

                    <?php $countries = array(
                        "AF" => "Afghanistan",
                        "AX" => "Aland Islands",
                        "AL" => "Albania",
                        "DZ" => "Algeria",
                        "AS" => "American Samoa",
                        "AD" => "Andorra",
                        "AO" => "Angola",
                        "AI" => "Anguilla",
                        "AQ" => "Antarctica",
                        "AG" => "Antigua and Barbuda",
                        "AR" => "Argentina",
                        "AM" => "Armenia",
                        "AW" => "Aruba",
                        "AU" => "Australia",
                        "AT" => "Austria",
                        "AZ" => "Azerbaijan",
                        "BS" => "Bahamas",
                        "BH" => "Bahrain",
                        "BD" => "Bangladesh",
                        "BB" => "Barbados",
                        "BY" => "Belarus",
                        "BE" => "Belgium",
                        "BZ" => "Belize",
                        "BJ" => "Benin",
                        "BM" => "Bermuda",
                        "BT" => "Bhutan",
                        "BO" => "Bolivia",
                        "BA" => "Bosnia and Herzegovina",
                        "BW" => "Botswana",
                        "BV" => "Bouvet Island",
                        "BR" => "Brazil",
                        "IO" => "British Indian Ocean Territory",
                        "BN" => "Brunei Darussalam",
                        "BG" => "Bulgaria",
                        "BF" => "Burkina Faso",
                        "BI" => "Burundi",
                        "KH" => "Cambodia",
                        "CM" => "Cameroon",
                        "CA" => "Canada",
                        "CV" => "Cape Verde",
                        "KY" => "Cayman Islands",
                        "CF" => "Central African Republic",
                        "TD" => "Chad",
                        "CL" => "Chile",
                        "CN" => "China",
                        "CX" => "Christmas Island",
                        "CC" => "Cocos (Keeling) Islands",
                        "CO" => "Colombia",
                        "KM" => "Comoros",
                        "CG" => "Congo",
                        "CD" => "Congo, The Democratic Republic of The",
                        "CK" => "Cook Islands",
                        "CR" => "Costa Rica",
                        "CI" => "Cote D'ivoire",
                        "HR" => "Croatia",
                        "CU" => "Cuba",
                        "CY" => "Cyprus",
                        "CZ" => "Czech Republic",
                        "DK" => "Denmark",
                        "DJ" => "Djibouti",
                        "DM" => "Dominica",
                        "DO" => "Dominican Republic",
                        "EC" => "Ecuador",
                        "EG" => "Egypt",
                        "SV" => "El Salvador",
                        "GQ" => "Equatorial Guinea",
                        "ER" => "Eritrea",
                        "EE" => "Estonia",
                        "ET" => "Ethiopia",
                        "FK" => "Falkland Islands (Malvinas)",
                        "FO" => "Faroe Islands",
                        "FJ" => "Fiji",
                        "FI" => "Finland",
                        "FR" => "France",
                        "GF" => "French Guiana",
                        "PF" => "French Polynesia",
                        "TF" => "French Southern Territories",
                        "GA" => "Gabon",
                        "GM" => "Gambia",
                        "GE" => "Georgia",
                        "DE" => "Germany",
                        "GH" => "Ghana",
                        "GI" => "Gibraltar",
                        "GR" => "Greece",
                        "GL" => "Greenland",
                        "GD" => "Grenada",
                        "GP" => "Guadeloupe",
                        "GU" => "Guam",
                        "GT" => "Guatemala",
                        "GG" => "Guernsey",
                        "GN" => "Guinea",
                        "GW" => "Guinea-bissau",
                        "GY" => "Guyana",
                        "HT" => "Haiti",
                        "HM" => "Heard Island and Mcdonald Islands",
                        "VA" => "Holy See (Vatican City State)",
                        "HN" => "Honduras",
                        "HK" => "Hong Kong",
                        "HU" => "Hungary",
                        "IS" => "Iceland",
                        "IN" => "India",
                        "ID" => "Indonesia",
                        "IR" => "Iran, Islamic Republic of",
                        "IQ" => "Iraq",
                        "IE" => "Ireland",
                        "IM" => "Isle of Man",
                        "IL" => "Israel",
                        "IT" => "Italy",
                        "JM" => "Jamaica",
                        "JP" => "Japan",
                        "JE" => "Jersey",
                        "JO" => "Jordan",
                        "KZ" => "Kazakhstan",
                        "KE" => "Kenya",
                        "KI" => "Kiribati",
                        "KP" => "Korea, Democratic People's Republic of",
                        "KR" => "Korea, Republic of",
                        "KW" => "Kuwait",
                        "KG" => "Kyrgyzstan",
                        "LA" => "Lao People's Democratic Republic",
                        "LV" => "Latvia",
                        "LB" => "Lebanon",
                        "LS" => "Lesotho",
                        "LR" => "Liberia",
                        "LY" => "Libyan Arab Jamahiriya",
                        "LI" => "Liechtenstein",
                        "LT" => "Lithuania",
                        "LU" => "Luxembourg",
                        "MO" => "Macao",
                        "MK" => "Macedonia, The Former Yugoslav Republic of",
                        "MG" => "Madagascar",
                        "MW" => "Malawi",
                        "MY" => "Malaysia",
                        "MV" => "Maldives",
                        "ML" => "Mali",
                        "MT" => "Malta",
                        "MH" => "Marshall Islands",
                        "MQ" => "Martinique",
                        "MR" => "Mauritania",
                        "MU" => "Mauritius",
                        "YT" => "Mayotte",
                        "MX" => "Mexico",
                        "FM" => "Micronesia, Federated States of",
                        "MD" => "Moldova, Republic of",
                        "MC" => "Monaco",
                        "MN" => "Mongolia",
                        "ME" => "Montenegro",
                        "MS" => "Montserrat",
                        "MA" => "Morocco",
                        "MZ" => "Mozambique",
                        "MM" => "Myanmar",
                        "NA" => "Namibia",
                        "NR" => "Nauru",
                        "NP" => "Nepal",
                        "NL" => "Netherlands",
                        "AN" => "Netherlands Antilles",
                        "NC" => "New Caledonia",
                        "NZ" => "New Zealand",
                        "NI" => "Nicaragua",
                        "NE" => "Niger",
                        "NG" => "Nigeria",
                        "NU" => "Niue",
                        "NF" => "Norfolk Island",
                        "MP" => "Northern Mariana Islands",
                        "NO" => "Norway",
                        "OM" => "Oman",
                        "PK" => "Pakistan",
                        "PW" => "Palau",
                        "PS" => "Palestinian Territory, Occupied",
                        "PA" => "Panama",
                        "PG" => "Papua New Guinea",
                        "PY" => "Paraguay",
                        "PE" => "Peru",
                        "PH" => "Philippines",
                        "PN" => "Pitcairn",
                        "PL" => "Poland",
                        "PT" => "Portugal",
                        "PR" => "Puerto Rico",
                        "QA" => "Qatar",
                        "RE" => "Reunion",
                        "RO" => "Romania",
                        "RU" => "Russian Federation",
                        "RW" => "Rwanda",
                        "SH" => "Saint Helena",
                        "KN" => "Saint Kitts and Nevis",
                        "LC" => "Saint Lucia",
                        "PM" => "Saint Pierre and Miquelon",
                        "VC" => "Saint Vincent and The Grenadines",
                        "WS" => "Samoa",
                        "SM" => "San Marino",
                        "ST" => "Sao Tome and Principe",
                        "SA" => "Saudi Arabia",
                        "SN" => "Senegal",
                        "RS" => "Serbia",
                        "SC" => "Seychelles",
                        "SL" => "Sierra Leone",
                        "SG" => "Singapore",
                        "SK" => "Slovakia",
                        "SI" => "Slovenia",
                        "SB" => "Solomon Islands",
                        "SO" => "Somalia",
                        "ZA" => "South Africa",
                        "GS" => "South Georgia and The South Sandwich Islands",
                        "ES" => "Spain",
                        "LK" => "Sri Lanka",
                        "SD" => "Sudan",
                        "SR" => "Suriname",
                        "SJ" => "Svalbard and Jan Mayen",
                        "SZ" => "Swaziland",
                        "SE" => "Sweden",
                        "CH" => "Switzerland",
                        "SY" => "Syrian Arab Republic",
                        "TW" => "Taiwan, Province of China",
                        "TJ" => "Tajikistan",
                        "TZ" => "Tanzania, United Republic of",
                        "TH" => "Thailand",
                        "TL" => "Timor-leste",
                        "TG" => "Togo",
                        "TK" => "Tokelau",
                        "TO" => "Tonga",
                        "TT" => "Trinidad and Tobago",
                        "TN" => "Tunisia",
                        "TR" => "Turkey",
                        "TM" => "Turkmenistan",
                        "TC" => "Turks and Caicos Islands",
                        "TV" => "Tuvalu",
                        "UG" => "Uganda",
                        "UA" => "Ukraine",
                        "AE" => "United Arab Emirates",
                        "GB" => "United Kingdom",
                        "US" => "United States",
                        "UM" => "United States Minor Outlying Islands",
                        "UY" => "Uruguay",
                        "UZ" => "Uzbekistan",
                        "VU" => "Vanuatu",
                        "VE" => "Venezuela",
                        "VN" => "Viet Nam",
                        "VG" => "Virgin Islands, British",
                        "VI" => "Virgin Islands, U.S.",
                        "WF" => "Wallis and Futuna",
                        "EH" => "Western Sahara",
                        "YE" => "Yemen",
                        "ZM" => "Zambia",
                        "ZW" => "Zimbabwe"); ?>
                    <!--country-->   <select name="country" class ="form-control" size="1" >

                        <?php
                        foreach($countries as $key => $value) {
                            ?>
                            <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                            <?php
                        }
                        ?> </select>
                    <label> Would you recommend my store? </label>
                    <input type="radio" name="recommendation" value="Yes" required>  Yes
                    <input type="radio" name="recommendation" value="No"> No


                    </select> <br/>
                </fieldset>


                <a href="index.html" class="button" width="100">Back</a>
                <?php
                if(!empty($_SESSION['shopping_cart'])):

                $total = 0;

                foreach($_SESSION['shopping_cart'] as $key => $product):
                    ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td>$ <?php echo $product['price']; ?></td>
                        <td>$ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
                        <td>
                            <a href="shop.php?action=delete&id=<?php echo $product['id']; ?>">
                                <div class="btn-danger">Remove</div>
                            </a>
                        </td>
                    </tr>

                    <?php
                    $total = $total + ($product['quantity'] * $product['price']);
                endforeach;
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <!-- Show checkout button only if the shopping cart is not empty -->
                    <td colspan="5">
                        <?php
                        if (isset($_SESSION['shopping_cart'])):
                        if (count($_SESSION['shopping_cart']) > 0):
                        ?>

                        <button type="submit" class="button" name="submit" >Checkout</button>

                        <?php
                        if(isset($_POST['submit']))
                        {
                            $date_clicked = date('Y-m-d H:i:s');;
                        }
                        ?>

            </form>

            <?php endif; endif; ?>
            </td>
            </tr>
            <?php
            endif;
            ?>
        </table>
    </div>
</div>
</body>
</html>
