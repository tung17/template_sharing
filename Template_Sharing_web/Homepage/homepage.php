<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Homepage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="../css/header.css"/>
	<link rel="stylesheet" type="text/css" href="../css/homepage.css">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
   	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="full-size">
            <?php
			include('../Header_Footer/header.php');
	?>
            <div id="body" class="row" style=" margin-right: 0px; margin-left: 0px;">	
                <div class="col-sm-4"></div>
                    <div id="introduce" class="col-sm-4">
                        <h1>Design without limits</h1>
                        <p>inspiring and ready-to-use photos, templates, fonts and assets. Unlimited downloads and free.</p>
                        <p>Template are now available</p>
                        <a href="../Templates/index.php"><input type="button" name="button" id="BROWSE" value="Browse now for free"></a>
                    </div>
                    <div class="col-sm-4"></div>
            </div>
            <div id="body_img" class="row" style=" margin-right: 0px; margin-left: 0px;">
                <div id="select" class="col-sm-12 col-md-12 col-lg-3">
                    <h2>Browse by categories</h2>
                        <div class="row option" id="presentation">
                            <strong>PRESENTATION TEMPLATES</strong>
                        </div>
                        <div class="row option" id="WEB">
                            <strong>WEB TEMPLATES</strong>
                        </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-9" id="image_contend">
                </div>
            </div>
            <div id="back_body" class="row" style=" margin-right: 0px; margin-left: 0px;">
                <div class="col-sm-6 content">
                    <h1><strong>One subscription.<br/>Unlimited downloads</strong></h1>
                    <p><strong>Beautiful ready to use photos, templates, fonts and assets.</strong></p>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-4 advertisement">
                    <h1><strong>FREE</strong></h1>
                    <ul>
                        <li>Unlimited downloads</li>
                        <li>57 web templates</li>
                        <li>55 presentation templates</li>
                        <li>Commercial license</li>
                        <li>beautiful and unique</li>
                        <li>AND CO membership for free</li>
                        <li>Cancel anytime</li>
                    </ul>
                    <a href="../Access/register.php"><button>GO UNLIMITTED</button></a>
                </div>
            </div>
            <div id="end_body" class="row" style=" margin-right: 0px; margin-left: 0px;">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 summary">
                    <img src="../images/homepage/license.png" style="height: 100px; width:200px; padding: 10px;">
                    <h1>LICENSE</h1>
                    <h2>© Copyright 2017</h2>
                    <p>This is a template-sharing website created by HCMUT students, contributed by the community and the efforts of members in the search, design. The site is completely free. You can download, share and use for any purpose
                    </p>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <?php
			include("../Header_Footer/footer.php");
			?>
        </div>
<script>
    var image = document.getElementById("image_contend");
    var web = document.getElementById("WEB");
    var presentation = document.getElementById("presentation");

web.onclick = function()
{
    image.innerHTML = "<div class=\"row\" style=\" margin-right: 0px; margin-left: 0px;\">"+
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=0&name=Ben - Creative Portfolio\"><img class=\"img-responsive\" src=\"../images/templates/web/Ben - Creative Portfolio.jpg\" alt=\"\"></a>" +
                        "</div>" +
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=0&name=Rigo - Responsive Emailand Newsletter Template\"><img class=\"img-responsive\" src=\"../images/templates/web/Rigo - Responsive Emailand Newsletter Template.jpg\" alt=\"\"></a>" +
                        "</div>" + 
                        "<div class=\"col-sm-4\">" +
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=0&name=Mr Resume - One Page Resume Personal\"><img class=\"img-responsive\" src=\"../images/templates/web/Mr Resume - One Page Resume Personal.jpg\" alt=\"\"></a>"+
                        "</div>"+
                    "</div>" + 
                    "<div class=\"row\" style=\" margin-right: 0px; margin-left: 0px;\">"+
                        "<div class=\"col-sm-4\">" + 
                            "<br/>"+
                            "<a href=\"../Templates/search_result.php?mode=0&name=Clymene - Creative Multipurpose HTML Template + WP\"><img class=\"img-responsive\" src=\"../images/templates/web/Clymene - Creative Multipurpose HTML Template + WP.jpg\" alt=\"\"></a>" +
                        "</div>"+
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=0&name=Big Stream - One Page Multi - Purpose Template\"><img class=\"img-responsive\" src=\"../images/templates/web/Big Stream - One Page Multi - Purpose Template.jpg\" alt=\"\"></a>" +
                        "</div>" +
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=0&name=Grafika - Photography & Blog HTML Template.jpg\"><img class=\"img-responsive\" src=\"../images/templates/web/Grafika - Photography & Blog HTML Template.jpg\" alt=\"\"></a>"+
                        "</div>"+
                    "</div>";
}
window.onload = function()
{
    image.innerHTML = "<div class=\"row\" style=\" margin-right: 0px; margin-left: 0px;\">"+
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Enjoy PowerPoint Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Enjoy PowerPoint Template.jpg\" alt=\"\"></a>" +
                        "</div>" +
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Eco Business Presentation Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Eco Business Presentation Template.jpg\" alt=\"\"></a>" +
                        "</div>" + 
                        "<div class=\"col-sm-4\">" +
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Endless Blue PowerPoint Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Endless Blue PowerPoint Template.jpg\" alt=\"\"></a>"+
                        "</div>"+
                    "</div>" + 
                    "<div class=\"row\" style=\" margin-right: 0px; margin-left: 0px;\">"+
                        "<div class=\"col-sm-4\">" + 
                            "<br/>"+
                            "<a href=\"../Templates/search_result.php?mode=1&name=Granite Powerpoint Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Granite Powerpoint Template.jpg\" alt=\"\"></a>" +
                        "</div>"+
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Genius Project Presentation Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Genius Project Presentation Template.jpg\" alt=\"\"></a>" +
                        "</div>" +
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Pitch Vol.3 - Professional Keynote Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Pitch Vol.3 - Professional Keynote Template.jpg\" alt=\"\"></a>"+
                        "</div>"+
                    "</div>";
} 
presentation.onclick = function()
{
    image.innerHTML = "<div class=\"row\" style=\" margin-right: 0px; margin-left: 0px;\">"+
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Enjoy PowerPoint Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Enjoy PowerPoint Template.jpg\" alt=\"\"></a>" +
                        "</div>" +
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Eco Business Presentation Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Eco Business Presentation Template.jpg\" alt=\"\"></a>" +
                        "</div>" + 
                        "<div class=\"col-sm-4\">" +
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Endless Blue PowerPoint Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Endless Blue PowerPoint Template.jpg\" alt=\"\"></a>"+
                        "</div>"+
                    "</div>" + 
                    "<div class=\"row\" style=\" margin-right: 0px; margin-left: 0px;\">"+
                        "<div class=\"col-sm-4\">" + 
                            "<br/>"+
                            "<a href=\"../Templates/search_result.php?mode=1&name=Granite Powerpoint Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Granite Powerpoint Template.jpg\" alt=\"\"></a>" +
                        "</div>"+
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Genius Project Presentation Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Genius Project Presentation Template.jpg\" alt=\"\"></a>" +
                        "</div>" +
                        "<div class=\"col-sm-4\">"+
                            "<br/>" +
                            "<a href=\"../Templates/search_result.php?mode=1&name=Pitch Vol.3 - Professional Keynote Template\"><img class=\"img-responsive\" src=\"../images/templates/presentation/Pitch Vol.3 - Professional Keynote Template.jpg\" alt=\"\"></a>"+
                        "</div>"+
                    "</div>";
}
</script>
</body>
</html>