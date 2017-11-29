CREATE TABLE IF NOT EXISTS `contact_form` (
  `u_name` text(255) NOT NULL COMMENT 'u_name',
  `u_email` text NOT NULL COMMENT 'u_email',
  `sub` text(100) NOT NULL COMMENT 'subj',
  `message` text(200) NOT NULL COMMENT 'message',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datatable for contact_form' ;