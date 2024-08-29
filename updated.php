<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bilihin";

$connection = new mysqli($servername, $username,$password,$database);

$id = "";
$name = "";
$description = "";
$price = "";
$Quantity = "";

$errorMessage = "";
$successsMessage= "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (!isset($_GET["id"])){
        header("location: /APP DEV/act.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM products where id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /APP DEV/act.php");
    }

    $name = $row["Name"];
    $description = $row["Description"];
    $price = $row["Price"];
    $address = $row["Quantity"];
}
else{

    $id = $_POST["id"];
    $name = $_POST["Name"];
    $description = $_POST["Description"];
    $price = $_POST["Price"];
    $Quantity = $_POST["Quantity"];

    do{
        if(empty($name) || empty($description) || empty($price) || empty($Quantity)){
            $errorMessage = "All the field are required";
            break;
        }

        $sql = "UPDATE products SET Name = '$name', Description = '$description', Price = '$price', Quantity = '$Quantity' WHERE id = '$id'";


        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successsMessage = "Account updated correctly";

        header("location: /APP DEV/act.php");
        exit;

    }while(false);

}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create accounts</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
    </head>
    <body style="background-color: aquamarine;">
        <div class="container my-5">
            <h2>New accounts</h2>

            <?php
            if(!empty($errorMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
                ";
            }
            ?>

            <form method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Description" value="<?php echo $description; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Price" value="<?php echo $price; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Quantity" value="<?php echo $Quantity; ?>">
                    </div>
                </div>
                
                
                <?php
                if(!empty($successMessage)){
                    echo"
                    <div class= 'row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                            </div>
                        </div>
                    </div>

                    ";
                }
                ?>
                
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid" >
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/APP DEV/act.php" role="button">Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </body>
    </html>