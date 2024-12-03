<?php include "header.php";
$id = $_GET['id'];
echo $id; ?>
<div class="container">
    <h5 class="mb-2 text-gray-800">Categories
    </h5>
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary mt-2">Edit Category</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" name="cat_name" placeholder="Category Name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="add_cat" value="Update" class="btn btn-primary">
                            <a href="categories.php" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include "footer.php";
?>