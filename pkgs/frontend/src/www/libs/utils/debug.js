
function toggle_tags(){
  let $body = document.getElementsByTagName('body')[0];
  $body.classList.toggle('tags');
  local_sync('TAG_MODE',hasClass($body,'tags'));
}

function toggle_debug(){
  let $body = document.getElementsByTagName('body')[0];
  $body.classList.toggle('debug');
  local_sync('DEBUG_MODE',hasClass($body,'debug'));
}

function hasClass(el, cls) {
  return el.classList.contains(cls);
}

function local_sync(key,value){
  let storeValue = JSON.parse(localStorage.getItem(key));
  console.info(value,storeValue);
  if(storeValue!==value){ 
    localStorage.setItem(key, JSON.stringify(value));
  }else{
    value=storeValue;
  }
  return value;
}

window.addEventListener('load', () => {
  // Read the value from local storage and update the status element
  let isDebug = JSON.parse(localStorage.getItem('DEBUG_MODE') || 'false');
  let isTag   = JSON.parse(localStorage.getItem('TAG_MODE') || 'false');
  (isDebug) && toggle_debug();
  (isTag)   && toggle_tags();
  //console.log('load...');
});
