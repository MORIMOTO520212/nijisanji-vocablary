<?php
    $json = file_get_contents("assets/memberStatus.json");
    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $status = json_decode($json,true);
    // お気に入りリスト存在確認 //
    if (@$_COOKIE["favorites"] == True){
        $favorites = $_COOKIE["favorites"];
    }else{
        echo "<h1>申し訳ございませんが予期せぬエラーが発生しました。<a href=\"./\">こちら</a>からホーム画面に移動し再度アクセスしてください。</h1><!--";
    }
?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <title>お気に入り</title>
        <link rel="shortcut icon" href="src/logo.jpg">
        <link rel="stylesheet" type="text/css" href="assets/style5.css">
        <script type="text/javascript" src="assets/choice.js"></script>
        <meta name="theme-color" content="#323639">
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
        <div class="main">
            <div class="liver">
                <?php
                    $idArray = [];
                    $favoriteList = str_replace("[","", $favorites);
                    $favoriteList = str_replace("]","", $favoriteList);
                    $favoriteList = str_replace("\"","", $favoriteList);
                    $favoriteList = explode(",", $favoriteList);
                    echo "<div class=\"icon-home\"><a href=\"./\"><img src=\"src/logo.png\"></a></div>";
                    echo "<div class=\"icon\"><a href=\"#\" onclick='selector(\"all\");return false;'><img src=\"src/all.png\"></a></div>";
                    foreach($favoriteList as $favorite){
                        if(preg_match("/[0-9]+/u", $favorite)){
                            $id = preg_replace("/[^0-9]/","",$favorite);
                            if(in_array($id, $idArray)==false){
                                $idArray[] = $id;
                                echo "<div class=\"icon\"><a href=\"#\" onclick='selector(\"".$id."\");return false;'><img src=\"".$status[$id]["picPath"]."\"></a></div>";
                            }
                        }
                    }
                ?>
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
            <div class="vocabulary">
                <ul id="vocabularyList">
                    <?php
                        $json = file_get_contents("assets/memberStatus.json");
                        $status = json_encode($json);
                    ?>
                    <script>
                        var valueStage = document.getElementById("vocabularyList");
                        var favorites = <?php echo $favorites; ?>;
                        const status = JSON.parse(<?php echo $status ?>);
                        selector = function(self){
                            var count = 0; 
                            var id = "";
                            var sources = "";                            
                            if(self=="all"){
                                favorites.forEach(filename => {
                                    id = filename.replace(/[^0-9]/g, "");
                                    if(""!=id){
                                        status[id]["vocabulary"].forEach(vocabulary => {
                                            if(vocabulary[1] == filename){
                                                sources += "<li id=\""+vocabulary[2]+"\" class=\"is-none\"><a href=\"#\" class=\"btn\" onclick=\"document.getElementById('"+filename+"').play();return false;\"><p>"+vocabulary[0]+"</p></a><audio src=\"src/voice/"+filename+".mp3\" id=\""+filename+"\"></audio></li>";
                                                count++;
                                            }
                                        });
                                    }
                                });
                                if(count==0){
                                    valueStage.innerHTML = "<li class=\"is-none\"><a href=\"#\" class=\"btn\"><p>お気に入り登録されていません。</p></a></li>";
                                }else{
                                    valueStage.innerHTML = sources;
                                }
                            }else{
                                favorites.forEach(filename => {
                                    id = filename.replace(/[^0-9]/g, "");
                                    if(""!=id){
                                        if(self==id){
                                            status[id]["vocabulary"].forEach(vocabulary => {
                                                if(vocabulary[1] == filename){
                                                    sources += "<li id=\""+vocabulary[2]+"\" class=\"is-none\"><a href=\"#\" class=\"btn\" onclick=\"document.getElementById('"+filename+"').play();return false;\"><p>"+vocabulary[0]+"</p></a><audio src=\"src/voice/"+filename+".mp3\" id=\""+filename+"\"></audio></li>";
                                                    count++;
                                                }
                                            });
                                        }
                                    }
                                });
                                if(count==0){
                                    valueStage.innerHTML = "<li class=\"is-none\"><a href=\"#\" class=\"btn\"><p>まだ語録がありません。※有志の方語録募集中</p></a></li>";
                                }else{
                                    valueStage.innerHTML = sources;
                                }
                            }
                        }
                        selector("all"); // set
                    </script>
                    <li id="joy" class="is-none"><a href="#" class="btn"><p></p></a></li>
                    <li id="anger" class="is-none"><a href="#" class="btn"><p></p></a></li>
                    <li id="sad" class="is-none"><a href="#" class="btn"><p></p></a></li>
                    <li id="surprise" class="is-none"><a href="#" class="btn"><p></p></a></li>
                    <li id="laugh" class="is-none"><a href="#" class="btn"><p></p></a></li>
                    <li id="bad" class="is-none"><a href="#" class="btn"><p></p></a></li>
                    <li id="dialect" class="is-none"><a href="#" class="btn"><p></p></a></li>
                    <li id="native" class="is-none"><a href="#" class="btn"><p></p></a></li>
                </ul>
            </div>
    </body>
</html>