$(document).ready(() => {
  getReg('null');
  getUsers();
});

const getUsers = () => {
  $.ajax({
    url: 'api/users',
    dataType: 'json',
    success: (response) => {
      response.message.length ? $('#content').html(`<table>${response.message.map(user =>
        `<tr>${`<td>${user.id}</td><td>${user.name}</td><td>${user.email}</td><td>${user.ter_address}</td>`}</tr>`).join('')}</table>`) : $('#content').html('<strong>Список пуст</strong>');
    },
  });
}

$('#form').submit((e) =>{
  e.preventDefault();
  $('.error').remove();
  var data = {};
  var error = false;
  $('#form').find('input,select').each(function () {
    data[this.name] = $(this).val();
  });
  const regEx = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/;
  if (!data.name.length || data.name.length > 255) {
    $(e.target).find('#name').after('<span class="error">Неверное ФИО</span>');
    error=true;
  }
  if (!regEx.test($(e.target.email).val())) {
    $(e.target).find('#email').after('<span class="error">Неверный email</span>');
    error=true;
  }
  if (data.reg == 'none') {
    $('select option:selected[value="none"]').parent().next().after('<span class="error">Error</span>');
    error=true;
  }
  if (!error){
    register(data.name, data.email, data.reg);
    e.target.reset();
  }
});

const getReg = (pid) => {
  $.ajax({
    url: 'api/regions',
    data: { pid },
    dataType: 'json',
    success: (response) => {
      if (response.message.length) {
        $('.selects').append(`<select class="chosen-select" name="reg"></select>`);
        $(`.chosen-select`).append('<option value="none">Выберите место</option>');
        response.message.forEach(reg => {
          $(`.chosen-select`).append(`<option value="${reg.ter_id}">${reg.ter_name}</option>`);
        });
        $('.chosen-select').chosen({ no_results_text: 'Oops, nothing found!' });
      }
    },
  });
}

$('.selects').change((e) => {
  $('.selects').find('.error').remove();
  $( e.target ).next().nextAll('.chosen-select, .chosen-container').remove();
  getReg(e.target.value);
});

const register = (name, email, terr_id) => {
  $.ajax({
    method: 'POST',
    url: 'api/user/create',
    dataType: 'json',
    data: {
      name, email, terr_id
    },
    success: (response) => {
      if (response.message.id) {
        $(location).attr('href', `api/user/${response.message.id}`);
      }
      getUsers();
    },
  });
}