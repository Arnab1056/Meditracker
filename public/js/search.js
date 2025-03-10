document.getElementById('searchInput').addEventListener('input', function() {
    const query = this.value.toLowerCase();
    const results = document.getElementById('results');
    results.innerHTML = '';

    fetch(`/search-medicines?q=${query}`)
        .then(response => response.json())
        .then(medicines => {
            medicines.forEach(medicine => {
                const medicineDiv = document.createElement('div');
                medicineDiv.className = 'medicine';
                medicineDiv.innerHTML = `
                    <h2>${medicine.name}</h2>
                    <p>Quantity: ${medicine.quantity}</p>
                    <p>Location: ${medicine.location}</p>
                    <p>Details: ${medicine.detail}</p>
                    <button onclick="buyMedicine('${medicine.id}')">Buy Now</button>
                `;
                results.appendChild(medicineDiv);
            });
        });
});

function buyMedicine(medicineId) {
    fetch(`/buy-medicine/${medicineId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    });
}
