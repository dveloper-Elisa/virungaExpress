<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection file
include "../connect.php";

$result = $conn->query("SELECT * FROM `nightParking`");

?>

<!-- Responsive Table Styling -->
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    a{
        text-decoration: none;
        background-color: black;
        color: white;
        border: none ;
        padding: 5px 10px;       
    }
    a:hover{
        cursor: pointer;
        background-color: #333333;
        

    }
    @media only screen and (max-width: 600px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }
</style>

<!-- Display the Data in a Table -->
 <div id="header">
     <h2>Night Parking Information</h2>
        <a href="./nightParking.php"> Back</a>
 </div>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Branch</th>
            <th>Car Plaque</th>
            <th>Driver Name</th>
            <th>Ration</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['branch']); ?></td>
                    <td><?php echo htmlspecialchars($row['placque']); ?></td>
                    <td><?php echo htmlspecialchars($row['driver']); ?></td>
                    <td><?php echo htmlspecialchars($row['ration']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No data found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
// Close the connection
$conn->close();
?>
