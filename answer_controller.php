<?php

function answerInit($genre_param){
    require_once("answer_model.php");
    return answerGetRecord($genre_param);

}
