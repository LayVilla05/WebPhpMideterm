<?php

include 'db_config.php';
include 'navbar.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'] ?? '';
    $qty = $_POST['qty'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($product_name) || !is_numeric($qty) || $qty <= 0 || !is_numeric($price) || $price <= 0) {
        $message = "Please fill in all required fields correctly (QTY and Price must be positive numbers).";
        $message_type = 'error';
    } else {
        if ($stmt = $conn->prepare("CALL PRO_INSERETPRODUCT(?, ?, ?, ?)")) {
            $stmt->bind_param("sdds", $product_name, $qty, $price, $description);

            if ($stmt->execute()) {
                $message = "Product '" . htmlspecialchars($product_name) . "' inserted successfully!";
                $message_type = 'success';
            } else {
                $message = "Error inserting product: " . $stmt->error;
                $message_type = 'error';
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
            $message_type = 'error';
        }
    }
}
?>

<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Insert New Product</h2>

<?php if ($message): ?>
    <div class="p-4 mb-4 rounded-md text-center <?php echo $message_type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?> shadow-md">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form method="POST" action="insertProduct.php" class="p-6 bg-white rounded-lg shadow-md mx-auto max-w-md">
    <div class="mb-4">
        <label for="product_name" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
            placeholder="Enter Product Name">
    </div>
    <div class="mb-4">
        <label for="qty" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
        <input type="number" id="qty" name="qty" required min="1"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
            placeholder="Enter Quantity">
    </div>
    <div class="mb-4">
        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
        <input type="number" id="price" name="price" required step="0.01" min="1"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
            placeholder="Enter Price (e.g., 1)">
    </div>
    <div class="mb-6">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
        <textarea id="description" name="description" rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
            placeholder="Enter Product Description"></textarea>
    </div>
    <div class="flex items-center justify-center">
        <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-300 shadow-md">
            Add Product
        </button>
    </div>
</form>

<?php
$conn->close();
echo '</main>';
echo '</body>';
echo '</html>';
?>