<html>

<body>
    COngratulations on logging in
    <?php
    session_start();
    echo $_SESSION['username'];
    ?>
</body>

</html>