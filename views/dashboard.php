<?php
require_once("controllers/auth_session.php");
require_once('models/post.php');

if (isset($_POST['post'])){
    $post = new Post();
    $date = date("Y/m/d");

    $image = $_FILES["blog_img"]["name"];
    $tempname = $_FILES["blog_img"]["tmp_name"];    
    $target_folder = "../assets/imgs/uploads/".$image;

    $post->createPost($_POST, $image, $date);

    // move_uploaded_file($tempname, $target_folder);
    if (move_uploaded_file($tempname, $image))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('components/head.php'); ?>
    <title>Admin</title>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-between">
        <h5 class="m-3 text-dark"> Admin <span class="text-uppercase text-primary"> <?php echo $_SESSION["username"]; ?> </span></h5>
        <div>
            <a href='logout.php'><button class="btn btn-outline-light bg-primary text-light m-3">Logout</button></a>
        </div>
    </div>

    <div class="container border p-3">
        <p class="fw-bold">Post a Blog</p>
        <hr />
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <!-- Admin -->
                <input type="hidden" name="user_name" value="<?php echo $_SESSION["username"]; ?>">
            </div>
            <div>
                <label for="#blog_ttl">Title of blog</label>
                <input type="text" name="blog_ttl" id="blog_ttl">
            </div>
            <div>
                <label for="#blog_subttl">Subtitle</label>
                <input type="text" name="blog_subttl" id="blog_subttl">
            </div>
            <div>
                <label for="#blog_img">Post image</label>
                <input type="file" name="blog_img" id="blog_img">
            </div>
            <div>
                <label for="#blog_body">body</label><br>
                <textarea name="blog_body" id="blog_body" class="form-control" placeholder="Leave a comment here" ></textarea>
            </div>
            <div>
                <input type="submit" name="post" value="Post" class="btn btn-outline-light bg-primary text-light m-3">
            </div>
        </form>
    </div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

<?php include_once('components/scripts.php'); ?>
</body>
</html>