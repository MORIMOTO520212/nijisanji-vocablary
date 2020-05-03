# coding:utf-8
import json

with open("../assets/memberStatus.json", "r") as f:
    nijiStatus = json.load(f)

length = len(nijiStatus)
i=1
while i <= length:
    nijiStatus[str(i)]["vocabulary"]=[]
    i=i+1

with open("../assets/memberStatus.json", "w") as f:
    json.dump(nijiStatus, f, indent=4)