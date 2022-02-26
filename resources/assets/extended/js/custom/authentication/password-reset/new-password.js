"use strict";

// Class Definition
var KTPasswordResetNewPassword = function () {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Kata sandi tidak boleh kosong'
                            },
                            callback: {
                                message: 'Kata sandi terlalu lemah!',
                                callback: function (input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'confirm-password': {
                        validators: {
                            notEmpty: {
                                message: 'Konfirmasi kata sandi tidak boleh kosong'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Kata sandi tidak sama'
                            }
                        }
                    },
                    'toc': {
                        validators: {
                            notEmpty: {
                                message: 'Anda harus menyetujui syarat dan ketentuan'
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

        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Simulate ajax request
                    axios
                        .post(
                            submitButton.closest("form").getAttribute("action"),
                            new FormData(form)
                        )
                        .then(function (response) {
                            Swal.fire({
                                text: "Kata sandi berhasil diubah!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, siap!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                                
                            }).then(function () {
                                window.location.href = "/";
                            });

                            
                        })
                        .catch(function (error) {
                            let dataMessage = error.response.data.message;
                            let dataErrors = error.response.data.errors;
                            let errorMessage = "";

                            for (const errorsKey in dataErrors) {
                                if (!dataErrors.hasOwnProperty(errorsKey))
                                    continue;
                                errorMessage += dataErrors[errorsKey] + "<br/>";
                            }

                            if (error.response) {
                                Swal.fire({
                                    html: dataErrors
                                        ? errorMessage
                                        : "Ups! ada yang salah nih, laporin kuy! <br/> " +
                                          `"${dataMessage}"`,

                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK! kembali",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                            }
                        })
                        .then(function () {
                            // always executed
                            // Hide loading indication
                            submitButton.removeAttribute("data-kt-indicator");

                            // Enable button
                            submitButton.disabled = false;
                        });
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Upsy! ada yang salah nih, coba cek dulu yuk!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "OK! kembali",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

        form.querySelector('input[name="password"]').addEventListener('input', function () {
            if (this.value.length > 0) {
                validator.updateFieldStatus('password', 'NotValidated');
            }
        });
    }

    var validatePassword = function () {
        return (passwordMeter.getScore() > 50);
    }

    // Public Functions
    return {
        // public functions
        init: function () {
            form = document.querySelector('#kt_new_password_form');
            submitButton = document.querySelector('#kt_new_password_submit');
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTPasswordResetNewPassword.init();
});
