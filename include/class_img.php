<?php

    class Img {
        public function upload_img($image_file) {
            // Bildeopplasting (kopiert fra w3scools, men tilpasset)
            $target_dir = "img/uploads/";
            $target_file = $target_dir . basename($image_file["name"]);
            $uploadOk = 1;
            $err;

            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($image_file["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $err = "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $err = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($image_file["size"] > 500000) {
                $err = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                return array(FALSE, $err);
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($image_file["tmp_name"], $target_file)) {
                    $img_link = basename($image_file["name"]);
                    $img_id = $this->insert_image_without_referance($img_link);
                    return array(TRUE, $img_id);
                } else {
                    return array(FALSE, "Sorry, there was an error uploading your file.");
                }
            }
        }

        public function insert_image($residence_ID, $img_name, $img_description) {
            global $pdo;
            $query = $pdo->prepare("INSERT INTO img (img_residence_ID, img_link, img_description) VALUES (?, ?, ?)");
            $query->bindValue(1, $residence_ID);
            $query->bindValue(1, $img_link);
            $query->bindValue(1, $img_description);
            $query->execute();
        }

        private function insert_image_without_referance($img_link) {
            global $pdo;
            $query = $pdo->prepare("INSERT INTO img (img_link) VALUES (?)");
            $query->bindValue(1, $img_link);
            $query->execute();

            $query = $pdo->prepare("SELECT * FROM img WHERE img_link = ?");
            $query->bindValue(1, $img_link);
            $query->execute();

            return $query->fetch()['img_ID'];
        }
    }