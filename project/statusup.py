# coding:utf-8
import json

with open("assets\\memberStatus.json", "r") as f:
    nijiStatus = json.load(f)

i = len(nijiStatus)

while 1 <= i:
    if i > 10:
        nijiStatus[str(i)] = nijiStatus[str(i-1)]
        nijiStatus[str(i)]["id"] = i
    print("Complate "+str(i)+"/87 ...")
    i=i-1

with open("assets\\memberStatusRS.json", "w") as f:
    json.dump(nijiStatus, f, indent=4)