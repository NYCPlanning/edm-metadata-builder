 <?php

try { 
    $db = new PDO("pgsql:dbname=postgres;host=localhost","amolivani");
}   
catch(PDOException $e) {
    echo $e->getMessage();
}

 if(isset($_POST["Export"])){
         
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $query = "COPY info TO '/Users/amolivani/Desktop/info.csv' DELIMITER ',' CSV HEADER";  
      $result = $db->query($query); 
    
 }  

?> 