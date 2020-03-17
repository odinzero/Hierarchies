

--
-- База данных: `hierarchy_php`
--

-- frontend: NestedController.php
-- backend:  Nested2Controller.php

--
-- Структура таблицы `nested_category`
--

CREATE TABLE IF NOT EXISTS `nested_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `nested_category`
--

INSERT INTO `nested_category` (`category_id`, `name`, `lft`, `rgt`) VALUES
(1, 'ELECTRONICS', 1, 28),
(2, 'TELEVISIONS', 2, 17),
(3, 'TUBE', 7, 8),
(4, 'LCD', 11, 12),
(5, 'PLASMA', 13, 16),
(6, 'PORTABLE ELECTRONICS', 18, 27),
(7, 'MP3 PLAYERS', 19, 22),
(8, 'FLASH', 20, 21),
(9, 'CD PLAYERS', 23, 24),
(10, '2 WAY RADIOS', 25, 26),
(13, 'TUBE2', 9, 10),
(14, 'TV1', 5, 6),
(15, 'plasma1', 14, 15),
(16, 'TV5', 3, 4);
