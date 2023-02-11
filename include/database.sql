create database `exchange_rates`;

DROP TABLE IF EXISTS `exchange_rates`;
CREATE TABLE `exchange_rates` (
    `exch_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `admin_id` int(11) NOT NULL,
    `pri_key` varchar(200) NOT NULL,
    `exch_type` varchar(20) NOT NULL,
    `kes` varchar(20) NOT NULL,
    `ugx` varchar(20) NOT NULL,
    `usdk` varchar(20) NOT NULL,
    `usdu` varchar(20) NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `exchange_rates` (`exch_id`, `admin_id`, `pri_key`, `exch_type`, `kes`, `ugx`, `usdk`, `usdu`, `date`) VALUES
(1, 1, '63b4520079f60', 'buy', '30.4', 29, 123, 3720, '2023-01-03 14:04:16'),
(2, 1, '63b2e662342fe', 'sell', '31.4', 28, 124, 126, '2023-01-02 12:12:50');
