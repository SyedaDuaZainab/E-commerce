<?php
        include"Element/navbar.php";
        if (isset($_SESSION['msg'])) {
          echo "<script>alert('".$_SESSION['msg']."');</script>";
          unset($_SESSION['msg']);
        }
         
echo"

<body>
    <main>
        <div class='intro'>
           <img src='images/Z-logo.png' alt='ZayNah'>
           <div class='in-des'>
            <h1>Welcome! to <span>Zaynah</span></h1>
            <h3>Unveil elegance with ZayNah<br>where timeless tradition meets modern luxury<br>It's the fashion that defines our souls</h3>
           </div>
        </div>
        <div class='head'>
            <h1>Categories to Explore</h1>
        </div>";
  $cat = "SELECT * FROM category";
  $newcat = mysqli_query($conn, $cat);
  if (mysqli_num_rows($newcat) > 0) {
    echo"<div class='contain'>";
      while ($row = mysqli_fetch_assoc($newcat)){

    echo"<a href='Category.php?id={$row['Cat_id']}'><div class='category'>
        <img src='images/{$row['Picture']}' alt='{$row['Name']}'>
        <h1>{$row['Name']}</h1>  
        </div></a>";
      }
  }
  include"Element/footer.html";
?>