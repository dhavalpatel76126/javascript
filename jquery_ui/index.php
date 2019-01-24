<?php
// Define needed credentials.
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$sql = "SELECT * FROM listitems where is_completed = 'no'";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Connect lists</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
  #sortable1, #sortable2 {
    border: 1px solid #eee;
    width: 142px;
    min-height: 20px;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
  }
  #sortable1 li, #sortable2 li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em;
    width: 120px;
  }
  img{
      width: 100px;
      height:100px;
  }
  img:hover{
     border: solid; 
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable1, #sortable2" ).sortable({

connectWith: ".connectedSortable"
  
}).disableSelection();

    $( "#sortable2" ).droppable({
 
    drop: function( event, ui ) {
   
     $(this).addClass( "ui-state-highlight" );

     var itemid = ui.draggable.attr('id')
      
     $.ajax({
        method: "POST",
        url: "update.php",
        data:{'itemid': itemid}, 
     })
    }
 });

 $( "#sortable1" ).droppable({
 
 drop: function( event, ui ) {
 
  $(this).addClass( "ui-state-highlight" );

  var itemid = ui.draggable.attr('id')

  $.ajax({
     method: "POST",
     url: "update2.php",
     data:{'itemid': itemid}, 
  })
 }
});
    
  } );
  </script>
</head>
<body>
<ul id="sortable1" class="connectedSortable">
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
  <li class="ui-state-default" id="<?=$row['id']?>"><?=$row['name']?></li>
<?php } ?>
</ul>
<ul id="sortable2" class="connectedSortable">
    <?php 
    $sql2 = "SELECT * FROM listitems where is_completed = 'yes'";
    $result2 = mysqli_query($conn, $sql2);
    while($row2 = mysqli_fetch_assoc($result2)){ 
    ?>
  <li class="ui-state-highlight" id="<?=$row2['id']?>"><?=$row2['name']?></li>
    <?php }?>
</ul>
</body>
</html>