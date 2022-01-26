# nijisanji-vocablary

# 概要
にじさんじの語録をボイス形式で聞けるウェブアプリケーション

# 開発期間
2019/06/25 ~ 2019/09/23

# ファイル説明
**index.php**  
ウェブページ

**memberStatus.json**  
全ライバーの語録の情報を記録している。
`id (int)` - ユーザーID  
`name (char)` - ユーザー名  
`picPath (char)` - アイコン画像  
`channelid (char)` - YouTubeチャンネルID  
`twitterid (char)` - Twitter ID  
`vocabulary (list)` - 語録情報  

**subscribersdata.json**  
全ライバーの登録者を記録している。  
ウェブページの登録者順に並び変えるときに使われる。  
```json
[
    [
        ユーザーID(char),
        チャンネル登録者(int)
    ],
    ...
]
```

**NewVoiceAdd.php**  
新しい語録を追加することができる。  
src/newvoice内の音声ファイル情報をmemberStatus.json, nijiData.jsonに記録する。  
音声ファイル形式：mp3  
※src/newvoice内のファイルは手動でサーバーに転送する。  

**sort_subscribe.py**  
subscribersdata.jsonの登録者情報を最新の情報に書き換える。  

**add_newmember.py**  
新しいライバーを追加することができる。  

**developer.php**  
新しい語録を追加することができる。（NewVoiceAdd.phpに置き換わった）

**add.php**
developer.php用のファイルでjsonに記録する。


# ボイス追加手順
## 1. ボイスをmp3ファイルにする。  
1.1. 動画から取得した音声をmp3に変更し、「参加アーティスト」にカテゴリ：greeting | joy | anger | sad | surprize | laugh | bad | dialect | nativeの中から1つを入れる。  
1.2. タイトルに語録テキストを入れる。  

## 2. mp3ファイルをsrc/newvoiceに移動する。
## 3. NewVoiceAdd.phpを実行して登録する。
## 4. jsonファイルとsrc/newvoice内のmp3ファイルをサーバーに転送する。
## 5. src/newvoice内のmp3ファイルをローカルのvoiceファイルに移動する。


# TODO
 ライバー名（必須）, 語録テキスト（必須）, 該当する動画リンク（任意）, その他要望
・ライバーの画像を更新する。