<?php


include 'db_config.php';
include 'navbar.php';

$product = null;


if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];


    if ($stmt = $conn->prepare("CALL PRO_GETPRODUCTBYID(?)")) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "<p class='text-red-500 text-center'>Error preparing statement: " . $conn->error . "</p>";
    }
}
?>

<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Search Product by ID</h2>

<form method="GET" action="getProductByID.php" class="mb-8 p-6 bg-white rounded-lg shadow-md mx-auto max-w-md">
    <div class="mb-4">
        <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product ID:</label>
        <input type="number" id="product_id" name="product_id" required
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
            placeholder="Enter Product ID" value="<?php echo isset($_GET['product_id']) ? htmlspecialchars($_GET['product_id']) : ''; ?>">
    </div>
    <div class="flex items-center justify-center">
        <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-300 shadow-md">
            Search
        </button>
    </div>
</form>

<?php if ($product !== null): ?>
    <?php if ($product): ?>
        <div class="overflow-x-auto rounded-lg shadow-md mt-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="table-header">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider rounded-tl-lg">PRODUCT ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">PRODUCT NAME</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">QTY</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">PRICE</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">AMOUNT USD</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">AMOUNT RIEL</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">DESCRIPTION</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider rounded-tr-lg">CREATED AT</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="table-row-even">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($product['PRODUCT ID']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($product['PRODUCT Name']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($product['QTY']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($product['PRICE']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($product['AMOUNT_USD']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($product['AMOUNT_REIL']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($product['DISCRIPTION']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($product['CREATED_AT']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 mt-8">No product found with ID: <?php echo htmlspecialchars($_GET['product_id']); ?></p>
    <?php endif; ?>
<?php elseif (isset($_GET['product_id'])): ?>
    <p class="text-center text-red-500 mt-8">An error occurred or no ID was provided.</p>
<?php endif; ?>

<?php
$conn->close();

echo '</main>';

echo '</body>';
echo '</html>';
?>