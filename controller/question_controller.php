<?php

function questionInit($genre_param){
    require_once("../model/question_model.php");
    return QuestiongetRecord($genre_param);

}
