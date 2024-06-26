<?php
//@Reference:Andropov Ajuatah Ajebua, “Building a Secure Login and Registration System with HTML, CSS, JavaScript, PHP, and MySQL,” Medium, Apr. 12, 2024. https://medium.com/@ajuatahcodingarena/building-a-secure-login-and-registration-system-with-html-css-javascript-php-and-mysql-591f839ee8f3 (accessed Jul. 22, 2024).
session_start();
session_unset();
session_destroy();
header("Location: index.html");
exit();
?>
