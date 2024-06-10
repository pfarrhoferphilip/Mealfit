window.setTimeout(loadingEnd, 3000);

function loadingEnd() {
    console.log("Loading ended");
    document.getElementById("loading-box").remove();
    document.getElementById("invis").classList.remove("invisible");
}