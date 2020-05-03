<?php
    if(strpos($_SERVER["REQUEST_URI"], '?') == false){
        $id = "";
        $voicePath = "";
        $category = "";
    }else{
        $id = "value=\"".$_GET['id']."\"";
        $voicePath = "value=\"".$_GET['voicePath']."\"";
        $category = "value=\"".$_GET['category']."\"";
    }
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
    <head>
        <title>デベロッパーツール</title>
        <link rel="shortcut icon" href="src/logo.jpg">
        <link rel="stylesheet" type="text/css" href="assets/style3.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <NOSCRIPT>
        <body>
    </NOSCRIPT>
    <body>
        <div class="main">
        <form action="add.php" method="get">
        <p class="warning">五十音順に整列しない</p>
        <div>
            <label>ライバーの番号：</label>
            <input type="text" name="id" class="id" <?php if(empty($_POST['id'])){echo $id;}?>>
        </div>
        <div>
            <label>ボイスのテキスト：</label>
            <input type="text" name="voiceText" class="voiceText">
        </div>
        <div>
            <label>ボイスのファイル名：</label>
            <input type="text" name="voicePath" class="voicePath" <?php if(empty($_POST['voicePath'])){echo $voicePath;}?>>
        </div>
        <div>
            <label>カテゴリ：</label> <!--選択式にする-->
            <input type="text" name="category" class="category" <?php if(empty($_POST['category'])){echo $category;}?>>
        </div>
        <div>
            <button>追加</button>
        </div>
    </form>
    <br><br>
    <p>カテゴリ一覧: greeting | joy | anger | sad | surprize | laugh | bad | dialect | native</p>
    <hr><br>
    <pre>
        1 月ノ美兎
        2 勇気ちひろ
        3 える
        4 樋口楓
        5 静凛
        6 渋谷ハジメ
        7 鈴谷アキ
        8 モイラ
        9 鈴鹿詩子
       10 宇志海いちご
       11 夕陽リリ
       12 物述有栖
       13 文野環
       14 伏見ガク
       15 ギルザレンIII世
       16 剣持刀也
       17 森中花咲
       18 叶
       19 赤羽葉子
       20 笹木咲
       21 本間ひまわり
       22 魔界ノりりむ
       23 葛葉
       24 雪汝
       25 椎名唯華
       26 ドーラ
       27 出雲霞
       28 轟京子
       29 シスター・クレア
       30 花畑チャイカ
       31 社築
       32 安土桃
       33 卯月コウ
       34 鈴木勝
       35 緑仙
       36 神田笑一
       37 飛鳥ひな
       38 春崎エアル
       39 雨森小夜
       40 鷹宮リオン
       41 舞元啓介
       42 竜胆尊
       43 でびでび・でびる
       44 桜凛月
       45 町田ちま
       46 月見しずく
       47 ジョー・力一
       48 遠北千南
       49 成瀬鳴
       50 ベルモンド・バンデラス
       51 矢車りね
       52 夢追翔
       53 黒井しば
       54 童田明治
       55 郡道美玲
       56 夢月ロア
       57 小野町春香
       58 語部紡
       59 瀬戸美夜子
       60 御伽原江良
       61 戌亥とこ
       62 アンジュ・カトリーナ
       63 リゼ・ヘルエスタ
       64 三枝明那
       65 愛園愛美
       66 鈴原るる
       67 雪城眞尋
       68 エクス・アルビオ
       69 レヴィ・エリファ
       70 葉山舞鈴
       71 ニュイ・ソシエール
       72 葉加瀬冬雪
       73 加賀美ハヤト
       74 夜見れな
       75 黛灰
       76 アルス・アルマル
       77 相羽ういは
       78 天宮こころ
       79 エリー・コニファー
       80 ラトナ・プティ
       81 早瀬走
       82 健屋花那
       83 シェリン・バーガンディ
       84 フミ
       85 山神カルタ
       86 星川サラ
    </pre>
    </div>
    </body>
</html>