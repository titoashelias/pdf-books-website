<?php
include 'layout/include/header.php';

if (isset($_GET['bookTitle'])) {
    $bookAuthor = $_GET['bookTitle'];
	$q = "SELECT * FROM books WHERE bookTitle LIKE(%".$bookAuthor."%) OR bookContent LIKE(%".$bookAuthor."%) OR bookCat LIKE(%".$bookAuthor."%) OR authorcompany LIKE(%".$bookAuthor."%)";
	
}
?>
<!-- Start banar  -->
<div class="banar">
    <div class="overlay"></div>
    <div class="lib-info text-center">
        <h4>حمّل عشرات الكتب مجاناً </h4>
        <p>من أجل نشر المعرفة والثقافة، وغرس حب القراءة بين المتحدثين باللغة العربية</p>
    </div>
</div>
<!-- End banar -->
<div class="container">
        <div class="row">
			
				<form method="GET" action="search.php">
					<div class="form-group">
								<label for="title">خانة البحث</label>
								<input type="text" id="title" placeholder="ابحث عن الكتاب" class="form-control" name="bookTitle">
							</div>
				</form>

		</div>
</div>
<!-- Start Books -->
<div class="books">
    <div class="container">
        <div class="row">
		
            <?php
            $query = "SELECT * FROM books ORDER BY id DESC";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="img-cover">
                                <img src="uploads\bookCovers/<?php echo $row['bookCover']; ?>" alt="Book Cover" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>"><?php echo $row['bookTitle']; ?></a>
                                </h4>
                                <p class="card-text"><?php echo mb_substr($row['bookContent'], 0, 150, "UTF-8"); ?></p>
                                <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>">
                                    <button class="custom-btn">تحميل الكتاب</button>
                                </a>
								
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="text-center">لاتوجد أي كتب</div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- End Books -->

<!-- Start Footer -->
<?php
include 'layout/include/footer.php';
?>
