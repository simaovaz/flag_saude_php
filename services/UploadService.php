<?php

class UploadService{

    public function saveFile($target_file, $file) : bool
    {

        // Check if file already exists
        if (file_exists($target_file)) {
            return true;
        }

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $allowedExtentions = ['jpg', 'png', 'jpeg', 'gif'];
        $allowedTypes = ['image/png', 'image/jpeg'];
        $check = getimagesize($file);

        // Allow certain file formats
        if(!in_array($imageFileType, $allowedExtentions) || !in_array($check['mime'], $allowedTypes)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return false;
        }

        return move_uploaded_file($file, $target_file);
    }
}