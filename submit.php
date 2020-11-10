<?php 

$input_data = $_POST;

// BU = Bangkok University
// ICE = ICE Lab
$session_id = 'TEST';

$time = time();

$filename = implode(".", array($input_data["user-id"], $session_id, $time)); 
$data = array();
$favorite = array();

//question-1-music-rating

$txt_file = fopen('raw_data/' . $filename . '.txt', "w") or die("Unable to open file!");
foreach ($input_data as $key => $value)
{
    $line = $key . " : " . $value . "\n";
    fwrite($txt_file, $line);
    
    $re_question = "/question-(\d*)-(\w*)/";
    $valid = preg_match_all($re_question, $key, $match);
    if($valid){
        if(empty($data[$match[1][0]]["img"])){
            $data[$match[1][0]]["qid"] = $match[1][0];
        }
        switch ($match[2][0]) {
            case "image":
                $re_img = "/\w*.(\d*).\w*/";
                $valid_img = preg_match_all($re_img, $value, $img_match);
                $data[$match[1][0]]["img"]["img_id"] = $img_match[1][0];
                $data[$match[1][0]]["img"]["file"] = $value;
                break;
            case "music":
                $re_music = "/\d*\/((\w*).(\S*))/";
                $valid_music = preg_match_all($re_music, $value, $music_match);
                if($valid_music){
                    $music_array = array(
                        "genre" => $music_match[2][0],
                        "file" => $music_match[1][0]   
                    );
                    $data[$match[1][0]]["music"] = $music_array;
                }else{
                    $data[$match[1][0]]["music"]["rating"] = $value;
                }
                break;
            case "description":
                $data[$match[1][0]]["desc"] = $value;
                break;
        }
    }else{
        $re_fav = "/(\w*)-fav-music-?(\S*)/";
        $fav_valid = preg_match_all($re_fav, $key, $fav_match);
        if(!empty($fav_match[1][0])){
            switch ($fav_match[1][0]){
                case "most":
                    if(empty($fav_match[2][0])){
                        $favorite["most"]["qid"] = $value;
                    } else {
                        $favorite["most"]["reason"] = $value;
                    }
                    break;
                case "least":
                    if(empty($fav_match[2][0])){
                        $favorite["least"]["qid"] = $value;
                    } else {
                        $favorite["least"]["reason"] = $value;
                    }
                    break;
            }
        }
    }
}

fclose($txt_file);

$most_fav_music = $data[$favorite["most"]["qid"]]["music"];
$least_fav_music = $data[$favorite["least"]["qid"]]["music"];

$final_fav = array(
    "most" => array(
        "genre" => $most_fav_music["genre"],
        "file" => $most_fav_music["file"],
        "reason" => $favorite["most"]["reason"],
        "rating" => $most_fav_music["rating"]
    ),
    "least" => array(
        "genre" => $least_fav_music["genre"],
        "file" => $least_fav_music["file"],
        "reason" => $favorite["least"]["reason"],
        "rating" => $least_fav_music["rating"]
    )
);

$final_data = array();

foreach($data as $key => $value){
    $final_data[$value['img']['img_id']] = array(
        "qid" => $value["qid"],
        "desc" => $value["desc"],
        "music" => $value["music"]
    );
}

ksort($final_data);

$final = array(
    "uid" => $input_data["user-id"],
    "session" => $session_id,
    "timestamp" => $time,
    "age" => $input_data["age"],
    "familiarity" => $input_data["familiarity"],
    "gender" => $input_data["gender"],
    "data" => $final_data,
    "favorite" => $final_fav
);

$json_file = fopen('raw_data/' . $filename . '.json', 'w');
fwrite($json_file, json_encode($final));
fclose($json_file);