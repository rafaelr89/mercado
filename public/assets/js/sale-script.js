window.addEventListener("load", (event) => {
    const addButton = document.getElementById('add-product');

    // Adicionar evento de clique ao botão "Adicionar"
    addButton.addEventListener('click', () => {
        const productsSelect = document.getElementById("products");
        const product = productsSelect.options[productsSelect.selectedIndex];
        const quantityInput = document.getElementById('quantity');
        const table = document.getElementById('products-table');

        if (product.value == '' || quantityInput.value.trim() === '' || quantityInput.value <= 0) {
            return false;
        }

        // Criar uma nova linha na tabela
        const newLine = table.insertRow();

        newLine.dataset.id = product.value;

        newLine.insertCell().innerHTML = product.value;
        newLine.insertCell().innerHTML = product.text;

        const productPrice = product.dataset.price;
        newLine.insertCell().innerHTML = 'R$ ' + formatDecimal(productPrice);

        const productQuantity = quantityInput.value;
        newLine.insertCell().innerHTML = productQuantity;
        newLine.dataset.quantity = productQuantity;

        newLine.insertCell().innerHTML = product.dataset.type;
        
        const productTax = product.dataset.tax;
        newLine.insertCell().innerHTML = productTax + '%';

        var subTotal = productPrice * productQuantity;
        var taxTotal = (subTotal / 100) * productTax;

        newLine.dataset.price = subTotal;
        newLine.dataset.tax = taxTotal;
        
        subTotal = parseFloat(subTotal + taxTotal).toFixed(2);

        newLine.dataset.subtotal = subTotal;

        newLine.insertCell().innerHTML = 'R$ ' + formatDecimal(subTotal);
        newLine.insertCell().innerHTML = '<button type="button" class="btn btn-danger btn-sm" onClick="deleteProduct(' + product.value + ');"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>';

        if (table.tBodies[0].rows[0].dataset.empty === 'true') {
            table.tBodies[0].removeChild(table.tBodies[0].rows[0]);
        }

        disableProduct(product.value, true);

        printTotal();
        refreshTotal();

        // Limpar os inputs
        productsSelect.value = '';
        quantityInput.value = '';

        document.getElementById('alert-products').classList.add('d-none');
    });
});

function deleteProduct(id) {
    var tbody = document.getElementById('products-table').tBodies[0];
    var row = tbody.querySelector('[data-id="' + id + '"]');

    tbody.removeChild(row);

    disableProduct(id, false);

    if (tbody.rows.length === 0) {
        const newRow = document.createElement('tr');
        newRow.dataset.empty = true;
        newRow.innerHTML = '<td colspan="8" class="text-center">Nenhum produto adicionado</td>';

        tbody.appendChild(newRow);
    }

    printTotal();
    refreshTotal();
}

function disableProduct(id, disable) {
    const productsSelect = document.getElementById("products").options;

    for (let i = 0; i < productsSelect.length; i++) {
        if (productsSelect[i].value == id) {
            productsSelect[i].disabled = disable;
        }
    }
}

function formatDecimal(number) {
    const formattedNumber = new Intl.NumberFormat('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(number);
    
    return formattedNumber;
}

function printTotal() {
    const products = document.querySelectorAll("#products-table tr");

    var priceTotal = 0;
    var taxTotal = 0;
    var total = 0;

    for (let i = 0; i < products.length; i++) {
        if (parseFloat(products[i].dataset.subtotal) > 0) {
            priceTotal = priceTotal + parseFloat(products[i].dataset.price);
            taxTotal = taxTotal + parseFloat(products[i].dataset.tax);
            total = total + parseFloat(products[i].dataset.subtotal);
        }
    }

    const productsTotalInput = document.getElementById('products-total');
    const taxTotalInput = document.getElementById('tax-total');
    const totalInput = document.getElementById('total');

    productsTotalInput.value = 'R$ ' + formatDecimal(priceTotal);
    taxTotalInput.value = 'R$ ' + formatDecimal(taxTotal);
    totalInput.value = 'R$ ' + formatDecimal(total);
}

function refreshTotal() {
    // seleciona a tabela de produtos
    const table = document.getElementById('products-table');

    // array para armazenar os produtos
    const products = [];

    // itera sobre as linhas da tabela
    for (let i = 1; i < table.rows.length; i++) {
        const row = table.rows[i];
        const id = row.dataset.id;
        const quantity = row.dataset.quantity;

        // adiciona as informações do produto ao array
        products.push({ id, quantity });
    }

    // converte o array em uma string JSON e armazena no campo oculto
    document.getElementById('all-products').value = JSON.stringify(products);
}

function validaForm() {
    // seleciona a tabela de produtos
    const products = document.querySelectorAll('#products-table tbody tr');

    if (products.length <= 1 || products[0].dataset.empty === 'true') {
        document.getElementById('alert-products').classList.remove('d-none');
        return false;
    }
}