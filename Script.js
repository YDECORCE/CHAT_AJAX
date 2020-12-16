var  xhr= new XMLHttpRequest(), IdSession;
xhr.open('POST', "get_session.php", false);
xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
        IdSession = xhr.responseText;
    }
};
xhr.send();
// console.log(IdSession);
var Btn=document.getElementById("Envoyer");
var Input=document.getElementById("texte");
var Ouput=document.getElementById("retour");
var AllPosts=document.getElementById("allposts")
AfficherMessage();
Btn.addEventListener("click", function(){
    AjouterMessage();
})

function AjouterMessage(){
    let message=Input.value;
    if(message != ""){
        let requete= new XMLHttpRequest();
        requete.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                Ouput.innerHTML="<p>Message transmis</p>"
                Input.value="";
                AfficherMessage()
            }
            else{
                Ouput.innerHTML="<p>WTF</p>"  
            }
          };
          requete.open("POST", "controleur.php?action=send&message="+message);
          requete.send();
        }
     else{
        alert("saisir votre message");
    }
}

function AfficherMessage(){
    let chat=new XMLHttpRequest();
    chat.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const resultat = JSON.parse(chat.responseText)
            AllPosts.innerHTML="";
            for (let i =0; i<resultat.length;i++){
                var ligne=document.createElement("div")
                console.log(IdSession)
                console.log(resultat[i].Name_Users);
                 
                if(resultat[i].Name_Users==IdSession){
                    ligne.classList="user";
                }
                else{ligne.classList="other"}
                ligne.textContent=resultat[i].Date_Chat+" "+resultat[i].Message_chat+" "+resultat[i].Name_Users
                AllPosts.append(ligne)
            }
            }
      };
      chat.open("GET", "controleur.php?action=read");
      chat.send();
}