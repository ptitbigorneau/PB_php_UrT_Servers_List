function checkUrTServers(){
    $.ajax({
        url : 'urtservers.php',
        type : 'GET',
        dataType : 'html',
        success : function(code_html, statut){
            document.getElementById("contenu").innerHTML = code_html;
        }
    });

    setTimeout(checkUrTServers,60000);

}

function myFunction(n){
    $.ajax({
        url : 'urtservers.php?data='+n,
        type : 'GET',
        dataType : 'html',
        success : function(code_html, statut){
            document.getElementById("contenu").innerHTML = code_html;
        }
    });

}

checkUrTServers();
