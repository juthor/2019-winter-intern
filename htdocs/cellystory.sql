-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- 생성 시간: 19-01-30 22:09
-- 서버 버전: 5.6.38
-- PHP 버전: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `cellystory`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `admin`
--

CREATE TABLE `admin` (
  `idx` int(11) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '9',
  `id` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `auth_post` int(1) NOT NULL DEFAULT '1',
  `auth_office` int(1) NOT NULL DEFAULT '0',
  `auth_voc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `admin`
--

INSERT INTO `admin` (`idx`, `level`, `id`, `passwd`, `name`, `auth_post`, `auth_office`, `auth_voc`) VALUES
(1, 1, 'plusinside', 'd5b6c63bca55e2e2a2eaad4702ee472a', '김응진', 2, 0, 1),
(2, 1, 'test', 'e10adc3949ba59abbe56e057f20f883e', '테스트a', 3, 0, 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `config`
--

CREATE TABLE `config` (
  `idx` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cfg_key` varchar(50) NOT NULL,
  `cfg_value` text NOT NULL,
  `input_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `config`
--

INSERT INTO `config` (`idx`, `title`, `cfg_key`, `cfg_value`, `input_type`) VALUES
(1, '사이트명', 'site_name', '셀리스토리', ''),
(2, 'Description', 'meta_description', '', ''),
(3, 'Keyword', 'meta_keyword', '', ''),
(4, 'OG 이미지', 'og_image', 'e7af15a8acef5b516f588b55d23e5866.jpg', ''),
(5, '구글 사이트 소유확인', 'site_veri_google', '', ''),
(6, '네이버 사이트 소유확인', 'site_veri_naver', '', ''),
(7, '개인정보취급방침', 'privacy_policy', '개인정보 취급방침 내용은\n관리자페이지 > 오피스 > 환경설정 > 개인정보취급방침에서 작성하실 수 있습니다.\n테스트\n테스트테스트\n테스트\n테스트\n테스트\n테스트', 'textarea'),
(8, '이용약관', 'terms_of_use', '이용약관 내용은\n관리자페이지 > 오피스 > 환경설정 > 이용약관에서 작성하실 수 있습니다.\n테스트\n테스트테스트\n테스트\n테스트\n테스트\n테스트', 'textarea'),
(11, '상호', 'corp_name', '10WONDERs', ''),
(12, '사업자등록번호', 'corp_num', '729-40-00385', ''),
(13, '사업장주소', 'corp_addr', '서울시 서초구 법원로3길 26', ''),
(14, '회사전화번호', 'corp_tel', '02-6105-0857', ''),
(15, '회사팩스번호', 'corp_fax', '02-6009-9208', ''),
(16, '회사이메일', 'corp_email', 'hello@madein20.com', ''),
(22, '통신판매업신고', 'corp_telebiz', '서울 종로 2018', ''),
(23, '대표자명', 'corp_ceo', '신수현', ''),
(24, '이용약관', 'terms_of_use_eng', '이용약관 내용은영\r\n관리자페이지 > 오피스 > 환경설정 > 이용약관에서 작성하실 수 있습니다.\r\n테스트\r\n테스트테스트\r\n테스트\r\n테스트\r\n테스트\r\n테스트ㅇㅇ', 'textarea');

-- --------------------------------------------------------

--
-- 테이블 구조 `creator`
--

CREATE TABLE `creator` (
  `idx` int(11) NOT NULL,
  `is_confirm` int(1) NOT NULL DEFAULT '0',
  `is_display` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `name` blob NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birth` date NOT NULL,
  `phone` blob NOT NULL,
  `email` blob NOT NULL,
  `addr` blob NOT NULL,
  `thumb_image` varchar(50) NOT NULL,
  `bg_type` varchar(10) NOT NULL,
  `active_channel` text NOT NULL,
  `active_part` text NOT NULL,
  `regdate` varchar(20) NOT NULL,
  `activedate` varchar(20) NOT NULL,
  `active_admin` int(11) NOT NULL,
  `apply_platform` text NOT NULL,
  `likes` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `creator_content`
--

CREATE TABLE `creator_content` (
  `idx` int(11) NOT NULL,
  `creator_idx` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `regdate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `creator_content_list`
--

CREATE TABLE `creator_content_list` (
  `idx` int(11) NOT NULL,
  `content_idx` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `youtube_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `creator_hashtag`
--

CREATE TABLE `creator_hashtag` (
  `idx` int(11) NOT NULL,
  `creator_idx` int(11) NOT NULL,
  `hashtag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `creator_hit`
--

CREATE TABLE `creator_hit` (
  `idx` int(11) NOT NULL,
  `creator_idx` int(11) NOT NULL,
  `regdate` varchar(20) NOT NULL,
  `user_ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `creator_profile`
--

CREATE TABLE `creator_profile` (
  `idx` int(11) NOT NULL,
  `creator_idx` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `year` int(20) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `payment`
--

CREATE TABLE `payment` (
  `idx` int(11) NOT NULL,
  `oid` varchar(30) NOT NULL,
  `creator_idx` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(100) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `pay_pg` varchar(10) NOT NULL,
  `pay_method` varchar(20) NOT NULL,
  `pay_currency` varchar(3) NOT NULL DEFAULT 'KRW',
  `pay_price` float NOT NULL,
  `pay_amt` float NOT NULL,
  `regdate` varchar(20) NOT NULL,
  `paydate` varchar(20) NOT NULL,
  `vbank_acc_num` varchar(30) NOT NULL,
  `vbank_acc_code` varchar(10) NOT NULL,
  `vbank_acc_username` varchar(30) NOT NULL,
  `receipt_id` varchar(30) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `search_log`
--

CREATE TABLE `search_log` (
  `idx` int(11) NOT NULL,
  `hashtag` varchar(50) NOT NULL,
  `regdate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `creator`
--
ALTER TABLE `creator`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `creator_content`
--
ALTER TABLE `creator_content`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `creator_content_list`
--
ALTER TABLE `creator_content_list`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `creator_hashtag`
--
ALTER TABLE `creator_hashtag`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `creator_hit`
--
ALTER TABLE `creator_hit`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `creator_profile`
--
ALTER TABLE `creator_profile`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `search_log`
--
ALTER TABLE `search_log`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `config`
--
ALTER TABLE `config`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 테이블의 AUTO_INCREMENT `creator`
--
ALTER TABLE `creator`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `creator_content`
--
ALTER TABLE `creator_content`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `creator_content_list`
--
ALTER TABLE `creator_content_list`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `creator_hashtag`
--
ALTER TABLE `creator_hashtag`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- 테이블의 AUTO_INCREMENT `creator_hit`
--
ALTER TABLE `creator_hit`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `creator_profile`
--
ALTER TABLE `creator_profile`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `payment`
--
ALTER TABLE `payment`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 테이블의 AUTO_INCREMENT `search_log`
--
ALTER TABLE `search_log`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
