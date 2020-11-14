#!/user/bim/env

import os

directory = './'
for filename in os.listdir(directory):
  if filename.endswith(".osm"):
    print("osmtogeojson " + str(filename) + " > " + str(filename)[0:-4] + ".json")
    os.system("osmtogeojson " + str(filename) + " > " + str(filename)[0:-4] + ".json")
    continue
  else:
    continue
