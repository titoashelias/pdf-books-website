<?php
include 'layout/include/header.php';


?>
<!--    End navbar    -->

    <div class="books">
        <div class="container">
            <div class="author-info bg-secondary text-white p-2 mb-3">
            <span>جميع الاقسام</span>
        </div>
            <div class="row">
                <?php
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="category.php?author=<?php echo $row['categoryName']; ?>"><?php echo $row['categoryName']; ?></a>
                                </h4>
                                <a href="category.php?author=<?php echo $row['categoryName']; ?>">
                                    <button class="custom-btn">عرض جميع كتب هذا القسم</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                ?>
            </div>
        </div>
    </div>

<!-- Start Footer -->
<?php
include 'layout/include/footer.php';
?>
