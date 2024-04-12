define(['jquery'], function($) {
    return {
        init: function() {
            $('#quadratic-calculator-form').on('submit', function(e) {
                e.preventDefault(); // Предотвращаем стандартную отправку формы

                // Собираем данные формы
                var formData = {
                    a: $('#a').val(),
                    b: $('#b').val(),
                    c: $('#c').val(),
                    sesskey: $('[name=sesskey]').val()
                };

                // Отправляем данные на сервер с помощью AJAX
                $.ajax({
                    type: 'POST',
                    url: M.cfg.wwwroot + '/blocks/quadratic_calculator/calculate.php',
                    data: formData,
                    success: function(response) {
                        // Обрабатываем ответ сервера
                        var data = JSON.parse(response);
                        if (data.hasOwnProperty('x1') && data.hasOwnProperty('x2')) {
                            // Выводим результаты на страницу
                            $('#result_x1').text(data.x1);
                            $('#result_x2').text(data.x2);
                        }
                    },
                    error: function() {
                        // Обрабатываем возможные ошибки запроса
                        alert('Error calculating the quadratic equation.');
                    }
                });
            });
        }
    };
});