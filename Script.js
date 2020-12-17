var  xhr= new XMLHttpRequest(), IdSession;
xhr.open('POST', "get_session.php", false);
xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
        IdSession = JSON.parse(xhr.responseText) 
    }
};
xhr.send();
// console.log(IdSession);
var Btn=document.getElementById("Envoyer");
var Input=document.getElementById("texte");
var Ouput=document.getElementById("retour");
var WhoConnect=document.getElementById("connecte");
var AllPosts=document.getElementById("allposts")
AfficherMessage();
AfficherConnected();
Input.addEventListener("keypress", verifEntree)
Btn.addEventListener("click", function(){
    AjouterMessage();
})
const interval = window.setInterval(AfficherMessage, 3000);
const Logge = window.setInterval(AfficherConnected, 10000);


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
            var resultat = JSON.parse(chat.responseText)
            var affichage=resultat.reverse();
            AllPosts.innerHTML="";
            for (let i=0; i<affichage.length; i++){
                // console.log(i);
                var ligne=document.createElement("div")
                                
                if(affichage[i].ID_Users==IdSession){
                    ligne.classList="chat user";
                    ligne.textContent=affichage[i].Date_Chat.substring(11,16)+" : "+affichage[i].Message_chat
                }
                else{
                    ligne.classList="chat other"
                    ligne.textContent=affichage[i].Name_Users+" a écrit : "+affichage[i].Message_chat+" à "+affichage[i].Date_Chat.substring(11,16)
                }
                
                AllPosts.append(ligne)
                AllPosts.scrollTop = AllPosts.scrollHeight;
            }
            }
      };
      chat.open("GET", "controleur.php?action=read");
      chat.send();
}

function AfficherConnected(){
    let Users=new XMLHttpRequest();
    Users.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            WhoConnect.innerHTML="";
            var resultat = JSON.parse(Users.responseText)
            var titre=document.createElement("h3")
            titre.textContent="Ils sont sur le Chat..."
            WhoConnect.appendChild(titre);
            for(var i=0; i<resultat.length;i++){
                var avatar=document.createElement("div")
                avatar.classList="pseudo";
                avatar.textContent=resultat[i].Name_Users;
                WhoConnect.appendChild(avatar);
            }
        }
    }
    Users.open("GET", "controleur.php?action=connected");
    Users.send();
}

function verifEntree(e){
    if(e.key == "Enter"){
        console.log(e.key);
        AjouterMessage();
    }
}