<?php//if review posted by user currently signed in

$reviewidparent = $allparents[$i]['review_id'];
$profilepicture = $image->show($allparents[$i]['review_pic']);
$likes = $allparents[$i]['review_total_likes'];
$dislikes = $allparents[$i]['review_total_dislikes'];

echo "<form class='parentsectionreviews' method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";

//parentprofilepic
echo "<div class='parentleft'>";
    echo "<div class='circle'>";
    echo "</div>";
echo "</div>";

echo '<div class="parentright">';

    echo "<div class='usernamereviewcontainer'>";
        echo "<h4 class='usernamereview'>".$allparents[$i]['user_username']."</h4>";
        echo "<div class='kea'>";
            echo "<a class=\"kebab-link\" data-toggle=\"dropdown\" data-target=\"#dropdown1\"><i class=\"fa fa-ellipsis-v\"></i></a>";
            echo "<div class=\"dropdown kebab-dropdown dropdown-sm\" id=\"dropdown1\">";
                echo "<div class=\"dropdown-menu dropdown-unroll dropdown-menu-right\">";
                    echo "<a id='delete$reviewidparent' class=\"dropdown-item\" href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewidparent&csrf=$csrf"."'>Delete Review</a>";
                    echo "<div class=\"dropdown-divider\"></div>";
                    echo "<a id='editbutton$reviewidparent'  onclick='editReview($reviewidparent)' class=\"dropdown-item\">Edit Review</a>";
                    
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";

    
    echo "<input type='hidden' name='csrf' value='$csrf'>";
    // echo "<p>Username: ".$allparents[$i]['user_username']."</p>";

    // echo "<div id='image$reviewidparent'>";
    // echo '<img  width="100px" src="'.$profilepicture.'" />';
    // echo "</div>";

    // echo "<br>";
    getRating($allparents[$i]['review_rating'],$reviewidparent);

    echo "<div id='rating$reviewidparent'>";
    
    echo "</div>";
    
    

    echo "<div id='comment$reviewidparent'>";
    echo "<p class='reviewdetails'>Comment: ".$allparents[$i]['review_comment']."</p>";
    echo "</div>";

    // echo "<div id='rating$reviewidparent'>";
    // echo "<p>Rating: ".$allparents[$i]['review_rating']."</p>";
    // echo "</div>";

    echo "<div class=\"imagescontainer\">";
        echo "<div class='picturesreview'>";
        
        echo "</div>";
    
        echo "<div class=\"picturesreview\">";
        
        echo "</div>";
    echo "</div>";

    echo "<p class='date'>".$allparents[$i]['review_date']."</p>";

    
    echo "<div id=likeordislike>";
        
        
        

        if(in_array($reviewidparent,$listwhichuserliked)){
            //if its liked already
            echo "<span id='likeid$reviewidparent' class='like'>".$allparents[$i]['review_total_likes']."&nbsp&nbsp<i  style='color:#73C2FB;opacity:0.8;' class=\"fas fa-chevron-up\"></i></span>";
            // echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
            // echo "<h4 id='likesbutton$reviewid'>Liked</h4>";
        } else {
            echo "<span id='likeid$reviewidparent' class='like'>".$allparents[$i]['review_total_likes']."&nbsp&nbsp<i onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)' class=\"fas fa-chevron-up\"></i></span>";
            // echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
            // echo "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)'>Like</button>";

        }
        

        
        if(in_array($reviewidparent,$listwhichuserdisliked)){
            //if its disliked already
            // echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
            // echo "<h4 id='dislikesbutton$reviewid'>Disliked</h4>";
            echo "<span id='dislikeid$reviewidparent' class='dislike'>".$allparents[$i]['review_total_dislikes']."&nbsp&nbsp<i style='color:#73C2FB;opacity:0.8;' class='fas fa-chevron-down'></i></span>";
        } else {
            echo "<span id='dislikeid$reviewidparent' class='dislike'>".$allparents[$i]['review_total_dislikes']."&nbsp&nbsp<i onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)' class=\"fas fa-chevron-down\"></i></span>";
            // echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
            // echo "<button id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)'>Dislike</button>";
        }

    echo "</div>";
    

    


    echo "<button type='submit' class='inptdesignbtn' id='submit$reviewidparent' style='display:none'>Update Changes</button>";

    if($signedinrole==6){
        echo "<p class='replybtn' type='button' id='replybutton$reviewidparent' onclick='replyReview($reviewidparent)'>"."Reply". "</p>";


    }
    

    

    echo "</form>";

    echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewidparent' id='replybox$reviewidparent'>";
        echo "<input type='hidden' name='csrf' value='$csrf'>";
        echo "<input class='inptdesign' type='text' name='comment' placeholder='comment'><br>";
        echo "<input class='inptdesignbtn' type='submit'>";
    echo "</form>";

    
echo "</div>"; //parentright