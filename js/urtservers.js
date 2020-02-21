function updateUrTServers(){
    $.ajax({
        url : 'update_urtservers.php',
        type : 'GET',
        dataType : 'html',
        success : function(code_html, statut){
            document.getElementById("contenu").innerHTML = code_html;
        }
    });

    setTimeout(updateUrTServers,60000);

}

function FunctionTableTry(n){
    $.ajax({
        url : 'update_urtservers.php?data='+n,
        type : 'GET',
        dataType : 'html',
        success : function(code_html, statut){
            document.getElementById("contenu").innerHTML = code_html;
        }
    });

}

updateUrTServers();
