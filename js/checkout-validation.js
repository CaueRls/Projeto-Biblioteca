document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('payment-form');
    
    const inputs = {
        cpf: document.getElementById('cpf'),
        cardNumber: document.getElementById('card-number'),
        expiry: document.getElementById('expiry-date'),
        cvv: document.getElementById('cvv')
    };

    // --- 1. MÁSCARAS (Formatação enquanto digita) ---

    // Máscara CPF: 000.000.000-00
    inputs.cpf.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número
        if (value.length > 11) value = value.slice(0, 11); // Limita a 11 números

        if (value.length > 9) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d+)/, '$1.$2.$3-$4');
        } else if (value.length > 6) {
            value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
        } else if (value.length > 3) {
            value = value.replace(/(\d{3})(\d+)/, '$1.$2');
        }
        e.target.value = value;
    });

    // Máscara Cartão: 0000 0000 0000 0000
    inputs.cardNumber.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    });

// Máscara Validade: MM/AA (Adiciona a barra automaticamente)
    inputs.expiry.addEventListener('input', (e) => {
        // 1. Remove tudo que não é número
        let value = e.target.value.replace(/\D/g, '');

        // 2. Limita a 4 dígitos no total (2 para mês, 2 para ano)
        if (value.length > 4) value = value.slice(0, 4);

        // 3. Se tiver mais de 2 números, coloca a barra entre o mês e o ano
        if (value.length > 2) {
            value = value.replace(/(\d{2})(\d+)/, '$1/$2');
        }

        // 4. Atualiza o campo visualmente
        e.target.value = value;
    });

    // Máscara CVV: Apenas números
    inputs.cvv.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/\D/g, '');
    });


    // --- 2. VALIDAÇÕES (Ao sair do campo ou enviar) ---

    // Função auxiliar para mostrar/esconder erro
    function setError(input, isValid) {
        const group = input.closest('.form-group'); // Pega a div pai
        if (!isValid) {
            input.classList.add('input-error');
            group.classList.add('error'); // Mostra a mensagem span
        } else {
            input.classList.remove('input-error');
            group.classList.remove('error');
        }
        return isValid;
    }

    // Valida CPF (Verifica tamanho e formato básico)
    function validateCPF() {
        const value = inputs.cpf.value.replace(/\D/g, '');
        // Regra: Deve ter 11 dígitos e não pode ser todos iguais (ex: 111.111.111-11)
        const isValid = value.length === 11 && !/^(\d)\1+$/.test(value);
        return setError(inputs.cpf, isValid);
    }

    // Valida Cartão (Mínimo 16 dígitos)
    function validateCard() {
        const value = inputs.cardNumber.value.replace(/\D/g, '');
        return setError(inputs.cardNumber, value.length === 16);
    }

    // Valida Data (Mês 01-12 e Ano futuro)
    function validateExpiry() {
        const value = inputs.expiry.value;
        const regex = /^(0[1-9]|1[0-2])\/\d{2}$/; // Formato MM/AA
        
        if (!regex.test(value)) return setError(inputs.expiry, false);

        // Lógica simples de data futura (opcional)
        const [month, year] = value.split('/').map(Number);
        const currentYear = new Date().getFullYear() % 100; // Pega últimos 2 dígitos do ano
        const currentMonth = new Date().getMonth() + 1;

        const isValid = (year > currentYear) || (year === currentYear && month >= currentMonth);
        return setError(inputs.expiry, isValid);
    }

    // Valida CVV (3 ou 4 dígitos)
    function validateCVV() {
        const value = inputs.cvv.value.replace(/\D/g, '');
        return setError(inputs.cvv, value.length >= 3 && value.length <= 4);
    }

    // --- 3. EVENTOS DE SAÍDA (BLUR) ---
    // Valida assim que o usuário clica fora do campo
    inputs.cpf.addEventListener('blur', validateCPF);
    inputs.cardNumber.addEventListener('blur', validateCard);
    inputs.expiry.addEventListener('blur', validateExpiry);
    inputs.cvv.addEventListener('blur', validateCVV);

    // --- 4. ENVIO DO FORMULÁRIO ---
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Impede o envio real para testarmos

        const isCpfValid = validateCPF();
        const isCardValid = validateCard();
        const isExpiryValid = validateExpiry();
        const isCvvValid = validateCVV();

        if (isCpfValid && isCardValid && isExpiryValid && isCvvValid) {
            alert('Pagamento validado com sucesso! Enviando pedido...');
            // Aqui você colocaria o código para enviar ao backend
        } else {
            // Foca no primeiro campo com erro
            const firstError = document.querySelector('.input-error');
            if (firstError) firstError.focus();
        }
    });
});