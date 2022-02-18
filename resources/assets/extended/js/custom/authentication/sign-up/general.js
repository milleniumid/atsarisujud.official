"use strict";

// Class definition
var KTSignupGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    // Handle form
    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'first_name': {
                        validators: {
                            notEmpty: {
                                message: 'Nama depan tidak boleh kosong!'
                            }
                        }
                    },
                    'last_name': {
                        validators: {
                            notEmpty: {
                                message: 'Nama belakang tidak boleh kosong!'
                            }
                        }
                    },
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Email tidak boleh kosong!'
                            },
                            emailAddress: {
                                message: 'Email tidak valid!'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Kata sandi tidak boleh kosong!'
                            },
                            callback: {
                                message: 'Kata sandi tidak valid!',
                                callback: function (input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'toc': {
                        validators: {
                            notEmpty: {
                                message: 'Kamu harus menyetujui syarat dan ketentuan!'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status === 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Simulate ajax request
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
                        .then(function (response) {
                            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Registrasi kamu berhasil!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Lanjutkan",
                                customClass: {
                                    confirmButton: "btn btn-success"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    form.querySelector('[name="email"]').value = "";
                                    form.querySelector('[name="password"]').value = "";
                                    window.location.reload();
                                }
                            });
                        })
                        .catch(function (error) {
                            let dataMessage = error.response.data.message;
                            let dataErrors = error.response.data.errors;
                            let errorMessage = '';

                            for (const errorsKey in dataErrors) {
                                if (!dataErrors.hasOwnProperty(errorsKey)) continue;
                                errorMessage += dataErrors[errorsKey] + "<br/>";
                            }

                            if (error.response) {
                                Swal.fire({
                                    html: dataErrors ? errorMessage : 'Ups! ada yang salah nih, laporin kuy! <br/> ' + `"${dataMessage}"`,
                                    
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK! kembali",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        })
                        .then(function () {
                            // always executed
                            // Hide loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;
                        });
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Ups! kayanya ada kesalahan nih, cek dulu kuy!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Kembali",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

        // Handle password input
        form.querySelector('input[name="password"]').addEventListener('input', function () {
            if (this.value.length > 0) {
                validator.updateFieldStatus('password', 'NotValidated');
            }
        });
    }

    // Password input validation
    var validatePassword = function () {
        return (passwordMeter.getScore() > 50);
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_up_form');
            submitButton = document.querySelector('#kt_sign_up_submit');
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
