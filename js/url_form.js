

 function clear_data(){
 // resets the textarea field where the URL address will be entered
 // and highlights this field approprietly

 document.getElementById('url_address').value=" ";
 document.getElementById('message').innerHTML=" ";
 document.getElementById('message').style.backgroundColor="white";
 }

 function validate_url(){
 //validates the URL address against a regular expression

 var Regexp = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})$/;
 var url=document.getElementById('url_address').value.trim();

 //if the URL is valid, there is a message informing the user that everything is OK
 //and the results will be displayed via PHP code ELSE part,
 //otherwise there is an error and no results will be diplayed IF part

 var result = url.match(Regexp);

 if (result==null){
 document.getElementById("message").innerHTML="URL address entered is wrong!";
 document.getElementById('message').style.backgroundColor="red";
 return false;
 }else{ document.getElementById('message').innerHTML="URL address entered is valid!";
 document.getElementById('message').style.backgroundColor="blue";
 return true;
 }
}