#!/user/bim/env

import json
import wget

osmData = {
  'topLeft': { "nw": 48.69000, "el": 9.34000 },
  'bottomRight': {"nw":48.6400, "el": 9.4400 },
  'stepNw': 0.01,
  'stepEl': 0.01,
}

currentNw = osmData["topLeft"]["nw"]
currentEl = osmData["topLeft"]["el"]
fileIndex = 0
conditionNw = True
while conditionNw:
  conditionEl = True
  while conditionEl:
    if currentEl > osmData["bottomRight"]["el"]:
      conditionEl = False
      currentEl = osmData["topLeft"]["el"]
    else:
      fileIndex += 1
      url = "https://api.openstreetmap.org/api/0.6/map?bbox=" + str(currentEl) + "," + str(currentNw) + "," + str(currentEl + osmData["stepEl"]) + "," + str(currentNw + osmData["stepNw"])
      print(url)
      wget.download(url, 'mapData' + str(fileIndex) + '.osm')
      print(url)
      currentEl = currentEl + osmData["stepEl"]
  if currentNw < osmData["bottomRight"]["nw"]:
    conditionNw = False
  else:
    currentNw = currentNw - osmData["stepNw"]
