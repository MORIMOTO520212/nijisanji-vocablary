<?php
// member.phpから復帰時に直前のスクロール位置に移動
// お気に入りボイスを登録出来るようにする
// みなさんからの語録を募集
// カテゴリにお気に入りリストを実装する
// サーチボックス
$result = glob('./src/voice/*');
$count = count($result);
$json = file_get_contents("assets/nijiData.json");
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$nijiStatus = json_decode($json,true);
$voice_add = null;
// voice_addのcookieの存在確認 //
if (@$_COOKIE["voice_add"] == True){
    $nowcount = $count - $_COOKIE["voice_add"];
    if (0 < $nowcount){
        $voice_add = "前回のアクセスから".$nowcount."ボイスが追加されました。";
    }
    setcookie("voice_add", $count, time()+60*60*24*60); // 2ヶ月間有効
}else{
    $nowcount = 0;
    setcookie("voice_add", $count, time()+60*60*24*60); // 2ヶ月間有効
}
?>
<!doctype html>
<html lang="ja">
    <head>
        <title>にじさんじ語録ｽﾞ</title>
        <link rel="shortcut icon" href="src/logo.jpg">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="theme-color" content="#323639">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="にじさんじのライバーの語録をボイス形式としてまとめてます。" />
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151169093-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-151169093-1');
            var favorites = Cookies.get("favorites"); // cookie取得
            if (favorites === undefined){
                console.log("Cookie undefined");
                Cookies.set("favorites", JSON.stringify(["PS","PS","PS"]));
            }
        </script>
        <script>
            // dark mode
            function displaymode(){
                let body = document.getElementById('mode');
                if(sessionStorage.getItem('displaymode') == 'white'){
                    console.log('displaymode dark');
                    sessionStorage.setItem('displaymode', 'dark');
                    body.classList.add('dark');
                }else if(sessionStorage.getItem('displaymode') == 'dark'){
                    console.log('displaymode white');
                    sessionStorage.setItem('displaymode', 'white');
                    body.classList.remove('dark');
                }else{
                    console.log('set cookie displaymode dark');
                    sessionStorage.setItem('displaymode', 'dark');
                    body.classList.add('dark');
                }
            }
        </script>
        <script>
            var lagyLoad=true;
            $(window).scroll(function(){
                sessionStorage.setItem('jscl', $(this).scrollTop());
                // topscroll - continue
                if(sessionStorage.getItem('jscl') > window.pageYOffset+document.getElementById("target").getBoundingClientRect().top-1000){
                    if(lagyLoad==true){
                        lagyLoad=false;
                        if(sessionStorage.getItem('activsubscs')=="activeorder"){
                            console.log("activeorder load.");
                            for(i=parseInt(Nliver/2)+1;i<=Nliver;i++){
                                liverStatus = status_array[String(i)];
                                document.getElementById(i).setAttribute("src", liverStatus["picPath"]);
                            }
                        }else{
                            console.log("subscribers load.");
                            for(i=parseInt(Nliver/2)+1;i<Nliver;i++){
                                liverStatus = status_array[sb_status_array[i][0]];
                                document.getElementById(i).setAttribute("src", liverStatus["picPath"]);
                            }
                        }
                    }
                }
            });
        </script>
    </head>
    <NOSCRIPT>
        <body>
    </NOSCRIPT>      
    <body class="" id="mode">
        <div class="header">
            <a href="#"><img src="src/homelogo.png"></a>
        </div>
        <p class="text">ここでいう語録とは個人的観点に基づく面白い発言や名言などとする。</p>
        <p class="text">※モバイル端末専用</p>
        <a href="about.html"><p class="text">ツールについての説明</p></a>
        <a href="news.html"><p class="text">ツール新規情報</p></a>
        <a href="favorite.php"><p class="text">お気に入りリスト</p></a>
        <a href="#" onclick='displaymode();return false;'><p class="text">ダークモード変更</p></a>
        <p class="text">
            <span class="notice">
                <?php echo $voice_add."<br><br>"; ?>
                <?php if (0 < $nowcount){foreach ($nijiStatus["updateLivers"] as &$liver_Name){echo $liver_Name." , ";}} ?>
            </span>
        </p>
        <p class="heading">並び替え</p>
        <div class="order">
            <a href="#" onclick="activeorder();return false;">活動開始順</a>
            <a href="#" onclick="subscribers();return false;">登録者数順</a>
        </div>
        <div class=main id="main"></div>
        <?php
            $json = file_get_contents("assets/memberStatus.json");
            $json = json_encode($json);
            $json2 = file_get_contents("assets/subscribersdata.json");
            $json2 = json_encode($json2);
        ?>
        <script>
            /*************************************************************
                          Thank you for looking at the source
               Create by NIJISANJI vocabularies - inspiration of MEDAKA. 
                                   UPDATE 2020 02 15 
             *************************************************************/

            // mode check
            if(sessionStorage.getItem('displaymode')=='dark'){
                let body = document.getElementById('mode');
                console.log('displaymode dark');
                body.classList.add('dark');
            }

            const status = <?php echo $json; ?>;
            const status_array = JSON.parse(status);
            const sb_status = <?php echo $json2; ?>;
            const sb_status_array = JSON.parse(sb_status);            
            const Nliver = sb_status_array.length;
            var sources = "";
            var scrollIn="";
            var valueStage = document.getElementById("main");

            // Activeorder Subscribers Select //
            if (sessionStorage.getItem('activsubscs')!=null){
                switch (sessionStorage.getItem('activsubscs')) {
                    case 'activeorder':
                        activeorder();
                        break;
                    case 'subscribers':
                        subscribers();
                        break;
                    default:
                        console.log("Error: activsubscs");
                }
            }else{
                activeorder(); // fast
            }
            // activity start order
            function activeorder(){
                console.log("function: activeorder");
                lagyLoad=true;
                sources = ""; // sources reset
                for(i=1;i<=parseInt(Nliver/2);i++){
                    liverStatus = status_array[String(i)];
                    sources += "<div class=\"boxz1\"><img src=\""+liverStatus["picPath"]+"\" id=\""+liverStatus["id"]+"\"><div class=\"bg\"><p>"+liverStatus["name"]+"</p></div><a href=\"member.php?id="+liverStatus["id"]+"\"></a></div>";
                }
                sources +="<span id=\"target\"></span>";
                for(i=parseInt(Nliver/2)+1;i<=Nliver;i++){
                    liverStatus = status_array[String(i)];
                    sources += "<div class=\"boxz1\"><img src=\"src/dummy.png\" id=\""+liverStatus["id"]+"\"><div class=\"bg\"><p>"+liverStatus["name"]+"</p></div><a href=\"member.php?id="+liverStatus["id"]+"\"></a></div>";
                }
                valueStage.innerHTML = sources;
                sessionStorage.setItem('activsubscs', 'activeorder'); // Add sessionStorage
            }

            // number of subscribers
            function subscribers(){
                console.log("function: subscribers");
                lagyLoad=true;
                sources = ""; // sources reset
                for(i=0;i<=parseInt(Nliver/2);i++){
                    liverStatus = status_array[sb_status_array[i][0]];
                    sources += "<div class=\"boxz1\"><img src=\""+liverStatus["picPath"]+"\" id=\""+i+"\"><div class=\"bg\"><p>"+liverStatus["name"]+"</p></div><a href=\"member.php?id="+liverStatus["id"]+"\"></a></div>";
                }
                sources +="<span id=\"target\"></span>";
                for(i=parseInt(Nliver/2)+1;i<Nliver;i++){
                    liverStatus = status_array[sb_status_array[i][0]];
                    sources += "<div class=\"boxz1\"><img src=\"src/dummy.png\" id=\""+i+"\"><div class=\"bg\"><p>"+liverStatus["name"]+"</p></div><a href=\"member.php?id="+liverStatus["id"]+"\"></a></div>";
                }
                valueStage.innerHTML = sources;
                sessionStorage.setItem('activsubscs', 'subscribers'); // Add sessionStorage
            }

            // MOVE TO POINT //
            $(window).load(function(){
                if (sessionStorage.getItem('jscl')!=null){
                    $(window).scrollTop(sessionStorage.getItem('jscl'));
                    scrollIn = sessionStorage.getItem('jscl');
                }
            });
        </script>
    </body>
</html>