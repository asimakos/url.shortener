<html>

<head>
  <title>URL Shortener</title>
   <link rel="stylesheet" type="text/css" href="css/url_form.css">
  <script type="text/javascript" src="js/url_form.js"> </script>
</head>

<body>

<?php
 // PHP classes to implement the API URL shortener and to be
 // used in this script

 require('./apiservices/googleurl.php');
 require('./apiservices/bitlyurl.php');
 require('./apiservices/tinyurl.php');

?>

<!-- HTML form where the user enters URL address to be truncated.
     URL address should be a valid in order to be truncated, otherwise
     an error message appears informing the user!
     The validation of URL is done via javascript (client side) and not via PHP (server side).
 -->

<form id="url_form" method='POST' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validate_url()">
<table border="1">
  <tr>
     <td>
        <label for="url_address">Enter your Web address:</label>
     </td>
  </tr>
  <tr>
    <td>
       <textarea id="url_address" name="url_address" rows="4" cols="50" onFocus="clear_data()">
       <?php  if (isset($_POST['url_address']))
         echo trim($_POST['url_address']);
         else
         echo "Enter here ...."; ?>
        </textarea>
    </td>
    <td>
    <!-- The user sees the results in an HTML table  -->
       <button type="submit" name="Submit">Display</button> &nbsp;
    <!-- The user resets the textarea field for another attempt -->
       <button type="button" onclick="clear_data()">Clear</button>
    </td>
  </tr>
</table>
<br/>
<br/>
<div id="message"></div>
<br/>

 <?php
 // Initialization of the required API variables (keys) to be used in
 // these URL Shortener Web Services

 if (isset($_POST['Submit'])){

 $url_address=trim($_POST['url_address']);

 // Google Shortener URL API
 $google_key = 'AIzaSyDJlUPj987ds8jHtcQTC_NP3uyBB0F5r5w';
 $googler = new GoogleUrl($google_key);

 // Bitly Shortener URL API
 $bitly_login='asimkon';
 $bitly_appkey='R_ebb1b9ff52844920a925427407585c8e';
 $bitler=new BitlyUrl($url_address,$bitly_login,$bitly_appkey);

 //Tiny Shortener URL API
 $tinyler=new TinyUrl();

?>

 <table border='1'>

   <tr class='header'>
      <th> Service Shortener API   </th>
      <th> Short Url  </th>
      <th> Long Url  </th>
   </tr>
   <tr class='data'>
      <!-- Google API Shortener and expander result  -->
      <td> Google Shortener API   </td>
      <td> <?php echo $googler->shorten($url_address);
            $short_address=$googler->shorten($url_address); ?> </td>
      <td> <?php echo $googler->expand($short_address); ?>  </td>
   </tr>
   <tr class='data'>
       <!-- Bitly API Shortener and expander result -->
      <td> Bitly Shortener API  </td>
      <td> <?php echo $bitler->get_bitly_short_url();
            $short_address=$bitler->get_bitly_short_url(); ?></td>
      <td><?php echo $bitler->get_bitly_long_url($short_address); ?> </td>
   </tr>
   <tr class='data'>
      <!-- Tiny API Shortener and expander result -->
      <td> Tiny Shortener API  </td>
      <td> <?php echo $tinyler->get_tiny_url($url_address);?></td>
      <td> <?php echo  $url_address; ?> </td>
   </tr>
 </table>

<?php

}
 ?>

 </form>

</body>

</html>