<?php
echo "<h3>RAM:</h3><pre>" . shell_exec('free -h') . "</pre>";
echo "<h3>Disco:</h3><pre>" . shell_exec('df -h') . "</pre>";
?>