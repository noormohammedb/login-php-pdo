console.log("Hello World");
dv = document.getElementsByTagName("div");
 setTimeout(
 function()
 {
 dv[dv.length-1].remove();
console.log("label removed");
 }, 500);