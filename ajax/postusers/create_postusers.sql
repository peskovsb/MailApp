CREATE TABLE IF NOT EXISTS `postusers` (
  `post_id` int(10) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `post_sort` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `postusers`
  ADD PRIMARY KEY (`post_id`);
  
ALTER TABLE `postusers`
  MODIFY `post_id` int(10) NOT NULL AUTO_INCREMENT; 