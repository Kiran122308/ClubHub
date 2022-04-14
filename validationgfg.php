<?php
$name=$_POST['name'];
$roll=$_POST['roll'];
$branch=$_POST['branch'];
$section=$_POST['section'];
$gmail=$_POST['gmail'];
if(!empty($name) || !empty($roll) || !empty($branch)|| !empty($section)|| !empty($gmail))
{
  $host="localhost";
  $dbusername="root";
  $dbpassword="";
  $dbname="webtech";

  $con=new mysqli($host, $dbusername, $dbpassword, $dbname);
  if(mysqli_connect_error())
  {
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
  }
  else{
    $SELECT="SELECT gmail from gfg where gmail=? Limit 1";
    $INSERT="INSERT INTO gfg(name,roll,branch,section,gmail) values(?,?,?,?,?)";

  $st=$con->prepare($SELECT);
  $st->bind_param("s",$gmail);
  $st->execute();
  $st->bind_result($gmail);
  $st->store_result();
  $rnum=$st->num_rows;

  if($rnum==0)
  {
    $st->close();
    $st=$con->prepare($INSERT);
    $st->bind_param("sssss",$name,$roll,$branch,$section,$gmail);
    $st->execute();
    echo "Thanks for registering";
  }
  else
  {
    echo "You have already registered with this gmail";
  }
  $st->close();
  $con->close();
  }
}
else{
  echo "All fields are required";
  die();
}
?>
