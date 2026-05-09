const STORAGE_KEY = 'ferrari_cart';

const getCart = () => JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
const saveCart = (data) => localStorage.setItem(STORAGE_KEY, JSON.stringify(data));

function initAddToCart() {
    const buyButtons = document.querySelectorAll('.btn-primary');
    
    buyButtons.forEach(btn => {
        if (btn.innerText.toUpperCase().includes('ADD TO CART')) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const name = this.getAttribute('data-name');
                const price = parseFloat(this.getAttribute('data-price'));

                if (name && !isNaN(price)) {
                    const cart = getCart();
                    cart.push({ name, price });
                    saveCart(cart);

                    const originalText = this.innerText;
                    this.innerText = "ADDING...";
                    this.style.backgroundColor = "#28a745";
                    
                    setTimeout(() => {
                        window.location.href = 'payment.html';
                    }, 400);
                } else {
                    console.error("Atribut data-name atau data-price hilang di HTML!");
                }
            });
        }
    });
}

function renderSummary() {
    const listContainer = document.getElementById('cart-items-list');
    const totalCountEl = document.getElementById('total-items-count');
    const subtotalEl = document.getElementById('subtotal-price');
    const finalTotalEl = document.getElementById('final-total');

    if (!listContainer) return;

    const cart = getCart();
    let html = '';
    let total = 0;

    if (cart.length === 0) {
        listContainer.innerHTML = '<p style="color: #666; text-align: center; margin-top: 20px;">Your cart is empty.</p>';
        if (totalCountEl) totalCountEl.innerText = "0";
        if (subtotalEl) subtotalEl.innerText = "$0.00";
        if (finalTotalEl) finalTotalEl.innerText = "$0.00";
        return;
    }

    cart.forEach((item, index) => {
        total += item.price;
        html += `
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: #1a1a1a; padding: 10px; border-radius: 6px;">
                <div>
                    <p style="color: white; margin: 0; font-weight: 600; font-size: 0.85rem;">${item.name}</p>
                    <small style="color: #666;">Official Teamwear</small>
                </div>
                <span style="color: #d4af37; font-weight: bold;">$${item.price.toFixed(2)}</span>
            </div>
        `;
    });
    

    listContainer.innerHTML = html;
    if (totalCountEl) totalCountEl.innerText = cart.length;
    if (subtotalEl) subtotalEl.innerText = `$${total.toFixed(2)}`;
    if (finalTotalEl) finalTotalEl.innerText = `$${total.toFixed(2)}`;
}

window.clearCart = function() {
    if (confirm("Remove all items from cart?")) {
        localStorage.removeItem(STORAGE_KEY);
        renderSummary();
    }
};

window.onload = () => {
    initAddToCart();
    renderSummary();
    console.log("Ferrari Cart System: Active");

const sidebar = document.getElementById('merch-sidebar');
const openBtn = document.getElementById('open-merch-sidebar');
const closeBtn = document.getElementById('close-sidebar');
const overlay = document.getElementById('sidebar-overlay');

if (openBtn && sidebar) {
    openBtn.addEventListener('click', () => {
        sidebar.style.left = '0';
        overlay.style.display = 'block';
    });

    const closeSidebar = () => {
        sidebar.style.left = '-400px';
        overlay.style.display = 'none';
    };

    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
}

function initQuickAdd() {
    const quickButtons = document.querySelectorAll('#quick-merch-list .btn-primary');
    quickButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price'));
            
            if (name && !isNaN(price)) {
                let cart = JSON.parse(localStorage.getItem('ferrari_cart')) || [];
                cart.push({ name, price });
                localStorage.setItem('ferrari_cart', JSON.stringify(cart));

                renderSummary(); 
                
                this.innerText = "ADDED!";
                this.style.backgroundColor = "#28a745";
                setTimeout(() => {
                    this.innerText = "+ ADD";
                    this.style.backgroundColor = "";
                }, 1000);
            }
        });
    });
}
};