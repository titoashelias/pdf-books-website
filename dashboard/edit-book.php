<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
    header('Location:index.php');
} else {

?>


    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <?php
	if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM books WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bookTitle = $_POST['bookTitle'];
        $bookAuthor = $_POST['authorName'];
		$authorcompany = $_POST['authorcompany'];
        $bookCat = $_POST['bookCat'];
        $bookContent = $_POST['bookContent'];
        // Book Cover
        $imageName = $_FILES['bookCover']['name'];
        $imageTmp = $_FILES['bookCover']['tmp_name'];

        // Book file
        $bookName = $_FILES['book']['name'];
        $bookTmp = $_FILES['book']['tmp_name'];

		//Valideation
        if (empty($bookTitle) || empty($bookAuthor) || empty($bookCat) || empty($bookContent)) {
            $error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
        } elseif (empty($imageName)) {
            $error = "<div class='alert alert-danger'>" . "الرجاء إختيار صورة مناسبة" . "</div>";
        } elseif (empty($bookName)) {
            $error = "<div class='alert alert-danger'>" . "الرجاء إختيار ملف الكتاب" . "</div>";
        } else {
            // Book cover
            $bookCover = rand(0, 1000) . "_" . $imageName;
            move_uploaded_file($imageTmp, "../uploads/bookCovers/" . $bookCover);
            // Book cover
            $book = rand(0, 1000) . "_" . $bookName;
            move_uploaded_file($bookTmp, "../uploads/books/" . $book);
			$query = "UPDATE `books` SET 
			`bookTitle` = '".$bookTitle."',
			`bookAuthor` = '".$bookAuthor."',
			`bookCover` = '".$bookCover."',
			`mbookContent` = '".$bookContent."',
			`bookCat` = '".$bookCat."',
			`book` = '".$book."',
			`authorcompany` = '".$authorcompany."'
			WHERE `id` = '".$id."'";
			$edit = mysqli_query($con, $query);
            header("Location: books.php");
			exit();	
        }
    }
    ?>

    <div class="container-fluid">
        <!-- Start new book -->
        <div class="new-book">
            <?php
            if (isset($error)) {
                echo $error;
            } elseif (isset($success)) {
                echo $success;
            }

            ?>
            <form action="edit-book.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان الكتاب</label>
                    <input type="text" id="title" class="form-control" name="bookTitle" value="<?php echo $row['bookTitle'];?>">
                </div>
                <div class="form-group">
                    <label for="author">إسم الكاتب</label>
                    <input type="text" id="author" class="form-control" name="authorName" value="<?php echo $row['bookAuthor'];?>">
                </div>
				<div class="form-group">
                    <label for="author">دارا النشر والطبع</label>
                    <input type="text" id="author" class="form-control" name="authorcompany" value="<?php echo $row['authorcompany'];?>">
                </div>
				<div class="form-group">
                    <label for="img">نبذة عن الكتاب</label>
                    <textarea name="bookContent" cols="30" rows="10" class="form-control"><?php echo $row['bookContent'];?></textarea>
                </div>
                <div class="form-group">
                    <label for="title">التصنيف</label>
                    <select class="form-control" name="bookCat">
                        <option></option>
                        <?php
                        $query = "SELECT categoryName FROM categories";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option><?php echo $row['categoryName']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="img">غلاف الكتاب</label>
                    <input type="file" class="form-control" name="bookCover">
                </div>
                <div class="form-group">
                    <label for="img">ملف الكتاب</label>
                    <input type="file" class="form-control" name="book">
                </div>
                
                <button class="custom-btn">نشر الكتاب</button>
            </form>
        </div>
        <!-- End new book -->
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
    include 'include/footer.php';
    ?>


<?php
}
?>