<?php
	session_start();
?>
<head>
	<link rel="stylesheet" href="/views/style/dashboard.css">
</head>
<body>
<div id="info-account">
	user : <?php echo $_SESSION['user'];?><br>
	mail : <?php echo $_SESSION['mail'];?><br>

</div>

<div id="score">


</div>

</body>
