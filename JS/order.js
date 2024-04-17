const delay = ms => new Promise(res => setTimeout(res, ms));

async function addToCart(id) {
    const response = await fetch(`./../PHP/addItemToCart.php?id=${id}`);

    let elemDiv = document.createElement('div');
    elemDiv.classList.add("notification");
    elemDiv.id = "noti";
    elemDiv.innerHTML = "<h2>Zum Warenkorb hinzugefügt</h2>";
    document.body.appendChild(elemDiv);

    await delay(4900);

    elemDiv.remove();
}

function openShoppingCart() {
    window.open("./../PHP/shoppingCart.php", "_self");
}