document.addEventListener('DOMContentLoaded', function() {
  // --- Seleção de Elementos ---
  const firstNameInput = document.querySelector('input[placeholder="Ex: Edson"]');
  const lastNameInput = document.querySelector('input[placeholder="Ex: Manuel"]');
  const emailInput = document.querySelector('input[type="email"]');
  const passwordInput = document.querySelector('input[placeholder*="Senha"]');
  const provinceSelect = document.querySelector('select');
  const termsCheckbox = document.getElementById('terms-checkbox');
  const submitButton = document.querySelector('button[type="button"]:not(#toggle-password)');

  // Error spans
  const firstNameError = document.getElementById('first-name-error');
  const lastNameError = document.getElementById('last-name-error');
  const emailError = document.getElementById('email-error');
  const passwordError = document.getElementById('password-error');
  const provinceError = document.getElementById('province-error');
  const termsError = document.getElementById('terms-error');

  // Loading Overlay
  const loadingOverlay = document.querySelector('.fixed.inset-0.z-\\[100\\]');
  const successOverlay = document.getElementById('success-overlay-container');

  // --- Password Toggle ---
  const togglePasswordBtn = document.getElementById('toggle-password');
  if (togglePasswordBtn) {
    togglePasswordBtn.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      const icon = this.querySelector('span');
      if (icon) {
        icon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
      }
    });
  }

  // --- Funções de Validação ---
  function showError(input, errorSpan, message) {
    if(input) input.classList.add('border-error', 'border-red-500');
    if(errorSpan) {
      errorSpan.textContent = message;
      errorSpan.classList.remove('hidden');
    }
  }

  function hideError(input, errorSpan) {
    if(input) input.classList.remove('border-error', 'border-red-500');
    if(errorSpan) errorSpan.classList.add('hidden');
  }
  // --- Adicione ANTES de "Validação Inicial ao Carregar" ---

  // Bloquear submit normal do formulário
  const form = document.querySelector('form');
  if(form) {
      form.addEventListener('submit', function(e) {
          e.preventDefault(); // Impede o envio normal do form
      });
  }

  function validateFirstName() {
    const value = firstNameInput?.value.trim() || '';
    if (value === '') {
      showError(firstNameInput, firstNameError, 'Por favor, insira seu primeiro nome');
      return false;
    } else {
      hideError(firstNameInput, firstNameError);
      return true;
    }
  }

  function validateLastName() {
    const value = lastNameInput?.value.trim() || '';
    if (value === '') {
      showError(lastNameInput, lastNameError, 'Por favor, insira seu sobrenome');
      return false;
    } else {
      hideError(lastNameInput, lastNameError);
      return true;
    }
  }

  function validateEmail() {
    const value = emailInput?.value.trim() || '';
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (value === '') {
      showError(emailInput, emailError, 'Por favor, insira um endereço de e-mail');
      return false;
    } else if (!emailPattern.test(value)) {
      showError(emailInput, emailError, 'Por favor, insira um endereço de e-mail válido');
      return false;
    } else {
      hideError(emailInput, emailError);
      return true;
    }
  }

  function validatePassword() {
    const value = passwordInput?.value || '';
    if (value.length < 8) {
      showError(passwordInput, passwordError, 'A senha deve ter pelo menos 8 caracteres');
      return false;
    } else {
      hideError(passwordInput, passwordError);
      return true;
    }
  }

  function validateProvince() {
    const value = provinceSelect?.value || '';
    if (value === '') {
      showError(provinceSelect, provinceError, 'Por favor, selecione uma província');
      return false;
    } else {
      hideError(provinceSelect, provinceError);
      return true;
    }
  }

  function validateTerms() {
    if (!termsCheckbox?.checked) {
      showError(termsCheckbox, termsError, 'Você deve aceitar os Termos de Serviço e Política de Privacidade');
      return false;
    } else {
      hideError(termsCheckbox, termsError);
      return true;
    }
  }

  // --- Atualizar Estado do Botão ---
  function updateSubmitButtonState() {
    const isFirstNameValid = validateFirstName();
    const isLastNameValid = validateLastName();
    const isEmailValid = validateEmail();
    const isPasswordValid = validatePassword();
    const isProvinceValid = validateProvince();
    const isTermsValid = validateTerms();

    const isFormValid = isFirstNameValid && isLastNameValid && isEmailValid && 
                        isPasswordValid && isProvinceValid && isTermsValid;

    if (isFormValid && submitButton) {
      submitButton.removeAttribute('disabled');
      submitButton.classList.remove('opacity-40', 'cursor-not-allowed');
    } else if (submitButton) {
      submitButton.setAttribute('disabled', '');
      submitButton.classList.add('opacity-40', 'cursor-not-allowed');
    }
  }

  // --- Loading Toggle ---
  function toggleLoading(show) {
    if (show) {
      if(loadingOverlay) loadingOverlay.classList.remove('hidden');
      if(submitButton) {
        submitButton.disabled = true;
        submitButton.classList.add('opacity-50', 'cursor-not-allowed');
      }
    } else {
      if(loadingOverlay) loadingOverlay.classList.add('hidden');
      if(submitButton) {
        submitButton.disabled = false;
        submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
      }
    }
  }

  // --- Event Listeners para Validação em Tempo Real ---
  if(firstNameInput) firstNameInput.addEventListener('input', function() { validateFirstName(); updateSubmitButtonState(); });
  if(lastNameInput) lastNameInput.addEventListener('input', function() { validateLastName(); updateSubmitButtonState(); });
  if(emailInput) emailInput.addEventListener('input', function() { validateEmail(); updateSubmitButtonState(); });
  if(passwordInput) passwordInput.addEventListener('input', function() { validatePassword(); updateSubmitButtonState(); });
  if(provinceSelect) provinceSelect.addEventListener('change', function() { validateProvince(); updateSubmitButtonState(); });
  if(termsCheckbox) termsCheckbox.addEventListener('change', function() { validateTerms(); updateSubmitButtonState(); });

  // --- Submit Button Logic ---
    // --- Submit Button Logic ---
  if(submitButton) {
    submitButton.addEventListener('click', async function(e) {
      e.preventDefault();

      // Validação final antes de enviar
      updateSubmitButtonState();

      const isFirstNameValid = validateFirstName();
      const isLastNameValid = validateLastName();
      const isEmailValid = validateEmail();
      const isPasswordValid = validatePassword();
      const isProvinceValid = validateProvince();
      const isTermsValid = validateTerms();

      if (!isFirstNameValid || !isLastNameValid || !isEmailValid || 
          !isPasswordValid || !isProvinceValid || !isTermsValid) {
        return;
      }

      // Preparar Dados
      const formData = new FormData();
      formData.append('primeiro_nome', firstNameInput.value.trim());
      formData.append('sobrenome', lastNameInput.value.trim());
      formData.append('email', emailInput.value.trim());
      formData.append('password', passwordInput.value);
      formData.append('provincia_id', provinceSelect.value);
      
      // Define a função baseada na página atual
      const isClientePage = document.title.includes('Cliente'); 
      formData.append('funcao', isClientePage ? 'cliente' : 'freelancer');

      // Mostrar loading
      toggleLoading(true);

      try {
        const response = await fetch('/registar', {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const data = await response.json();

        if (response.ok) {
    // Parse da resposta JSON
    const data = await response.json();
          
    // SUCESSO
    toggleLoading(false);

    const successEl = document.getElementById('success-overlay-container');
    if (successEl) {
        successEl.classList.remove('hidden');
    }

    setTimeout(() => {
        // Usa o redirect do backend se existir, senão usa o fallback
        window.location.href = data.redirect || 
            (data.role === 'cliente' ? '/painel/cliente' : '/painel/freelancer');
    }, 4000);

} else if (response.status === 422) {
    // ERRO DE VALIDAÇÃO
    toggleLoading(false);
    
    const data = await response.json();
    
    if (data.errors) {
        const errorMap = {
            'primeiro_nome': 'primeiro_nome',
            'sobrenome': 'sobrenome',
            'email': 'email',
            'password': 'password',
            'provincia_id': 'provincia'
        };

        for (const [key, messages] of Object.entries(data.errors)) {
            const frontendKey = errorMap[key];
            if (frontendKey) {
                showFieldError(frontendKey, messages[0]);
            }
        }
    }
    
} else {
            toggleLoading(false);
            alert('Ocorreu um erro inesperado. Tente novamente.');
        }

      } catch (error) {
        toggleLoading(false);
        console.error('Erro:', error);
        alert('Erro de conexão. Verifique sua internet.');
      }
    }); // <--- ADICIONE ISTO (Fecha o addEventListener)
  } // <--- ISTO JÁ EXISTIA (Fecha o if)

  // --- Validação Inicial ao Carregar ---
  validateFirstName();
  validateLastName();
  validateEmail();
  validatePassword();
  validateProvince();
  validateTerms();
  updateSubmitButtonState();
});