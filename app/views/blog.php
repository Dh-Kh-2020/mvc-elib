<?php
require_once('models/post.php');
$post = new Post();

if(isset($_GET['post_id'])){
    $pst = $post->selectOnePost($_GET['post_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('components/head.php'); ?>
        <title>Blogs</title>
    </head>
    <body>
        <!-- Navigation-->
        <?php include_once('components/nav.php'); ?>
        <!-- /Navigation-->
        
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $pst['title']; ?></h1>
                            <h2 class="subheading"><?php echo $pst['sub_title']; ?></h2>
                            <span class="meta">
                                Posted by <?php echo $pst['username']; ?>
                                on <?php echo $pst['created_at']; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <?php echo $pst['body']; ?>
                        <img class="img-fluid" src="<?php echo $pst['post_img']; ?>" alt="..." /></a>
                        </p>
                    </div>
                </div>
            </div>
        </article>
        <!-- Footer-->
        <?php include_once('components/footer.php'); ?>
        <!-- Footer-->
        
        <!-- Scripts -->
        <?php include_once('components/scripts.php'); ?>
        <!-- /Scripts -->
    </body>
</html>
