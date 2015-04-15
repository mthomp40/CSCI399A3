var rows = 0;

function FileDragHover(e) {
    e.stopPropagation();
    e.preventDefault();
    e.target.className = (e.type == "dragover" ? "filedrag hover" : "filedrag");
}

function FileSelectHandler(e) {
    FileDragHover(e);
    var files = e.target.files || e.dataTransfer.files;

    if (files.length > 1) {
        alert('Only one file can be dragged onto the upload area');
    } else if (files.length === 1) {
        if (files[0].type.indexOf("image") == 0) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.getElementById("filedrag" + rows);
                img.src = e.target.result;
                img.className = "";
                var hidden = document.createElement("input");
                hidden.type = "hidden";
                hidden.name = "img" + rows;
                hidden.value = e.target.result;
                hidden.innerHTML = e.target.result;
                var dropper = document.getElementById("droppertable");
                img.appendChild(hidden);
            }
            reader.readAsDataURL(files[0]);
        }
    }

}

function addData() {
    if (window.File && window.FileList && window.FileReader) {
        rows++;
        var dropper = document.getElementById("droppertable");
        var newtr = document.createElement("tr");
        var newtd = document.createElement("td");
        newtd.width = 150;
        newtd.height = 150;
        var newimg = document.createElement("img");
        newimg.id = "filedrag" + rows;
        newimg.name = "filedrag" + rows;
        newimg.className = "filedrag";
        newimg.style.width = "100%";
        newimg.style.height = "100%";
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
            newimg.addEventListener("dragover", FileDragHover, false);
            newimg.addEventListener("dragleave", FileDragHover, false);
            newimg.addEventListener("drop", FileSelectHandler, false);
        }
        newtd.appendChild(newimg);
        newtr.appendChild(newtd);
        newtd = document.createElement("td");
        newtd.width = 500;
        newtd.height = 150;
        var newtextarea = document.createElement("textarea");
        newtextarea.id = "info" + rows;
        newtextarea.name = "info" + rows;
        newtextarea.style.width = "100%";
        newtextarea.style.height = "100%";
        newtd.appendChild(newtextarea);
        newtr.appendChild(newtd);
        dropper.appendChild(newtr);
    }
}