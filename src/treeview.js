

requestTreeLayerData = function(url, onSuccess) {
  var xmlhttp = new XMLHttpRequest()
  // var url = "assets/treeData/treeData.json"

  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      onSuccess(JSON.parse(this.responseText))
    }
  }
  xmlhttp.open("GET", url, true)
  xmlhttp.send()
}