function imprimir(t,cid) {
var cid = cid*1;
switch (t) {
    case "recibo":
$.get("cuota/recibo", { id: cid},
  function(data){
      $('#imprimir').html(data);
      window.print();
      window.location.href = window.location.href;
  });
       break;
    case "sobre":
$.get("cuota/sobre", { id: cid},
  function(data){
      $('#imprimir').html(data);
      window.print();
  });
       break;
    default:
return;
} 

}
