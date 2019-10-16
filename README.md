# Задание на создание скрипта гостевой книги
Гостевая книга предоставляет возможность пользователям сайта оставлять сообщения на сайте. Все данные введенные пользователем сохраняются в БД MySQL, так же в базе данных сохраняются данные о IP пользователя и его браузере. 

Форма добавления записи в гостевую книгу должна иметь следующие поля:

    • User Name (цифры и буквы латинского алфавита) – обязательное поле
    • E-mail (формат email) – обязательное поле
    • Homepage (формат url) – необязательное поле
    • Text (непосредственно сам текст сообщения, HTML тэги недопустимы) – обязательное поле

Сообщения должны выводится в виде таблицы, с возможностью сортировки по следующим полям:  User Name, e-mail, и дата добавления (как в порядке убывания, так и в обратном). Сообщения должны разбиваться на страницы, по 25 сообщений на каждой. Необходимо добавить возможность поиска.

При написании проекта следует обратить внимание на защиту от  XSS атак и SQL –инъекций.

Приветствуется создание простейшего дизайна с использованием CSS (разрешен BootStrap).

## JavaScript и работа с файлами

К базовой функциональности, следует добавить следующие возможности:

    • К сообщению пользователь может добавить картинку или текстовый файл
    • Изображение должно быть не более 320 пикселей  по ширине и не более 240 по высоте, допустимые форматы файлов: JPG, GIF, PNG, и размером не более 1 Мб.
    • Текстовый файл не должен быть больше чем 100кб, формат TXT

## JavaScript и AJAX

К базовой функциональности, следует добавить следующие возможности:

    • Валидация вводимых данных на стороне сервера и клиента
    • Функция предпросмотра сообщения, без перезагрузки страницы
    • Добавление визуальных эффектов так же приветствуется
## Редактор записей

К базовой функциональности, следует добавить следующие возможности:

    • Реализация отдельной страницы редактирования сообщений
    • Валидация вводимых данных
    • Проверка логина и пароля
    • Редактирование существующих данных авторизованным пользователем 
    • Корректное удаление прикрепленных к записям файлов с сервера.

## Дополнительное задание повышенной сложности

Будет хорошим бонусом реализация следующего:

    • CAPTCHA (цифры и буквы латинского алфавита) – изображение и обязательное поле
    • Добавление визуальных эффектов так же приветствуется
    • Добавление анимации процесса загрузки файлов
    • Добавление «Прелоадера» для ajax запросов
    • Изменение параметра пагинации (изменение количества отображаемых сообщений),
    • Просмотр картинки вплывающим окном
    • Отображение миниатюр прикрепленных картинок
    • Кэширование миниатюр прикрепленных картинок
    • Сделать регистрацию пользователей на сайте с подтверждением по email
    • Сделать счетчик посетителей сайта
    • При попытке загрузить изображение большего размера, картинка должна быть пропорционально уменьшена до заданных выше размеров



## Требования

При написании скрипта необходимо использовать ООП (Обязательно MVC) , документирование классов с обязательным  использованием PHPdoc .  

Система должна корректно работать со следующей конфигурацией:

    • PHP 7+
    • MySQL 5+

Задание должно быть выполнено в кодировке UTF-8

Имена файлов кода должны использоваться с учетом регистра

Разрешено использовать следующие библиотеки:

    • JS jQuery 
    • JS jQuery UI
    • Bootstrap
    • TinyMCE

Код должен соответствовать форматам PSR 0, 1, 2,5 

Использование готовых фреймворков (таких как yii, CI, laravell, etc, а тем более CMS) запрещено.