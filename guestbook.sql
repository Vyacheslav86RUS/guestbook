-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 17 2019 г., 06:32
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gmsg`
--

CREATE TABLE IF NOT EXISTS `gmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `hpage` varchar(255) NOT NULL DEFAULT '',
  `gmsg` text NOT NULL,
  `fpath` varchar(255) NOT NULL DEFAULT '',
  `cdate` int(11) NOT NULL,
  `uip` varchar(255) NOT NULL,
  `ubrowser` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Дамп данных таблицы `gmsg`
--

INSERT INTO `gmsg` (`id`, `name`, `email`, `uid`, `hpage`, `gmsg`, `fpath`, `cdate`, `uip`, `ubrowser`) VALUES
(1, 'slava', 'slava@mao.re', 0, '', 'dfsdfsdsf', '/uploads/1.txt', 1560387239, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(2, 'slava', 'slava@mail.ru', 0, '', 'Hello\nGood lyck!', '', 1560388030, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(3, 'slava', 'slava@mail.ru', 0, '', 'Большинство разработчиков которые используют AJAX в процедурном PHP знают как работать с AJAX , но в MVC любой с вариантов приведет к тому что у вас повторно от рисуется вся страница в том месте где вы будете выводить результат. И тут возникает куча вопросов у новичков. Но хотя если подумать, то даже в процедурном подходе, при запросе AJAX делается направление ПОСТ данных на файл который специально был подготовлен для обработки данных. MVC подход не исключение. Для обработки данных AJAX в MVC паттерне, нужно также создать отдельный контроллер AJAX, я назвал его ajaxController.php отдельно создал ajaxModel.php и самое интересное что для данной связки нужно создать вьюшку, но в файле вьюшка можно просто написать одну маленькую строчку просто блок див, а можно ничего не писать, все зависит от вашей реализации. Ну и получается что когда вы отправляете запрос со страницы которая была от рисована ранее в браузере, первым обработчиком выступает jQuery AJAX я использовал библиотеку jQuery, так как можно использовать уже готовые решения, а не придумывать велосипед.', '/uploads/3.png', 1560388196, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(4, 'slava', 'slava@mail.ru', 0, '', 'Подведём итоги: Мы написали полноценную гостевую книгу и выполнили все задачи, которые поставили перед собой. Конечно можно сделать ещё кучу всяких фишек, написать администрирование гостевой книги и многое другое, но это уже тема другой статьи. В общем, надеюсь статья была вам полезна. Если что-то было не понятно, то милости прошу: пишите на мыло - обязательно отвечу.', '/uploads/4.png', 1560388914, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(5, 'slava', 'slava@mail.ru', 0, '', 'В сети большое количество мануалов по созданию сайтов на готовой CMS или фреймворке. Однако, работая фрилансером, часто встречаю сайты на самописных системах. Программисты пишут их не от хорошей жизни. В зависимости от степени простоты(сложности) проекта чрезмерно или наоборот недостаточно, применение готовой системы, и на ее переделки уходит больше времени, чем на создание сайта с нуля. К примеру, для сайта одностраничника не нужно тяжелой системы типа Joomla или фреймворка типа Yii, а у CMS типа Texpattern может не хватить функционала. Плюс задачи, которые ставит заказчик, могут быть весьма специфичными, и достаточно тяжело реализуемыми на готовой системе.', '/uploads/5.png', 1560389144, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(6, 'slava', 'slava@mail.ru', 0, '', 'Шаблон MVC используется в качестве архитектурной основы во многих фреймворках и CMS, которые создавались для того, чтобы иметь возможность разрабатывать качественно более сложные решения за более короткий срок. Это стало возможным благодаря повышению уровня абстракции, поскольку есть предел сложности конструкций, которыми может оперировать человеческий мозг.\n\nНо, использование веб-фреймворков, типа Yii или Kohana, состоящих из нескольких сотен файлов, при разработке простых веб-приложений (например, сайтов-визиткок) не всегда целесообразно. Теперь мы умеем создавать красивую MVC модель, чтобы не перемешивать Php, Html, CSS и JavaScript код в одном файле.\n\nДанная статья является скорее отправной точкой для изучения CMF, чем примером чего-то истинно правильного, что можно взять за основу своего веб-приложения. Возможно она даже вдохновила Вас и вы уже подумываете написать свой микрофреймворк или CMS, основанные на MVC. Но, прежде чем изобретать очередной велосипед с «блекджеком и шлюхами», еще раз подумайте, может ваши усилия разумнее направить на развитие и в помощь сообществу уже существующего проекта?!\n\nP.S.: Статья была переписана с учетом некоторых замечаний, оставленных в комментариях. Критика оказалась очень полезной. Судя по отклику: комментариям, обращениям в личку и количеству юзеров добавивших пост в избранное затея написать этот пост оказалось не такой уж плохой. К сожалению, не возможно учесть все пожелания и написать больше и подробнее по причине нехватки времени… но возможно это сделают те таинственные личности, кто минусовал первоначальный вариант. Удачи в проектах!', '', 1560389485, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(7, 'slava', 'slava@mail.ru', 0, '', 'Маркировка пагинации \nВ нумерация страниц должны быть обернута в <nav> элемент как навигацией по разделам для чтения с экрана и других специальных возможностях. Кроме того, как страница может иметь более одного такого навигационной секции уже есть (например, основная навигация в шапке сайта или в боковой панели навигации), рекомендуется дать описательное aria-label Для <nav>, который отражает его назначение. Например, если в пагинации используется для навигации между набором результатов поиска подходящей надписи может быть aria-label="Search results pages". ', '', 1560389756, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(8, 'slava', 'slava@mail.ru', 0, '', 'Событие click является сложным событием, оно возникает после генерирования событий mousedown и mouseup. Событие mousedown возникает, когда указатель находится над элементом и кнопка мыши нажата. Событие mouseup происходит, когда указатель находится над элементом и кнопка мыши отпущена. Событие click генерируется, когда курсор находится над элементом, и клавиша мыши нажата и отпущена. Эти события могут получать любые HTML элементы.', '/uploads/8.png', 1560389889, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(9, 'admin', 'admin@gmail.com', 1, '', 'Привет, народ. Этот сайт исключительно для научных целей.\nДанная гостевая книга предназначена для того, что бы вы оставили свои отзывы.\nВы можете зарегистрироваться и тогда сможете редактировать свои записи.', '', 1560390427, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(10, 'user', 'user@user.ru', 2, '', 'Вам сейчас кажется, что все это ерунда и можно было сделать все это проще. Но если вдуматься, у нашего фреймворка огромные возможности. Он полностью структурирован. Расширить его возможности не составит большого труда. Добавляем класс для работы с БД и класс для работы с шаблонами и вот у нас полноценный фреймоворк. Самое важное, что вы поймете написав такой велосипед, это принцип работы MVC фреймворков таких как Zend или Yii. А понимание принципов работы это 99% процентов успеха в любой разработке.', '', 1560390577, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(11, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '', 1560411375, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(12, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '', 1560411461, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(13, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '', 1560411596, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(14, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '', 1560411659, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(15, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '', 1560411684, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(16, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '', 1560411776, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(17, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '', 1560411803, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(18, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '/uploads/18.png', 1560411823, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(19, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '/uploads/19.png', 1560411853, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(20, 'test8', 'test8@test.ru', 0, '', 'TEST INSERT AND UPDATE', '/uploads/20.png', 1560411923, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(21, 'test9', 'test9@mail.ru', 0, '', 'dgsdgsdgsd', '/uploads/21.png', 1560439622, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(22, 'test10', 'test10@test.re', 0, '', 'sdfsdfsds', '', 1560446668, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(23, 'test11', 'test11@msai.ef', 0, '', 'dsfsdfsd', '/uploads/23.png', 1560446706, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(24, 'test12', 'test12@msil.ri', 0, '', 'asfasfasfas', '/uploads/24.png', 1560638915, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(25, 'test13', 'test13@dfsd.rfas', 0, '', 'sfasfsdvdsdvsdvsd', '/uploads/25.png', 1560639311, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(26, 'test14', 'test14@mail.re', 0, '', 'asfasfasf', '/uploads/26.png', 1560639396, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(27, 'test14', 'test14@mail.re', 0, '', 'asfasfasf', '/uploads/27.png', 1560639399, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(28, 'test15', 'test15@msdl.eu', 0, '', 'dsgsdgsdfs', '/uploads/28.png', 1560639513, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(29, 'test16', 'test16@dsf.ru', 0, '', 'sdfgsdgsd', '/uploads/29.png', 1560639541, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(30, 'test17', 'test17@fsafs.dsfs', 0, '', 'safasfa', '/uploads/30.png', 1560639586, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(31, 'test18', 'test18@mfk.ru', 0, '', 'dsfsffsdfs', '/uploads/31.png', 1560639629, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(32, 'test19', 'test19@maul.ru', 0, '', 'asfasfasf', '/uploads/32.png', 1560639749, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(33, 'test20', 'test20@nfas.fe', 0, '', 'dsgsdgsd', '/uploads/33.png', 1560639852, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(34, 'test21', 'test21@afas.df', 0, '', 'sdfsdfgsdg', '/uploads/34.png', 1560640079, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(35, 'test21', 'test21@sfas.ry', 0, '', 'asfasfas', '/uploads/35.png', 1560640806, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(36, 'test23', 'test23@dsgsd.re', 0, '', 'asfasfasfas', '/uploads/36.png', 1560640890, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(37, 'test24', 'ttes@dsf.dsg', 0, '', 'asfasfas', '/uploads/37.png', 1560641203, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(38, 'test26', 'test26@saf.ef', 0, '', 'dsfsdgsd', '/uploads/38.png', 1560641347, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(39, 'test27', 'test27@jsff.ru', 0, '', 'sdfsdgsdg', '/uploads/39.png', 1560641813, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(40, 'asfasfa', 'fsafa@fas.efs', 0, '', 'dsfsdgsd', '', 1560642291, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(41, 'test29', 'test29@nfsi.ru', 0, '', 'dfsdgsdgsd', '', 1560642778, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(42, 'test30', 'test30@fndfi.ri', 0, '', 'dsfgsdgsd', '/uploads/42.png', 1560642912, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(43, 'test31', 'test31@mfid.ri', 0, '', 'sdfsdfsd', '/uploads/43.png', 1560642980, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(44, 'test31', 'test31@mfid.ri', 0, '', 'sdfsdfsd', '/uploads/44.png', 1560643063, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(45, 'test31', 'test31@mfid.ri', 0, '', 'sdfsdfsd', '/uploads/45.png', 1560643083, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(46, 'test31', 'test31@mfid.ri', 0, '', 'sdfsdfsd', '/uploads/46.png', 1560643126, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(47, 'test32', 'ters32sfas@fasf.sfs', 0, '', 'asfasgfas', '/uploads/47.png', 1560643263, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(48, 'test32', 'ters32sfas@fasf.sfs', 0, '', 'asfasgfas', '/uploads/48.png', 1560643287, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(49, 'test32', 'ters32sfas@fasf.sfs', 0, '', 'asfasgfas', '/uploads/49.png', 1560643397, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(50, 'test32', 'ters32sfas@fasf.sfs', 0, '', 'asfasgfas', '', 1560643460, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(51, 'test32', 'ters32sfas@fasf.sfs', 0, '', 'asfasgfas', '/uploads/51.png', 1560647311, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(52, 'test52', 'test52@mail.ru', 0, '', 'dsfsdgsd', '/uploads/52.png', 1560647410, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(53, 'test30', 'test30@mail.ru', 0, '', 'dsgsdgsgsd', '', 1560666604, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(54, 'test31', 'test31@mail.ru', 0, '', 'dfsdfsdgsd', '', 1560666646, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(55, 'asqwqwq', 'safdas@safa.es', 0, '', 'dfsdsdfs', '', 1560667038, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36'),
(56, 'Vlad', 'Vlad@mail.ru', 11, '', 'sdfsdgsdsd\nqrarq', '', 1560681139, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(57, 'admin', 'admin@gmail.com', 1, '', 'Hello. Test response server', '', 1560719834, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(58, 'admin', 'admin@gmail.com', 1, 'http://guestbook.ru', 'Test add guest', '', 1560720153, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151'),
(59, 'userstest', 'userstest@mail.ru', 12, '', 'sdfsdgsdgs', '/uploads/59.ico', 1560720285, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36 OPR/60.0.3255.151');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dreg` int(11) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `dreg`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 1559760587, 1),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.ru', 1559760587, 0),
(3, 'test', '827ccb0eea8a706c4c34a16891f84e7b', 'test@mail.ru', 1559763572, 0),
(4, 'test2', 'a384b6463fc216a5f8ecb6670f86456a', 'test@gmail.com', 1559764133, 0),
(5, 'test3', '827ccb0eea8a706c4c34a16891f84e7b', 'test3@mail.ru', 1559764216, 0),
(6, 'test4', '827ccb0eea8a706c4c34a16891f84e7b', 'test4@mail.ru', 1559764289, 0),
(7, 'test5', 'a384b6463fc216a5f8ecb6670f86456a', 'test5@mail.ru', 1559764376, 0),
(8, 'test6', '827ccb0eea8a706c4c34a16891f84e7b', 'test6@gmail.com', 1559764434, 0),
(9, 'slava', '37f68757b2dcac8990f32c506ca9cb85', 'proslavon86@gmail.ru', 1560167463, 0),
(10, 'test7', 'e10adc3949ba59abbe56e057f20f883e', 'test7@test.rt', 1560298621, 0),
(11, 'vlads', '827ccb0eea8a706c4c34a16891f84e7b', 'Vlad@mail.ru', 1560682867, 0),
(12, 'userstest', '06c02bae7cb2b4f36a56d10b57712bcb', 'userstest@mail.ru', 1560720614, 0),
(13, 'slava', '087603808ee0585f1a17809c71ac483f', 'ProSlavon86@gmail.com', 1560729457, 0),
(14, 'testemail', 'a384b6463fc216a5f8ecb6670f86456a', 'emailtest@mail.ru', 1560731010, 0),
(15, 'temail', 'a384b6463fc216a5f8ecb6670f86456a', 'temail@mail.ru', 1560731196, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
