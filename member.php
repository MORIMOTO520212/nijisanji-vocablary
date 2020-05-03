<?php
$id = $_GET["id"];
// エンコードツール https://ja.infobyip.com/jsonencoderdecoder.php
$json = file_get_contents("assets/memberStatus.json");
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$status = json_decode($json,true);
$name = $status[$id]["name"];
$Path = $status[$id]["picPath"];
$channelid = $status[$id]["channelid"];
$twitterid = $status[$id]["twitterid"];
$count = count($status[$id]["vocabulary"]); // 語録数カウント
$voca = $status[$id]["vocabulary"]; // 語録リスト
// お気に入りリスト存在確認 //
if (@$_COOKIE["favorites"] == True){
    $favorites = $_COOKIE["favorites"];
}else{
    $favorites = "PS,PS,PS";
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>にじさんじ語録ｽﾞ</title>
        <link rel="shortcut icon" href="src/logo.jpg">
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script type="text/javascript" src="assets/choice.js"></script>
        <script type="text/javascript" src="assets/favorite.js"></script>
        <meta name="theme-color" content="#323639">
        <link rel="stylesheet" type="text/css" href="assets/style2.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <NOSCRIPT>
        <body>
    </NOSCRIPT>
    <body class="" id="mode">
        <script>
            var mode = sessionStorage.getItem('displaymode');
            if(mode=='dark'){
                console.log('dark mode');
                let body = document.getElementById('mode');
                body.classList.add('dark');
            }
        </script>
        <div class="header">
            <a href="./"><img src="src/logo.png"></a>
        </div>
        <div class="memberPic">
            <img src=<?php echo "\"".$Path."\"" ?>>
        </div>
        <p class="name"><?php echo $name; ?></p>
        <div class="main">
            <div class="sns-box">
                <?php echo "<a href=\"https://www.youtube.com/channel/".$channelid."\" target=\"_blank\"><img class=\"youtube\" src=\"src/youtubeicon.png\"></a>" ?>
                <?php echo "<a href=\"https://twitter.com/".$twitterid."\" target=\"_blank\"><img class=\"twitter\" src=\"src/twittericon.png\"></a>" ?>
            </div>
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
                            if(strpos($favorites,"\"".$vocaData[1]."\"") !== false){
                                // お気に入りに登録している場合
                                $favoriteStatus = "on_star.png";
                            }else{
                                // 登録してない場合
                                $favoriteStatus = "off_star.png";
                            }
                            echo "<li id=\"".$vocaData[2]."\" class=\"is-none\"><a href=\"#\" onclick='favorite(\"".$vocaData[1]."\");return false;'><img class=\"favorite\" src=\"src/".$favoriteStatus."\" id=\"".$vocaData[1]."+\"></a><a href=\"#\" class=\"btn\" onclick=\"document.getElementById('".$vocaData[1]."').play();return false;\"><p>".$vocaData[0]."</p></a><audio src=\"src/voice/".$vocaData[1].".mp3\" id=\"".$vocaData[1]."\"></audio></li>";
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
        </div>
    </body>
</html>