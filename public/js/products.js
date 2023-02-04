const addProductForm = document.querySelector(".addProductForm");
const editProductForm = document.querySelector(".editProductForm");
const productNameInput = document.querySelector(".productName");
const productPriceInput = document.querySelector(".productPrice");
const productQuantityInput = document.querySelector(".productQuantity");
const productsTable = document.querySelector(".productsTable");
const sumTotalValue = document.querySelector(".sumTotalValue");
const productId = document.querySelector(".productId");

productNameInput.addEventListener("input", (e) => {
    removeValidationStyle(e);
});

productPriceInput.addEventListener("input", (e) => {
    removeValidationStyle(e);
});

productQuantityInput.addEventListener("input", (e) => {
    removeValidationStyle(e);
});

const appendProductRowToProductsTable = (productId, product, createdAt) => {
    const tableRow = document.createElement("tr");
    tableRow.innerHTML = `
        <td>${product.name}</td>
        <td>${product.quantity_in_stock}</td>
        <td>${product.price}</td>
        <td>${createdAt}</td>
        <td>${product.price * product.quantity_in_stock}</td>
        <td><a href="/products/${productId}/edit" class="btn btn-sm btn-info">Edit</a></td>
    `;
    productsTable.querySelector(".tbody").appendChild(tableRow);
    let oldTotalValue =
        sumTotalValue.textContent === ""
            ? 0
            : parseInt(sumTotalValue.textContent);
    oldTotalValue += parseInt(product.price * product.quantity_in_stock);
    sumTotalValue.textContent = oldTotalValue;
};

const updateProduct = async () => {
    if (!validateProductInputs()) return false;
    const productData = {
        name: productNameInput.value,
        price: productPriceInput.value,
        quantity_in_stock: productQuantityInput.value,
    };

    try {
        const response = await axios.post(`/products/${productId.value}`, {
            _method: "patch",
            data: productData,
        });

        if (response.data.error) {
            alert("something went wrong");
            clearInputsAndStyles();
            return false;
        }
        const { product } = response.data;
        const parsedProduct = JSON.parse(product.data);

        location.href = "/products/create";
    } catch (error) {
        console.log(error);
        alert("something wen wrong");
    }
};

const storeProduct = async () => {
    if (!validateProductInputs()) return false;
    const productData = {
        name: productNameInput.value,
        price: productPriceInput.value,
        quantity_in_stock: productQuantityInput.value,
    };

    try {
        const response = await axios.post(`/products/`, {
            data: productData,
        });

        if (response.data.error) {
            alert("something went wrong");
            clearInputsAndStyles();
            return false;
        }
        const { product } = response.data;
        const parsedProduct = JSON.parse(product.data);
        appendProductRowToProductsTable(
            product.id,
            parsedProduct,
            product.created_at
        );
        clearInputsAndStyles();
    } catch (error) {
        console.log(error);
        alert("something wen wrong");
    }
};

const clearInputsAndStyles = () => {
    const inputs = document.querySelectorAll(".form-control");
    inputs.forEach((item) => {
        item.value = "";
        item.style.border = "1px solid #ced4da";
    });
};

const removeValidationStyle = (e) => {
    const targetedInput = e.target;
    if (targetedInput.value === "") {
        targetedInput.style.border = "1px solid red";
    } else {
        targetedInput.style.border = "1px solid green";
    }
};

const validateProductInputs = () => {
    if (productNameInput.value === "") {
        productNameInput.style.border = "1px solid red";
        return false;
    }

    if (productPriceInput.value === "") {
        productPriceInput.style.border = "1px solid red";
        return false;
    }

    if (productQuantityInput.value === "") {
        productQuantityInput.style.border = "1px solid red";
        return false;
    }

    return true;
};

if (addProductForm) {
    addProductForm.addEventListener("submit", (e) => {
        e.preventDefault();
        storeProduct();
    });
}

if (editProductForm) {
    editProductForm.addEventListener("submit", (e) => {
        e.preventDefault();
        updateProduct();
    });
}
