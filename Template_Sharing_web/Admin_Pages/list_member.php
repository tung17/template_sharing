<?php
session_start();
include 'database.php';
include 'user.php';
include 'pagination.php';
include 'security.php';
?>
<?php
$Pagination = new Pagination();
$user = new user();
$security = new security();
$limit = $Pagination->limit;
$start = $Pagination->start();
$TotalRecord = $user->totalRecord();
$TotalPages = $Pagination->totalPages($TotalRecord);
$listUsers = $user->listUsers($start, $limit);
?>
<?php if (($security->checkadmin())==TRUE)
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>list_member</title>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css"/>
  <link rel="stylesheet" type="text/css" href="../css/header.css"/>
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="full-size"> 
      <?php include '../Header_Footer/header.php'; ?>
<div class="row" style="margin-right: 0; margin-left: 0"> 
  <h1 class="text-center">Manage Member</h1> 
  <div class="col-md-10 col-md-offset-1"> 
   <div class="panel panel-default panel-table"> 
    <div class="panel-heading"> 
     <div class="row"> 
      <div class="col col-xs-6"> 
       <h3 class="panel-title">List Member</h3> 
      </div> 
      <div class="col col-xs-6 text-right"> 
          <button type="button" class="btn btn-sm btn-primary btn-create" id="themmoi">ADD MEMBER</button>
      </div> 
     </div> 
    </div> 
    <div class="panel-body">
    <div class="row">
     <table class="table table-striped table-bordered table-list"> 
      <thead> 
       <tr> 
        <th><em class="fa fa-cog"></em>
        </th> 
        <th>Index</th> 
        <th>Join Day</th>
        <th>LastName</th>
        <th>FirstName</th>
        <th>UserName</th>
        <th>Email</th> 
       </tr>    
      </thead> 
      <tbody>
      <?php $stt=1; ?>
      <?php foreach($listUsers as $items){ ?>
      <tr> 
          <td align="center">
              <a <?php echo "href='../Access/myaccount.php?memberID=".$items["MemberID"]."'" ?> class="btn btn-default"><em class="fa fa-pencil"></em></a> 
              <a <?php echo "href='delete_member.php?memberID=".$items["MemberID"]."'" ?> class="btn btn-danger"><em class="fa fa-trash"></em></a>
       </td>
       <td><?php echo $stt; ?></td>
       <td><?php echo $items['JoinDate'] ?></td>
       <td><?php echo $items['LastName']; ?></td> 
       <td><?php echo $items['FirstName']; ?></td>
       <td><?php echo $items['Username']; ?></td>
       <td><?php echo $items['Email']; ?></td> 
      </tr> 
      <?php $stt++; } ?>
     </tbody>
     </table>
    </div>
    </div> 
    <div class="panel-footer"> 
     <div class="row"> 
      <div class="col col-xs-4">Page 1</div> 
      <div class="col col-xs-8"> 
       <ul class="pagination hidden-xs pull-right"> 
        <li><?php echo $Pagination->listPages($TotalPages); ?></li>
       </ul> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
 </div>
</div>
    <script>
        var them = document.getElementById("themmoi");
        them.onclick = function()
        {
            window.location="../access/register.php";
        }
    </script>
    <?php include '../Header_Footer/footer.php'; ?>
</body>
</html>
<?php }
else
{
    echo "<script> alert(\"This is page for admin\"); window.location=\"../access/login.php\";</script>";
}
?>