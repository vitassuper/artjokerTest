
$(document).ready(function () {
  getUsers();
  getReg('null');
});


function getUsers() {
  $.ajax({
    method: 'GET',
    url: 'api/users',
    dataType: "json",
    success: function (response) {
      var str = '';
      response.message.forEach(user => {
        str += "<tr>";
        str += '<td>' + user.id + '</td>';
        str += '<td>' + user.name + '</td>';
        str += '<td>' + user.email + '</td>';
        str += '<td>' + user.ter_address + '</td>';
        str += '</tr>';
        $('#users').html(str);
      });
    },
  });
}

$('#form').submit(function (e) {
  var data = {};
  var error = false;
  $(".error").remove();
  e.preventDefault();
  $('#form').find('input,select').each(function () {
    data[this.name] = $(this).val();
  });
  var regEx = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/;
  if (!regEx.test(data.email)) {
    $(this).find('#email').after('<span class="error">Ошибка</span>');
    error = true;
  }
  if (data.name.length == 0 || data.name.length > 255) {
    $(this).find('#name').after('<span class="error">Ошибка</span>');
    error = true;
  }
  if (data.reg == "none") {
    $('select option:selected[value="none"]').parent().after('<span class="error">Ошибка</span>');
    error = true;
  }
  if (!error)
    register(data.name, data.email, data.reg);
});


function getReg(pid) {
  $.ajax({
    method: 'GET',
    url: 'api/regions',
    data: { 'pid': pid },
    dataType: "json",
    success: function (response) {
      if (response.message.length != 0) {
        var level = response.message[0].ter_level;
        $('.selects').append('<select class="chosen-select" tabindex="7" name="reg" id=' + level + '></select>');
        $('#' + level).append('<option value="none" hidden="">Выберите место</option>');
        response.message.forEach(reg => {
          $('#' + level).append('<option value="' + reg.ter_id + '">' + reg.ter_name + '</option>');
        });
      }
      $(".chosen-select").chosen();
    },
  });
}

$('.selects').change(function (e) {
  $('.selects').find('span').remove();
  for (i = 4; i > e.target.id; i--) {
    $('.selects').find('#' + i).remove();

  }
  getReg(e.target.value);
});


function register(name, email, reg_id) {
  $.ajax({
    method: 'POST',
    url: 'api/user/create',
    dataType: "json",
    data: {
      'name': name,
      'email': email,
      'terr_id': reg_id
    },
    success: function (response) {
      if (response.message.id) {
        $(location).attr('href', 'http://artjoker/user/' + response.message.id);
      }
      getUsers();
    },
  });

}