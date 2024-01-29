<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Your database connection details
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "diary"; 

    try {
        // Create a PDO connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert user data into the database
        $query = "INSERT INTO users (Username, PASSWORD) VALUES (:username, :password)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

		header("Location: http://localhost/WEBSITE/login.html#");
            exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
} else {
    // Handle invalid request method
    echo "Invalid request method!";
}
?>
