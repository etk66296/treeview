#!/user/bim/env

import json


# convert the data to geo json
center = { 'B': 9.3788162, 'L': 48.6712771 }
scaleGradient = 30000
transformOrigin = { 'x': 400, 'y': 400 }

# scale the coordinates to render them as svg data
def scaleCoordinates(data):
  # attention! The function changes the parametes values
  for childData in data:
    if type(childData) == list:
      scaleCoordinates(childData)
    # it must be float by data
  if type(data[0]) == float and type(data[1]) == float:
    data[0] = (data[0] - center['B']) * scaleGradient + transformOrigin['x']
    data[1] = (data[1] - center['L']) * scaleGradient + transformOrigin['y']
    
import os

directory = './'
for filename in os.listdir(directory):
  if filename.endswith(".json"):
    print(filename)
    with open(filename) as f:
      data = json.load(f)
      exportGeoData = {"data": []}
      for geo in data["features"]:
        scaleCoordinates(geo["geometry"]["coordinates"])
        exportGeoData["data"].append({
          "id": geo["id"],
          "properties": geo["properties"],
          "type": geo["geometry"]["type"],
          "coordinates": geo["geometry"]["coordinates"]
        })
    with open(str(filename[0:-5]) + 'Export.json', 'w') as fp:
      json.dump(exportGeoData, fp)
    continue
  else:
    continue
