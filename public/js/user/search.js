document.getElementById('searchInput').addEventListener('input', function() {
    let query = this.value;
    if (query.length > 1) {
        fetch(`/search-medicines?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let results = document.getElementById('results');
                results.innerHTML = '';
                data.forEach(item => {
                    let resultItem = document.createElement('div');
                    resultItem.classList.add('result-item');
                    resultItem.innerHTML = `
                        <p>${item.name}</p>
                        <button onclick="buyMedicine(${item.id})">Buy Now</button>
                    `;
                    results.appendChild(resultItem);
                });
            });
    } else {
        document.getElementById('results').innerHTML = '';
    }
});

function buyMedicine(id) {
    fetch(`/buy-medicine/${id}`, {
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
