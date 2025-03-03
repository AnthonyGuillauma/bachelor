

function openWorldParticularity(name){
    document.getElementById(name + "-world-presentation").style.display = "flex";
    document.body.style.overflow = "hidden";
    document.getElementById("button-close-world-presentation").style.display = "block";
    document.getElementById("button-close-world-presentation").onclick = () => {closeWorldParticularity(name);}
}

function closeWorldParticularity(name){
    console.log("f")
    document.getElementById(name + "-world-presentation").style.display = "none";
    document.body.style.overflow = "auto";
    document.getElementById("button-close-world-presentation").style.display = "none";
}