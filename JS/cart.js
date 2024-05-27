function openCheckout() {
    window.open('./checkout.php', '_self');
}

async function removeFromCart(id) {
    if (confirm("Möchten Sie dieses Gericht wirklich aus dem Warenkorb entfernen?")) {
        const response = await fetch(`./../PHP/removeFromCart.php?id=${id}`);
        location.reload();
    }
}

function goBack() {
    window.open("./../PHP/orderPage.php", "_self");
}