<?php 
require("includes/user_auth.php");
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';



// deals with url stuff
if (!isset($_SESSION['loginstate'])) {
    header("location: ../login");
    exit();
} elseif ($_SESSION['loginstate'] === "A") {
    header("location: ../emailverification");
    exit();
} elseif ($_SESSION['loginstate'] === "B") {
    header("location: ../googleauthentication");
    exit();
} elseif (!$_SESSION['loginstate'] === "OK") {
    header("location: ../logout");
    exit();
}

$userid = $_SESSION['userid'];


$query = $conn->prepare("SELECT user_username, user_fname,user_lname,user_role,username_email,
user_number,date_of_signup
FROM mydb.users WHERE user_id = $userid;");

if($query->execute()){

    $query->bind_result($username,$fname,$lname,$role,$email,$number,$dateofsignup);

    if($query->execute()){

        if($query->fetch()){
            echo "<form method=POST>";
            echo "Username"."<br>";
            echo "<input type='text' name='username' value='$username'><br>";
            

            echo "Fname"."<br>";
            echo "<input type='text' name='fname' value='$fname'><br>";

            echo "Lname"."<br>";
            echo "<input type='text' name='lname' value='$lname'><br>";

            

            echo "Email"."<br>";
            echo "<input type='text' name='email' value='$email'><br>";

            echo "Number"."<br>";
            echo "<input type='text' name='number' value='$number'><br><br>";

            echo "Date: ".$dateofsignup."<br>";

            if($role==0){
                echo "Type: Normal User <br><br>";
            } elseif($role==6){
                echo "Type: Server Admin <br><br>";
            } elseif($role==2){
                echo "Type: Employee Manager <br><br>";
            }

            echo '<input type="submit" value="update" name="submit" formaction="/swapproj/updateprofile">';
            echo '<input type="submit" value="delete" name="submit" formaction="/swapproj/deleteprofile">';

            echo "</form>";


            if(isset($_GET['type'])){
                if($_GET['type']=='success'){
                    echo "updated succesfully";
                }
            }
            

            

        }
        
        
    }else {
        header("location: ../swapproj/userprofile?error=stmtfailed");
        exit();
    }

}





?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
setInterval(function(){
    check_user();
},2000);
function check_user(){
    jQuery.ajax({
        url:'https://www.swapamc.com/swapproj/check',
        type:'post',
        data:'type=ajax',
        success:function(result){
            console.log(result);
            let text = result.includes("logout");
            if(text==true){
                window.location.href="https://www.swapamc.com/swapproj/logout";
            }
        }

    });
}
</script>

