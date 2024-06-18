<?php
session_start();
require_once "db.php";

    function login( $email,$password) {
        // Şifreyi MD5 ile şifrele    
        $db = new Database();
	$pass = md5($password);

$sql = "SELECT id FROM user WHERE email = '$email' AND pass = '$pass'";
        try{
	$result = $db->executeQuery($sql);
	}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "</br>";
}

        if (!empty($result)) {
            // Kullanıcı bulundu, oturum başlat
            $_SESSION['user_id'] = $result[0]['id'];
 $referer = $_SERVER['HTTP_REFERER'];
        header("Location: ../index.php");

            // Ana sayfaya veya başka bir sayfaya yönlendirme
            // header('Location: index.php');
        } else {
            echo "</br>Email veya şifre yanlış.";
        }
    
}
function addComent( $user_id,$content,$xeber_id) {
    // Şifreyi MD5 ile şifrele

    $db = new Database();
    $sql = "INSERT INTO comment (news_id, user_id, comment_text) VALUES ('$xeber_id', '$user_id', '$content')";
    $result = $db->executeQuery($sql);
echo $sql;
    if (!empty($result)) {
        header('Location: ../news.php?xeber='.$xeber_id);
    } else {
        echo "Email veya şifre yanlış.";
    }

}
function deleteComment($id) {
    // Şifreyi MD5 ile şifrele

    $db = new Database();
    $sql = "DELETE FROM comment WHERE id =".$id;
    $result = $db->executeQuery($sql);
    if (!empty($result)) {
	$referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    } else {
        echo "silmek istediyiniz serh yoxdu .";
    }
}

function deletenews($id) {
    // Şifreyi MD5 ile şifrele

    $db = new Database(); 
    $sql = "DELETE FROM news WHERE id =".$id;
    $result = $db->executeQuery($sql);
    if (!empty($result)) {
        $referer = $_SERVER['HTTP_REFERER'];
       header("Location: $referer");
    } else {
        echo "silmek istediyiniz serh yoxdu .";
    }
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_source']) && $_POST['form_source'] === 'login_form') {       
           login( $_POST['email'],md5($_POST['password']));        
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_source']) && $_POST['form_source'] === 'coment_form' && isset($_POST['content']) && isset($_POST['xeber_id']) && isset($_SESSION['user_id'])) {
      // echo $_SESSION['user_id']."<br>".$_POST['content']."<br>".$_POST['xeber_id']."<br>";
	addComent($_SESSION['user_id'],$_POST['content'],$_POST['xeber_id']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['moodle']) && isset($_GET['method']) && $_GET['moodle'] === 'comment' && $_GET['method'] === 'delete') {
    // Gerekli alanlar dolu ve doğru metot kullanılmış, şimdi fonksiyonu çağırabiliriz.
    	deleteComment($_GET['id']);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['moodle']) && isset($_GET['method']) && $_GET['moodle'] === 'news' && $_GET['method'] === 'delete') {
    // Gerekli alanlar dolu ve doğru metot kullanılmış, şimdi fonksiyonu çağırabiliriz.
    	deletenews($_GET['id']);
     }


?>
