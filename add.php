<?php
$id = $_GET["id"];
$voiceText = $_GET["voiceText"];
$voicePath = $_GET["voicePath"];
$category  = $_GET["category"];

$json = file_get_contents('assets/memberStatus.json');
$records = json_decode($json, true);

$records[$id]["vocabulary"][] = array(
    $voiceText,
    $voicePath,
    $category
);

$out_json = json_encode($records, JSON_PRETTY_PRINT);
file_put_contents('assets/memberStatus.json', $out_json, LOCK_EX);

header('Location: developer.php?id='.$id.'&voicePath='.$voicePath.'&category='.$category);
exit;
?>