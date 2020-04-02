/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

// require('./bootstrap');
clearModalOnClose('lecturerModal');
$(document).ready(function () {
  $('#lecturers').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/dashboard/lecturer/list',
    "pagingType": "full_numbers",
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    columns: [{
      data: 'first_name',
      name: 'first_name'
    }, {
      data: 'last_name',
      name: 'last_name'
    }, {
      data: 'gender',
      name: 'gender'
    }, {
      data: 'age',
      name: 'age'
    }, {
      data: 'updated_at',
      name: 'updated_at'
    }, {
      data: 'action',
      className: "text-center",
      orderable: false,
      searchable: false
    }],
    responsive: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records"
    }
  });
  changeTitleAndAction('lecturerTableBtnAdd', 'lecturerModalLabel', 'Add new lecturer', 'lecturerModalButton', 'Add new', 'Add');
  $('#lecturerModalButton').click(function (e) {
    e.preventDefault();

    if ($('#action').val() == 'Add') {
      var timerInterval;
      var first_name = document.getElementById('first_name').value;
      var last_name = document.getElementById('last_name').value;
      var age = document.getElementById('age').value;
      var gender = $("input[name=gender]:checked").val();
      $.ajax({
        url: '/dashboard/lecturer',
        method: "POST",
        data: {
          'first_name': first_name,
          'last_name': last_name,
          'age': age,
          'gender': gender,
          '_token': $('input[name=_token]').val()
        },
        beforeSend: function beforeSend() {
          Swal.fire({
            title: 'Sending....',
            html: '<span class="text-success">Waiting for data to be sent</span>',
            timer: 100000,
            onBeforeOpen: function onBeforeOpen() {
              Swal.showLoading();
              timerInterval = setInterval(function () {
                Swal.getTimerLeft();
              }, 100);
            }
          });
        },
        success: function success(data) {
          Swal.disableLoading(); // console.log(data);

          if (data.errors) {
            forEachError(data);
          } else if (data.message) {
            displayErrorMessage(data.message);
          } else {
            $(".lecturerModal").hide();
            Swal.close();
            clearInterval(timerInterval);
            Swal.fire({
              type: 'success',
              title: 'Success!',
              html: '<span class="text-success">Your page will be refreshed shortly.</span>',
              showConfirmButton: false,
              timer: 1000
            });
            window.setTimeout(function () {
              location.reload();
            }, 1000);
          }
        },
        error: function error(jqXHR, textStatus, errorThrown) {
          formatErrorMessage(jqXHR, errorThrown);
        }
      });
    }

    if ($('#action').val() == 'Edit') {
      var _timerInterval;

      var id = document.getElementById("id").value;
      var first_name = document.getElementById('first_name').value;
      var last_name = document.getElementById('last_name').value;
      var age = document.getElementById('age').value;
      var gender = $("input[name=gender]:checked").val();
      $.ajax({
        url: '/dashboard/lecturer/update',
        method: "PUT",
        data: {
          'id': id,
          'first_name': first_name,
          'last_name': last_name,
          'age': age,
          'gender': gender,
          '_token': $('input[name=_token]').val()
        },
        beforeSend: function beforeSend() {
          Swal.fire({
            title: 'Sending....',
            html: '<span class="text-success">Waiting for data to be sent</span>',
            timer: 100000,
            onBeforeOpen: function onBeforeOpen() {
              Swal.showLoading();
              _timerInterval = setInterval(function () {
                Swal.getTimerLeft();
              }, 100);
            }
          });
        },
        success: function success(data) {
          Swal.disableLoading(); // console.log(data);

          if (data.errors) {
            forEachError(data);
          } else if (data.message) {
            displayErrorMessage(data.message);
          } else {
            $(".lecturerModal").hide();
            Swal.close();
            clearInterval(_timerInterval);
            Swal.fire({
              type: 'success',
              title: 'Success!',
              html: '<span class="text-success">Your page will be refreshed shortly.</span>',
              showConfirmButton: false,
              timer: 1000
            });
            window.setTimeout(function () {
              location.reload();
            }, 1000);
          }
        },
        error: function error(jqXHR, textStatus, errorThrown) {
          formatErrorMessage(jqXHR, errorThrown);
        }
      });
    }
  });
});
$(document).on('click', '.lecturerEdit', function (e) {
  e.preventDefault();
  var parentElement = $(this).parent('.lecturerParent');
  var id = $(parentElement).find('.id').val();
  var timerInterval;
  $.ajax({
    url: '/dashboard/lecturer/edit',
    method: "GET",
    dataType: 'JSON',
    data: {
      id: id
    },
    beforeSend: function beforeSend() {
      Swal.fire({
        title: 'Sending....',
        html: '<span class="text-success">Waiting for data to be sent</span>',
        showConfirmButton: false,
        timer: 100000,
        onBeforeOpen: function onBeforeOpen() {
          Swal.showLoading();
          timerInterval = setInterval(function () {
            Swal.getTimerLeft();
          }, 100);
        }
      });
    },
    success: function success(data) {
      Swal.disableLoading();
      changeTitleAndAction('', 'lecturerModalLabel', 'Updating Lecturer', 'lecturerModalButton', 'Update', 'Edit');
      $('#id').val(id);
      $.each(data, function (k, v) {
        $("input[value='" + v.gender + "']").prop("checked", true);
        $("input[name=first_name]").val(v.first_name);
        $("input[name=last_name]").val(v.last_name);
        $("input[name=age]").val(v.age);
        Swal.close();
        $('.lecturerModal').modal('show');
        clearInterval(timerInterval);
      });
    },
    error: function error(jqXHR, textStatus, errorThrown) {
      formatErrorMessage(jqXHR, errorThrown);
    }
  });
});
$(document).on('click', '.lecturerRemove', function (e) {
  e.preventDefault();
  var parentElement = $(this).parent('.lecturerParent');
  var id = $(parentElement).find('.id').val();
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(function (result) {
    if (result.value) {
      // console.log(id);
      $.ajax({
        url: '/dashboard/lecturer/destroy',
        method: "DELETE",
        data: {
          'id': id,
          '_token': $('input[name=_token]').val()
        },
        beforeSend: function beforeSend() {
          Swal.fire({
            title: 'Sending....',
            html: '<span class="text-success">Waiting for data to be sent</span>',
            timer: 100000,
            onBeforeOpen: function onBeforeOpen() {
              Swal.showLoading();
            }
          });
        },
        success: function success(data) {
          Swal.disableLoading();

          if (data.message) {
            Swal.fire({
              type: 'error',
              title: 'Oops!!!',
              html: '<span class="text-danger">' + data.message + '</span>',
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              type: 'success',
              title: 'Successfully delete data!',
              html: '<span class="text-success">Your page will be refreshed shortly.</span>',
              showConfirmButton: false,
              timer: 1000
            });
            window.setTimeout(function () {
              location.reload();
            }, 1000);
          }
        },
        error: function error(jqXHR, textStatus, errorThrown) {
          formatErrorMessage(jqXHR, errorThrown);
        }
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      // Cancel button is pressed
      Swal.fire({
        type: 'info',
        title: 'Your data is safe!',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
});

function displayErrorMessage(message) {
  $('.customAlert').show();
  $('.customAlert').append("<div class='alert alert-danger alert-dismissible fade show' id='errorAlert' role='alert'><strong>" + message + "</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
  $(".alert-danger").fadeTo(2000, 1000).slideUp(1000, function () {
    $('.customAlert').empty();
    $(".alert-danger").slideUp(1000);
  });
}

function forEachError(data) {
  $.each(data.errors, function (key, value) {
    $('.customAlert').show();
    $('.customAlert').append("<div class='alert alert-danger alert-dismissible fade show' id='errorAlert' role='alert'><strong>" + value + "</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
  });
  $(".alert-danger").fadeTo(2000, 1000).slideUp(1000, function () {
    $('.customAlert').empty();
    $(".alert-danger").slideUp(1000);
  });
}

function sweetAlertError(message) {
  Swal.fire({
    type: 'error',
    title: message,
    showConfirmButton: false,
    timer: 1500
  });
}

function formatErrorMessage(jqXHR, exception) {
  if (jqXHR.status === 0) {
    return sweetAlertError('Not connected.\nPlease verify your network connection.');
  } else if (jqXHR.status == 404) {
    return sweetAlertError('The requested page not found.');
  } else if (jqXHR.status == 401) {
    return sweetAlertError('Sorry!! You session has expired. Please login to continue access.');
  } else if (jqXHR.status == 500) {
    return sweetAlertError('Internal Server Error.');
  } else if (exception === 'parsererror') {
    return sweetAlertError('Requested JSON parse failed.');
  } else if (exception === 'timeout') {
    return sweetAlertError('Time out error.');
  } else if (exception === 'abort') {
    return sweetAlertError('Ajax request aborted.');
  } else {
    return sweetAlertError('Unknown error occured. Please try again.');
  }
}

function changeTitleAndAction(buttonID, modalLabel, labelText, modalButton, buttonText, actionValue) {
  if (buttonID != '') {
    $('#' + buttonID).click(function (e) {
      e.preventDefault();
      $('#' + modalLabel).text(labelText);
      $('#' + modalButton).text(buttonText);
      $('#action').val(actionValue);
    });
  } else {
    $('#' + modalLabel).text(labelText);
    $('#' + modalButton).text(buttonText);
    $('#action').val(actionValue);
  }
}

function clearModalOnClose(classProps) {
  $('.' + classProps).on("hidden.bs.modal", function () {
    if (classProps == 'lecturerModal') {
      $("input[name=first_name]").val("");
      $("input[name=last_name]").val("");
      $("input[name=age]").val("");
      $("input[name=gender]").prop('checked', false);
    }
  });
}

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/tringuyen/Desktop/personal-project/s3759797-cloud-computing/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/tringuyen/Desktop/personal-project/s3759797-cloud-computing/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });