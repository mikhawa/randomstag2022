const httpRequest = new XMLHttpRequest();
const httpRequest2 = new XMLHttpRequest();
const httpRequest3 = new XMLHttpRequest();
const httpRequest4 = new XMLHttpRequest();

function onUpdate(idstag, idan, point) {
    httpRequest.onreadystatechange = () => {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            document.getElementById("test").innerHTML = httpRequest.responseText;
            onLoadPage('hasard', 'hasard', httpRequest2);
            onLoadPage('statstotal', 'general', httpRequest3);
            onLoadPage('updateAllStagiaires', 'equipe', httpRequest4);
        }
    }
    httpRequest.open('POST', 'index.php?myfile=update', true);
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpRequest.send("idstag=" + idstag +
        "&idan=" + idan + "&points=" + point);
}

function onLoadPage(idLoad, Lurl, num) {

    num.onreadystatechange = () => {
        if (num.readyState == 4 && num.status == 200) {
            document.getElementById(idLoad).innerHTML = num.responseText;
        } else {
            document.getElementById(idLoad).innerHTML = "<img src='img/load.gif' alt='loading' />";
        }
    }
    let idan = 1;
    num.open('POST', 'index.php?myfile=load&partie=' + Lurl + '&idan=' + idan + '&cache=' + (new Date()).getTime(), true);
    num.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    num.send("temps=" + (new Date()).getTime(), true);
}

function choix(idannee,idstagiaire,nom)
{
    document.getElementById("idstagiaire").innerHTML=idstagiaire;
    document.getElementById("idannee").innerHTML=idannee;
    document.getElementById('staticBackdropLabel').innerHTML=nom;
}

document.getElementById('b3').onclick = () => {
    onUpdate(document.getElementById("idstagiaire").textContent, document.getElementById("idannee").textContent, 3);
}
document.getElementById('b2').onclick = () => {
    onUpdate(document.getElementById("idstagiaire").textContent, document.getElementById("idannee").textContent, 2);
}
document.getElementById('b1').onclick = () => {
    onUpdate(document.getElementById("idstagiaire").textContent, document.getElementById("idannee").textContent, 1);
}
document.getElementById('b0').onclick = () => {
    onUpdate(document.getElementById("idstagiaire").textContent, document.getElementById("idannee").textContent, 0);
}