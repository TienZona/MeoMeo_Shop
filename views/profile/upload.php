<?php
$target_dir = "../../img/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$hasExist = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    // echo "<script>alert('File is an image')</script>";
    $uploadOk = 1;
  } else {
    // echo "<script>alert('File is not an image.')</script>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  // echo  "Sorry, file already exists.";
  $hasExist = 1;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
  // echo  "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  // echo  "<script>alert('Tệp tải lên phải là ảnh JPG, JPEG, PNG & GIF')</script>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 || $hasExist == 1) {
  // echo  "<script>alert('Không thể tải ảnh lên!')</script>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    // echo "<script>alert(\"Tải ảnh lên thành công!\")</script>";
  } else {
    // echo "<script>alert(\"Xin lỗi, đã xảy ra lỗi khi tải tệp của bạn lên.\")</script>";
  }
}
?>