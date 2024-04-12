document.addEventListener('DOMContentLoaded', function() {
  var form = document.querySelector('#quadratic-calculator-form');
  form.addEventListener('submit', function(e) {
      e.preventDefault();
      var xhr = new XMLHttpRequest();
      xhr.open('POST', form.action);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
          if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              document.querySelector('#result_x1').textContent = response.x1;
              document.querySelector('#result_x2').textContent = response.x2;
          }
      };
      xhr.send('a=' + form.a.value + '&b=' + form.b.value + '&c=' + form.c.value + '&sesskey=' + form.sesskey.value);
  });
});