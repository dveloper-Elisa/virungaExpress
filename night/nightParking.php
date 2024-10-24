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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #header-container{
            min-width: 100%;
            display: flex;
            flex-direction: column;
            margin-top: 0;
        }
        #header{
            position: absolute;
            top: 0;
            width: 100%;
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
    <link rel="stylesheet" href="../css/csspage.css">
</head>

<?php include "../connect.php"?>

<body>

<div id="header-container">
<div id="header">
<div id="image">
<img style="float:left;margin-left:5px;margin-top:5px;" src="../virungalogo.png" alt="" width="50%"/> 
</div>
<div id="Headercontent">
<h3>VIRUNGA EXPRESS</h3>
<h5>Reporting System</h5>
</div>
</div>

<!-- HEADER MENU -->
<div id="horizMenu">
<ul class="ullisthorizMenu">
<li><a href="../cardep.php">Car Departure</a></li>
<li><a href="../expenses.php">Fuel</a></li>
<li><a href="../greport.php">Report</a></li>
<li><a href="../sreport.php">Stock</a></li>
<li><a href="../settings.php">Settings</a></li>
<li><a href="../distroysession.php">Log out</a> </li>
<li><a href="./nightInfo.php">Parking Report</a> </li>
</ul>
<div COLOR="white"> 
  <p class="welcome-text">
    <?php print("Welcome ".$_SESSION['name']); ?>
  </p>
</div>
</div>
</div>
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
