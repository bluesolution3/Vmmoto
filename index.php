<?php

require_once "config.php";

$controller = $_GET['controller'] ?? 'configuration';
$action     = $_GET['action'] ?? 'index';

/*
|--------------------------------------
| Handle CSV Export BEFORE HTML Layout
|--------------------------------------
*/

if($controller == "payment" && $action == "exportCSV"){

    require_once "App/Controllers/PaymentController.php";

    $ctrl = new PaymentController($pdo);
    $ctrl->exportCSV();

    exit; // stop HTML from loading
}

?>

<!DOCTYPE html>
<html>

<head>

<title>VeMotto Admin Panel</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
}

.sidebar{
height:100vh;
width:220px;
position:fixed;
background:#1f2937;
color:white;
}

.sidebar h5{
padding:20px;
border-bottom:1px solid #374151;
}

.sidebar a{
color:#cbd5e1;
padding:12px 20px;
display:block;
text-decoration:none;
}

.sidebar a:hover{
background:#374151;
color:white;
}

.sidebar .active{
background:#2563eb;
color:white;
}

.main-content{
margin-left:220px;
padding:30px;
}

</style>

</head>

<body>

<div class="sidebar">

<h5>VeMotto Admin</h5>

<a href="index.php?controller=configuration&action=index"
class="<?= ($controller=='configuration')?'active':'' ?>">
⚙ Configuration
</a>

<a href="index.php?controller=promotion&action=index"
class="<?= ($controller=='promotion')?'active':'' ?>">
📩 Promotions
</a>

<a href="index.php?controller=payment&action=index"
class="<?= ($controller=='payment')?'active':'' ?>">
💳 Payments
</a>

</div>

<div class="main-content">

<?php

switch($controller){

case "configuration":

require_once "App/Controllers/ConfigurationController.php";
$ctrl = new ConfigurationController($pdo);
break;

case "promotion":

require_once "App/Controllers/PromotionController.php";
$ctrl = new PromotionController($pdo);
break;

case "payment":

require_once "App/Controllers/PaymentController.php";
$ctrl = new PaymentController($pdo);
break;

default:

die("Controller not found");

}

if(method_exists($ctrl,$action)){
$ctrl->$action();
}else{
echo "Action not found";
}

?>

</div>

</body>
</html>
