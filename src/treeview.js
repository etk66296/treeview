

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

postRequest = function(onSuccess, params, url) {
  var xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       onSuccess(this.response)
    }
  }
  xhttp.open("POST", url, true)
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send(params)
}

loginRequest = function(onSuccess, params) {
  postRequest(onSuccess, params, "http://localhost:9999/submit.php")
}

connectRequest = function(onSuccess, user) {
  postRequest(onSuccess, user, "http://localhost:9999/src/connect.php")
}