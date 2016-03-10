//READY_STATE_UNINITIALIZED=0;
//READY_STATE_LOADING=1;
//READY_STATE_LOADED=2;
//READY_STATE_INTERACTIVE=3;
READY_STATE_COMPLETE=4;

function envioAjax(url, texto) {
    peticion_http = new XMLHttpRequest();
  if(peticion_http) {
    peticion_http.onreadystatechange = recibo;   //cuando se recibe respuesta se ejecuta la funcion
    peticion_http.open("GET", url, true);
    peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion_http.send(texto);
  }
}

function recibo() {
      if(peticion_http.readyState == READY_STATE_COMPLETE) {
          if (peticion_http.status == 200) {
 var recibido = peticion_http.responseText;
eval(galleta)(recibido);
          }
      }
}

