<?php

function questionInit($genre_param){
    require_once("question_model.php");
    return QuestiongetRecord($genre_param);

}
