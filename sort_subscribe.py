# coding:utf-8

import json
from googleapiclient.discovery import build

input("<全ライバーの登録者を取得して整列します。> Enter.")
YOUTUBE_API_KEY = "AIzaSyDuixjP8mVYvEZdMNCVWvUlPg3b5a-x2I8"
youtube = build('youtube', 'v3', developerKey=YOUTUBE_API_KEY)

with open("assets/memberStatus.json", "r") as f:
    nijiStatus = json.load(f)

users = len(nijiStatus)
i = 1
nijidict = {}

while i <= users:
    subscriptions_response = youtube.channels().list(part="statistics", id=nijiStatus[str(i)]["channelid"]).execute()
    try:
        items = subscriptions_response['items'][0]
        print(nijiStatus[str(i)]["name"]+"   "+items['statistics']['subscriberCount'])
    except:
        print(nijiStatus[str(i)]["name"]+"のアカウントが存在しません。")
    
    nijidict[str(i)] = int(items['statistics']['subscriberCount'])
    i=i+1
nijidictReSu = sorted(nijidict.items(), key=lambda x:x[1], reverse=True)

with open("assets/subscribersdata.json", "w") as f:
    json.dump(nijidictReSu, f, indent=4)

input("assets/subscribersdata.jsonファイルをサーバーに転送してください。\n終了するにはなにかキーを押してください。")