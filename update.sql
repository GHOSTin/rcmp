CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pubtime` int(11) NOT NULL,
  `description` text,
  `rating` int(4) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `news2votes` (
  `news_id` int(8) NOT NULL,
  `user_id` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;