# coding:utf-8
import json, os

# set variable
memberStatus = {}
subscribersdata = []

def inp():
    print("-------------------------------")
    name = input("ライバー名 >")
    channelid = input("YoutubeチャンネルID >")
    twitterid = input("TwitterID >")
    print("アイコンの保存先は G:\\xampp\\htdocs\\nijisanji\\src\\member です。 例）src/member/tsukino_mito.png")
    picPath = input("アイコンファイル相対パス >")
    print("-------------------------------")
    print("入力した内容はこれでいいですか。")
    print("ライバー名 >\t\t\t{}\nYoutubeチャンネルID >\t\t{}\nTwitterID >\t\t\t{}\nアイコンファイルフルパス >\t{}".format(name, channelid, twitterid, picPath))
    if name!='' and channelid!='' and twitterid!='' and picPath!='' and "src/member" in picPath:
        return name, channelid, twitterid, picPath
    return 0

def add(data):
    try:
        with open('assets/memberStatus.json', 'r') as f:
            json_data = json.load(f)
            memberStatus = json_data
        print("memberStatus.json 読み込み")
        for memberStatus_liver_count in range(9999):
            try:
                memberStatus[str(memberStatus_liver_count+1)]
                print("memberStatusのライバーカウント "+str(memberStatus_liver_count+1))
            except:
                break
        print("新規追加ライバーID :"+str(memberStatus_liver_count+1))
        memberStatus[str(memberStatus_liver_count+1)] = {
            "id": str(memberStatus_liver_count+1),
            "name": data[0],        # name
            "picPath": data[3],     # picPath
            "channelid": data[1],   # channelid
            "twitterid": data[2],   # twitterid
            "vocabulary": []
        }
        print(memberStatus)
        print("-------------------------------\nmemberStatus.json 上書き完了")
        with open('assets/memberStatus.json', 'w') as f:
            json.dump(memberStatus, f, indent=4)
        print("memberStatus.json 書き込み完了")
        print("{}の登録者数を subscribersdata.json に保存します。".format(data[0]))
        with open('assets/subscribersdata.json', 'r') as f:
            json_data = json.load(f)
            subscribersdata = json_data
        print("subscribersdata.json 読み込み")
        subscribersdata.append([str(memberStatus_liver_count+1), 0])
        print(subscribersdata)
        print("-------------------------------\nsubscribersdata.json 上書き完了")
        with open("assets/subscribersdata.json", "w") as f:
            json.dump(subscribersdata, f, indent=4)
        print("subscribersdata.json 書き込み完了")
        print("-------------------------------")
        print("subscribersdata.json をソート中")
        os.system("python sort_subscribe.py")
        print("ソート完了")
        return data[0]
    except Exception as e:
        input(str(e))


if __name__ == "__main__":
    try:
        input("<新規ライバーを追加します。ENTER>")
        while True:
            liver_data = inp()
            if liver_data != 0:
                if input("完了y / 編集n >") == "y":
                    break
            else:
                print("入力エラーがあります。再度入力してください。")
        name = add(liver_data)
        input("{} 追加完了。終了する場合はなにかキーを押してください。".format(name))
    except Exception as e:
        input(str(e))