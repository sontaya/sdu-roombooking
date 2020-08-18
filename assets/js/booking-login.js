"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

		_login.removeClass('login-signin-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Password is required'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {


					var formData = {
						'username': $("#input_username").val(),
						'passwd' : $("#input_password").val()
						// [csrfName] : csrfHash
					}

					console.log(formData);
					// console.log(base_url);

					$.ajax({
						url:  BASE_URL + "user/do_login",
						type: 'POST',
						dataType: 'json',
						data: formData,
						success: function (resLogin){

							console.log("user/do_login : [success]");
							console.log(resLogin);

							if(resLogin.uid == ""){

								swal.fire({
									text: "Login Fail!!",
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "กรุณาลองใหม่อีกครั้ง",
									customClass: {
										confirmButton: "btn font-weight-bold btn-light-primary"
									}
								}).then(function() {
									location.reload();
									KTUtil.scrollTop();
								});

							}else{

								var apiFormData = {
									'code_person': resLogin.hrcode
								}
								jQuery.ajax({
									url:  "https://personnel.dusit.ac.th/app/api/get_personnel_profile",
									header:{
										'Access-Control-Allow-Origin': '*',
										'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS, PUT, DELETE',
									},
									type: 'POST',
									dataType: 'json',
									data: apiFormData,
									success: function (resProfile){


										console.log("api->get_personnel_profile : [success]");

										var profile = resProfile['profile'][0];
										console.log(profile);

										//--::Begin Store Session
											var FormLoginData = {

												'uid' : resLogin.uid,
												'user_id' : resLogin.hrcode,
												'citizencode' : resLogin.citizencode,
												'name' : resLogin.name,
												'surname' : resLogin.surname,
												'staff_type' : profile.STAFF_TYPE,
												'staff_type_name' : profile.STAFF_TYPE_NAME,
												'substaff_type' : profile.SUBSTAFF_TYPE,
												'substaff_type_name' : profile.SUBSTAFF_TYPE_NAME,
												'code_faculty' : profile.CODE_FACULTY,
												'name_faculty' : profile.NAME_FACULTY,
												'code_department' : profile.CODE_DEPARTMENT,
												'name_department' : profile.NAME_DEPARTMENT,
												'code_site' : profile.CODE_SITE,
												'name_site' : profile.NAME_SITE,
												'bio_pic_file' : profile.BIO_PIC_FILE

											}
											jQuery.ajax({
												url:  BASE_URL + "user/do_login_session",
												type: 'POST',
												dataType: 'json',
												data: FormLoginData,
												success: function (resSession){

													console.log("user/do_login_session : [success]");
													console.log(resSession);
													window.location.href = BASE_URL;

												}
											});
										//--::End Store Session



									}
								});


							}
						}
					});

				}
		    });
        });

    }



    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');
            _handleSignInForm();

        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
	KTLogin.init();

});

function rest_personnel_token()
{
	var apiFormData = {
		'username': 'datacenter',
		'password' : 'admin@sdu'
	}

	jQuery.ajax({
		url:  "https://personnel.dusit.ac.th/app/api/login",
		// url:  "https://personnel.dusit.ac.th/app/api/hello",
		header:{
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Methods' : 'GET, POST, OPTIONS, PUT, DELETE'
		},
		type: 'post',
		dataType: 'json',
		data: apiFormData,
		success: function (res){

			// console.log(res);
			resToken = res.token;
		}
	});
}



