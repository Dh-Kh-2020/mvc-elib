<?php
require_once('models/post.php');
$post = new Post();
$psts = $post->selectAllPosts();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('components/head.php'); ?>
        <title>Clean Blog - PHP OOP</title>
    </head>
    <body>
        <!-- Navigation-->
        <?php include_once('components/nav.php') ?>
        <!-- /Navigation-->
        
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog by PHP OOP</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?php foreach ($psts as $pst) {?>
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <!-- Post preview-->

                        <div class="post-preview">
                            <a href="post.html">
                                <h2 class="post-title"><?php echo $pst['title']; ?></h2>
                                <h3 class="post-subtitle"><?php echo $pst['sub_title']; ?></h3>
                            </a>
                            <p class="post-meta">
                                Posted by <?php echo $pst['username']; ?>
                                on <?php echo $pst['created_at']; ?>
                            </p>
                        </div>

                        <!-- Divider-->
                        <hr class="my-4" />
                        
                        <!-- Pager-->
                        <!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="blog.php">read more →</a></div> -->
                        <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="blog.php?post_id=<?php echo $pst['post_id']; ?>">read more →</a></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Footer-->
        <?php include_once('components/footer.php'); ?>
        <!-- /Footer-->
        
        <!-- Scripts -->
        <?php include_once('components/scripts.php'); ?>
        <!-- /Scripts -->
    </body>
</html>