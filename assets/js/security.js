/**
 * Security Utilities for Modern Agent
 * CSRF token management, form validation, and XSS protection
 */

(function(window) {
    'use strict';

    // CSRF Token Management
    const Security = {
        
        // CSRF token cache
        csrfToken: null,
        
        /**
         * Initialize security features
         */
        init: function() {
            this.setupCSRFToken();
            this.setupFormValidation();
            this.setupXSSProtection();
            this.bindEvents();
        },

        /**
         * Setup CSRF token for all forms
         */
        setupCSRFToken: function() {
            // Get CSRF token from meta tag or generate one
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (tokenMeta) {
                this.csrfToken = tokenMeta.getAttribute('content');
            }

            // Add CSRF token to all forms
            this.addCSRFToForms();
        },

        /**
         * Add CSRF token to all forms on the page
         */
        addCSRFToForms: function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                if (!form.querySelector('input[name="csrf_token"]')) {
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = 'csrf_token';
                    csrfInput.value = this.csrfToken || this.generateToken();
                    form.appendChild(csrfInput);
                }
            });
        },

        /**
         * Generate a CSRF token
         */
        generateToken: function() {
            return Math.random().toString(36).substr(2) + Date.now().toString(36);
        },

        /**
         * Setup form validation
         */
        setupFormValidation: function() {
            const forms = document.querySelectorAll('form[data-validate="true"]');
            forms.forEach(form => {
                form.addEventListener('submit', this.validateForm.bind(this));
            });
        },

        /**
         * Validate form before submission
         */
        validateForm: function(event) {
            const form = event.target;
            const isValid = this.checkFormValidity(form);
            
            if (!isValid) {
                event.preventDefault();
                this.showValidationErrors(form);
                return false;
            }
            
            return true;
        },

        /**
         * Check form validity
         */
        checkFormValidity: function(form) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    this.markFieldInvalid(field, 'This field is required');
                    isValid = false;
                } else {
                    this.markFieldValid(field);
                }

                // Email validation
                if (field.type === 'email' && field.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(field.value)) {
                        this.markFieldInvalid(field, 'Please enter a valid email address');
                        isValid = false;
                    }
                }

                // Password validation (minimum 8 characters)
                if (field.type === 'password' && field.value && field.value.length < 8) {
                    this.markFieldInvalid(field, 'Password must be at least 8 characters long');
                    isValid = false;
                }
            });

            return isValid;
        },

        /**
         * Mark field as invalid
         */
        markFieldInvalid: function(field, message) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            
            let errorElement = field.parentNode.querySelector('.error-message');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.className = 'error-message';
                errorElement.style.color = '#dc3545';
                errorElement.style.fontSize = '0.875rem';
                errorElement.style.marginTop = '0.25rem';
                field.parentNode.appendChild(errorElement);
            }
            errorElement.textContent = message;
        },

        /**
         * Mark field as valid
         */
        markFieldValid: function(field) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
            
            const errorElement = field.parentNode.querySelector('.error-message');
            if (errorElement) {
                errorElement.remove();
            }
        },

        /**
         * Show validation errors summary
         */
        showValidationErrors: function(form) {
            const errorFields = form.querySelectorAll('.is-invalid');
            if (errorFields.length > 0) {
                this.showAlert('Please correct the errors in the form before submitting.', 'danger');
                errorFields[0].focus();
            }
        },

        /**
         * Setup XSS protection
         */
        setupXSSProtection: function() {
            // Automatically escape content in elements with data-escape attribute
            const escapeElements = document.querySelectorAll('[data-escape="true"]');
            escapeElements.forEach(element => {
                element.textContent = this.escapeHtml(element.textContent);
            });
        },

        /**
         * Escape HTML to prevent XSS
         */
        escapeHtml: function(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },

        /**
         * Sanitize HTML content
         */
        sanitizeHtml: function(html) {
            const temp = document.createElement('div');
            temp.innerHTML = html;
            
            // Remove script tags
            const scripts = temp.querySelectorAll('script');
            scripts.forEach(script => script.remove());
            
            // Remove dangerous attributes
            const dangerousAttributes = ['onclick', 'onerror', 'onload', 'onmouseover'];
            const allElements = temp.querySelectorAll('*');
            allElements.forEach(element => {
                dangerousAttributes.forEach(attr => {
                    element.removeAttribute(attr);
                });
            });
            
            return temp.innerHTML;
        },

        /**
         * Show alert message
         */
        showAlert: function(message, type = 'info') {
            const alertContainer = document.querySelector('.alert-container') || this.createAlertContainer();
            
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `
                <span>${this.escapeHtml(message)}</span>
                <button type="button" class="close" onclick="this.parentElement.remove()">×</button>
            `;
            
            alertContainer.appendChild(alert);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        },

        /**
         * Create alert container if it doesn't exist
         */
        createAlertContainer: function() {
            const container = document.createElement('div');
            container.className = 'alert-container';
            container.style.position = 'fixed';
            container.style.top = '20px';
            container.style.right = '20px';
            container.style.zIndex = '9999';
            container.style.maxWidth = '400px';
            document.body.appendChild(container);
            return container;
        },

        /**
         * Bind events
         */
        bindEvents: function() {
            // Add CSRF tokens to dynamically created forms
            document.addEventListener('DOMNodeInserted', (event) => {
                if (event.target.tagName === 'FORM') {
                    this.addCSRFToForms();
                }
            });

            // Real-time validation
            document.addEventListener('input', (event) => {
                const field = event.target;
                if (field.hasAttribute('required') || field.type === 'email' || field.type === 'password') {
                    this.validateField(field);
                }
            });
        },

        /**
         * Validate individual field
         */
        validateField: function(field) {
            if (field.hasAttribute('required') && !field.value.trim()) {
                this.markFieldInvalid(field, 'This field is required');
            } else if (field.type === 'email' && field.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(field.value)) {
                    this.markFieldInvalid(field, 'Please enter a valid email address');
                } else {
                    this.markFieldValid(field);
                }
            } else if (field.type === 'password' && field.value && field.value.length < 8) {
                this.markFieldInvalid(field, 'Password must be at least 8 characters long');
            } else {
                this.markFieldValid(field);
            }
        },

        /**
         * File upload validation
         */
        validateFileUpload: function(input, allowedTypes = [], maxSize = 5 * 1024 * 1024) {
            const files = input.files;
            let isValid = true;
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                // Check file size
                if (file.size > maxSize) {
                    this.markFieldInvalid(input, `File size must be less than ${Math.round(maxSize / 1024 / 1024)}MB`);
                    isValid = false;
                    break;
                }
                
                // Check file type
                if (allowedTypes.length > 0 && !allowedTypes.includes(file.type)) {
                    this.markFieldInvalid(input, `Invalid file type. Allowed types: ${allowedTypes.join(', ')}`);
                    isValid = false;
                    break;
                }
            }
            
            if (isValid) {
                this.markFieldValid(input);
            }
            
            return isValid;
        },

        /**
         * Setup image upload validation
         */
        setupImageUploadValidation: function() {
            const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
            imageInputs.forEach(input => {
                input.addEventListener('change', () => {
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    this.validateFileUpload(input, allowedTypes, 2 * 1024 * 1024); // 2MB max
                });
            });
        }
    };

    // Accordion functionality
    const Accordion = {
        init: function() {
            const accordionHeaders = document.querySelectorAll('.accordion-header');
            accordionHeaders.forEach(header => {
                header.addEventListener('click', this.toggleAccordion.bind(this));
                header.addEventListener('keydown', this.handleKeydown.bind(this));
            });
        },

        toggleAccordion: function(event) {
            const header = event.currentTarget;
            const body = header.nextElementSibling;
            const icon = header.querySelector('.accordion-icon');
            
            // Close other accordions in the same group
            const accordion = header.closest('.accordion');
            const otherBodies = accordion.querySelectorAll('.accordion-body.show');
            otherBodies.forEach(otherBody => {
                if (otherBody !== body) {
                    otherBody.classList.remove('show');
                    otherBody.previousElementSibling.setAttribute('aria-expanded', 'false');
                }
            });
            
            // Toggle current accordion
            body.classList.toggle('show');
            const isExpanded = body.classList.contains('show');
            header.setAttribute('aria-expanded', isExpanded);
            
            if (icon) {
                icon.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        },

        handleKeydown: function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                this.toggleAccordion(event);
            }
        }
    };

    // Modal functionality
    const Modal = {
        init: function() {
            const modalTriggers = document.querySelectorAll('[data-modal-target]');
            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', this.openModal.bind(this));
            });

            const modalCloses = document.querySelectorAll('[data-modal-close]');
            modalCloses.forEach(close => {
                close.addEventListener('click', this.closeModal.bind(this));
            });

            // Close modal on escape key
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    this.closeAllModals();
                }
            });

            // Close modal on backdrop click
            document.addEventListener('click', (event) => {
                if (event.target.classList.contains('modal')) {
                    this.closeModal(event);
                }
            });
        },

        openModal: function(event) {
            event.preventDefault();
            const targetId = event.currentTarget.getAttribute('data-modal-target');
            const modal = document.getElementById(targetId);
            
            if (modal) {
                modal.style.display = 'block';
                modal.setAttribute('aria-hidden', 'false');
                
                // Focus the first focusable element
                const focusable = modal.querySelector('input, button, textarea, select, [tabindex]:not([tabindex="-1"])');
                if (focusable) {
                    focusable.focus();
                }
                
                // Trap focus within modal
                this.trapFocus(modal);
            }
        },

        closeModal: function(event) {
            const modal = event.target.closest('.modal') || 
                         document.querySelector('.modal[style*="block"]');
            
            if (modal) {
                modal.style.display = 'none';
                modal.setAttribute('aria-hidden', 'true');
            }
        },

        closeAllModals: function() {
            const modals = document.querySelectorAll('.modal[style*="block"]');
            modals.forEach(modal => {
                modal.style.display = 'none';
                modal.setAttribute('aria-hidden', 'true');
            });
        },

        trapFocus: function(modal) {
            const focusableElements = modal.querySelectorAll(
                'input, button, textarea, select, [tabindex]:not([tabindex="-1"])'
            );
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            modal.addEventListener('keydown', (event) => {
                if (event.key === 'Tab') {
                    if (event.shiftKey) {
                        if (document.activeElement === firstElement) {
                            event.preventDefault();
                            lastElement.focus();
                        }
                    } else {
                        if (document.activeElement === lastElement) {
                            event.preventDefault();
                            firstElement.focus();
                        }
                    }
                }
            });
        }
    };

    // Image lazy loading
    const LazyLoader = {
        init: function() {
            const images = document.querySelectorAll('img[data-src]');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });

                images.forEach(img => imageObserver.observe(img));
            } else {
                // Fallback for older browsers
                images.forEach(img => {
                    img.src = img.dataset.src;
                });
            }
        }
    };

    // Initialize all modules when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        Security.init();
        Accordion.init();
        Modal.init();
        LazyLoader.init();
        Security.setupImageUploadValidation();
    });

    // Expose Security object globally for manual use
    window.ModernAgentSecurity = Security;
    window.ModernAgentAccordion = Accordion;
    window.ModernAgentModal = Modal;
    window.ModernAgentLazyLoader = LazyLoader;

})(window);