<?php
    session_start();
    include 'navigation.php';

    $conn= connect();
    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
    if(isset($_GET['id'])){
        $id= $_GET['id'];

        $sql= "SELECT * from products WHERE id=$id limit 1";
        $res= mysqli_fetch_assoc($conn->query($sql));

        $img= $res['image'];
    }

    $sql= "SELECT COUNT(id) as total_products from products";
    $total_product= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_buy from products";
    $total_buy= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sell from products";
    $total_sell= mysqli_fetch_assoc($conn->query($sql));

?>
<html>
    <head>
        <title> Products </title>
        <link rel="stylesheet" type="text/css" href="css/products.css">
    </head>
    <body>
    <div class="row" style="padding-top: 50px;">
        <div class="col-sm-9">
            <div class="row">
                <section style="padding-left: 20px; padding-right: 20px;">
                    <div class="col-sm-3">
                        <div class="card card-green">
                            <h3>Total Products </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_product?$total_product['total_products']: 'No Products available in stock'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-yellow" >
                            <h3>Products Bought </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']: 'You haven\'t bought anything yet'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3 " >
                        <div class="card card-blue" >
                            <h3>Products Sold </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_sell?$total_sell['total_sell']: 'You haven\'t sold anything yet'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3" >
                        <div class="card card-red" >
                            <h3>Available Stock </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']-$total_sell['total_sell']: 'You haven\'t invested anything yet'; ?></h2>
                        </div>
                    </div>
                </section>
            </div>
            <div class="pt-20 pl-20">
                <div class="col-sm-12" style="background-color: #282828; ">
                    <div class="text-center">
                        <h2 > Product Details</h2>
                    </div>
                    <div class="row pt-20" >
                        <div class="col-sm-5 p-20" >
                            <img src="<?php echo $img; ?>" class="pull-right" height="300" width="300" style="border-radius: 10px;">
                        </div>

                        <div class="col-sm-7" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Name:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo ucwords($res['name']) ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Buy Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['bought'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Sell Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['sold'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Created at:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo date('F j, Y', strtotime(str_replace('-','/',$res['created_at']))) ?></h2>
                                </div>
                            </div>

                            <div class="row text-center">
                                <a href="editProduct.php?id=<?php echo $res['id']; ?>"><button class="btn btn-warning">Edit</button></a>
                                <a href="deleteProduct.php?id=<?php echo $res['id']; ?>"><button class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card  text-center" >
                <h2>About User</h2>
                <div style="height:100px;"><img src="<?php echo $thisUser['avatar']; ?>" height="100px;" width="100px;" class="img-circle" alt="Please Select your avatar"></div>
                <p><h4><?php echo $thisUser['name'];  ?></h4> is working here since <h4><?php echo date('F j, Y', strtotime($thisUser['created_at'])); ?></h4></p>
            </div>
            <div class="card text-center">
                <h2>Owners Info</h2>
                <p>Some text..</p>
            </div>
        </div>
    </div>

    <?php include('footer.php')?>

    </body>
</html>