async function addToCart(id) {
    const response = await fetch(`./../PHP/addItemToCart.php?id=${id}`);
    const movies = await response.json();
    console.log(movies);
}

function openShoppingCart() {
    window.open("./../PHP/shoppingCart.php", "_self");
}