<html>

<body>
  <form method="post" action="/swapproj/forgetpasswordinc">
    <p>Enter Email Address To Send Password Link</p>
    <label>Email:</label><br>
    <input type="email" name="email"><br><br>
    <input type="submit" name="submit_email" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"><br><br>
    <a href="https://www.swapamc.com/swapproj/login">Back to login page</a>
  </form>
</body>

</html>

<?php
if (isset($_GET['email'])) {
  if ($_GET["email"] == "sent") {
    echo "<p>Email sent success. </p>";
    exit();

  } elseif ($_GET["email"] == "failed") {
    echo "<p>Email failed to sent. </p>";
    exit();

  } elseif ($_GET["email"] == "expired") {
    echo "<p>Email Link have expired. </p>";
    exit();

  }
}

if (isset($_GET['error'])) {
  if ($_GET["error"] == "invalidemail") {
    echo "<p> Invalid email. Try another email. </p>";
    exit();

  }
  elseif ($_GET["error"] == "invalidurl") {
    echo "<p> Invalid URL. Redo the process. </p>";
    exit();

  }
  elseif ($_GET["error"] == "invalidgoogleauth") {
    echo "<p> Invalid Google Authentication. Redo the process. </p>";
    exit();

  }
  elseif ($_GET["error"] == "stmtfailed") {
    echo "<p> STMT Error. </p>";
    exit();
  }
}
?>