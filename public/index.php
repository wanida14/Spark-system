<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<style>
    .login {
        background-color: white;
        margin-top: 100px;
        border-radius: 15px;
    }

    .shadow {
        box-shadow: 10px 10px 5px grey;
    }
</style>

<body style="background-color:#d3d3d3">
    <div class="container login" style="box-shadow: 8px 8px 8px rgba(68, 68, 68, 0.6);">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12" style="padding-left:0px;padding-right:0px;">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="images/logic.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="images/problem-solving.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="images/creativity.jpg" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="padding-top:20px;">
                <div class="row" >
                    <div class="col-sm-12 text-center">
                        <img src="images/spark-image-logo.png" width="100" height="100">
                    </div>
                </div>
                <div class="row" style="padding-top: 10px;">
                    <div class="col-sm-12 text-center">
                        <h3>Login</h3>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 70px;">
                    <div class="col-sm-12">
                        <form method="post" action="../app/src/process-login.php">
                            <div class="container">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                        <input id="status" type="radio" name="status" value="admin" checked> Admin
                                        <input id="status" type="radio" name="status" value="teacher"> Teacher
                                </div>
                                <button id="login" type="submit" class="btn btn-info">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script> 
    $(document).ready(function(){
        $('#login').click(function(e){
            var username = $('#username').val();
            var password = $('#password').val();

            if (username == '' || password == '') {
                alert("กรุณาป้อน Username หรือ Password หรือกดเลือก Admin และ Teacher");
                e.preventDefault();
            }        
        })
    });
</script>
</html>