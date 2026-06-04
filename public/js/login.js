document.addEventListener('DOMContentLoaded', function() {
    // --- Seleção de Elementos ---
    const form = document.getElementById('login-form');
    const emailInput = document.getElementById('email-input');
    const passwordInput = document.getElementById('password-input');
    const submitButton = document.getElementById('submit-button');
    const togglePasswordBtn = document.getElementById('toggle-password');
    
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const globalError = document.getElementById('global-error');
    const globalErrorMessage = document.getElementById('global-error-message');
    
    const loadingOverlay = document.getElementById('loading-overlay');
    const successOverlay = document.getElementById('success-overlay');

    // --- Funções de Validação ---

    function showError(input, errorSpan, message) {
        if (input) input.classList.add('border-error');
        if (errorSpan) {
            errorSpan.classList.remove('hidden');
            const textSpan = errorSpan.querySelector('span:last-child');
            if (textSpan) textSpan.textContent = message;
        }
    }

    function hideError(input, errorSpan) {
        if (input) input.classList.remove('border-error');
        if (errorSpan) errorSpan.classList.add('hidden');
    }

    function hideGlobalError() {
        globalError.classList.add('hidden');
    }

    function showGlobalError(message) {
        globalErrorMessage.textContent = message;
        globalError.classList.remove('hidden');
    }

    function validateEmail() {
        const value = emailInput?.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!value) {
            showError(emailInput, emailError, 'Por favor, insira seu e-mail');
            return false;
        } else if (!emailPattern.test(value)) {
            showError(emailInput, emailError, 'Por favor, insira um endereço de e-mail válido');
            return false;
        }
        hideError(emailInput, emailError);
        return true;
    }

    function validatePassword() {
        const value = passwordInput?.value;
        
        if (!value) {
            showError(passwordInput, passwordError, 'Por favor, insira sua senha');
            return false;
        }
        hideError(passwordInput, passwordError);
        return true;
    }

    function updateSubmitButtonState() {
        const isValid = validateEmail() && validatePassword();
        
        if (submitButton) {
            if (isValid) {
                submitButton.removeAttribute('disabled');
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitButton.setAttribute('disabled', '');
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    function toggleLoading(show) {
        if (show) {
            if (loadingOverlay) loadingOverlay.classList.remove('hidden');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            }
        } else {
            if (loadingOverlay) loadingOverlay.classList.add('hidden');
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    // --- Event Listeners ---

    // Toggle Password Visibility
    if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            const icon = this.querySelector('span');
            if (icon) {
                icon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
            }
        });
    }

    // Validação em tempo real
    emailInput?.addEventListener('input', function() {
        validateEmail();
        hideGlobalError();
        updateSubmitButtonState();
    });

    passwordInput?.addEventListener('input', function() {
        validatePassword();
        hideGlobalError();
        updateSubmitButtonState();
    });

    // Submit do Form
    form?.addEventListener('submit', async function(e) {
    e.preventDefault();
    hideGlobalError();

    if (!validateEmail() || !validatePassword()) {
        updateSubmitButtonState();
        return;
    }

    const formData = new FormData();
    formData.append('email', emailInput.value.trim());
    formData.append('password', passwordInput.value);

    toggleLoading(true);
    

    try {
    const response = await fetch('/login', {
    method: 'POST',
    body: formData,
    credentials: 'include',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

const data = await response.json();

if (response.ok) {
    toggleLoading(false);

    setTimeout(() => {
        window.location.href = data.redirect;
    }, 1200);
} else {
    showGlobalError(data.message);
}
    toggleLoading(false);

    console.log('STATUS:', response.status);

console.log('RESPONSE DATA:', data);



} catch (error) {
    toggleLoading(false);
    console.log('FETCH ERROR REAL:', error);
    showGlobalError('Erro de conexão com o servidor.');
    
}
});

    // Validação inicial ao carregar
    updateSubmitButtonState();
});