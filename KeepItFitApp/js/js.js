document.addEventListener('DOMContentLoaded',init());
function init (){
    document.getElementById('flashmessage_button').addEventListener('click',closeFlashmessage())
}
function closeFlashmessage () {
    alert("sfdf")
    document.getElementById('flashmessage_button').style.display="none"
}