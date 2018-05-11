<?php  
  include('db.php');
  $setSql = "SELECT * FROM users";  
  $setRec = mysqli_query($conn, $setSql);  
    
  $columnHeader = '';  
  $columnHeader = "id" . "\t" . "User Name" . "\t" . "Name" . "\t" . "Address" . "\t". "Email" . "\t". "Phone" . "\t". "Password" . "\t". "DOB" . "\t". "Link Avatar" . "\t". "Gender" . "\t". "User type" . "\t";  
    
  $setData = '';  
    
  while ($rec = mysqli_fetch_row($setRec)) {  
      $rowData = '';  
      foreach ($rec as $value) {  
          $value = '"' . $value . '"' . "\t";  
          $rowData .= $value;  
      }  
      $setData .= trim($rowData) . "\n";  
  }  
    
    
  header("Content-type: application/octet-stream; charset=utf-8");  
  header("Content-Disposition: attachment; filename=Users.xls; charset=utf-8");  
  header("Pragma: no-cache");  
  header("Expires: 0");  
  echo ucwords($columnHeader) . "\n";
  echo mb_convert_encoding($setData,'utf-32','utf-8');  
  ?>