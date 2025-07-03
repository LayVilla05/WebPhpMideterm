<?php

include 'db_config.php';
include 'navbar.php';
$records_per_page = 5;

$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// Get total number of records for pagination
$total_records_query = "SELECT COUNT(*) AS total FROM TblProducts";
$total_records_result = $conn->query($total_records_query);
$total_records_row = $total_records_result->fetch_assoc();
$total_records = $total_records_row['total'];
$total_pages = ceil($total_records / $records_per_page);

$sql = "SELECT * FROM view_list_product LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);

?>

<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Product List</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="w-full table-auto  divide-y divide-gray-200">
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
                <?php $row_index = 0; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="<?php echo ($row_index % 2 == 0) ? 'table-row-even' : 'table-row-odd'; ?>">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['PRODUCT ID']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['PRODUCT Name']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['QTY']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['PRICE']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['AMOUNT_USD']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['AMOUNT_REIL']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['DISCRIPTION']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['CREATED_AT']); ?></td>
                    </tr>
                    <?php $row_index++; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-8 space-x-2">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1; ?>" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 transition duration-300 shadow-md">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="px-4 py-2 rounded-md shadow-md
                <?php echo ($i == $current_page) ? 'bg-indigo-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?>
                transition duration-300">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?>" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 transition duration-300 shadow-md">Next</a>
        <?php endif; ?>
    </div>

<?php else: ?>
    <p class="text-center text-gray-600 mt-8">No products found.</p>
<?php endif; ?>

<?php
$conn->close();
echo '</main>';
echo '</body>';
echo '</html>';
?>