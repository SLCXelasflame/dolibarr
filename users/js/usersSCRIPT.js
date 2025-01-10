function updateClick(elt) {

    var columns = elt.children;
    var form = document.getElementById("editForm");
    //console.log("edit User");
    form.elements["firstname"].value = columns[1].innerText;
    form.elements["lastname"].value = columns[2].innerText;
    form.elements["mail"].value = columns[3].innerText;
    form.elements["birthday"].value = columns[4].innerText;
    form.elements["rowid"].value = columns[0].innerText;

    
}