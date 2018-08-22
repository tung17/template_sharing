<?php
include 'database.php';
$database = new database();
if($_GET['x'] == "Web")
$sql = "select * from template WHERE KindID='1'";
else {
$sql = "select * from template WHERE KindID='2'";
}
$database ->query($sql);
$q = $_REQUEST["q"];
$hint = "";
if($q !== "")
{
    $result = $database->fetchAll();
    $q = strtolower($q);
    $len=strlen($q);
    foreach($result as $name) {
        if (stristr($q, substr($name['Name'], 0, $len))) {
            if ($hint === "") {
                $hint = "<p"." id=\"".$name['TemplateID']."\""." onclick=\"take_data(".$name['TemplateID'].")"."\""." >".$name['Name']."</p>";
            } else {
                $hint .= "<p"." id=\"".$name['TemplateID']."\""." onclick=\"take_data(".$name['TemplateID'].")"."\""." >".$name['Name']."</p>";
            }
        }
    }
}
echo $hint;
?>
