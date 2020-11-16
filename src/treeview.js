

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

loginRequest = function() {
  var xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       console.log("Hello Login")
    }
  }
  xhttp.open("POST", "http://localhost:9999/login.php", true);
  xhttp.send();
}