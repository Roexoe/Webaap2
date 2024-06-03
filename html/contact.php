<?php
 
include_once("header.php");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="margin"></div>
    <div class="container">
  <img src="img/overonsoceaan.jpg" alt="Overons" class="background-image">
  <div class="text-over-image">
    <div class="tekstblokblok">
    <div class="contact-titel">Contact</div>
    <div class="contact-blok">
    <form class="form">
    <div class="flex">
<label>
    <input required="" placeholder="" type="text" class="input">
    <span>first name</span>
</label>
 
        <label>
<input required="" placeholder="" type="text" class="input">
    <span>last name</span>
</label>
</div>  
<label>
    <input required="" placeholder="" type="email" class="input">
    <span>email</span>
</label> 
    <label>
    <input required="" type="tel" placeholder="" class="input">
    <span>contact number</span>
</label>
<label>
    <textarea required="" rows="3" placeholder="" class="input01"></textarea>
    <span>message</span>
</label>
<button class="fancy" href="#">
    <span class="top-key"></span>
    <span class="text">submit</span>
    <span class="bottom-key-1"></span>
    <span class="bottom-key-2"></span>
</button>
</form>
    </div>
  </div>
</div>
    <?php
 
    include_once("footer.php");
 
    ?>
</body>
</html>