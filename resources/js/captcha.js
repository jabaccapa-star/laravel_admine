const IMAGE_URLS = window.CAPTCHA_IMAGE_URLS ?? [];
const CORRECT_ORDER = [0, 1, 2, 3];

const container = document.getElementById('captcha-container');
const resultMessage = document.getElementById('result-message');
const captchaOrderInput = document.getElementById('captcha_order');
const loginSubmitButton = document.getElementById('login-submit');

if (!container || !resultMessage) {
    // CAPTCHA block is not on this page
} else {
    const pieces = [];
    let captchaAttempted = false;
    const shuffledIndices = [...CORRECT_ORDER].sort(() => Math.random() - 0.5);

    function updateFormState() {
        const currentOrder = Array.from(pieces).map((p) => parseInt(p.dataset.index, 10));
        const passed = JSON.stringify(currentOrder) === JSON.stringify(CORRECT_ORDER);

        if (captchaOrderInput) {
            captchaOrderInput.value = currentOrder.join(',');
        }

        if (loginSubmitButton) {
            loginSubmitButton.disabled = !passed;
        }

        if (passed) {
            resultMessage.textContent = '✅ CAPTCHA пройдена!';
            resultMessage.className = 'correct';
        } else if (captchaAttempted) {
            resultMessage.textContent = '❌ Попробуйте ещё!';
            resultMessage.className = 'incorrect';
        } else {
            resultMessage.textContent = 'Соберите изображение!';
            resultMessage.className = '';
        }
    }

    function swapPieces(a, b) {
        captchaAttempted = true;
        const tempIndex = a.dataset.index;
        a.dataset.index = b.dataset.index;
        b.dataset.index = tempIndex;

        const tempImg = a.querySelector('img').src;
        a.querySelector('img').src = b.querySelector('img').src;
        b.querySelector('img').src = tempImg;

        a.classList.remove('selected');
        b.classList.remove('selected');
        updateFormState();
    }

    shuffledIndices.forEach((index) => {
        const piece = document.createElement('div');
        piece.className = 'captcha-piece';
        piece.dataset.index = String(index);
        piece.innerHTML = `<img src="${IMAGE_URLS[index]}" alt="Фрагмент">`;

        piece.draggable = true;
        piece.addEventListener('dragstart', () => {
            piece.classList.add('dragging');
        });

        piece.addEventListener('dragend', () => {
            piece.classList.remove('dragging');
        });

        piece.addEventListener('click', () => {
            if (piece.classList.contains('selected')) {
                piece.classList.remove('selected');
                return;
            }

            const selected = document.querySelector('.captcha-piece.selected');
            if (selected && selected !== piece) {
                swapPieces(selected, piece);
            } else {
                piece.classList.add('selected');
            }
        });

        container.appendChild(piece);
        pieces.push(piece);
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.captcha-piece')) {
            document.querySelectorAll('.captcha-piece.selected').forEach((el) => {
                el.classList.remove('selected');
            });
        }
    });

    container.addEventListener('dragover', (e) => {
        e.preventDefault();
        const dragging = document.querySelector('.dragging');
        if (!dragging) {
            return;
        }

        const target = e.target.closest('.captcha-piece');
        if (!target || target === dragging) {
            return;
        }

        swapPieces(dragging, target);
    });

    resultMessage.textContent = 'Соберите изображение!';
    resultMessage.className = '';
    updateFormState();
}
