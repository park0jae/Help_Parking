<?php
    // MySQL과 연동하기 위한 커넥션 생성
    // $dbConn = mysqli_connect("127.0.0.1", "root", "1234",
    // "project") or die("실패 시 출력할 문구");
    
    $db_host = "127.0.0.1";
    $db_name = "project";
    $username = "root";
    $pw = "1234";
    $dbChar = "utf8";
    $dsn = "mysql:host={$db_host};dbname={$db_name};charset={$dbChar}";
    
    $db = new PDO($dsn, $username, $pw);
    // try {
    //     $db = new PDO($dsn, $username, $pw);
    //     echo '접속성공 축하합니다!';
    // } catch (PDOException $th) {
    //     echo '접속실패 : ' . $th->getMessage();
    // };
   
    session_start();
    $title = $_POST['title'];
    $story = $_POST['story'];
    $check = 0;

    $conn = mysqli_connect('localhost','root','1234','project');
    $sql2 = "SELECT * FROM parking";
    $result = mysqli_query($conn,$sql2);
    while($row = mysqli_fetch_array($result)){
    if($row['name'] == $title) $check = 1;  
    }
    mysqli_close($conn);

    if($_GET['mode'] == 'delete')
    {
        
        $no = $_GET['no'];
        $sql = $db -> prepare("DELETE FROM review WHERE no=$no");
        $sql -> execute();

        echo "<script>alert('리뷰 삭제가 완료되었습니다.')</script>";
        echo "<script>var link = 'review.php';location.href=link;</script>";


    }

    else if($check == 1 && $_GET['mode'] != 'delete'){
    switch($_GET['mode']){
        case 'write':   
 

            $title = $_POST['title'];
            $story = $_POST['story'];

            $sql = $db -> prepare("INSERT INTO review
            (title, story,redate)
            VALUE
            (:title, :story, now())");

            $sql -> bindParam("title",$title);
            $sql -> bindParam("story",$story);

            $sql -> execute();
            echo "<script>alert('리뷰 작성이 완료되었습니다.')</script>";
            echo "<script>var link = 'review.php';location.href=link;</script>";
            // header("location:review.php");
            break;

        case 'update':
            $no = $_POST['no'];
            $newTitle = $_POST['title'];
            $newStory = $_POST['story'];

            $sql = $db -> prepare("UPDATE review SET title='$newTitle', story='$newStory' WHERE no=$no ");
            
            $sql -> execute();
            echo "<script>alert('리뷰 수정이 완료되었습니다.')</script>";
            echo "<script>var link = 'review.php';location.href=link;</script>";
            break;

        // case 'delete':
        //     $no = $_GET['no'];
        //     $sql = $db -> prepare("DELETE FROM review WHERE no=$no");
        //     $sql -> execute();

        //     header("location:review.php");
        //     break;
    }
    }
    else{
        $check = 0;
        echo "<script>alert('주차장 이름을 제대로 작성해주세요.')</script>";
        echo "<script>history.back();</script>";
    }
?>