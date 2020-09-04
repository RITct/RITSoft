<?php
session_start();
?>
<html>
<head>
<script language="JavaScript"><!--
javascript:window.history.forward(0);
//--></script>
</head>
<body>
<?php
unset($_SESSION['u']);
unset($_SESSION['a']);
session_destroy();
echo "<script>window.location.href='../login.php'</script>";
?>
</body>
</html>