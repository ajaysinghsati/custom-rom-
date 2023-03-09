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
  if ($file_type != "application/octet-stream" && $file_type != "application/vnd.android.package-archive") {
    echo "Error: Only binary files are allowed.";
    exit;
  }
  
  // Check file size
  if ($file_size > 50000000) {
    echo "Error: File size exceeds 50 MB.";
    exit;
  }
  
  // Generate unique file name
  $file_path = "firmware/" . uniqid() . "-" . $file_name;
  
  // Move file to firmware directory
  if (!move_uploaded_file($file_tmp, $file_path)) {
    echo "Error: Failed to upload file.";
    exit;
  }
  
  // Save firmware data to CSV file
  $csv_path = "firmware.csv";
  $data = array($version, $description, $file_path);
  $fp = fopen($csv_path, "a");
  fputcsv($fp, $data);
  fclose($fp);
  
  // Redirect to firmware page
  header("Location: firmware.php");
  exit;
}
?>

