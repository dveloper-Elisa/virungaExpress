<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Night Parking Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 15px;
            }

            input[type="text"],
            input[type="date"],
            select,
            input[type="submit"] {
                padding: 8px;
            }
        }
    </style>
</head>

<?php include "../connect.php"?>

<body>

<div class="form-container">
    <h2>Car Night Parking Info</h2>
    <form action="process_form.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" id="date" name="date" required>

        <label for="branch">Branch:</label>
        <input type="text" id="branch" name="branch" placeholder="Enter Branch" required>

        <label for="placque">Car Plaque:</label>
        <select name='placque' required>
            <?php 
            $placque = "SELECT Carid FROM cars";
            $result = mysqli_query($conn,$placque);

            if(mysqli_num_rows($result) > 0){
                while ($rows = mysqli_fetch_assoc($result)){
                    echo "<option  value='".$rows['Carid']."'>".$rows['Carid']."</option>";
                }
            }else{
                echo "<option value=''>No Placque were selected </option>";
            }
            ?>
        </select>
        <!-- <input type="text" id="placque" name="placque" placeholder="Enter Car Plaque" required> -->

        <label for="name_driver">Driver's Name:</label>
        <input type="text" id="name_driver" name="name_driver" placeholder="Enter Driver's Name" required>

        <label for="ration">Ration:</label>
        <input type="number" id="ration" name="ration" required />
          
       

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
