<?php
    function getExplainItems($genre){
    require_once("../model/explain_model.php");
    return explainItemsInit($genre);
}
