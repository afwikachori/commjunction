<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    

    <title>Commjuction Payment</title>

    
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="src/css/poles.css"> <!-- //custom -->

</head>
<body>
	<div class="container" style="margin-top: 2em; margin-bottom: 2em;">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-lg-6">
                <center>
                <img src="src/commjuction.png" class="commjuction-logo">
                <h2 class="cgrey" style="margin-top: 0.7em;">Successfull Registered</h2>
                <p class="clight" style="margin-top: 0.6em;">
                Hello, Admin Community
                Your Community Account has already registered 
                Please immediately complete your payment
                </p>
                <img src="src/bg-img1.png" class="bgimg1_email">

                <h6 class="cgrey2 h5" style="margin-top: 1.5em;">Payment Information</h6>
                </center>

                <form>
                <label class="clight">Status</label>
                <div class="cgrey2 h6 mgb-1">Waiting for payment </div>


                <label class="clight">Invoice Number</label>
                <div class="cgrey2 h6 mgb-1">123456789</div>


                <label class="clight">Detail Payment</label>
                <div class="cgrey2 h6 mgb-1">Pembayaran Pendaftaran Community</div>

                <div class="row">
                <div class="col-8">
                <label class="clight">Account Bank</label>
                <div class="cgrey2 h6 mgb-1">Account 1</div>

                <label class="clight">Bank Name</label>
                <div class="cgrey2 h6 mgb-1">B N I</div>

                </div>
                <div class="col">
                <label class="clight">Total Payment</label>
                <div class="cgrey2 h6 mgb-1">Rp 200.000</div>

                <label class="clight">Account Name</label>
                <div class="cgrey2 h6 mgb-1">Brian A</div>

                </div>
                </div>

                <center>
                <button type="button" class="btn btn-oren paynow" >Pay now</button>
                <hr>

                <img src="src/vascomm.png" class="vascomm-email"><br>
                <small class="clight">Ruko Gateway, Jl. Raya Waru, Dusun Sawo, Sawotratap, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur 61254</small>
                <br>
                <div style="margin-top: 1em;">
                 <a href="" class="abuabu"><i class="fa fa-facebook"></i></a>
                 &nbsp; &nbsp; &nbsp; &nbsp;
                 <a href="" class="abuabu"><i class="fa fa-twitter"></i></a>
                 &nbsp; &nbsp; &nbsp; &nbsp;
                 <a href="" class="abuabu"><i class="fa fa-linkedin"></i></a>
                 &nbsp; &nbsp; &nbsp; &nbsp;
                 <a href="" class="abuabu"><i class="fa fa-youtube-play"></i></a>
                </center>
                </form>
            </div>
            <div class="col">
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
