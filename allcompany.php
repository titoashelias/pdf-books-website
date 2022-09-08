<?php
include 'layout/include/header.php';


?>
<!--    End navbar    -->

    <div class="books">
        <div class="container">
            <div class="author-info bg-secondary text-white p-2 mb-3">
            <span>جميع دار النشر</span>
        </div>
            <div class="row">
                <?php
                    $query = "SELECT DISTINCT authorcompany FROM books";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="company.php?author=<?php echo $row['authorcompany']; ?>"><?php echo $row['authorcompany']; ?></a>
                                </h4>
                                <a href="company.php?author=<?php echo $row['authorcompany']; ?>">
                                    <button class="custom-btn">عرض جميع كتب دار النشر هذه</button>
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
