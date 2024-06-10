const delay = ms => new Promise(res => setTimeout(res, ms));
let cart_opened = false;

async function addToCart(id, restaurant_id) {
    const response = await fetch(`./../PHP/addItemToCart.php?id=${id}&restaurant=${restaurant_id}`);

    let elemDiv = document.createElement('div');
    elemDiv.classList.add("notification");
    elemDiv.id = "noti";
    elemDiv.onclick = function () {
        openShoppingCart();
    }
    elemDiv.innerHTML = "<h2>Zum Warenkorb hinzugefügt</h2>";
    document.body.appendChild(elemDiv);

    await delay(4900);

    elemDiv.remove();
}

function openShoppingCart() {
    cart_opened = true;
    window.open("./../PHP/shoppingCart.php", "_self");
}

function back() {
    window.open("./../PHP/restaurants.php", "_self");
}

// window.onbeforeunload = function () {
//     if (cart_opened == false)
//         return 'Are you sure you want to leave?';
// };