<?php
function answerInit($genre_param){
    require_once("../model/answer_model.php");
    return answerGetRecord($genre_param);
}

function putUserAnwser($answer_datas){
    require_once("../model/answer_model.php");
    insertUserAnwser($answer_datas);

}
