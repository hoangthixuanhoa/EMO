<?php
// Gọi session_start() để bắt đầu phiên làm việc
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION["ma_id"])) {
    // Nếu không có phiên làm việc, chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../accounts/login.php");
    exit();
}

// Kết nối đến cơ sở dữ liệu (chú ý thay đổi thông tin kết nối phù hợp với máy bạn)
$servername = "localhost";
$username = "emo";
$password = "123456EmoR2";
$dbname = "emo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script>
        function changeWeb(){
            window.location.href ='add_news.php';
        }
    </script>
</head>
<body>
    <div id="pattern">
        <div class="flex-left">Logo</div>
        <div class="flex-right">a</div>
    </div>
    <div id='body'>
        <header>
            <ul id="menu-ul">
                <li><a class="menu-content" id="home" href="home.php">Trang chủ</a></li>
                <li><a href="../quanly/quanly_users.php">Người dùng</a></li>
                <li><a class="menu-content" id="pro" href="../accounts/profile.php">Pro5</a></li>
            </ul>
        </header>
        <main id="home-container">
            <h3 class="h3-content">Bài viết</h3>
            <div class='content-table'>
                <button class="btn-clk" onclick="changeWeb()">Thêm mới</button>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Mô tả ngắn</th>
                        <th>Nội dung</th>
                        <th>trạng thái</th>
                        <th></th>
                    </tr>
                    <?php
                    $servername = "localhost";
                    $username = "emo";
                    $password = "123456EmoR2";
                    $dbname = "emo";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $sql = "SELECT * FROM news";
                    $result = $conn->query($sql);
                    if($result->num_rows>0)
                    {
                        while($row=$result->fetch_assoc())
                        {
                            $id=$row['id'];
                            $avatar = $row['avatars'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $content = $row['content'];
                            $created_at=$row['created_at'];
                            $status = $row['status'];
                            if ($status=='0'){
                                $status='Disable';
                            }elseif($status=='1'){
                                $status='Action';
                            }
                            echo "<tr>";
                            echo "<td>",$id,"</td>";
                            echo "<td><img src='../../uploads/",$avatar,"' width='50px'></td>";
                            echo "<td>",$title,"</td>";
                            echo "<td>",$description,"</td>";
                            echo "<td>",$content,"</td>";
                            echo "<td>",$status,"</td>";
                            echo "<td><a class='a-detail' href='detail.php?id=$id'>Xem</a>";
                            echo "</tr>";
                        }
                    }

                    ?>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
