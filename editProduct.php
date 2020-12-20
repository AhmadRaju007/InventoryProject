<?php
    session_start();
    include 'navigation.php';

    $conn= connect();
    $m='';

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $sql= "SELECT * from products WHERE id='$id' limit 1";
        $res= mysqli_fetch_assoc($conn->query($sql));

        $img= $res['image'];
    }elseif(isset($_POST['id'])){
        $id =$_POST['id'];
        $pName= $_POST['pname'];
        $buy= intval($_POST['buy']);
        $sell= intval($_POST['sell']);

        if($buy>=$sell){
            if(isset($_POST['Submit'])){
                $sql= "UPDATE products SET name= '$pName', bought= '$buy', sold= '$sell' WHERE id = '$id'";
                if($conn->query($sql)===true){
                    header('Location: products.php');
                } else{
                    $m= "Connection Failure!";
                    header("Location: editProduct.php?id=$id");
                }
            }
        } else{
            $m= "Buy quantity should be larger than Sell quantity!";
            header("Location: editProduct.php?id=$id");
        }
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
                            <h1 > Edit Product</h1>
                            <h2> <?php echo $m; ?> </h2>
                        </div>
                        <div class="row pt-20" >
                            <div class="col-sm-5 p-20" >
                                <img src="<?php echo $img; ?>" class="pull-right" height="300" width="300" style="border-radius: 10px;">
                            </div>

                            <div class="col-sm-7" >
                                <form method="POST" action="editProduct.php">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="pull-right"><h2> Name:</h2></label>
                                        </div>
                                        <div class="col-sm-6 form-input pt-10">
                                            <input type="text" class="login-input"  name="pname" value="<?php echo $res['name']; ?>" placeholder="Product Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="pull-right"><h2> Buy Quantity:</h2></label>
                                        </div>
                                        <div class="col-sm-6 form-input pt-10" >
                                            <input type="text" class="login-input" name="buy" value="<?php echo $res['bought']; ?>" placeholder="Buy Quantity">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="pull-right"><h2> Sell Quantity:</h2></label>
                                        </div>
                                        <div class="col-sm-6 form-input pt-10">
                                            <input type="text" class="login-input" name="sell" value="<?php echo $res['sold']; ?>" placeholder="Sell Quantity">
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                                    <div class="row">
                                        <div class="text-center">
                                            <input class="btn btn-success" type="submit" name="Submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
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