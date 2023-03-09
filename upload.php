<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $version = $_POST["version"];
  $description = $_POST["description"];
  
  // Get file data
  $file_name = basename($_FILES["firmware"]["name"]);
  $file_tmp = $_FILES["firmware"]["tmp_name"];
  $file_type = $_FILES["firmware"]["type"];
  $file_size = $_FILES["firmware"]["size"];
  
  // Check file type
