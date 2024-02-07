<?php

// require '../vendor/autoload.php'; // Load PhpSpreadsheet library

// use PhpOffice\PhpSpreadsheet\IOFactory;

// // Specify the sheet name you want to target
// $targetSheetName = 'Table10';

// // Check if a file is uploaded
// if (isset($_FILES['file'])) {
//     // Specify the directory where the uploaded file will be stored
//     $uploadDirectory = 'uploads/';
//     $uploadedFilePath = $uploadDirectory . basename($_FILES['file']['name']);

//     // Move the uploaded file to the specified directory
//     move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath);

//     // Load the Excel file
//     $spreadsheet = IOFactory::load($uploadedFilePath);

//     // Get the target sheet
//     $sheet = $spreadsheet->getSheetByName($targetSheetName);

//     if ($sheet !== null) {
//         // Define the range of merged cells (LMN) and lines (10 to 29)
//         $startColumn = 'L';
//         $endColumn = 'N';
//         $startRow = 10;
//         $endRow = 29;

//         // Get the values of the specified range
//         $mergedCellValues = $sheet->rangeToArray("$startColumn$startRow:$endColumn$endRow");

//         // Return the retrieved values as the AJAX response
//         echo json_encode($mergedCellValues);
//     } else {
//         echo "Sheet '$targetSheetName' not found.";
//     }

//     // Optionally, you may want to delete the uploaded file after processing
//     unlink($uploadedFilePath);
// } else {
//     echo "No file uploaded.";
// }


// require '../vendor/autoload.php'; // Load PhpSpreadsheet library

// use PhpOffice\PhpSpreadsheet\IOFactory;

// // Specify the sheet name you want to target
// $targetSheetName = 'Table10';

// // Check if a file is uploaded
// if (isset($_FILES['file'])) {
//     // Specify the directory where the uploaded file will be stored
//     $uploadDirectory = 'uploads/';
//     $uploadedFilePath = $uploadDirectory . basename($_FILES['file']['name']);

//     // Move the uploaded file to the specified directory
//     move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath);

//     // Load the Excel file
//     $spreadsheet = IOFactory::load($uploadedFilePath);

//     // Get the target sheet
//     $sheet = $spreadsheet->getSheetByName($targetSheetName);

//     if ($sheet !== null) {
//         // Define the range of merged cells (B to K) and lines (10 to 29)
//         $startColumn = 'B';
//         $endColumn = 'K';
//         $startRow = 10;
//         $endRow = 29;

//         // Get the values of the specified range
//         $mergedCellValues = $sheet->rangeToArray("$startColumn$startRow:$endColumn$endRow");

//         // Return the retrieved values as the AJAX response
//         echo json_encode($mergedCellValues);
//     } else {
//         echo "Sheet '$targetSheetName' not found.";
//     }

//     // Optionally, you may want to delete the uploaded file after processing
//     unlink($uploadedFilePath);
// } else {
//     echo "No file uploaded.";
// }



// require '../vendor/autoload.php'; // Load PhpSpreadsheet library

// use PhpOffice\PhpSpreadsheet\IOFactory;

// // Specify the sheet name you want to target
// $targetSheetName = 'Table10';

// // Check if a file is uploaded
// if (isset($_FILES['file'])) {
//     // Specify the directory where the uploaded file will be stored
//     $uploadDirectory = 'uploads/';
//     $uploadedFilePath = $uploadDirectory . basename($_FILES['file']['name']);

//     // Move the uploaded file to the specified directory
//     move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath);

//     // Load the Excel file
//     $spreadsheet = IOFactory::load($uploadedFilePath);

//     // Get the target sheet
//     $sheet = $spreadsheet->getSheetByName($targetSheetName);

//     if ($sheet !== null) {
//         // Define the column (C) and the range of lines (10 to 29)
//         $column = 'C';
//         $startRow = 10;
//         $endRow = 29;

//         // Initialize an array to store the retrieved values
//         $cellValues = [];

//         // Loop through the specified range
//         for ($row = $startRow; $row <= $endRow; $row++) {
//             // Get the value of the current cell in column C and add it to the array
//             $cellValue = $sheet->getCell($column . $row)->getValue();
//             $cellValues[] = $cellValue;
//         }

//         // Return the retrieved values as the AJAX response
//         echo json_encode($cellValues);
//     } else {
//         echo "Sheet '$targetSheetName' not found.";
//     }

//     // Optionally, you may want to delete the uploaded file after processing
//     unlink($uploadedFilePath);
// } else {
//     echo "No file uploaded.";
// }





// This is the correct reading on one file only


// require '../vendor/autoload.php'; // Load PhpSpreadsheet library

// use PhpOffice\PhpSpreadsheet\IOFactory;

// // Specify the sheet name you want to target
// $targetSheetName = 'Table10';

// // Check if a file is uploaded
// if (isset($_FILES['file'])) {
//     // Specify the directory where the uploaded file will be stored
//     $uploadDirectory = 'uploads/';
//     $uploadedFilePath = $uploadDirectory . basename($_FILES['file']['name']);

//     // Move the uploaded file to the specified directory
//     move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath);

//     // Load the Excel file
//     $spreadsheet = IOFactory::load($uploadedFilePath);

//     // Get the target sheet
//     $sheet = $spreadsheet->getSheetByName($targetSheetName);

//     if ($sheet !== null) {
//         // Define the columns (B, L, O, R) and the range of lines (10 to 29)
//         $columns = ['C', 'L', 'O', 'R'];
//         $startRow = 10;
//         $endRow = 29;

//         // Initialize an array to store the retrieved values
//         $rowData = [];

//         // Variables to store totals
//         $totalL = 0;
//         $totalO = 0;
//         $totalR = 0;

//         // Loop through the specified range
//         for ($row = $startRow; $row <= $endRow; $row++) {
//             // Initialize an array for the current row
//             $currentRow = [];

//             // Get the values of the specified columns
//             foreach ($columns as $column) {
//                 $cellValue = $sheet->getCell($column . $row)->getValue();

//                 // Check if the value is null, and set it to 0
//                 $currentRow[] = ($cellValue === null) ? 0 : $cellValue;
//             }

//             // Add the current row to the overall data array
//             $rowData[] = $currentRow;

//             // Add the values to the totals
//             $totalL += $currentRow[1];
//             $totalO += $currentRow[2];
//             $totalR += $currentRow[3];
//         }

//         // Return the retrieved values and totals as the AJAX response
//         $response = [
//             'data' => $rowData,
//             'totals' => [
//                 'totalL' => $totalL,
//                 'totalO' => $totalO,
//                 'totalR' => $totalR,
//             ]
//         ];

//         // Close the spreadsheet to release the file lock
// $spreadsheet->disconnectWorksheets();
// unset($spreadsheet);

//         echo json_encode($response);
//     } else {
//         echo "Sheet '$targetSheetName' not found.";
//     }

//     // Optionally, you may want to delete the uploaded file after processing
//     unlink($uploadedFilePath);
// } else {
//     echo "No file uploaded.";
// }







require '../vendor/autoload.php'; // Load PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;

// Specify the directory where the uploaded files will be stored
$uploadDirectory = 'uploads/';

// Check if files are uploaded
if (!empty($_FILES['files']['name'])) {
    $responses = [];

    foreach ($_FILES['files']['name'] as $key => $value) {
        // Specify the target sheet name
        $targetSheetName = 'Table10';

        // Construct the file path
        $uploadedFilePath = $uploadDirectory . basename($_FILES['files']['name'][$key]);

        // Move the uploaded file to the specified directory
        move_uploaded_file($_FILES['files']['tmp_name'][$key], $uploadedFilePath);

        // Load the Excel file
        $spreadsheet = IOFactory::load($uploadedFilePath);

        // Get the target sheet
        $sheet = $spreadsheet->getSheetByName($targetSheetName);

        if ($sheet !== null) {
            // Define the columns (B, L, O, R) and the range of lines (10 to 29)
            $columns = ['C', 'L', 'O', 'R'];
            $startRow = 10;
            $endRow = 29;

            // Initialize an array to store the retrieved values
            $rowData = [];

            // Variables to store totals
            $totalL = 0;
            $totalO = 0;
            $totalR = 0;

            // Loop through the specified range
            for ($row = $startRow; $row <= $endRow; $row++) {
                // Initialize an array for the current row
                $currentRow = [];

                // Get the values of the specified columns
                foreach ($columns as $column) {
                    $cellValue = $sheet->getCell($column . $row)->getValue();

                    // Check if the value is null, and set it to 0
                    $currentRow[] = ($cellValue === null) ? 0 : $cellValue;
                }

                // Add the current row to the overall data array
                $rowData[] = $currentRow;

                // Add the values to the totals
                $totalL += $currentRow[1];
                $totalO += $currentRow[2];
                $totalR += $currentRow[3];
            }

            // Return the retrieved values and totals as part of the responses array
            $responses[] = [
                'data' => $rowData,
                'totals' => [
                    'totalL' => $totalL,
                    'totalO' => $totalO,
                    'totalR' => $totalR,
                ],
                'filename' => $_FILES['files']['name'][$key], // Include the filename in the response
            ];

            // Close the spreadsheet to release the file lock
            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
        } else {
            $responses[] = "Sheet '$targetSheetName' not found in file {$_FILES['files']['name'][$key]}.";
        }

        // Optionally, you may want to delete the uploaded file after processing
        unlink($uploadedFilePath);
    }

    echo json_encode($responses);
} else {
    echo "No files uploaded.";
}
