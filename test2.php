
<?php
        $conn = mysqli_connect('localhost','root','1234','project');
        $sql2 = "SELECT * FROM review WHERE title = '오거리 주차장' order by id DESC";
        $result2 = mysqli_query($conn,$sql2);

        while($row2 = mysqli_fetch_array($result2)){
        ?>
            <span><?= $row2['story']?></span>
        
        <?php                     
    }
    mysqli_close($conn);
    ?>
     





    <?php
     if($row2 != NULL)
        {?>
        <div class ="info" id = "review_story">
            <span class ="recent_review">해당 주차장 최근 리뷰</span>
            <span class ="story"><?= $row2['story'] ?></span>
        </div>
        <?php                     
        }
        else{
            ?>
                <div class ="info" id = "review_story">
                <span class ="recent_review">해당 주차장 최근 리뷰</span>
                <span class="story">해당 주차장에 대한 최근 리뷰가 존재하지 않습니다.</span>
                </div>
            <?php
            }
        mysqli_close($conn);
   
    ?>