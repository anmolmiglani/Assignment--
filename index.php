<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
  <div class="container ">
    <h1 class="text-center mt-5">Pizza Order Form</h1> <!-- Pizza form started-->
    <form method="post" class="mt-5">
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label> <!-- Enter your name-->
        <input type="text" id="name" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address:</label> <!-- Enter your address-->
        <input type="text" id="address" name="address" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone:</label> <!-- Enter your phone number-->
        <input type="tel" id="phone" name="phone" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="size" class="form-label">Pizza Size:</label> <!-- Enter your pizza size-->
        <select id="size" name="size" class="form-select" required>
          <option value="">Choose Size</option>
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Toppings:</label> <!-- Enter your toppings-->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="pepperoni" name="toppings[]" value="pepperoni">
          <label class="form-check-label" for="pepperoni">Pepperoni</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="mushrooms" name="toppings[]" value="mushrooms">
          <label class="form-check-label" for="mushrooms">Mushrooms</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="onions" name="toppings[]" value="onions">
          <label class="form-check-label" for="onions">Onions</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="sausage" name="toppings[]" value="sausage">
          <label class="form-check-label" for="sausage">Sausage</label>
        </div>
      </div>
      <input type="submit" name="submit" class="btn btn-primary" value="Place Order">
    </form>
  </div>

</body>

</html>
<!--PHP starts from here-->
<?php

if(isset($_POST["submit"]))
{

    // Database connection (replace with your own)
    $host = 'localhost';
    $db = 'pizzadb';
    $user = 'root';
    $password = '';

    // Create a connection
    $conn = mysqli_connect($host, $user, $password, $db);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $size = $_POST['size'];
    $toppings = implode(', ', $_POST['toppings']);

    // Insert order into database
    $sql = "INSERT INTO orders (name, address, phone, size, toppings) VALUES ('$name', '$address', '$phone', '$size', '$toppings')";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>Order Placed Successfully!</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Address:</strong> $address</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Size:</strong> $size</p>";
        echo "<p><strong>Toppings:</strong> $toppings</p>";
    } else {
        echo "<h2>Failed to place order. Please try again.</h2>";
    }

    // Close the connection
    mysqli_close($conn);

}

?>