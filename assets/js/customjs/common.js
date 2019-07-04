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