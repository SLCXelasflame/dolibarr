function updateClick(elt) {

    var columns = elt.children;
    var form =  window.parent.document.getElementById("editForm");
    var deleted =  window.parent.document.getElementById("deleteForm");
    //console.log("edit User");
    form.elements["sexe"].value = columns[1].innerText;
    form.elements["nom"].value = columns[4].innerText;
    form.elements["prenom"].value = columns[5].innerText;
    form.elements["nompatronymique"].value = columns[6].innerText;
    form.elements["adresse"].value = columns[7].innerText;
    form.elements["adresse2"].value = columns[8].innerText;
    form.elements["cp"].value = columns[9].innerText;
    form.elements["ville"].value = columns[10].innerText;
    form.elements["tel"].value = columns[11].innerText;
    form.elements["tel2"].value = columns[12].innerText;
    form.elements["portable"].value = columns[13].innerText;
    form.elements["mail"].value = columns[14].innerText;
    form.elements["naissance"].value = columns[15].innerText;
    form.elements["cpnaissance"].value = columns[16].innerText;
    form.elements["ddn"].value = columns[17].innerText;
    form.elements["annee"].value = columns[18].innerText;
    form.elements["actif"].checked = columns[19].innerText === "1";
    form.elements["pupitre"].value = columns[20].innerText;
    form.elements["tailleveste"].value = columns[21].innerText;
    form.elements["taillechemise"].value = columns[22].innerText;
    form.elements["taillepantalon"].value = columns[23].innerText;
    form.elements["taillegilet"].value = columns[24].innerText;
    form.elements["casquette"].value = columns[25].innerText;
    form.elements["profession"].value = columns[26].innerText;
    form.elements["musicien"].checked = columns[27].innerText === "1";
    form.elements["convocation_papier"].checked = columns[28].innerText === "1";
    form.elements["convocation_mail"].checked = columns[29].innerText === "1";
    form.elements["commentaires"].value = columns[30].innerText;
    form.elements["clairon"].checked = columns[31].innerText === "1";
    form.elements["tambour"].checked = columns[32].innerText === "1";
    form.elements["mail_valide"].checked = columns[33].innerText === "1";
    form.elements["medaille"].value = columns[34].innerText;
    form.elements["f1_envoi_taches"].checked = columns[35].innerText === "1";
    form.elements["fic"].value = columns[36].innerText;
    form.elements["id"].value = columns[0].innerText;
    console.log(form.elements["id"].value );
    deleted.elements["id"].value = columns[0].innerText;
    deleted.elements["nom"].value = columns[4].innerText;
    deleted.elements["prenom"].value = columns[5].innerText;
    
}

function loadTable(tableHTML) {
    var iframe = document.getElementById('tableFrame');
    var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
    iframeDocument.open();
    var button = "<input type=\"text\" id=\"searchBar\" onkeyup=\"filterTable()\" placeholder=\"Rechercher par nom ou prénom...\">";
    var script = "<script src=\"js/usersSCRIPT.js\"></script>";
    iframeDocument.write(script);
    iframeDocument.write(button);
    iframeDocument.write(tableHTML);
    iframeDocument.close()
}

function filterTable() {
    var input = document.getElementById('searchBar');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('dataTable');
    var tr = table.getElementsByTagName('tr');
    for (var i = 1; i < tr.length; i++) {
        tr[i].style.display = 'none';
        var tds = tr[i].getElementsByTagName('td');
        for (var j = 0; j < tds.length; j++) {
            var td = tds[j];
            if (td) {
                var txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = ''; 
                    break;
                }
            }
        }
    }
}

function toggleForm(elt) {
    var id = elt.getAttribute('id');
    switch(id){
        case "toggleBar":
            var form = document.getElementById('createTable');
            var button = document.getElementById('createButton');
            break;
        case "toggleBar2":
            var form = document.getElementById('editTable');
            var button = document.getElementById('editButton');
            break;
        case "toggleBar3":
            var form = document.getElementById('deleteTable');
            var button = document.getElementById('deleteButton');
            break;
        default:
            break;
    }

    if (form.style.display === 'none') {
        form.style.display = 'block';
        button.style.display = 'block';
    } else {
        form.style.display = 'none';
        button.style.display = 'none';
    }
}
