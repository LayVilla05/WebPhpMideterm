<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETEC Product Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .navbar-item:hover {
            background-color: #4c51bf;

        }

        .table-header {
            background-color: #4f46e5;
            color: white;
        }

        .table-row-even {
            background-color: #f8fafc;

        }

        .table-row-odd {
            background-color: #ffffff;

        }


        .header-section {
            background-color: #5b21b6;
            color: white;
            padding: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .header-section img {
            max-height: 80px;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
        }

        .header-section h1 {
            font-size: 1.875rem;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col ">
    <header class="header-section shadow-lg mx-auto w-11/12 lg:w-4/5 mt-4">
        <img src="logo/logo.png" alt="SETEC Logo" class="rounded-lg">
    </header>

    <nav class="bg-indigo-700 p-4 rounded-lg shadow-md mx-auto w-11/12 lg:w-4/5 mb-6">
        <div class="container mx-auto flex flex-wrap justify-center space-x-4 md:space-x-8">
            <a href="index.php" class="text-white hover:bg-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300 navbar-item">HOME</a>
            <a href="listview.php" class="text-white hover:bg-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300 navbar-item">LIST VIEW</a>
            <a href="getProductByID.php" class="text-white hover:bg-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300 navbar-item">PRODUCTBYID</a>
            <a href="getProductByName.php" class="text-white hover:bg-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300 navbar-item">PRODUCTBYNAME</a>
            <a href="insertProduct.php" class="text-white hover:bg-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300 navbar-item">INSERTPRODUCT</a>
        </div>
    </nav>
    <main class="container mx-auto p-4  w-11/12 lg:w-4/5 bg-white rounded-lg shadow-md">

</body>

</html>