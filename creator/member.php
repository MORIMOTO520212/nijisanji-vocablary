<?php
$id = $_GET["id"];
// エンコードツール https://ja.infobyip.com/jsonencoderdecoder.php
$json = file_get_contents("../assets/memberStatus.json");
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$status = json_decode($json,true);
$name = $status[$id]["name"];
$Path = $status[$id]["picPath"];
$count = count($status[$id]["vocabulary"]); // 語録数カウント
$voca = $status[$id]["vocabulary"]; // 語録リスト
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
    <head>
        <title>にじさんじ語録ｽﾞ</title>
        <link rel="shortcut icon" href="../src/logo.jpg">
        <script type="text/javascript" src="../assets/choice.js"></script>
        <link rel="stylesheet" type="text/css" href="../assets/style2.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <NOSCRIPT>
        <body>
    </NOSCRIPT>
    <body>
        <div class="header">
            <a href="./"><img src="../src/logo.png"></a>
        </div>
        <div class="memberPic">
            <img src=<?php echo "\"../".$Path."\"" ?>>
        </div>
        <p class="name"><?php echo $name; ?></p>
        <p class="heading">カテゴリ</p>
        <div class="kategori">
            <a class="btn" href="#" onclick='vocajs("greeting");return false;'>挨拶</a>
            <a class="btn" href="#" onclick='vocajs("joy");return false;'>喜び</a>
            <a class="btn" href="#" onclick='vocajs("anger");return false;'>怒り</a>
            <a class="btn" href="#" onclick='vocajs("sad");return false;'>悲しみ</a>
            <a class="btn" href="#" onclick='vocajs("surprise");return false;'>驚き</a>
            <a class="btn" href="#" onclick='vocajs("laugh");return false;'>笑い</a>
            <a class="btn" href="#" onclick='vocajs("bad");return false;'>キモイ</a>
            <a class="btn" href="#" onclick='vocajs("dialect");return false;'>方言</a>
            <a class="btn" href="#" onclick='vocajs("native");return false;'>母国語</a>
            <a class="btn" href="#" onclick='alls();return false;'>すべて</a>
        </div>
        <p class="heading"><!--50音順--></p>
        <div class="vocabulary">
            <ul id="vocabularyList">
                <?php
                    for ($i=0; $i<$count; $i++){
                        $vocaData = $voca[$i];
                        echo "<li id=\"".$vocaData[2]."\" class=\"is-none\"><a href=\"#\" class=\"btn\" onclick=\"document.getElementById('".$vocaData[1]."').play();return false;\"><p>".$vocaData[0]."</p></a><audio src=\"../src/voice/".$vocaData[1].".mp3\" id=\"".$vocaData[1]."\"></audio><a href=\"changing.php?type=delete"."&id=".$status[$id]["id"]."&vid=".$i."\" class=\"btn\">削除</a></li>";
                    }
                    if ($count == 0){
                        echo "<p>まだ語録がありません。※有志の方語録募集中</p>";
                    }
                ?>
                <!-- not such -->
                <li id="joy" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <li id="anger" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <li id="sad" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <li id="surprise" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <li id="laugh" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <li id="bad" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <li id="dialect" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <li id="native" class="is-none"><a href="#" class="btn"><p></p></a></li>
                <!-- not such -->
            </ul>
        </div>
    </body>
</html>