document.getElementById('buyOrderForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let amount = document.getElementById('buyAmount').value;
    let price = document.getElementById('buyPrice').value;

    if (amount <= 0 || price <= 0) {
        showAlert("error", "Miktar ve fiyat pozitif olmalıdır.");
        return;
    }

    fetch('/api/buyOrder.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ amount: amount, price: price })
    })
    .then(response => response.json())
    .then(data => {
        showAlert(data.message.includes("başarıyla") ? "success" : "error", data.message);
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('sellOrderForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let amount = document.getElementById('sellAmount').value;
    let price = document.getElementById('sellPrice').value;

    if (amount <= 0 || price <= 0) {
        showAlert("error", "Miktar ve fiyat pozitif olmalıdır.");
        return;
    }

    fetch('/api/sellOrder.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ amount: amount, price: price })
    })
    .then(response => response.json())
    .then(data => {
        showAlert(data.message.includes("başarıyla") ? "success" : "error", data.message);
    })
    .catch(error => console.error('Error:', error));
});

function showAlert(type, message) {
    let alertDiv = document.createElement("div");
    alertDiv.className = `alert ${type}`;
    alertDiv.textContent = message;

    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}
