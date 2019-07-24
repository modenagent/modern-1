/**
* Prepare ISte Url just like CI php method
*/
function site_url(path){
  var site_url = BASE_URL;
  if(site_url.endsWith("/")){//Remove / at the end of string if any
    site_url = site_url.substring(0,site_url.length-1);
  }
  if(path.startsWith("/")) {//Remove / at the begining of string if any
    path = path.substring(1,path.length);
  }
  return site_url+"/"+path;
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}