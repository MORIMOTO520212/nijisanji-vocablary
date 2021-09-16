<?php
/*
タイトル：　ボイスのセリフ
アーティスト：　カテゴリ
ファイルタイトルにはアンダーバーの後に数字を含めないこと
*/
require_once('getID3-1.9.18/getid3/getid3.php');
$getID3 = new getID3();
$result = glob('./src/newvoice/*');
$count = count($result);
$liver_Name = array();
$json = file_get_contents("assets/memberStatus.json");
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$status = json_decode($json,true);

foreach ($result as $value) {
    $rere = str_replace('./src/newvoice/','',$value);
    $fileName = str_replace('.mp3','',$rere); // ファイル名
    //$id = preg_replace('/[^0-9]/', '', $fileName);
    preg_match('/\d+/', $fileName, $id);  // ライバーID
    $id = $id[0];
    if (!in_array($status[$id]["name"], $liver_Name)){ // ライバー名を格納
        array_push($liver_Name, $status[$id]["name"]); 
    }
    $fileInfo = $getID3->analyze($value);
    getid3_lib::CopyTagsToComments($fileInfo);
    $voiceText = $fileInfo['comments']['title'][0];  // ボイステキスト
    $category = $fileInfo['comments']['artist'][0];  // カテゴリ

    $json = file_get_contents('assets/memberStatus.json'); // assets/memberStatus.json
    $records = json_decode($json, true);
    $records[$id]["vocabulary"][] = array(
        $voiceText,
        $fileName,
        $category
    );
    echo " | ".$voiceText." | ".$fileName." | ".$category." | "."<br>";
    $out_json = json_encode($records, JSON_PRETTY_PRINT);
    file_put_contents('assets/memberStatus.json', $out_json, LOCK_EX); // assets/memberStatus.json
}
echo "--------------------------------------------------------------------------------<br>";
echo "memberStatus.json , nijiData.json , newvoice内のファイル をサーバーに転送してください。<br>";
echo $count."のファイルを処理しました。";

// nijiData.jsonにライバー名を書き込む
$json = file_get_contents('assets/nijiData.json');
$ul = json_decode($json, true);
$ul["updateLivers"] = $liver_Name;
$out_json = json_encode($ul, JSON_PRETTY_PRINT);
file_put_contents('assets/nijiData.json', $out_json, LOCK_EX);

//header('Location: /nijisanji/');
//exit;
?>