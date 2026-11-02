/**
 * Spillburg Logistics 1 (Private) Limited
 * RFQ Multi-Step Form Interactive Controller
 * Progressive enhancement: form submits natively if JS is absent.
 */

document.addEventListener('DOMContentLoaded', () => {
    const wizardForm = document.getElementById('quoteForm');
    if (!wizardForm) return;

    const steps = wizardForm.querySelectorAll('.wizard-step-pane');
    const tabs = document.querySelectorAll('.wizard-step-tab');
    const prevBtn = document.getElementById('prevStepBtn');
    const nextBtn = document.getElementById('nextStepBtn');
    const submitBtn = document.getElementById('submitRfqBtn');

    let currentStep = 1;
    const totalSteps = steps.length;

    function showStep(stepNum) {
        steps.forEach((pane) => {
            const paneStep = parseInt(pane.getAttribute('data-step'), 10);
            if (paneStep === stepNum) {
                pane.style.display = 'block';
            } else {
                pane.style.display = 'none';
            }
        });

        tabs.forEach((tab) => {
            const tabStep = parseInt(tab.getAttribute('data-step'), 10);
            tab.classList.remove('active');
            if (tabStep === stepNum) {
                tab.classList.add('active');
            } else if (tabStep < stepNum) {
                tab.classList.add('completed');
            } else {
                tab.classList.remove('completed');
            }
        });

        // Controls visibility
        if (prevBtn) {
            prevBtn.style.visibility = stepNum === 1 ? 'hidden' : 'visible';
        }

        if (nextBtn && submitBtn) {
            if (stepNum === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-flex';
            } else {
                nextBtn.style.display = 'inline-flex';
                submitBtn.style.display = 'none';
            }
        }

        window.scrollTo({
            top: wizardForm.getBoundingClientRect().top + window.scrollY - 100,
            behavior: 'smooth'
        });
    }

    function validateCurrentStep(stepNum) {
        const currentPane = wizardForm.querySelector(`.wizard-step-pane[data-step="${stepNum}"]`);
        if (!currentPane) return true;

        const requiredInputs = currentPane.querySelectorAll('[required]');
        let isValid = true;
        let firstInvalid = null;

        requiredInputs.forEach((input) => {
            // Check radio groups
            if (input.type === 'radio') {
                const groupName = input.name;
                const checked = currentPane.querySelector(`input[name="${groupName}"]:checked`);
                if (!checked) {
                    isValid = false;
                    if (!firstInvalid) firstInvalid = input;
                }
            } else if (!input.value.trim()) {
                input.style.borderColor = 'var(--color-error)';
                isValid = false;
                if (!firstInvalid) firstInvalid = input;
            } else {
                input.style.borderColor = '';
            }
        });

        if (!isValid && firstInvalid) {
            firstInvalid.focus();
            return false;
        }

        return true;
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (validateCurrentStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    }

    // Allow clicking completed tabs to jump back
    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const targetStep = parseInt(tab.getAttribute('data-step'), 10);
            if (targetStep < currentStep || validateCurrentStep(currentStep)) {
                currentStep = targetStep;
                showStep(currentStep);
            }
        });
    });

    // Remove red error highlight upon user input
    wizardForm.querySelectorAll('input, select, textarea').forEach((field) => {
        field.addEventListener('input', () => {
            field.style.borderColor = '';
        });
    });

    // Initialize first step
    showStep(currentStep);
});
