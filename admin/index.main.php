<?php
  require(__DIR__."/../config/connection.php");

  function errorMsg($msg){
    echo "<script type='text/javascript'>
            window.alert('".$msg."');
          </script>";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Stop n Shop : Admin Console</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="bodydiv">

      <!-- categories Section -->
      <div class="sectiondiv categoriesdiv">
        <div class="formdiv">
          <h2>Categories</h2>
          <fieldset>
            <legend>Add a New Category</legend>
            <form class="categoriesform" name='categoriesform' id='categoriesform' action="" method="post">
              <span class='labelspan'><label for='cat_name' onclick="notEmptyValid(document.getElementById('cat_name').value,document.getElementById('cat_name').id)">Category Name</label></span>
              <input type="text" name="cat_name" id='cat_name' placeholder="New Category Name" onkeyup="notEmptyValid(this.value,this.id)" onmousedown="notEmptyValid(this.value,this.id)"/>
              <br><span class='errorspan' id='cat_name_empty'>Category name cannot be empty.</span><br>

              <button type="submit" name="cat_submit" id='cat_submit'>Add Category</input>
            </form>
          </fieldset>
        </div>

        <div class="tablediv">
          <table id='categoriestable'>

          </table>
        </div>
      </div>

      <!-- Products Section -->
      <div class="sectiondiv productsdiv">

        <div class="formdiv">
          <h2>Products</h2>
          <fieldset>
            <legend>Add a New Product</legend>
            <form class="productsform" name='productsform' id='productsform' action="" method="post" enctype="multipart/form-data">
              <span class='labelspan'><label for='prod_name' onclick="notEmptyValid(document.getElementById('prod_name').value,document.getElementById('prod_name').id)">Product Name</label></span>
              <input type="text" name="prod_name" id='prod_name' placeholder="New Product Name" onkeyup="notEmptyValid(this.value,this.id)" onmousedown="notEmptyValid(this.value,this.id)"/>
              <br><span class='errorspan' id='prod_name_empty'>Product name cannot be empty.</span><br>

              <span class='labelspan'><label for="prod_cat_name" onclick="notEmptyValid(document.getElementById('prod_cat_name').value,document.getElementById('prod_cat_name').id)">Category of New Product</label></span>
              <input type="text" name="prod_cat_name" id="prod_cat_name" onkeyup='notEmptyValid(this.value,this.id)' onmousedown="notEmptyValid(this.value,this.id)" placeholder="Category Name"/>
              <br><span class='errorspan' id='prod_cat_name_empty'>Product must belong to some existing category.</span><br>

              <span class='labelspan'><label for='prod_desc' onclick="notEmptyValid(document.getElementById('prod_desc').value,document.getElementById('prod_desc').id)">Product Descritpion</label></span>
              <textarea name="prod_desc" id="prod_desc" placeholder="Description of Product" onkeyup='notEmptyValid(this.value,this.id)' onmousedown="notEmptyValid(this.value,this.id)" rows='8'></textarea>
              <br><span class='errorspan' id='prod_desc_empty'>Product description cannot be empty.</span><br>

              <span class='labelspan'><label for="prod_price" onclick="notEmptyValid(document.getElementById('prod_price').value,document.getElementById('prod_price').id)">Price of New Product</label></span>
              <input type="number" name="prod_price" id="prod_price" onkeyup='notEmptyValid(this.value,this.id)' onmousedown="notEmptyValid(this.value,this.id)" placeholder="Price"/>
              <br><span class='errorspan' id='prod_price_empty'>The product must have a price associated with it</span><br>

              <span class='labespan'><label for='prod_image'>Product Image</label></span>
              <input type="file" name="prod_image" id='prod_image' onchange="displayImgPrev(this)" onclick="notEmptyValid('1',this.id)">
              <span class='filespan' onclick="$('#prod_image').click()">Choose Product Image<br><img id='prod_upload_image' src='#' alt='image'></span>
              <br><span class='errorspan' id='prod_image_empty'>Upload an image of the image.</span><br>

              <button type="submit" name="prod_submit" id='prod_submit'>Add Product</input>
            </form>
          </fieldset>
        </div>

        <div class="tablediv">
          <table id='productstable'>

          </table>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript" src='../js/admin.js'></script>
</html>
