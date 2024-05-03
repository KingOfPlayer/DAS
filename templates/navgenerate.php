<?php
$navbegin = "
<header class=\"header border-bottom border-2\" >
	<div class=\"header-inner\">
		<div class=\"container\">
			<div class=\"inner\">
				<div class=\"row justify-content-between align-items-center padding-tb-20px\">
";

$navend = "					
				</div>
			</div>
		</div>
	</div>
</header>
";

$nav = "";

function addLogoToNav($link){
	global $nav;
	$nav .= "
		<div class=\"col-lg-3 col-md-3 col-12\">
				<a href=\"$link\"><img src=\"/img/logo.png\" alt=\"#\"></a>
		</div>
	";
}

function addToNav($element){
	global $nav;
	$nav .= $element;
}

function dumpNav(){
	global $navbegin,$nav,$navend;
	echo $navbegin;
	echo $nav;
	echo $navend;
}

?>