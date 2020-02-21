function updateUrTViewer(){
    $.ajax({
        url : 'update_urtviewers.php',
        type : 'GET',
        dataType : 'html',
        success : function(code_html, statut){
            document.getElementById("blockviewer").innerHTML = code_html;
        }
    });

    setTimeout(updateUrTViewer,30000);

}

updateUrTViewer();
