<?php
// number of participants
$n = 10;
$genre = 10;

$uid = 0;
if(isset($_GET['uid'])){
    $uid = $_GET['uid'];
    if($uid > 10 || $uid < 1 ){
        $uid = 0;
    }
}else{
    $uid = 0;
}

$image_set = array_slice(scandir('img'), 2);
$music_set_all = array();

for($i = 1; $i < 11; $i++){
    $temp = array_slice(scandir('music/'.$i), 2);
    $rand_key = array_rand($temp);
    array_push($music_set_all, $i.'/'.$temp[$rand_key]);
}

// echo $blues;
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Experiment</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<pre>
<?php echo "test"; ?>
<?php print_r($music_set_all, false); ?>
</pre>
<body class="d-flex flex-column h-100">

    <header class="header">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand" href="#">Experiment <?php echo date("Y/m/d");?></span>
        </div>
    </header>

    <main class="container">
        <?php
        if($uid > 0){ ?>

            <div class="row">
                <div class="col">

                    <?php ?>
                    <?php foreach($image_set as $key => $image){ ?>
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-6 col-sm-12">
                                <img src="img\<?php echo $image; ?>" class="card-img" alt="">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card-body">
                                    <h5 class="card-title">Question <?php echo $key; ?></h5>
                                    <p class="card-text">Please Describe the image after listening to the music for at least 30s</p>
                                    <p class="card-text">
                                        <audio controls loop>
                                            <source src="music\2\classical.00001.1.wav" type="audio/wav">
                                            Your browser does not support the audio element.
                                        </audio> 
                                    </p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?> 
                
                
                </div>
            </div>



        <?php } else { ?>
        <div class="row">
            <div class="col">
                <div class="alert alert-danger" role="alert">
                    <h1 class="alert-heading">Please use the correct url!</h1>
                    <p>Please use the correct format for url. Please do not forget to add <strong>"?uid={your id here}"</strong></p>
                    <hr>
                    <p class="mb-0">Feel free to ask if you do not know your id.</p>
                </div>  
            </div>
        </div>
        <?php } ?>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    Ritsumeikan University - Intelligent Computer Entertainment Lab
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>

</html>