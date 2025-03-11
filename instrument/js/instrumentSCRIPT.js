function updateClick(elt) {

    var columns = elt.children;
    var form =  window.parent.document.getElementById("editForm");
    var deleted =  window.parent.document.getElementById("deleteForm");
    //console.log("edit User");
    form.elements["perso"].value = columns[1].innerText;
    form.elements["num_membre"].value = columns[2].innerText;
    form.elements["num_type_instrument"].value = columns[3].innerText;
    form.elements["membre"].value = columns[4].innerText;
    form.elements["num_serie"].value = columns[5].innerText;
    form.elements["marque"].value = columns[6].innerText;
    form.elements["proprietaire"].value = columns[7].innerText;
    form.elements["reference"].value = columns[8].innerText;
    form.elements["remarques"].value = columns[9].innerText;
    form.elements["id"].value = columns[0].innerText;

    deleted.elements["id"].value = columns[0].innerText;
    deleted.elements["membre"].value = columns[4].innerText;
    deleted.elements["num_serie"].value = columns[5].innerText;
    
}

function loadTable(tableHTML) {
    var iframe = document.getElementById('tableFrame');
    var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
    iframeDocument.open();
    var button = "<input type=\"text\" id=\"searchBar\" onkeyup=\"filterTable()\" placeholder=\"Rechercher par nom ou prénom...\">";
    var script = "<script src=\"js/instrumentSCRIPT.js\"></script>";
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
