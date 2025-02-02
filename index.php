<?php include "header.php";
include "Config.php";
// pagination   

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$limit = 3;
$offset = ($page - 1) * $limit;


// ------------ 
$sql = "SELECT * FROM blog LEFT JOIN categories ON blog.category=categories.cat_id LEFT JOIN user ON blog.author_id=user.user_id ORDER BY blog.publish_date DESC limit $offset, $limit";
$run = mysqli_query($config, $sql);
$row = mysqli_num_rows($run);
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8">
            <?php if ($row) {
                while ($result = mysqli_fetch_assoc($run)) {
            ?>
                    <div class="card shadow">
                        <div class="card-body d-flex blog_flex">
                            <div class="flex-part1">
                                <a href="single_post.php?id=<?= $result['blog_id'] ?>">
                                    <?php $img = $result['blog_image'] ?>
                                    <img src="admin/upload/<?= $img ?>"> </a>
                            </div>
                            <div class="flex-grow-1 flex-part2">
                                <a href="single_post.php?id=<?= $result['blog_id'] ?>" id="title"><?= ucfirst($result['blog_title']) ?></a>
                                <p>
                                    <a href="single_post.php?id=<?= $result['blog_id'] ?>" id="body">
                                        <?= strip_tags(substr($result['blog_body'], 0, 200)) . "..." ?>
                                    </a> <span><br>
                                        <a href="single_post.php?id=<?= $result['blog_id'] ?>" class="btn btn-sm btn-outline-primary">Continue Reading
                                        </a></span>
                                </p>
                                <ul>
                                    <li class="me-2"><a href=""> <span>
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"><?= $result['username'] ?></i></span></a>
                                    </li>
                                    <li class="me-2">
                                        <a href=""> <span><i class="fa fa-calendar-o" aria-hidden="true"><?php $time = $result['publish_date'] ?>
                                                    <?= date('d-M-Y', strtotime($time)) ?></i></span>

                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.php?id=<?= $result['cat_id'] ?>"> <span><i class="fa fa-tag" aria-hidden="true"> <?= $result['cat_name'] ?></i></span>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            <?php  }
            } ?>
            <!-- Pagination begin  -->

            <?php
            $pagination = "SELECT * FROM blog";
            $run_q = mysqli_query($config, $pagination);
            $total_posts = mysqli_num_rows($run_q);
            $pages = ceil($total_posts / $limit);
            if ($total_posts > $limit) {
            ?>
                <ul class="pagination pt-2 pb-5">
                    <?php for ($i = 1; $i <= $pages; $i++) {
                    ?>
                        <li class="page-item <?= ($i == $page) ? $active = "active" : ""; ?>">
                            <a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <!-- ------------------------  -->
        </div>
        <?php include "sidebar.php" ?>
    </div>
</div>
<?php include "footer.php";

?>