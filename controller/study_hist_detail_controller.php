<?php
// 該当のuser_idのusres_answerレコードを返す
function BigQuestionInit(){
    require_once("../model/sutdy_hist_detail_model.php");
    return getBigQuestion();
}

function SmallQuestionInit($genre_value){
    require_once("../model/sutdy_hist_detail_model.php");
    return getSmallQuestion($genre_value);
}

//回答履歴の詳細を、ユーザーId,保存日時を基準に取得し、返す
function InitStudyHistDetail($user_id, $created){
    require_once("../model/sutdy_hist_detail_model.php");
    return getStudyHistDetail($user_id, $created);
}



//回答履歴の詳細を、ユーザーId,保存日時を基準に取得し、返す
function HistInitStudyDetail($user_id, $created, $genre_value){
    require_once("../model/sutdy_hist_detail_model.php");
    return HistGetStudyDetail($user_id, $created, $genre_value);
}
