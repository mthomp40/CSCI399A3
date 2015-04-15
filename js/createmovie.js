var rows = 0;

// file drag hover
function FileDragHover(e) {
    if (!e)
        e = window.event;
    e.stopPropagation();
    e.preventDefault();
    e.target.css = (e.type == "dragover" ? "border-color: #f00;border-style: solid;box-shadow: inset 0 3px 4px #888" : "");

}

// file selection
function FileSelectHandler(e) {
    FileDragHover(e);
    var files = e.target.files || e.dataTransfer.files;

    // process all File objects
    for (var i = 0, f; f = files[i]; i++) {
        ParseFile(f);
    }

}

function ParseFile(file) {

    console.log(
            "<p>File information: <strong>" + file.name +
            "</strong> type: <strong>" + file.type +
            "</strong> size: <strong>" + file.size +
            "</strong> bytes</p>"
            );
}

function addData() {
    if (window.File && window.FileList && window.FileReader) {
        rows++;
        var dropper = document.getElementById("droppertable");
        var newtr = document.createElement("tr");
        var newtd = document.createElement("td");
        newtd.width = 150;
        newtd.height = 150;
        var newdiv = document.createElement("div");
        newdiv.id = "filedrag" + rows;
        newdiv.className = "filedrag";
        newdiv.style.width = "100%";
        newdiv.style.height = "100%";
        newdiv.style.backgroundColor = "gray";
        newtd.appendChild(newdiv);
        newtr.appendChild(newtd);
        newtd = null;
        newtd = document.createElement("td");
        newtd.width = 500;
        newtd.height = 150;
        var newtextarea = document.createElement("textarea");
        newtextarea.style.width = "100%";
        newtextarea.style.height = "100%";
        newtd.appendChild(newtextarea);
        newtr.appendChild(newtd);
        dropper.appendChild(newtr);

        var filedrag = document.getElementById("filedrag" + rows);
        filedrag.addEventListener("dragover", FileDragHover, false);
        filedrag.addEventListener("dragleave", FileDragHover, false);
        filedrag.addEventListener("drop", FileSelectHandler, false);
        //filedrag.style.display = "block";
    }
}

function redraw(elm) {
    var n = document.createTextNode(' ');
    elm.appendChild(n);
    setTimeout(function() {
        n.parentNode.removeChild(n)
    }, 0);
    return elm;
}