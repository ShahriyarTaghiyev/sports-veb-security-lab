<?php
include_once "part/header.php";
?> 
    <body id="page-top">
        <!-- Navigation-->
        <?php
include_once "part/nav.php";
include_once "conf/db.php";
$db = new Database();

if (isset($_GET['xeber'])) {
// Güvenli bir SELECT sorgusu:
$new = $db->executeQuery("SELECT * FROM news  where id= ".$_GET['xeber']);

$coment = $db->executeQuery("SELECT * FROM comment  where news_id= ".$_GET['xeber']); 
}
$news = $db->executeQuery("SELECT * FROM news   ORDER BY id DESC LIMIT 3" );

?> 
    <style>
        .news-detail img {
            width: 100%;
            height: auto;
        }
        .recent-news img {
            width: 100%;
            height: auto;
        }
        .comment-section {
            margin-top: 20px;
        }
    </style>
<div class="container mt-5">
    <div class="row mt-5"></div>
    <div class="row mt-5"></div>
     
        <div class="row mt-5">

            <!-- Ana Haber Bölümü -->
            <div class="col-lg-8 col-md-12 mb-4 news-detail">
<?php
                foreach ($new as $item) {
                ?>
                
<img src="https://via.placeholder.com/750x300" alt="Haber Fotoğrafı">
                <p class="text-muted mt-2"><?php echo htmlspecialchars($item['date']);?></p>
                <h2><?php echo htmlspecialchars($item['name']);?></h2>
                <?php echo htmlspecialchars($item['content']);?>
                <?php
}
                foreach ($coment as $item) {
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text"> <?php echo htmlspecialchars($item["comment_text"]); ?> </p>
		<?php if ($_SESSION['user_id'] == $item["user_id"]){ ?>
		<a href="conf/auth.php?moodle=comment&method=delete&id=<?php echo htmlspecialchars($item['id']); ?>" class="btn btn-primary"> sil </a>            
<?php } ?>
        </div>
                </div>
                <?php
                }
                ?>
                <!-- Yorum Bölümü -->
                <?php if (isset($_SESSION['user_id'])) {
            ?>    
                <div class="comment-section">
                    <h5>Şərh yaz</h5>
                    <form method="post" action="conf/auth.php">
                        <div class="form-group">
                            <label for="comment">Şərh</label>
                            <input type="hidden" name="form_source" value="coment_form">
                            <input type="hidden" name="xeber_id" value="<?php echo $_GET['xeber']; ?>">
                            <textarea class="form-control" name="content" id="comment" rows="3" placeholder="Şərh buraya yazın"></textarea>
                        </div>
                        <button type="submit" class="btn mt-2 btn-primary">Göndər</button>
                    </form>
                </div>
           
            <?php }else {
                echo "</br></br></br><h5>Şərh yazmaq üçün daxil olmalısınız.</h5>";
            }
            ?>    
             </div>
            <!-- Son 3 Haber Bölümü -->
            <div class="col-lg-4 col-md-12 recent-news">
                <h5>Son Xəbərlər</h5>
                <?php
                foreach ($news as $item) {
                ?>
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Haber Fotoğrafı">
                    <div class="card-body">
                        <p class="text-muted"><?php echo htmlspecialchars($item['date']);?></p>
                        <h6 class="card-title"><?php echo htmlspecialchars($item['name']);?></h6>
                    </div>
                </div>
               <?php } ?>
                </div>
            </div>
        </div>
    </div>
        
        <!-- Bootstrap core JS-->
<?php
include_once "part/footer.php"
?>
