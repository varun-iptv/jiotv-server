<?php
echo '<table cellpadding="10">' ;
foreach ($_SERVER as $parm => $value) {
echo '<tr><td>'.$parm.'</td><td>' . $value . '</td></tr>' ;
}
echo '</table>';
?>
