<?php
//該当のuser_idのusres_answerレコードを返す
function histInit($user_id){
    require_once("../model/study_hist_model.php");
    return getStudyHist($user_id);
}
