<?php
include 'layout/include/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!--    End navbar    -->

<!-- Start show book -->
<div class="books">
    <div class="container">
        <div class="book">
            <div class="row">
                <?php
                $query = "SELECT * FROM books WHERE id='$id'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-md-4">
                    <div class="book-cover">
                        <img src="uploads\bookCovers/<?php echo $row['bookCover']; ?>" alt=" Book cover">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="book-content">
                        <h4><?php echo $row['bookTitle']; ?></h4>
						الكاتب :
                        <h5>
                            <a href="author.php?author=<?php echo $row['bookAuthor']; ?>"><?php echo $row['bookAuthor']; ?></a>
                        </h5>
						دار حقوق النشر :
						<h5>
                            <a href="company.php?author=<?php echo $row['authorcompany']; ?>"><?php echo $row['authorcompany']; ?></a>
                        </h5>
						رقم اصدار الكتاب :
						<h5>
                            <a href="#"><?php echo $row['numberbook']; ?></a>
                        </h5>
                        <hr>
                        <p><?php echo $row['bookContent']; ?></p>
                        <button class="custom-btn" style="width: 160px">
                            <a href="uploads\books/<?php echo $row['book']; ?>" download>تحميل الكتاب</a>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End show book -->

<!-- Start Related Books -->
<div class="related-books">
    <div class="container">
        <h4>كتب ذات صلة</h4>
        <hr>
        <div class="row">
        <?php 
            if(isset($_GET['category'])){
                $bookCat = $_GET['category'];
            }
            // fetch related books
            $query = "SELECT * FROM books WHERE bookCat = '$bookCat' AND id !='$id'";
            $res = mysqli_query($con,$query);
            while($row = mysqli_fetch_assoc($res)){
            ?>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="related-book text-center">
                    <div class="cover">
                        <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>">
                            <img src="uploads/bookCovers/<?php echo $row['bookCover']; ?>" alt="Book Cover">
                        </a>
                    </div>
                    <div class="title">
                        <h5>
                            <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat'];?>"><?php echo $row['bookTitle']; ?></a>
                        </h5>
                    </div>
                </div>
            </div>            
            <?php
            }
        ?>
        </div>
    </div>
</div>
<!-- End Related Books -->

<!-- Start Footer -->
<?php
include 'layout/include/footer.php';
?>
