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
    else{
        // genre i+10 - second song for the same genre
        $laten_pair = array(
            array(
                array(1,1), array(2,2), array(3,3), array(4,4), array(5,5), array(6,6), array(7,7), array(8,8), array(9,9), array(10,10), 
                array(11,11), array(12,12), array(13,13), array(14,14), array(15,15), array(16,16), array(17,17), array(18,18), array(19,19), array(20,20)
            ), 
            array(
                array(1,2), array(2,3), array(3,4), array(4,5), array(5,6), array(6,7), array(7,8), array(8,9), array(9,10), array(10,11), 
                array(11,12), array(12,13), array(13,14), array(14,15), array(15,16), array(16,17), array(17,18), array(18,19), array(19,20), array(20,1)
            ), 
            array(
                array(1,3), array(2,4), array(3,5), array(4,6), array(5,7), array(6,8), array(7,9), array(8,10), array(9,11), array(10,12), 
                array(11,13), array(12,14), array(13,15), array(14,16), array(15,17), array(16,18), array(17,19), array(18,20), array(19,1), array(20,2)
            ), 
            array(
                array(1,4), array(2,5), array(3,6), array(4,7), array(5,8), array(6,9), array(7,10), array(8,11), array(9,12), array(10,13), 
                array(11,14), array(12,15), array(13,16), array(14,17), array(15,18), array(16,19), array(17,20), array(18,1), array(19,2), array(20,3)
            ), 
            array(
                array(1,5), array(2,6), array(3,7), array(4,8), array(5,9), array(6,10), array(7,1), array(8,2), array(9,3), array(10,4), 
                array(11,5), array(12,6), array(13,7), array(14,8), array(15,9), array(16,10), array(17,1), array(18,2), array(19,3), array(20,4)
            ), 
            array(
                array(1,6), array(2,7), array(3,8), array(4,9), array(5,10), array(6,11), array(7,12), array(8,13), array(9,14), array(10,15), 
                array(11,16), array(12,17), array(13,18), array(14,19), array(15,20), array(16,1), array(17,2), array(18,3), array(19,4), array(20,5)
            ), 
            array(
                array(1,7), array(2,8), array(3,9), array(4,10), array(5,11), array(6,12), array(7,13), array(8,14), array(9,15), array(10,16), 
                array(11,17), array(12,18), array(13,19), array(14,20), array(15,1), array(16,2), array(17,3), array(18,4), array(19,5), array(20,6)
            ), 
            array(
                array(1,8), array(2,9), array(3,10), array(4,11), array(5,12), array(6,13), array(7,14), array(8,15), array(9,16), array(10,17), 
                array(11,18), array(12,19), array(13,20), array(14,1), array(15,2), array(16,3), array(17,4), array(18,5), array(19,6), array(20,7)
            ), 
            array(
                array(1,9), array(2,10), array(3,11), array(4,12), array(5,13), array(6,14), array(7,15), array(8,16), array(9,17), array(10,18), 
                array(11,19), array(12,20), array(13,1), array(14,2), array(15,3), array(16,4), array(17,5), array(18,6), array(19,7), array(20,8)
            ), 
            array(
                array(1,10), array(2,11), array(3,12), array(4,13), array(5,14), array(6,15), array(7,16), array(8,17), array(9,18), array(10,19), 
                array(11,20), array(12,1), array(13,2), array(14,3), array(15,4), array(16,5), array(17,6), array(18,7), array(19,8), array(20,9)
            )
        );

        $user_laten_pair = $laten_pair[$uid-1];
        shuffle($user_laten_pair);

        $count = count($user_laten_pair);

        $image_set = array_slice(scandir('img'), 2);
        $music_set_all = array();

        for($i = 1; $i < 21; $i++){
            $n = $i;
            if($n > 10) $n = $n - 10;
            $temp = array_slice(scandir('music/'.$n), 2);
            $rand_key = array_rand($temp);
            array_push($music_set_all, $n.'/'.$temp[$rand_key]);
        }
    }
}else{
    $uid = 0;
}

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

<body class="d-flex flex-column h-100">

    <header class="header">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand" href="#">Experiment <?php echo date("Y/m/d");?></span>
        </div>
    </header>

    <main class="container-fluid">
        <?php
        if($uid > 0){ ?>

        <div class="row">
            <div class="col">

                <form action="" method="post" id="experiment-form">

                    <input type="hidden" id="user-id" name="user-id" value="<?php echo $uid ?>">

                    <div class="card text-center">
                        <div class="card-body">
                            <h1>JUSTIN Experiment</h1>
                            <h2 class="card-text">Please describe the image on questions below.</h2>
                            <h2 class="card-text">During anwering, please remember the music you <span class="text-danger">like</span> the most and <span class="text-danger">do not like</span> the most</h2>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Question 1</h5>
                            <p class="card-text">
                                <div class="form-group">
                                    <label for="familiarity">From 1(Lowest) to 5(Highest), how familiar are you with ukiyo-e?</label>
                                    <fieldset id="familiarity">
                                        <?php for($i = 1; $i <= 5; $i++){ ?>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="familiarity-<?php echo $i ?>" name="familiarity" class="custom-control-input" value="<?php echo $i ?>" required>
                                            <label class="custom-control-label" for="familiarity-<?php echo $i ?>"><?php echo $i ?></label>
                                        </div>

                                        <?php } ?>
                                    </fieldset>
                                </div>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Question 2</h5>
                            <p class="card-text">
                                <div class="form-group">
                                    <label for="age">What is your age?</label>
                                    <input type="number" class="form-control" id="age" name="age" min="1" max="120" required>
                                </div>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Question 3</h5>
                            <p class="card-text">
                                <div class="form-group">
                                    <label for="gender">What is your gender?</label>
                                    <fieldset id="gender">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="gender-male" name="gender" class="custom-control-input" value="Male" required>
                                            <label class="custom-control-label" for="gender-male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="gender-female" name="gender" class="custom-control-input"  value="Female" required>
                                            <label class="custom-control-label" for="gender-female">Female</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </p>
                        </div>
                    </div>
                    
                    <?php foreach($user_laten_pair as $key => $pair){ ?>

                    <?php $question_number = $key + 4; ?>
                    
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-6 col-sm-12">
                                <img src="img/<?php echo $image_set[$pair[0]-1]; ?>" class="card-img" alt="" data-toggle="modal" data-target="#image-modal" data-image="img/<?php echo $image_set[$pair[0]-1]; ?>" data-title="Question <?php echo $question_number; ?>">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card-body">
                                    <h5 class="card-title">Question <?php echo $question_number; ?></h5>
                                    <p class="card-text">Please <strong class="text-danger">describe</strong> the image on this question <strong class="text-danger">after</strong> listening to the music below for at least 30s.</p>
                                    <p class="card-text">
                                        <audio controls loop>
                                            <source src="music/<?php echo $music_set_all[$pair[1]-1]; ?>" type="audio/wav">
                                            Your browser does not support the audio element.
                                        </audio> 
                                    </p>
                                    <p class="card-text">
                                        <div class="form-group">
                                            <input type="hidden" id="question-<?php echo $question_number; ?>-image" name="question-<?php echo $question_number; ?>-image" value="<?php echo $image_set[$pair[0]-1]; ?>">
                                            <input type="hidden" id="question-<?php echo $question_number; ?>-music" name="question-<?php echo $question_number; ?>-music" value="<?php echo $music_set_all[$pair[1]-1]; ?>">
                                            <label for="question-<?php echo $question_number; ?>-description">Please Describe the image in this question.</label>
                                            <textarea class="form-control" name="question-<?php echo $question_number; ?>-description" id="question-<?php echo $question_number; ?>-description" rows="3" required></textarea>
                                            
                                            <label for="question-<?php echo $question_number; ?>-music-rating">From 1(Lowest) to 5(Highest), how much you like the music</label>
                                            <fieldset id="question-<?php echo $question_number; ?>-music-rating">

                                                <?php for($i = 1; $i <= 5; $i++){ ?>

                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="question-<?php echo $question_number; ?>-music-rating-<?php echo $i ?>" name="question-<?php echo $question_number; ?>-music-rating" class="custom-control-input" value="<?php echo $i ?>" required>
                                                    <label class="custom-control-label" for="question-<?php echo $question_number; ?>-music-rating-<?php echo $i ?>"><?php echo $i ?></label>
                                                </div>

                                                <?php } ?>
                                                

                                            </fieldset>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?> 

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Question <?php echo $count+4; ?></h5>
                            <p class="card-text">
                                <div class="form-group">
                                    <label for="most-fav-music">Please tell us <strong class="text-danger">music on which question</strong> you <strong class="text-danger">like</strong> the most</label>
                                    <input type="number" class="form-control" id="most-fav-music" name="most-fav-music" min="4" max="23" required>
                                    <label for="most-fav-music-reason">Please tell us your reason (if any).</label>
                                    <textarea class="form-control" name="most-fav-music-reason" id="most-fav-music-reason" rows="3"></textarea>
                                </div>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Question <?php echo $count+5; ?></h5>
                            <p class="card-text">
                                <div class="form-group">
                                    <label for="least-fav-music">Please tell us <strong class="text-danger">music on which question</strong> you <strong class="text-danger">do not like</strong> the most</label>
                                    <input type="number" class="form-control" id="least-fav-music" name="least-fav-music" min="4" max="23" required>
                                    <label for="least-fav-music-reason">Please tell us your reason (if any).</label>
                                    <textarea class="form-control" name="least-fav-music-reason" id="least-fav-music-reason" rows="3"></textarea>
                                </div>
                            </p>
                        </div>
                    </div>

                    <div class="card text-center">
                        <div class="card-body">
                            <p class="card-text">Please make sure you have filled all the qustion before submitting</p>
                            <input type="submit" name="submit" class="btn btn-primary" id="submit-btn" value="Submit" />
                        </div>
                    </div>
                
                </form>
            
            </div>
        </div>

        <div class="modal" tabindex="-1" id="image-modal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <img class="modal-img img-fluid" src="" alt="">
                            </div>
                        </div>
                        
                    </div>
 
                </div>
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

        <div class="d-none" id="complete">
            <div class="row">
                <div class="col">
                    <div class="alert alert-success" role="alert">
                        <h1 class="alert-heading">Experiment Complete</h1>
                        <p>Thank you for participating in this experiment.</p>
                    </div>  
                </div>
            </div>
        </div>

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>

</html>