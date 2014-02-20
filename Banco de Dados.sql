-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `sugoigame2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cometchat`
--

CREATE TABLE IF NOT EXISTS `cometchat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL DEFAULT '0',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Extraindo dados da tabela `cometchat`
--

INSERT INTO `cometchat` (`id`, `from`, `to`, `message`, `sent`, `read`, `direction`) VALUES
(1, 2, 1, 'eae', 1374860997, 1, 0),
(2, 1, 2, 'eae', 1374861072, 1, 0),
(3, 1, 2, '...', 1374861073, 1, 0),
(4, 1, 2, '.....', 1374861085, 1, 0),
(5, 1, 2, '...', 1374861086, 1, 0),
(6, 1, 2, 'lol', 1374861206, 1, 0),
(7, 1, 2, 'por aki da pra ler', 1374861211, 1, 0),
(8, 1, 2, '<img class="cometchat_smiley" height="16" width="16" src="/images/smileys/tongue.png" title="Tongue">', 1374861212, 1, 0),
(9, 1, 2, 'eae', 1374861684, 1, 0),
(10, 1, 2, 'eae', 1374862425, 1, 0),
(11, 1, 2, 'bom?', 1374862430, 1, 0),
(12, 1, 2, 'teste', 1374862494, 1, 0),
(13, 2, 2, '...', 1374862698, 1, 0),
(14, 2, 1, 'agora', 1374862704, 1, 0),
(15, 2, 1, '.', 1374862778, 1, 0),
(16, 2, 1, 'hii', 1374862786, 1, 0),
(17, 1, 2, '...', 1374863148, 1, 0),
(18, 2, 1, 'teste', 1374863170, 1, 0),
(19, 1, 2, 'eae', 1374863174, 1, 0),
(20, 1, 2, 'pegando?', 1374863177, 1, 0),
(21, 1, 2, '...', 1374863178, 1, 0),
(22, 2, 1, 's', 1374863180, 1, 0),
(23, 3, 2, '<img class="cometchat_smiley" height="16" width="16" src="/images/smileys/big-smile.png" title="Big smile">', 1374863184, 1, 0),
(24, 3, 2, 'eae doido', 1374863185, 1, 0),
(25, 2, 3, 'lol', 1374863199, 1, 0),
(26, 3, 2, 'user de teste kkk', 1374863200, 1, 0),
(27, 3, 2, 'haha pelo menos ta pegando agora :3', 1374863222, 1, 0),
(28, 3, 2, 'kkkkk', 1374863225, 1, 0),
(29, 3, 2, 'has sent you a game request. <a href=''javascript:void(0);'' onclick="javascript:jqcc.ccgames.accept(''3'',''d35fa14014f1924ef23a5f286b39592c'',''a42065e980671d9aee6c1180c39b9d7e'',''d35fa14014f1924ef23a5f286b39592c,a42065e980671d9aee6c1180c39b9d7e'',''2'',''735'');">Click here to accept it</a> or simply ignore this message.', 1374863238, 1, 1),
(30, 3, 2, 'has successfully sent a game request.', 1374863238, 1, 2),
(31, 2, 3, 'has accepted your game request. <a href=''javascript:void(0);'' onclick="javascript:jqcc.ccgames.accept_fid(''2'',''a42065e980671d9aee6c1180c39b9d7e'',''d35fa14014f1924ef23a5f286b39592c'',''d35fa14014f1924ef23a5f286b39592c,a42065e980671d9aee6c1180c39b9d7e'',''2'',''735'');">Click here to launch the game window</a>', 1374863259, 1, 1),
(32, 2, 3, 'precisa de nick name', 1374863273, 1, 0),
(33, 2, 3, '.-.', 1374863274, 1, 0),
(34, 3, 2, 'aeaheiaeh sim, n sei bem como funciona esses jogos', 1374863286, 1, 0),
(35, 3, 2, 'sempre tiro kk', 1374863289, 1, 0),
(36, 1, 2, 'agora n itendi o pq do chatroom ta pequeno Oo', 1374863311, 1, 0),
(37, 2, 3, 'kk', 1374863313, 1, 0),
(38, 2, 1, 'ksapokeske', 1374863332, 1, 0),
(39, 2, 1, 'esse negocio e assombrado man', 1374863339, 1, 0),
(40, 2, 1, '.-.', 1374863340, 1, 0),
(41, 1, 2, 'aiehaei neh', 1374863349, 1, 0),
(42, 1, 2, 'kkk', 1374863350, 1, 0),
(43, 33, 34, 'ttes', 1374878419, 0, 0),
(44, 33, 34, 'teste', 1374878422, 0, 0),
(45, 33, 34, 'has invited you to join a chatroom. <a href="javascript:jqcc.cometchat.joinChatroom(''5'','''',''R2xvYmFs'')">Click here to join</a>', 1374882127, 0, 1),
(46, 33, 34, 'teste', 1374925533, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cometchat_announcements`
--

CREATE TABLE IF NOT EXISTS `cometchat_announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `announcement` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `to` int(10) NOT NULL,
  `recd` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `time` (`time`),
  KEY `to_id` (`to`,`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5007 ;

--
-- Extraindo dados da tabela `cometchat_announcements`
--

INSERT INTO `cometchat_announcements` (`id`, `announcement`, `time`, `to`, `recd`) VALUES
(5005, 'Iniciada a 2º Grande Era dos Piratas!', 1375300704, 0, 0),
(5006, 'Adicionadas novas funções a nossa biblioteca e auto scroll de menus de sub-sessões.', 1375300937, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cometchat_block`
--

CREATE TABLE IF NOT EXISTS `cometchat_block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `fromid_toid` (`fromid`,`toid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cometchat_chatroommessages`
--

CREATE TABLE IF NOT EXISTS `cometchat_chatroommessages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `chatroomid` (`chatroomid`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Extraindo dados da tabela `cometchat_chatroommessages`
--

INSERT INTO `cometchat_chatroommessages` (`id`, `userid`, `chatroomid`, `message`, `sent`) VALUES
(1, 1, 4, '<img class="cometchat_smiley" height="16" width="16" src="/images/smileys/big-smile.png" title="Big smile">', 1374860664),
(2, 1, 4, 'eae', 1374860680),
(3, 1, 4, 'hehe', 1374860685),
(4, 1, 4, 'opa', 1374861090),
(5, 1, 4, 'kkk', 1374861091),
(6, 1, 4, '2 Me na cv .-.', 1374861094),
(7, 1, 4, 'kk', 1374861097),
(8, 1, 4, 'sim.. ainda to vendo isso', 1374861104),
(9, 1, 4, 'man', 1374861132),
(10, 1, 4, 'ta pequeninim a janela aki', 1374861139),
(11, 1, 4, 'ha', 1374861145),
(12, 1, 4, 'ta sim n sei pq kkk', 1374861146),
(13, 1, 4, 'ok', 1374861146),
(14, 1, 4, 'mas ja vejo', 1374861149),
(15, 28, 4, 'teste', 1374867258),
(16, 33, 4, 'a', 1374867389),
(17, 33, 5, 'teste', 1374878130),
(18, 33, 5, 'teste', 1374886153),
(19, 33, 5, 'a', 1375377024),
(20, 33, 5, 'a', 1375377025),
(21, 33, 5, 'a', 1375377027),
(22, 33, 5, 'a', 1375377028),
(23, 33, 5, 'a', 1375377031),
(24, 33, 5, 'a', 1375377032),
(25, 33, 5, 'a', 1375377033),
(26, 33, 5, 'a', 1375377034),
(27, 33, 5, 'a', 1375377035),
(28, 33, 5, 'a', 1375377036),
(29, 33, 5, 'a', 1375377037),
(30, 33, 5, 'a', 1375377039),
(31, 33, 5, 'a', 1375377040),
(32, 33, 5, 'a', 1375377041),
(33, 33, 5, 'a', 1375377042),
(34, 33, 5, 'a', 1375377043),
(35, 33, 5, 'a', 1375377044),
(36, 33, 5, 'a', 1375377046),
(37, 33, 5, 'a', 1375377047),
(38, 33, 5, 'teste', 1375377049),
(39, 33, 5, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1375377052);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cometchat_chatrooms`
--

CREATE TABLE IF NOT EXISTS `cometchat_chatrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  `createdby` int(10) unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `vidsession` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lastactivity` (`lastactivity`),
  KEY `createdby` (`createdby`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `cometchat_chatrooms`
--

INSERT INTO `cometchat_chatrooms` (`id`, `name`, `lastactivity`, `createdby`, `password`, `type`, `vidsession`) VALUES
(5, 'Global', 1375377052, 0, '', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cometchat_chatrooms_users`
--

CREATE TABLE IF NOT EXISTS `cometchat_chatrooms_users` (
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  `isbanned` int(1) DEFAULT '0',
  PRIMARY KEY (`userid`,`chatroomid`) USING BTREE,
  KEY `chatroomid` (`chatroomid`),
  KEY `lastactivity` (`lastactivity`),
  KEY `userid` (`userid`),
  KEY `userid_chatroomid` (`chatroomid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cometchat_chatrooms_users`
--

INSERT INTO `cometchat_chatrooms_users` (`userid`, `chatroomid`, `lastactivity`, `isbanned`) VALUES
(1, 4, 1374864952, 0),
(2, 4, 1374864990, 0),
(28, 4, 1374867360, 0),
(33, 5, 1378475394, 0),
(36, 5, 1385072965, 0),
(38, 5, 1374881415, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cometchat_status`
--

CREATE TABLE IF NOT EXISTS `cometchat_status` (
  `userid` int(10) unsigned NOT NULL,
  `message` text,
  `status` enum('available','away','busy','invisible','offline') DEFAULT NULL,
  `typingto` int(10) unsigned DEFAULT NULL,
  `typingtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `typingto` (`typingto`),
  KEY `typingtime` (`typingtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cometchat_status`
--

INSERT INTO `cometchat_status` (`userid`, `message`, `status`, `typingto`, `typingtime`) VALUES
(28, NULL, 'away', NULL, NULL),
(33, 'Matando', 'offline', NULL, NULL),
(35, NULL, 'offline', NULL, NULL),
(36, NULL, 'offline', NULL, NULL),
(38, NULL, 'offline', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_akm_akuma`
--

CREATE TABLE IF NOT EXISTS `tb_akm_akuma` (
  `akuma_id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `img` int(4) unsigned NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `tipo` int(1) unsigned NOT NULL COMMENT '1-Paramecia, 2-Zoan, 3-Logia',
  `categoria` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-Neutra, 1-Mistica',
  `ataques` int(1) unsigned NOT NULL,
  `buffs` int(1) unsigned NOT NULL,
  `passivas` int(1) unsigned NOT NULL,
  `raridade` float unsigned NOT NULL,
  `efetividade` int(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`akuma_id`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `nome_2` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Extraindo dados da tabela `tb_akm_akuma`
--

INSERT INTO `tb_akm_akuma` (`akuma_id`, `img`, `nome`, `descricao`, `tipo`, `categoria`, `ataques`, `buffs`, `passivas`, `raridade`, `efetividade`) VALUES
(001, 105, 'Gura Gura no Mi', 'Transforma quem a come no "Homem-Tremor", lhe dando a habilidade de criar ondas de choque, causando terremotos ou maremotos.', 1, 0, 6, 2, 3, 0.25, 10),
(002, 100, 'Yami Yami no Mi', 'Permite ao usuário controlar a escuridão e a gravidade. Também permite absorver matéria física e ataques de qualquer tipo sugando-os em uma névoa negra que se espalha do usuário.', 1, 0, 4, 2, 5, 0.1, 10),
(003, 100, 'Hito Hito no Mi, Model: Daibutsu', 'Permite ao usuário se transformar em uma estátua do gigante Buda à vontade. ', 1, 0, 3, 5, 3, 0.25, 10),
(004, 100, 'Akuma no Mi Desconhecida - Fênix', 'Uma Zoan que permite ao usuário se transformar na lendária ave Fênix.', 1, 0, 2, 6, 3, 0.3, 10),
(005, 100, 'Gasu Gasu no Mi', 'Uma Akuma no Mi do tipo Logia que permite ao usuário criar, controlar e se transformar em gás à vontade, transformando o usuário em um Homem-Gás.', 1, 0, 3, 3, 5, 3, 6),
(006, 100, 'Magu Magu no Mi', 'Uma Akuma do tipo Logia,que permite o usuário se transformar em Magma da forma que desejar', 1, 0, 4, 2, 6, 1.6, 10),
(007, 100, 'Hie Hie no Mi', 'Logia que permite ao usuário se transformar em Gelo e controlá-lo da forma que desejar', 1, 0, 4, 2, 5, 2.5, 8),
(008, 100, 'Mera Mera no Mi', 'Logia que permite ao usuário se transformar e manipular o fogo da forma que desejar.', 1, 0, 4, 2, 5, 1.6, 9),
(009, 100, 'Suna Suna no Mi', 'Akuma do tipo Logia que permite ao usuário se transformar e manipular a areia da forma que desejar,podendo criar tempestades de areia e até mesmo drenar o liquido do corpo de seu oponente.', 1, 0, 2, 4, 5, 3, 6),
(010, 100, 'Yuki Yuki no Mi', 'Akuma do tipo Logia que permite ao usuário transformar seu corpo em neve.', 1, 0, 3, 3, 5, 4.8, 4),
(011, 100, 'Moku Moku no Mi', 'Akuma do tipo logia que permite ao usuário transformar seu corpo em fumaça e manipulá-la conforme sua vontade', 1, 0, 4, 2, 5, 5, 6),
(012, 100, 'Pika Pika no Mi', 'Akuma no Mi do tipo Logia que permite ao usuário transformar seu corpo em luz,conseguindo se movimentar e desferir golpes com extrema rapidez.', 1, 0, 3, 3, 5, 1.8, 8),
(013, 100, 'Goro Goro no Mi', 'Akuma no mi que permite ao usuário se transformar e manipular a eletricidade da maneira que desejar', 1, 0, 3, 3, 5, 1.8, 7),
(014, 100, 'Numa Numa no Mi', 'Logia que permite ao usuário transformar seu corpo em pântano,podendo afundar e esconder coisas em seu corpo sem que ninguém perceba.', 1, 0, 4, 2, 5, 7, 4),
(015, 100, 'Doku Doku no Mi', 'Akuma no Mi do tipo Paramecia,que torna o corpo do usuário completamente venenoso,podendo cobrir-se inteiro com veneno,fazendo assim esta akuma assemelhar-se a uma Logia.', 1, 0, 7, 1, 3, 1, 8),
(016, 100, 'Nikyu Niyku no Mi', 'É uma Akuma no Mi do tipo Paramecia que dá o seu utilizador a capacidade de repelir em alta velocidade qualquer coisa que toque,inclusive o ar.É representada fisicamente como patas na palma da mão do usuário que parecem estar permanentemente gravadas no usuário.', 1, 0, 6, 2, 3, 1, 7),
(017, 100, 'Ope Ope no Mi', 'É uma Akuma no Mi do tipo Paramecia que permite ao usuário criar um espaço esférico ou uma sala, onde o usuário tem controle completo sobre o posicionamento na orientação dos objetos no interior. "Ope" vem da palavra "operação", já que o espaço que o usuário cria é comparado a um "ambiente operacional" em que o usuário é um cirurgião.', 1, 0, 5, 3, 3, 1, 9),
(018, 100, 'Horu Horu no Mi', 'Horu Horu no Mi é a fruta que permite que seu usuário possa controlar os hormônios do próprio corpo ou de outras pessoas. ', 1, 0, 5, 3, 3, 1, 6),
(019, 100, 'Horo Horo no Mi', 'Permite ao usuário produzir e controlar réplicas espectrais como fantasmas em diferentes formas e funções.', 1, 0, 4, 4, 3, 1, 6),
(020, 100, 'Yomi Yomi no Mi', 'Akuma no Mi que permite que o usuário continue vivo independendo de seu corpo e orgãos,utilizando apenas sua alma e o poder dela. Alem disso,o usuário pode manipular e se movimentar com sua alma da forma que desejar,não necessitando de um corpo para deslocar-se', 1, 0, 5, 3, 3, 1, 1),
(021, 100, 'Akuma no Mi Desconhecida - Voodoo', 'Uma Akuma no Mi ainda desconhecida,que permite ao usuário transformar a si e fazer replicas de espantalhos de palha,como bonecos voodoo,podendo transferir seu dano sofrido a esses bonecos. ', 1, 0, 6, 2, 3, 1, 6),
(022, 100, 'Kage Kage no Mi', 'Permite ao usuário manifestar e controlar sombras em uma forma física, podendo alterar a forma ou o tamanho, colocar uma sombra em um cadáver sem vida para criar um zombie e trocar de lugar com uma para evitar ataques físicos. Além disso, pode roubar a sombra de alguém, agarrando e depois a cortando com uma tesoura como se fosse um pano. Mesmo que derrote ou mate o usuário, as sombras não retornarão aos donos originais porque é necessário uma ordem do mesmo.', 1, 0, 7, 1, 3, 1, 3),
(023, 100, 'Fuwa Fuwa no Mi', 'Akuma no Mi que permite ao usuário levitar e controlar coisas as quais ele toque,conforme sua vontade.', 1, 0, 5, 3, 3, 1, 5),
(024, 100, 'Awa Awa no Mi', 'Akuma no Mi que permite ao usuário controlar e emitir bolhas de sabão,que literalmente limpam tudo que tocam,tornando a pessoa atacada impossibilitada de se mover ou controlar seus poderes.', 1, 0, 4, 4, 3, 1, 2),
(025, 100, 'Wash Wash no Mi', 'Akuma no Mi que permite ao usuário literalmente lavar tudo que desejar,inclusive seus oponentes ou armamentos,deixando -os em uma forma maleavel similar a uma roupa lavada.', 1, 0, 7, 1, 3, 1, 3),
(026, 100, 'Doa Doa no Mi', 'Permite ao usuário criar portas em qualquer superficie que desejar,inclusive no ar,podendo criar passagens dimensionais de um lugar para o outro.', 1, 0, 6, 2, 3, 1, 5),
(027, 100, 'Sube Sube no Mi', 'Akuma no Mi que torna o corpo do usuário totalmente escorregadio,fazendo com que ataques comuns simplesmente deslizem sobre seu corpo.', 1, 0, 5, 3, 3, 1, 2),
(028, 100, 'Akuma no Mi Desconhecida - Fortaleza de Guerra', 'Akuma no mi que torna o interior do  corpo do usuário uma grande base, podendo guardar dentro de si  seu próprio exercito ou tripulação. As pessoas, armas e mesmo animais que ficam dentro do usuário, enquanto pequenas dentro de seu corpo, voltam a seus tamanhos normais após afastarem-se um pouco do corpo do mesmo.', 1, 0, 4, 4, 3, 1, 4),
(029, 100, 'Akuma no Mi Desconhecida - Diamante', 'Akuma no mi que permite o usuário transformar partes do seu corpo em diamante,sendo quase impossível de sofrer danos de ataques comuns,e podendo usar sua força também para atacar.', 1, 0, 6, 2, 3, 1, 7),
(030, 100, 'Akuma no Mi Desconhecida - Nenrei', 'Akuma no Mi com poderes ainda não muito conhecidos,mas sabe-se que o usuário tem a capacidade de alterar a propria idade e a idade de outras pessoas conforme desejar.', 1, 0, 5, 3, 3, 1, 3),
(031, 100, 'Sabi Sabi no Mi', 'Akuma no mi que permite ao usuário enferrujar tudo que toca como desejar', 1, 0, 4, 4, 3, 1, 2),
(032, 100, 'Toge Toge no Mi', 'Akuma no mi que permite que o usuário faça qualquer parte do seu corpo se tornar pontiagudo,tornando-se um homem espinho.', 1, 0, 7, 1, 3, 1, 4),
(033, 100, 'Supa Supa no Mi', 'Permite ao usuário tornar seu corpo aço,e ao mesmo tempo modelar as partes do seu corpo de forma que virem armas de corte.', 1, 0, 7, 1, 3, 1, 5),
(034, 100, 'Choki Choki no Mi', 'Faz o usuario se tornar um homem-tesoura,já que da a capacidade do mesmo de transformar suas mãos em tesouras que cortam qualquer tipo de material como se fosse papel.', 1, 0, 4, 4, 3, 1, 3),
(035, 100, 'Bomu Bomu no Mi', 'Transforma o usuário literalmente em um homem bomba,possibilitando o usuario explodir qualquer parte do corpo que desejar,inclusive seu halito e saliva também se tornam explosivos.', 1, 0, 6, 3, 2, 1, 2),
(036, 100, 'Jisei Jisei no Mi', 'Akuma no Mi que dá ao usuario poder de magnetismo,podendo atrair e repelir coisas como desejar.', 1, 0, 7, 1, 3, 1, 5),
(037, 100, 'Doru Doru no Mi', 'Permite o usuario criar e manipular a cera,se tornando um homem vela.', 1, 0, 4, 4, 3, 1, 3),
(038, 100, 'Gomu Gomu no Mi', 'Torna o usuário capaz de esticar todas as partes do corpo,o transformando em um homem borracha.Por causa disso,ataques de impacto,que não sejam cortantes,não afetam o usuario dessa Akuma no Mi', 1, 0, 6, 2, 3, 0.5, 6),
(039, 100, 'Bara Bara no Mi', 'Essa fruta permite ao usuário separar suas partes do corpo e ainda sim movê-las conforme sua vontade,podendo simplesmente se dividir em pedaços para que os ataques passem por ele.', 1, 0, 5, 3, 3, 1, 6),
(040, 100, 'Hana Hana no Mi', 'O usuário tem a capacidade de reproduzir qualquer parte do seu corpo em superficie solida,como se fosse o desabrochar de uma flor.', 1, 0, 7, 1, 3, 1, 7),
(041, 100, 'Shari Shari no Mi', 'Permite ao usuário tornar suas partes do corpo similares a rodas,usadas para atacar os inimigos.', 1, 0, 7, 1, 3, 1, 1),
(042, 100, 'Kilo Kilo no Mi', 'Ao comer essa fruta o usuário se torna capaz de alterar seu peso conforme desejar,podendo flutuar de tão leve,e em seguida despencar no chão como uma bomba de uma tonelada.', 1, 0, 5, 3, 3, 1, 2),
(043, 100, 'Bane Bane no Mi', 'Permite ao usuário transformar suas pernas em molas,fazendo com que possa alcançar grandes alturas e atacar com grande velocidade.', 1, 0, 5, 3, 3, 1, 1),
(044, 100, 'Mane Mane no Mi', 'Permite ao usuário fazer uma cópia exata de qualquer pessoa que toque.', 1, 0, 4, 4, 3, 1, 0),
(045, 100, 'Noro Noro no Mi', 'Permite ao usuário disparar um raio que deixa', 1, 0, 4, 4, 3, 0.5, 0),
(046, 100, 'Ori Ori no Mi', 'Permite ao usuário criar correntes de ferro similares a uma jaula,usando-as para prender seus oponentes e impedi-los de atacar', 1, 0, 5, 3, 3, 1, 1),
(047, 100, 'Beri Beri no Mi', 'Permite ao usuário transformar partes do seu corpo em esferas para golpear o oponende .', 1, 0, 6, 2, 3, 1, 1),
(048, 100, 'Baku Baku no Mi', 'Permite ao usuário literalmente mastigar qualquer coisa de qualquer tamanho que encontrar pela frente,podendo fundir partes ja mastigadas com seu proprio corpo.', 1, 0, 5, 3, 3, 1, 3),
(049, 100, 'Oto Oto no Mi', 'Torna cada parte do corpo do usuário um instrumento musical diferente,permitindo ao usuário atacar usando ondas sonoras que acertam de longe seus oponentes', 1, 0, 4, 4, 3, 1, 4),
(050, 100, 'Akuma no Mi Desconhecida - Dinossauro', 'Uma Zoan Ancestral que permite ao usuário se transformar em Dinossauro. Pouco se sabe sobre essa Akuma no Mi e seus poderes.', 1, 0, 4, 4, 3, 2.75, 6),
(051, 100, 'Hito Hito no Mi', 'Zoan que dá ao usuário a capacidade de se transformar em humano e outras formas ,que aumentam conforme a habilidade do usuário de controlar a fruta', 1, 0, 3, 5, 3, 2.75, 4),
(052, 100, 'Hebi Hebi no Mi - Model Anaconda', 'Zoan que dá ao usuário a capacidade de se transformar da cobra gigante Anaconda.', 1, 0, 3, 5, 3, 2.75, 5),
(053, 100, 'Hebi Hebi no Mi - Model King Cobra', 'Permite ao usuário se transformar em cobra e atirar um veneno poderoso por sua boca.', 1, 0, 2, 6, 3, 2.75, 2),
(054, 100, 'Ushi Ushi no Mi - Model Giraffe', 'Permite ao usuário se transformar em girafa,fazendo o alcance dos seus ataques aumentar consideravelmente', 1, 0, 2, 6, 3, 2.75, 4),
(055, 100, 'Ushi Ushi no Mi - Model Bisão', 'Permite ao usuário se tornar um poderoso bisão,aumentando consideravelmente sua força e resistencia.', 1, 0, 4, 4, 3, 2.75, 5),
(056, 100, 'Uma Uma no Mi', 'Permite ao usuário a capacidade de se transformar em cavalo.', 1, 0, 1, 7, 3, 2.75, 0),
(057, 100, 'Inu Inu no Mi - Model Wolf', 'Permite ao usuário a capacidade de se transformar em lobo,aumentando sua força e capacidade física', 1, 0, 4, 4, 3, 2.75, 6),
(058, 100, 'Inu Inu no Mi - Model Chacal', 'Permite que o usuário se transforme em um poderoso Chacal', 1, 0, 3, 5, 3, 2.75, 5),
(059, 100, 'Inu Inu no Mi - Model Dachshund', 'Permite que o usuário se transforme em uma mistura hibrida entre animal e arma de guerra.', 1, 0, 2, 6, 3, 2.75, 3),
(060, 100, 'Neko Neko no Mi', 'A pessoa que comer essa fruta se torna capaz de transformar-se em um leopardo,aumentando sua agilidade e força', 1, 0, 3, 5, 3, 2.75, 5),
(061, 100, 'Zou Zou no Mi', 'Akuma no Mi que permite que o usuário se transforme em elefante', 1, 0, 4, 4, 3, 2.75, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cbt_combate`
--

CREATE TABLE IF NOT EXISTS `tb_cbt_combate` (
  `combate_id` int(15) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `tipo` int(1) unsigned NOT NULL COMMENT '0-vsMob, 1-Ataque, 2-Saque, 3-Amigavel, 4-Coliseu, 5-Guerra, 6-Evento',
  `background` int(3) unsigned NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `turno` int(1) unsigned NOT NULL DEFAULT '0',
  `movimentos` int(1) NOT NULL DEFAULT '5',
  `rodadas` int(3) unsigned NOT NULL DEFAULT '0',
  `tempo` int(11) unsigned NOT NULL,
  PRIMARY KEY (`combate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cbt_combate_mob`
--

CREATE TABLE IF NOT EXISTS `tb_cbt_combate_mob` (
  `combate_id` int(15) unsigned zerofill NOT NULL,
  `mob_id` int(3) unsigned zerofill NOT NULL,
  `hp` int(4) unsigned NOT NULL,
  PRIMARY KEY (`combate_id`),
  KEY `mob_id` (`mob_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cbt_combate_personagem`
--

CREATE TABLE IF NOT EXISTS `tb_cbt_combate_personagem` (
  `combate_id` int(15) unsigned zerofill NOT NULL,
  `equipe` int(1) unsigned NOT NULL,
  `personagem_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `hp` int(4) unsigned NOT NULL DEFAULT '1000',
  `mp` int(4) unsigned NOT NULL DEFAULT '100',
  `atributo_atk` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_def` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_agl` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_res` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_pre` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_des` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_per` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_vit` int(4) unsigned NOT NULL DEFAULT '1',
  `dano` int(4) unsigned NOT NULL DEFAULT '0',
  `armadura` int(4) unsigned NOT NULL DEFAULT '0',
  `quadro` varchar(5) NOT NULL,
  PRIMARY KEY (`personagem_id`),
  KEY `combate_id` (`combate_id`),
  KEY `combate_id_2` (`combate_id`,`hp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cbt_combate_personagem_buff`
--

CREATE TABLE IF NOT EXISTS `tb_cbt_combate_personagem_buff` (
  `combate_id` int(15) unsigned zerofill NOT NULL,
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `bonus_attr` int(1) unsigned NOT NULL,
  `bonus_attr_quant` int(2) NOT NULL,
  `duracao` int(1) unsigned NOT NULL,
  KEY `personagem_id` (`personagem_id`),
  KEY `combate_id` (`combate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cbt_combate_personagem_espera`
--

CREATE TABLE IF NOT EXISTS `tb_cbt_combate_personagem_espera` (
  `combate_id` int(15) unsigned zerofill NOT NULL,
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `habilidade_id` int(4) unsigned zerofill NOT NULL,
  `espera` int(1) unsigned NOT NULL,
  PRIMARY KEY (`personagem_id`,`habilidade_id`),
  KEY `personagem_id` (`personagem_id`),
  KEY `habilidade_id` (`habilidade_id`),
  KEY `combate_id` (`combate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cbt_combate_tripulacao`
--

CREATE TABLE IF NOT EXISTS `tb_cbt_combate_tripulacao` (
  `combate_id` int(15) unsigned zerofill NOT NULL,
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `berries` double NOT NULL,
  `equipe` int(1) unsigned NOT NULL DEFAULT '0',
  `rodadas_perdidas` int(1) unsigned zerofill NOT NULL DEFAULT '0',
  PRIMARY KEY (`tripulacao_id`),
  KEY `combate_id` (`combate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cbt_combate_update`
--

CREATE TABLE IF NOT EXISTS `tb_cbt_combate_update` (
  `combate_id` int(15) unsigned zerofill NOT NULL,
  `update` text NOT NULL,
  PRIMARY KEY (`combate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_hos_personagem`
--

CREATE TABLE IF NOT EXISTS `tb_hos_personagem` (
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `finalizacao` int(11) unsigned NOT NULL,
  PRIMARY KEY (`personagem_id`),
  UNIQUE KEY `tripulacao_id` (`tripulacao_id`,`personagem_id`),
  KEY `tripulacao_id_2` (`tripulacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_itn_equipamento`
--

CREATE TABLE IF NOT EXISTS `tb_itn_equipamento` (
  `equipamento_id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `img` int(4) unsigned NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `slot` int(1) unsigned NOT NULL COMMENT '1-capacete, 2-colete, 3-calças, 4-bota, 5-luva, 6-capa, 7-Arma de 1° mao, 8-Item de 2° mao',
  `tipo_efeito` tinyint(1) unsigned NOT NULL COMMENT '0-Dano, 1-Armadura',
  `categoria` int(1) unsigned NOT NULL DEFAULT '1',
  `lvl` int(2) unsigned NOT NULL,
  `treino` int(5) unsigned NOT NULL,
  `requisito_classe` int(1) unsigned NOT NULL,
  `preco` double unsigned NOT NULL,
  `is_negociavel` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_armazenavel` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`equipamento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_itn_equipamento`
--

INSERT INTO `tb_itn_equipamento` (`equipamento_id`, `img`, `nome`, `descricao`, `slot`, `tipo_efeito`, `categoria`, `lvl`, `treino`, `requisito_classe`, `preco`, `is_negociavel`, `is_armazenavel`) VALUES
(0001, 1, 'asdasda', 'asdasdasd', 1, 1, 6, 1, 10, 0, 100, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_itn_item`
--

CREATE TABLE IF NOT EXISTS `tb_itn_item` (
  `item_id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `img` int(4) unsigned NOT NULL,
  `tipo` int(1) unsigned NOT NULL COMMENT '0-Acessório;1-Comida;2-Remédio;3-Material;4-Consumível;5-Akuma;',
  `lvl` int(2) unsigned NOT NULL DEFAULT '0',
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` int(1) unsigned NOT NULL DEFAULT '0',
  `is_consumivel` tinyint(1) unsigned NOT NULL,
  `descricao_efeito` varchar(100) NOT NULL,
  `hp_recuperado` int(4) unsigned NOT NULL DEFAULT '0',
  `mp_recuperado` int(4) unsigned NOT NULL DEFAULT '0',
  `bonus_atk` int(3) unsigned NOT NULL DEFAULT '0',
  `bonus_def` int(3) unsigned NOT NULL DEFAULT '0',
  `bonus_agl` int(3) unsigned NOT NULL DEFAULT '0',
  `bonus_pre` int(3) unsigned NOT NULL DEFAULT '0',
  `bonus_res` int(3) unsigned NOT NULL DEFAULT '0',
  `bonus_des` int(3) unsigned NOT NULL DEFAULT '0',
  `bonus_per` int(3) unsigned NOT NULL DEFAULT '0',
  `bonus_vit` int(3) unsigned NOT NULL DEFAULT '0',
  `preco` double unsigned NOT NULL,
  `script` varchar(100) NOT NULL,
  `is_negociavel` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_armazenavel` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_itn_item`
--

INSERT INTO `tb_itn_item` (`item_id`, `img`, `tipo`, `lvl`, `nome`, `descricao`, `categoria`, `is_consumivel`, `descricao_efeito`, `hp_recuperado`, `mp_recuperado`, `bonus_atk`, `bonus_def`, `bonus_agl`, `bonus_pre`, `bonus_res`, `bonus_des`, `bonus_per`, `bonus_vit`, `preco`, `script`, `is_negociavel`, `is_armazenavel`) VALUES
(0001, 80, 0, 1, 'Acessorio1', 'asdasda', 1, 0, '', 0, 0, 15, 0, 0, 0, 0, 7, 0, 0, 0, '', 1, 1),
(0002, 90, 1, 1, 'Comida', '1asdasd', 0, 0, '', 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 166, '', 1, 1),
(0003, 262, 3, 0, 'Presa de Batpanda', 'Uma presa de Batpanda', 1, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_itn_tripulacao_equipamento`
--

CREATE TABLE IF NOT EXISTS `tb_itn_tripulacao_equipamento` (
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `equipamento_id` int(4) unsigned zerofill NOT NULL,
  `evolucao` int(2) unsigned NOT NULL DEFAULT '0',
  `slot_1` int(1) unsigned NOT NULL DEFAULT '0',
  `slot_2` int(1) unsigned NOT NULL DEFAULT '0',
  KEY `tripulacao_id` (`tripulacao_id`),
  KEY `item_id` (`equipamento_id`),
  KEY `tripulacao_id_2` (`tripulacao_id`,`equipamento_id`,`evolucao`,`slot_1`,`slot_2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_itn_tripulacao_item`
--

CREATE TABLE IF NOT EXISTS `tb_itn_tripulacao_item` (
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `item_id` int(4) unsigned zerofill NOT NULL,
  `quant` int(5) unsigned NOT NULL,
  UNIQUE KEY `tripulacao_id_2` (`tripulacao_id`,`item_id`),
  KEY `tripulacao_id` (`tripulacao_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_itn_tripulacao_item`
--

INSERT INTO `tb_itn_tripulacao_item` (`tripulacao_id`, `item_id`, `quant`) VALUES
(0000000038, 0003, 40);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao` (
  `missao_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `mar_inicio` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-false; 1-east; 2-north; 3-south; 4-west; 5-GL; 6-NW; 7-all blues; 8-todos',
  `nome` varchar(250) NOT NULL,
  `texto_P_iniciacao` text NOT NULL,
  `texto_P_andamento` text NOT NULL,
  `texto_P_conclusao` text NOT NULL,
  `texto_M_iniciacao` text NOT NULL,
  `texto_M_andamento` text NOT NULL,
  `texto_M_conclusao` text NOT NULL,
  `is_texto_exclusivo` tinyint(1) unsigned NOT NULL,
  `requisito_faccao` tinyint(1) unsigned DEFAULT NULL,
  `requisito_missao` int(5) unsigned zerofill NOT NULL DEFAULT '00000',
  `requisito_lvl` int(2) unsigned NOT NULL DEFAULT '0',
  `recompensa_xp` int(6) unsigned NOT NULL,
  `recompensa_berries` int(10) unsigned NOT NULL,
  PRIMARY KEY (`missao_id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `requisito_missao` (`requisito_missao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `tb_mis_missao`
--

INSERT INTO `tb_mis_missao` (`missao_id`, `mar_inicio`, `nome`, `texto_P_iniciacao`, `texto_P_andamento`, `texto_P_conclusao`, `texto_M_iniciacao`, `texto_M_andamento`, `texto_M_conclusao`, `is_texto_exclusivo`, `requisito_faccao`, `requisito_missao`, `requisito_lvl`, `recompensa_xp`, `recompensa_berries`) VALUES
(00001, 8, 'Explorando a floresta', 'Há tempos que não conseguimos trabalhar na floresta dessa cidade. Poderia me ajudar?<br><br>\nObjetivo: Explorar a floresta e derrotar 50 (Nome do mob).', 'Tudo que tem a fazer é entrar na floresta e derrotar o monstro que está espantando nossos trabalhadores. Se você conseguir derrotá-lo,provará que é um carpinteiro digno de estar em nossa cidade.', 'Parabéns rapaz,agora enfim poderemos trabalhar em paz nessa ilha. Muito obrigado!', '', '', '', 0, 0, 00000, 0, 0, 0),
(00005, 0, 'Caverna desconhecida', 'Dizem que há um lugar nessa ilha que se pode encontrar diversos tipos de minérios preciosos.Gostaria de ouvir mais sobre a historia?\nObjetivo: Explorar a Mina e derrotar 50 (Nome do mob)', 'Encontre a mina localizada nesta ilha,ela fica por aqui perto,lá você encontrará diversos tipos de minérios.Só tem um problema,existe uma quadrilha que domina a mina e sua exploração. Se puder derrotá-los,poderá explorar a mina conforme sua vontade.\nObjetivo: Explorar a Mina e derrotar 50 (Nome do mob).', 'Finalmente,parece que agora poderei explorar a antiga mina da cidade em paz. Nada melhor do que mandar outras pessoas fazerem o seu serviço,ou você acha que eu enfrentaria esses bandidos?Bom,de qualquer forma,aqui está sua recompensa.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00006, 0, 'Boa ação', ' Você me parece uma boa pessoa,poderia me ajudar a carregar estas caixas até o meu navio? ( Sim ou Não).\n(Não):\n Então saia da frente e não me atrapalhe,seu preguiçoso...\n(Sim): \nObrigado,com você ajudando será mais rápido ainda.\nObjetivo: Ir até o porto da cidade.', 'Ajude o homem a transportar os caixotes até seu navio no porto da ilha.\nObjetivo: Ir até o porto da cidade.', 'Muito obrigado,rapaz,ainda existem trouxas no mundo,err,quer dizer,boas pessoas. Até nunca mais!', '', '', '', 0, 0, 00000, 0, 0, 0),
(00008, 0, 'Culinária especial', ' Hey,você parece gostar de cozinhar,gostaria de aprender a minha receita especial? ( Sim ou Não).\nObjetivo: Obter 50 carnes de (nome do mob).', 'Vamos lá,um bom cozinheiro tem que conseguir seus próprios ingredientes.Me mostre que é digno de aprender o nosso segredo de família!\nObjetivo: Obter 50 carnes de (nome do mob).', 'Experimente isso meu garoto. Bom ,não é? Pois leve algumas pra você e seus companheiros! E lembre-se de não passar a receita pra ninguém,ou terei que matá-lo. Hehehe,brincadeira. Ou não....', '', '', '', 0, 0, 00000, 0, 0, 0),
(00009, 0, 'A Arte da medicina', 'O que está olhando rapaz? Gosta de medicina?( Sim ou Não).\nObjetivo: Explorar a floresta e obter 5 (nome do ingrediente) e 5 (nome do outro ingrediente)', 'Ande rápido garoto,ou o paciente não resistirá! Um  bom médico não deixa ninguém morrer!\nObjetivo: Explorar a floresta e obter 5 (nome do ingrediente) e 5 (nome do outro ingrediente)', 'Não é incrível como esse paciente se recuperou rápido? Pois bem,palavra é palavra,tome aqui a receita e as doses que sobraram desse tratamento. E lembre-se de cuidar bem dos seus companheiros.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00010, 0, 'Cúmplice ou vitima?', ' Prendam esse homem,ele ajudou o cara que roubou minha loja! ( Correr ou Parar para explicar).\nObjetivo: Encontrar e derrotar o ladrão no oceano ( O ladrão estará entre as coordenadas N /- 3 e L /- 3 ( numa área possível de 9 celulas).', ' Ande logo rapaz,se demorar mais um pouco o ladrão irá escapar,e quem vai pagar é você,que ajudou a me roubar!\nObjetivo: Encontrar e derrotar o ladrão no oceano ( O ladrão estará entre as coordenadas N /- 3 e L /- 3 ( numa área possível de 9 celulas).', 'Isso mesmo garoto! Graças a você todos os vendedores de arma da região recuperaram seus pertences. Tome,estas aqui são especiais e por conta da casa.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00011, 0, 'Treinando a concentração', ' Jovem,gostaria de aprender mais sobre o poder da luta? ( Claro,me ensine já ou Não).\nObjetivo: Relaxar e meditar ao lado do sensei por 1 hora', 'Shhhhh! Fique quieto ou irá atrapalhar os outros alunos. Trate de se concentrar,jovem gafanhoto.\nObjetivo: Relaxar e meditar ao lado do sensei por 1 hora', 'Eu disse pra se concentrar e meditar,e não pra dormir ,seu preguiçoso! Bom,de qualquer forma você ficou quieto,o que já parecia quase impossível.Agora saia logo daqui antes que deixe todo mundo louco.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00012, 0, 'Piloto de testes', ' E ai rapaz,afim de conseguir um dinheiro sem esforço? ( Não confio em você ou Dinheiro?Mas é claro!).\nObjetivo: Ajudar Ed a testar equipamentos', 'Por enquanto eles estão resistindo bem. Vamos testar essa armadura agora,vista ela que eu vou tentar cortar com essa espada. Se você sobreviver,significa que os equipamentos são um sucesso,hahahahaahahah.\nObjetivo: Ajudar Ed a testar equipamentos', 'Os equipamentos são um sucesso.Rápido,quero todos eles nas lojas já! Oh,fique com estes pra você ,e desculpe os hematomas,hahahahaha.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00013, 0, 'Enfrentando o monstro', ' Dizem que há um lugar nessa ilha que se pode encontrar diversos tipos de minérios preciosos.Gostaria de ouvir mais sobre a historia? ( Sim ou Não).\nObjetivo: Explorar a Mina e derrotar 50 (Nome do mob).', 'Mestre dos Upgrades: Vai me dizer que você não consegue dar conta de simples bandidos? Volte pra lá e acabe com eles !\nObjetivo: Explorar a Mina e derrotar 50 (Nome do mob).', '- Fim da missão e recompensa:\nFinalmente,parece que agora poderei explorar a antiga mina da cidade em paz. Nada melhor do que mandar outras pessoas fazerem o seu serviço,ou você acha que eu enfrentaria esses bandidos?Bom,de qualquer forma,aqui está sua recompensa.\n', '', '', '', 0, 0, 00000, 0, 0, 0),
(00014, 0, 'Terror,onde está a cura?', 'A sua tripulação inteira está com uma doença grave! Vamos começar o tratamento o mais rápido possível! ( Eu não preciso disso,sei me virar ou O que tenho que fazer?).\nObjetivo: Entrar na floresta e conseguir 5 (nome da erva)', 'Não temos tempo a perder,a cada minuto que passa eles ficam piores!\nObjetivo: Entrar na floresta e conseguir 5 (nome da erva)', 'Graças a Deus,essa foi por pouco! Olhe por onde anda,essas ilhas costumam ter muitas doenças desconhecidas. Tome,leve isto,se alguém tiver uma recaída ,já tem o tratamento.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00015, 0, 'Beber um pouco não faz mal', 'Sente-se ai garoto,beba um pouco pra relaxar.( Não,não bebo,vim apenas pra visitar ou Me da uma de cada ai,hoje é por minha conta!)\nObjetivo: Relaxar bebendo um pouco no bar', 'Já vai embora? Claro que não,beba mais um pouco,é a ultima,prometo! hahahahaah\nObjetivo: Relaxar bebendo um pouco no bar', 'Eu estou bêbado ou ele disse algo sobre uma arma poderosa? Bem,mais tarde quando estiver sóbrio acho que vou voltar aqui,se eu me lembrar,hahahaha ', '', '', '', 0, 0, 00000, 0, 0, 0),
(00016, 0, 'Assuntos Interessantes', 'É isso ai,vamos levar a arma pro chefe,e esconder aquele navio roubado pra ninguém suspeitar. \nObjetivo: Seguir os homens suspeitos.', 'Já está quase na hora ,siga-os ou nunca mais saberá sobre a arma.\nObjetivo: Seguir os homens suspeitos.', 'O pacote está no convés do navio roubado,pegue os dois e suma logo daqui. Ah,e mande lembranças ao chefe. ', '', '', '', 0, 0, 00000, 0, 0, 0),
(00017, 0, 'A arma poderosa', 'Ei ,por acaso você estava ouvindo nossa conversa? Não tem medo de morrer rapaz?.( Não estava ouvindo,estou apenas de passagem ou Eu quero saber sobre a tal arma!)\nObjetivo: Seguir os homens suspeitos no oceano. Provavelmente estarão entre as coordenadas  /- 3 N e  /-3 L', 'Siga-os ou nunca mais saberá sobre a arma. Provavelmente estarão entre as coordenadas  /- 3 N e  /-3 L.\nObjetivo: Seguir os homens suspeitos no oceano. Provavelmente estarão entre as coordenadas  /- 3 N e  /-3 L', 'Quem diria que a arma existia mesmo,e estava na mão desses fracos. TSC TSC.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00018, 0, 'Pistas da historia', 'Ei ,por acaso você conhece sobre Poneglyphs?.( Não estou interessado ou Conheço!Conte-me mais!)\nObjetivo: Ir para a floresta e derrotar 50 (nome do mob)', 'Você se diz um arqueólogo e tem preguiça de pesquisar? Volte pra lá já\nObjetivo: Ir para a floresta e derrotar 50 (nome do mob)', 'Ah,quer dizer então que não era um poneglyph? Apenas a escrita de uma civilização  antiga? De qualquer forma,obrigado rapaz.', '', '', '', 0, 0, 00000, 0, 0, 0),
(00019, 8, 'Missão Exemplo1', 'Espere 5 minutos', 'Espere 5 minutos', 'Obrigado por esperar, aqui está a sua recompensa', '', '', '', 0, NULL, 00000, 1, 1000, 10000),
(00020, 8, 'Missao de exemplo2', 'Derrote 5 Cocofox na primeira zona fora da ilha.', 'Derrote 5 Cocofox na primeira zona fora da ilha.', 'Muito bem! Aqui esta sua recompensa:', '', '', '', 0, NULL, 00019, 2, 1000, 10000),
(00021, 8, 'Missao exemplo 3', 'Colete 5 presas de Batpanda na primeira zona da caverna', 'Colete 5 presas de Batpanda na primeira zona da caverna', 'Muito bem!', '', '', '', 0, NULL, 00020, 3, 1000, 10000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao_andamento`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao_andamento` (
  `missao_id` int(5) unsigned zerofill NOT NULL,
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `tipo` int(1) unsigned NOT NULL COMMENT '0-Tempo; 1-Matar Mob; 2-Ter item;',
  `objetivo_id` int(4) unsigned zerofill NOT NULL,
  `objetivo_quant` int(11) unsigned NOT NULL,
  PRIMARY KEY (`tripulacao_id`),
  KEY `missao_id` (`missao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mis_missao_andamento`
--

INSERT INTO `tb_mis_missao_andamento` (`missao_id`, `tripulacao_id`, `tipo`, `objetivo_id`, `objetivo_quant`) VALUES
(00020, 0000000039, 1, 0001, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao_concluida`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao_concluida` (
  `missao_id` int(5) unsigned zerofill NOT NULL,
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `data_finalizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `missao_id_2` (`missao_id`,`tripulacao_id`),
  KEY `missao_id` (`missao_id`),
  KEY `tripulacao_id` (`tripulacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mis_missao_concluida`
--

INSERT INTO `tb_mis_missao_concluida` (`missao_id`, `tripulacao_id`, `data_finalizacao`) VALUES
(00019, 0000000038, '2013-12-07 17:55:48'),
(00019, 0000000039, '2013-12-12 11:07:53'),
(00020, 0000000038, '2013-12-09 13:13:07'),
(00021, 0000000038, '2013-12-09 15:56:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao_npc_conclusao`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao_npc_conclusao` (
  `missao_id` int(5) unsigned zerofill NOT NULL,
  `npc_id` int(4) unsigned zerofill NOT NULL,
  `ilha_id` int(3) unsigned zerofill NOT NULL DEFAULT '000',
  KEY `missao_id` (`missao_id`),
  KEY `npc_id` (`npc_id`),
  KEY `ilha_id` (`ilha_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mis_missao_npc_conclusao`
--

INSERT INTO `tb_mis_missao_npc_conclusao` (`missao_id`, `npc_id`, `ilha_id`) VALUES
(00019, 0003, 000),
(00020, 0003, 000),
(00021, 0003, 000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao_npc_inicio`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao_npc_inicio` (
  `missao_id` int(5) unsigned zerofill NOT NULL,
  `npc_id` int(4) unsigned zerofill NOT NULL,
  `ilha_id` int(3) unsigned zerofill NOT NULL DEFAULT '000',
  KEY `missao_id` (`missao_id`),
  KEY `npc_id` (`npc_id`),
  KEY `ilha_id` (`ilha_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mis_missao_npc_inicio`
--

INSERT INTO `tb_mis_missao_npc_inicio` (`missao_id`, `npc_id`, `ilha_id`) VALUES
(00019, 0003, 000),
(00020, 0003, 000),
(00021, 0003, 000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao_objetivo`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao_objetivo` (
  `missao_id` int(5) unsigned zerofill NOT NULL,
  `tipo` int(1) unsigned NOT NULL COMMENT '0-Tempo; 1-Matar Mob; 2-Ter item;',
  `objetivo_id` int(4) unsigned zerofill NOT NULL,
  `objetivo_quant` int(4) unsigned NOT NULL,
  PRIMARY KEY (`missao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mis_missao_objetivo`
--

INSERT INTO `tb_mis_missao_objetivo` (`missao_id`, `tipo`, `objetivo_id`, `objetivo_quant`) VALUES
(00019, 0, 0000, 5),
(00020, 1, 0001, 5),
(00021, 2, 0003, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao_recompensa_equipamento`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao_recompensa_equipamento` (
  `missao_id` int(5) unsigned zerofill NOT NULL,
  `equipamento_id` int(4) unsigned zerofill NOT NULL,
  UNIQUE KEY `missao_id_2` (`missao_id`,`equipamento_id`),
  KEY `missao_id` (`missao_id`),
  KEY `item_id` (`equipamento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mis_missao_recompensa_item`
--

CREATE TABLE IF NOT EXISTS `tb_mis_missao_recompensa_item` (
  `missao_id` int(5) unsigned zerofill NOT NULL,
  `item_id` int(4) unsigned zerofill NOT NULL,
  `quant` int(5) unsigned NOT NULL,
  UNIQUE KEY `missao_id_2` (`missao_id`,`item_id`),
  KEY `missao_id` (`missao_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mis_missao_recompensa_item`
--

INSERT INTO `tb_mis_missao_recompensa_item` (`missao_id`, `item_id`, `quant`) VALUES
(00021, 0001, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_edificio`
--

CREATE TABLE IF NOT EXISTS `tb_mun_edificio` (
  `edificio_id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `img` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `npc_id` int(4) unsigned zerofill NOT NULL,
  `preco_construcao` float NOT NULL,
  `preco_upgrade` float NOT NULL,
  `tempo_construcao` int(11) NOT NULL,
  `tempo_upgrade` int(11) NOT NULL,
  PRIMARY KEY (`edificio_id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `npc_id` (`npc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `tb_mun_edificio`
--

INSERT INTO `tb_mun_edificio` (`edificio_id`, `img`, `nome`, `descricao`, `npc_id`, `preco_construcao`, `preco_upgrade`, `tempo_construcao`, `tempo_upgrade`) VALUES
(01, 'porto', 'Porto', 'Área abrigada de ondas e correntes à beira do oceano destinada ao atracamento de barcos.\nCada nível aumenta o número de navios que podem atracar no porto pelo lado de fora.', 0000, 100, 100, 20, 16),
(02, 'hospital', 'Hospital', 'Local de descanso que restaura o HP dos personagens, pode-se deixar personagens derrotados. Cada Nível diminui o tempo necessário para restaurar todo o HP do personagem.', 0006, 500, 80, 18, 12),
(03, 'restaurante', 'Restaurante', 'Vende diversos tipos de comidas que restauram a tripulação. Um restaurante mais evoluído vende comidas melhores e mais baratas.', 0000, 250, 30, 16, 10),
(04, 'profissoes', 'Escola de Profissões', 'Ensina as mais variadas profissões para seus tripulantes. Uma escola avançada ensina técnicas melhores de profissão.', 0000, 500, 200, 20, 14),
(05, 'dojo', 'Dojô', 'Ensina classes de luta e habilidades de combate para os personagens. Um Dojô evoluído permite evoluir cada vez mais suas habilidades.', 0005, 500, 200, 20, 14),
(06, 'materiais', 'Loja de Materiais', 'Vende ingredientes para criar os mais diversos itens. Quanto maior o nível, mais raros serão os ingredientes vendidos.', 0000, 100, 20, 12, 6),
(07, 'estaleiro', 'Estaleiro', 'Constroe, guarda e se desenvolvem grandes reparações em embarcações.\nGrandes estaleiros permitem maiores evoluções nos navios', 0001, 500, 100, 18, 12),
(08, 'leilao', 'Casa de Leilões', 'Anuncie e venda todo tipo de itens.\nCada nível aumenta a capacidade da casa permitindo os jogadores a colocarem mais itens a venda.', 0000, 1000, 500, 24, 18),
(09, 'equipamentos', 'Loja de Equipamentos', 'Vendem desde acessórios comuns até armas raras.', 0000, 550, 200, 18, 12),
(10, 'mestre', 'Mestre de Upgrades', 'Refine e aprimore seus equipamentos.', 0000, 500, 200, 18, 12),
(11, 'bar', 'Bar', 'Local onde as pessoas se juntam para beber, contar histórias ou procurar encrenca.', 0003, 500, 100, 20, 18),
(12, 'marinha', 'Base da Marinha', 'Central da marinha na ilha. Aqui marinheiros recebem tarefas para conseguir dinheiro.', 0002, 500, 100, 20, 18),
(13, 'pousada', 'Pousada', 'Local de descanso que restaura a Energia dos personagens, pode-se deixar personagens derrotados. Cada Nível diminui o tempo necessário para restaurar toda a Energia do personagem.', 0000, 500, 80, 18, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha` (
  `ilha_id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `coordenada` varchar(7) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cor_bg_dia` varchar(6) NOT NULL,
  `cor_bg_noite` varchar(6) NOT NULL,
  `bg` int(2) unsigned NOT NULL,
  `interno` int(2) unsigned NOT NULL,
  `externo` int(2) unsigned NOT NULL DEFAULT '1',
  `zona_saida` int(2) unsigned NOT NULL,
  `coordenada_saida` varchar(5) NOT NULL DEFAULT '0_0',
  PRIMARY KEY (`ilha_id`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `coordenada` (`coordenada`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Extraindo dados da tabela `tb_mun_ilha`
--

INSERT INTO `tb_mun_ilha` (`ilha_id`, `coordenada`, `nome`, `cor_bg_dia`, `cor_bg_noite`, `bg`, `interno`, `externo`, `zona_saida`, `coordenada_saida`) VALUES
(001, '000_000', 'Ilha Dawn', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '19_7'),
(002, '000_001', 'Shells Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(003, '000_002', 'Orange Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(004, '000_003', 'Vila Syrup', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(005, '000_004', 'Baratie', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(006, '000_005', 'Ilha Cocoyashi', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(007, '000_006', 'Loguetown', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(008, '000_007', 'Lvneel Kingdom', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(009, '000_008', 'Burlywood Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(010, '000_009', 'GoldenRod Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(011, '000_010', 'Oubliette Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(012, '000_011', 'Vila Whitewood', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(013, '000_012', 'Ilha North Coral', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(014, '000_013', 'Cartigen', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(015, '000_014', 'Baterilla', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(016, '000_015', 'Zozu Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(017, '000_016', 'Karatê Island', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(018, '000_017', 'Avalien Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(019, '000_018', 'Torino', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(020, '000_019', 'Cinturão das Luas', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(021, '000_020', 'Kimotsu Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(022, '000_021', 'Ilusia Kingdom', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(023, '000_022', 'Ohara', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(024, '000_023', 'Ilha Toroa', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(025, '000_024', 'Las Camp', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(026, '000_025', 'Kima Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(027, '000_026', 'Jumbo Town', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(028, '000_027', 'Ilha Kagero', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(029, '000_028', 'Farol', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(030, '000_029', 'Gold Beach', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(031, '000_030', 'Graethan', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(032, '000_031', 'Javelin', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(033, '000_032', 'Vendetta', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(034, '000_033', 'Momoiro', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(035, '000_034', 'Knave', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(036, '000_035', 'Serthzal', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0'),
(037, '000_036', 'Vortex', 'fcfcfc', 'a8afeb', 1, 1, 1, 1, '0_0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha_edificio`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha_edificio` (
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  `edificio_id` int(2) unsigned zerofill NOT NULL,
  `lvl` int(2) NOT NULL,
  `coordenada` int(2) NOT NULL,
  UNIQUE KEY `ilha_id_2` (`ilha_id`,`edificio_id`),
  UNIQUE KEY `ilha_id_3` (`ilha_id`,`coordenada`),
  KEY `ilha_id` (`ilha_id`),
  KEY `edificio_id` (`edificio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mun_ilha_edificio`
--

INSERT INTO `tb_mun_ilha_edificio` (`ilha_id`, `edificio_id`, `lvl`, `coordenada`) VALUES
(001, 01, 10, 0),
(001, 02, 3, 5),
(001, 03, 3, 10),
(001, 04, 3, 2),
(001, 05, 10, 3),
(001, 06, 3, 7),
(001, 07, 3, 4),
(001, 09, 3, 11),
(001, 10, 3, 13),
(001, 11, 3, 12),
(001, 12, 3, 9),
(001, 13, 3, 1),
(002, 01, 10, 0),
(002, 02, 3, 5),
(002, 03, 3, 3),
(002, 04, 3, 14),
(002, 05, 3, 13),
(002, 06, 3, 1),
(002, 07, 3, 2),
(002, 09, 3, 11),
(002, 10, 3, 10),
(002, 11, 3, 7),
(002, 12, 3, 8),
(002, 13, 3, 6),
(003, 01, 10, 0),
(003, 02, 3, 4),
(003, 03, 3, 3),
(003, 04, 3, 8),
(003, 05, 3, 7),
(003, 06, 3, 15),
(003, 07, 3, 13),
(003, 09, 3, 2),
(003, 10, 3, 10),
(003, 11, 3, 9),
(003, 12, 3, 12),
(003, 13, 3, 5),
(004, 01, 10, 0),
(004, 02, 3, 1),
(004, 03, 3, 15),
(004, 04, 3, 6),
(004, 05, 3, 2),
(004, 06, 3, 12),
(004, 07, 3, 4),
(004, 09, 3, 10),
(004, 10, 3, 11),
(004, 11, 3, 3),
(004, 12, 3, 14),
(004, 13, 3, 13),
(005, 01, 10, 0),
(005, 02, 3, 10),
(005, 03, 3, 2),
(005, 04, 3, 1),
(005, 05, 3, 5),
(005, 06, 3, 7),
(005, 07, 3, 14),
(005, 09, 3, 15),
(005, 10, 3, 6),
(005, 11, 3, 13),
(005, 12, 3, 12),
(005, 13, 3, 4),
(006, 01, 10, 0),
(006, 02, 3, 15),
(006, 03, 3, 10),
(006, 04, 3, 1),
(006, 05, 3, 7),
(006, 06, 3, 14),
(006, 07, 3, 8),
(006, 09, 3, 2),
(006, 10, 3, 11),
(006, 11, 3, 5),
(006, 12, 3, 13),
(006, 13, 3, 3),
(007, 01, 10, 0),
(007, 02, 3, 3),
(007, 03, 3, 9),
(007, 04, 3, 5),
(007, 05, 3, 4),
(007, 06, 3, 11),
(007, 07, 3, 1),
(007, 09, 3, 10),
(007, 10, 3, 15),
(007, 11, 3, 13),
(007, 12, 3, 2),
(007, 13, 3, 12),
(008, 01, 10, 0),
(008, 02, 3, 2),
(008, 03, 3, 3),
(008, 04, 3, 4),
(008, 05, 3, 6),
(008, 06, 3, 1),
(008, 07, 3, 9),
(008, 09, 3, 15),
(008, 10, 3, 11),
(008, 11, 3, 10),
(008, 12, 3, 14),
(008, 13, 3, 13),
(009, 01, 10, 0),
(009, 02, 3, 15),
(009, 03, 3, 1),
(009, 04, 3, 4),
(009, 05, 3, 8),
(009, 06, 3, 10),
(009, 07, 3, 7),
(009, 09, 3, 11),
(009, 10, 3, 14),
(009, 11, 3, 12),
(009, 12, 3, 6),
(009, 13, 3, 13),
(010, 01, 10, 0),
(010, 02, 3, 3),
(010, 03, 3, 2),
(010, 04, 3, 1),
(010, 05, 3, 7),
(010, 06, 3, 15),
(010, 07, 3, 9),
(010, 09, 3, 14),
(010, 10, 3, 10),
(010, 11, 3, 5),
(010, 12, 3, 12),
(010, 13, 3, 4),
(011, 01, 10, 0),
(011, 02, 3, 2),
(011, 03, 3, 1),
(011, 04, 3, 6),
(011, 05, 3, 14),
(011, 06, 3, 7),
(011, 07, 3, 13),
(011, 09, 3, 5),
(011, 10, 3, 4),
(011, 11, 3, 8),
(011, 12, 3, 12),
(011, 13, 1, 9),
(012, 01, 10, 0),
(012, 02, 3, 3),
(012, 03, 3, 2),
(012, 04, 3, 5),
(012, 05, 3, 4),
(012, 06, 3, 9),
(012, 07, 3, 8),
(012, 09, 3, 6),
(012, 10, 3, 15),
(012, 11, 3, 14),
(012, 12, 3, 13),
(012, 13, 3, 12),
(013, 01, 10, 0),
(013, 02, 3, 1),
(013, 03, 3, 10),
(013, 04, 3, 15),
(013, 05, 3, 5),
(013, 06, 3, 13),
(013, 07, 3, 12),
(013, 09, 3, 6),
(013, 10, 3, 8),
(013, 11, 3, 14),
(013, 12, 3, 9),
(013, 13, 3, 3),
(014, 01, 10, 0),
(014, 02, 3, 10),
(014, 03, 3, 3),
(014, 04, 3, 12),
(014, 05, 3, 4),
(014, 06, 3, 9),
(014, 07, 3, 15),
(014, 09, 3, 11),
(014, 10, 3, 5),
(014, 11, 3, 7),
(014, 12, 3, 2),
(014, 13, 3, 1),
(015, 01, 10, 0),
(015, 02, 3, 1),
(015, 03, 3, 3),
(015, 04, 3, 15),
(015, 05, 3, 13),
(015, 06, 3, 14),
(015, 07, 3, 4),
(015, 09, 3, 10),
(015, 10, 3, 11),
(015, 11, 3, 7),
(015, 12, 3, 6),
(015, 13, 3, 8),
(016, 01, 10, 0),
(016, 02, 3, 3),
(016, 03, 3, 1),
(016, 04, 3, 10),
(016, 05, 3, 5),
(016, 06, 3, 6),
(016, 07, 3, 4),
(016, 09, 3, 14),
(016, 10, 3, 12),
(016, 11, 3, 13),
(016, 12, 3, 7),
(016, 13, 3, 8),
(017, 01, 10, 0),
(017, 02, 3, 1),
(017, 03, 3, 3),
(017, 04, 3, 13),
(017, 05, 3, 5),
(017, 06, 3, 14),
(017, 07, 3, 4),
(017, 09, 3, 12),
(017, 10, 3, 6),
(017, 11, 3, 15),
(017, 12, 3, 9),
(017, 13, 3, 11),
(018, 01, 10, 0),
(018, 02, 3, 15),
(018, 03, 3, 4),
(018, 04, 3, 14),
(018, 05, 3, 11),
(018, 06, 3, 3),
(018, 07, 3, 9),
(018, 09, 3, 6),
(018, 10, 3, 10),
(018, 11, 3, 13),
(018, 12, 3, 2),
(018, 13, 3, 1),
(019, 01, 10, 0),
(019, 02, 3, 1),
(019, 03, 3, 5),
(019, 04, 3, 15),
(019, 05, 3, 11),
(019, 06, 3, 10),
(019, 07, 3, 3),
(019, 09, 3, 2),
(019, 10, 3, 12),
(019, 11, 3, 6),
(019, 12, 3, 13),
(019, 13, 3, 14),
(020, 01, 10, 0),
(020, 02, 3, 1),
(020, 03, 3, 15),
(020, 04, 3, 4),
(020, 05, 3, 2),
(020, 06, 3, 7),
(020, 07, 3, 5),
(020, 09, 3, 14),
(020, 10, 3, 6),
(020, 11, 3, 13),
(020, 12, 3, 8),
(020, 13, 3, 10),
(021, 01, 10, 0),
(021, 02, 3, 1),
(021, 03, 3, 15),
(021, 04, 3, 5),
(021, 06, 3, 6),
(021, 07, 3, 14),
(021, 09, 3, 10),
(021, 10, 3, 2),
(021, 11, 3, 3),
(021, 12, 3, 12),
(021, 13, 3, 13),
(022, 01, 10, 0),
(022, 02, 3, 3),
(022, 03, 3, 1),
(022, 04, 3, 5),
(022, 05, 3, 15),
(022, 06, 3, 14),
(022, 07, 3, 13),
(022, 09, 3, 12),
(022, 10, 3, 10),
(022, 11, 3, 8),
(022, 12, 3, 6),
(022, 13, 3, 9),
(023, 01, 10, 0),
(023, 02, 3, 1),
(023, 03, 3, 3),
(023, 04, 3, 4),
(023, 05, 3, 5),
(023, 06, 3, 6),
(023, 07, 3, 15),
(023, 09, 3, 14),
(023, 10, 3, 10),
(023, 11, 3, 7),
(023, 12, 3, 13),
(023, 13, 3, 12),
(024, 01, 10, 0),
(024, 02, 3, 1),
(024, 03, 3, 14),
(024, 04, 3, 15),
(024, 05, 3, 12),
(024, 06, 3, 11),
(024, 07, 3, 5),
(024, 09, 3, 6),
(024, 10, 3, 7),
(024, 11, 3, 9),
(024, 12, 3, 4),
(024, 13, 1, 10),
(025, 01, 10, 0),
(025, 02, 3, 11),
(025, 03, 3, 13),
(025, 04, 3, 1),
(025, 05, 3, 2),
(025, 06, 3, 4),
(025, 07, 3, 15),
(025, 09, 3, 5),
(025, 10, 3, 10),
(025, 11, 3, 14),
(025, 12, 3, 6),
(025, 13, 3, 8),
(026, 01, 10, 0),
(026, 02, 3, 1),
(026, 03, 3, 10),
(026, 04, 3, 7),
(026, 05, 3, 8),
(026, 06, 3, 12),
(026, 07, 3, 2),
(026, 09, 3, 15),
(026, 10, 3, 3),
(026, 11, 3, 4),
(026, 12, 3, 14),
(026, 13, 3, 5),
(027, 01, 10, 0),
(027, 02, 3, 11),
(027, 03, 3, 2),
(027, 04, 3, 12),
(027, 05, 3, 3),
(027, 06, 3, 13),
(027, 07, 3, 4),
(027, 09, 3, 14),
(027, 10, 3, 10),
(027, 11, 3, 5),
(027, 12, 3, 15),
(027, 13, 3, 1),
(028, 01, 10, 0),
(028, 02, 3, 14),
(028, 03, 3, 3),
(028, 04, 3, 13),
(028, 05, 3, 2),
(028, 06, 3, 6),
(028, 07, 3, 8),
(028, 09, 3, 12),
(028, 10, 3, 9),
(028, 11, 3, 15),
(028, 12, 3, 1),
(028, 13, 3, 5),
(030, 01, 1, 0),
(030, 02, 1, 4),
(030, 03, 2, 7),
(030, 04, 1, 15),
(030, 05, 1, 10),
(030, 08, 1, 11),
(030, 11, 1, 3),
(030, 12, 1, 5),
(031, 01, 1, 0),
(031, 02, 1, 5),
(031, 04, 3, 11),
(031, 05, 1, 10),
(031, 06, 4, 14),
(031, 07, 2, 4),
(031, 08, 4, 6),
(031, 09, 3, 1),
(031, 10, 3, 2),
(031, 11, 1, 13),
(031, 12, 1, 9),
(031, 13, 1, 7),
(032, 01, 1, 0),
(032, 02, 1, 10),
(032, 03, 5, 8),
(032, 04, 1, 5),
(032, 05, 1, 2),
(032, 06, 4, 11),
(032, 07, 3, 14),
(032, 08, 3, 13),
(032, 09, 5, 15),
(032, 10, 1, 3),
(032, 11, 1, 1),
(032, 12, 1, 4),
(032, 13, 3, 6),
(033, 01, 1, 0),
(033, 02, 5, 2),
(033, 03, 5, 15),
(033, 06, 5, 10),
(033, 08, 5, 14),
(033, 09, 5, 11),
(033, 11, 1, 4),
(033, 12, 1, 7),
(033, 13, 5, 5),
(034, 01, 1, 0),
(034, 02, 5, 11),
(034, 04, 5, 2),
(034, 05, 5, 15),
(034, 07, 3, 12),
(034, 10, 3, 6),
(034, 11, 1, 7),
(034, 12, 1, 8),
(034, 13, 5, 1),
(035, 01, 1, 0),
(035, 02, 1, 13),
(035, 04, 1, 8),
(035, 05, 1, 5),
(035, 06, 3, 3),
(035, 07, 3, 11),
(035, 10, 1, 14),
(035, 11, 1, 9),
(035, 12, 1, 1),
(035, 13, 1, 4),
(036, 01, 1, 0),
(036, 02, 1, 6),
(036, 05, 5, 5),
(036, 06, 1, 4),
(036, 07, 3, 14),
(036, 08, 2, 3),
(036, 09, 5, 15),
(036, 10, 4, 13),
(036, 11, 1, 2),
(036, 12, 1, 1),
(036, 13, 5, 8),
(037, 01, 1, 0),
(037, 04, 4, 8),
(037, 05, 5, 1),
(037, 06, 3, 13),
(037, 07, 3, 4),
(037, 08, 1, 7),
(037, 09, 3, 5),
(037, 11, 1, 6),
(037, 12, 1, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha_lider`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha_lider` (
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  `alianca_id` int(6) unsigned zerofill NOT NULL,
  PRIMARY KEY (`ilha_id`),
  KEY `alianca_id` (`alianca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mun_ilha_lider`
--

INSERT INTO `tb_mun_ilha_lider` (`ilha_id`, `alianca_id`) VALUES
(001, 000000),
(008, 000000),
(015, 000000),
(022, 000000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha_zona_coleta`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha_zona_coleta` (
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  `zona` int(2) unsigned zerofill NOT NULL,
  `coordenada` varchar(5) NOT NULL,
  `item_id` int(4) unsigned zerofill NOT NULL,
  `requisito_profissao` int(2) unsigned NOT NULL DEFAULT '0',
  `tempo_respawn` int(2) unsigned NOT NULL,
  `ultimo_respawn` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ilha_id`,`zona`,`coordenada`),
  KEY `ilha_id` (`ilha_id`),
  KEY `item_id` (`item_id`),
  KEY `ilha_id_2` (`ilha_id`,`zona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha_zona_mob`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha_zona_mob` (
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  `zona` int(2) unsigned zerofill NOT NULL,
  `coordenada` varchar(5) NOT NULL,
  `mob_id` int(3) unsigned zerofill NOT NULL,
  `chance` int(3) unsigned NOT NULL DEFAULT '100',
  `background` int(3) unsigned NOT NULL,
  PRIMARY KEY (`ilha_id`,`zona`,`coordenada`),
  KEY `ilha_id` (`ilha_id`),
  KEY `mob_id` (`mob_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mun_ilha_zona_mob`
--

INSERT INTO `tb_mun_ilha_zona_mob` (`ilha_id`, `zona`, `coordenada`, `mob_id`, `chance`, `background`) VALUES
(001, 01, '13_10', 001, 50, 2),
(001, 01, '18_7', 001, 50, 2),
(001, 01, '1_3', 001, 50, 2),
(001, 01, '3_15', 001, 50, 2),
(001, 01, '6_18', 001, 50, 2),
(001, 01, '8_11', 001, 50, 2),
(001, 01, '9_11', 001, 50, 2),
(001, 01, '9_12', 001, 50, 2),
(001, 01, '9_5', 001, 50, 2),
(001, 05, '11_10', 002, 50, 3),
(001, 05, '11_5', 002, 50, 3),
(001, 05, '12_11', 002, 50, 3),
(001, 05, '16_16', 002, 50, 3),
(001, 05, '16_7', 002, 50, 3),
(001, 05, '3_16', 002, 50, 3),
(001, 05, '6_16', 002, 50, 3),
(001, 05, '6_6', 002, 50, 3),
(001, 05, '9_11', 002, 50, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha_zona_portal`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha_zona_portal` (
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  `zona` int(2) unsigned zerofill NOT NULL,
  `coordenada` varchar(5) NOT NULL,
  `zona_destino` int(2) unsigned NOT NULL,
  `coordenada_destino` varchar(5) NOT NULL,
  PRIMARY KEY (`ilha_id`,`zona`,`coordenada`),
  KEY `ilha_id` (`ilha_id`),
  KEY `ilha_id_2` (`ilha_id`,`zona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mun_ilha_zona_portal`
--

INSERT INTO `tb_mun_ilha_zona_portal` (`ilha_id`, `zona`, `coordenada`, `zona_destino`, `coordenada_destino`) VALUES
(001, 01, '19_7', 0, '0_0'),
(001, 01, '5_19', 2, '5_0'),
(001, 02, '12_19', 3, '12_0'),
(001, 02, '5_0', 1, '5_19'),
(001, 03, '12_0', 2, '12_19'),
(001, 03, '13_19', 4, '13_0'),
(001, 04, '0_11', 5, '19_11'),
(001, 04, '13_0', 3, '13_19'),
(001, 05, '19_8', 4, '0_11'),
(001, 05, '2_17', 6, '19_3'),
(001, 06, '14_19', 7, '14_1'),
(001, 06, '19_3', 5, '2_17'),
(001, 07, '14_1', 6, '14_19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha_zona_pvp`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha_zona_pvp` (
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  `zona` int(2) unsigned zerofill NOT NULL,
  `background` int(2) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`ilha_id`,`zona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mun_ilha_zona_pvp`
--

INSERT INTO `tb_mun_ilha_zona_pvp` (`ilha_id`, `zona`, `background`) VALUES
(001, 02, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_ilha_zona_tripulacao`
--

CREATE TABLE IF NOT EXISTS `tb_mun_ilha_zona_tripulacao` (
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `zona` int(2) unsigned zerofill NOT NULL,
  `bandeira` varchar(100) NOT NULL,
  `coordenada` varchar(5) NOT NULL,
  PRIMARY KEY (`tripulacao_id`),
  KEY `ilha_id` (`ilha_id`),
  KEY `setor` (`zona`),
  KEY `ilha_id_2` (`ilha_id`,`zona`,`coordenada`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_mapa_naonavegavel`
--

CREATE TABLE IF NOT EXISTS `tb_mun_mapa_naonavegavel` (
  `x` int(3) unsigned NOT NULL,
  `y` int(3) unsigned NOT NULL,
  PRIMARY KEY (`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mun_mapa_naonavegavel`
--

INSERT INTO `tb_mun_mapa_naonavegavel` (`x`, `y`) VALUES
(0, 0),
(0, 1),
(0, 2),
(0, 3),
(0, 4),
(0, 5),
(0, 6),
(0, 7),
(0, 8),
(0, 9),
(0, 10),
(0, 11),
(0, 12),
(0, 13),
(0, 14),
(0, 15),
(0, 16),
(0, 17),
(0, 18),
(0, 19),
(0, 20),
(1, 0),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(2, 0),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(3, 0),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(4, 0),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 19),
(4, 20),
(5, 0),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 20),
(6, 0),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(7, 0),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 13),
(7, 14),
(7, 15),
(7, 16),
(8, 0),
(8, 1),
(8, 2),
(8, 12),
(8, 13),
(8, 14),
(8, 15),
(8, 16),
(9, 0),
(9, 1),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(10, 0),
(10, 1),
(10, 13),
(10, 14),
(10, 15),
(10, 16),
(11, 0),
(11, 1),
(11, 5),
(11, 14),
(11, 15),
(11, 16),
(12, 0),
(12, 1),
(12, 3),
(12, 4),
(12, 5),
(12, 14),
(12, 15),
(12, 16),
(13, 0),
(13, 3),
(13, 4),
(13, 5),
(13, 6),
(13, 7),
(13, 8),
(13, 9),
(13, 15),
(13, 16),
(14, 0),
(14, 3),
(14, 4),
(14, 5),
(14, 6),
(14, 7),
(14, 8),
(14, 9),
(15, 0),
(15, 3),
(15, 4),
(15, 5),
(15, 6),
(15, 7),
(16, 0),
(16, 3),
(16, 4),
(16, 5),
(16, 6),
(16, 7),
(17, 0),
(17, 4),
(17, 5),
(17, 6),
(17, 7),
(18, 0),
(18, 4),
(18, 5),
(18, 6),
(18, 7),
(19, 0),
(19, 5),
(19, 6),
(20, 0),
(21, 0),
(21, 1),
(22, 0),
(22, 1),
(23, 0),
(23, 1),
(23, 2),
(23, 3),
(24, 0),
(24, 1),
(24, 2),
(24, 3),
(25, 0),
(25, 1),
(25, 2),
(25, 3),
(26, 4),
(56, 23),
(56, 24),
(56, 25),
(56, 26),
(56, 27),
(57, 22),
(57, 23),
(57, 24),
(57, 25),
(57, 26),
(57, 27),
(57, 28),
(295, 0),
(295, 1),
(295, 2),
(295, 3),
(295, 4),
(295, 5),
(296, 0),
(296, 1),
(296, 2),
(296, 3),
(296, 4),
(296, 5),
(296, 6),
(296, 7),
(297, 0),
(297, 1),
(297, 2),
(297, 3),
(297, 4),
(297, 5),
(297, 6),
(297, 7),
(297, 8),
(297, 9),
(298, 0),
(298, 1),
(298, 2),
(298, 3),
(298, 4),
(298, 5),
(298, 6),
(298, 7),
(298, 8),
(298, 9),
(298, 10),
(299, 0),
(299, 1),
(299, 2),
(299, 3),
(299, 4),
(299, 5),
(299, 6),
(299, 7),
(299, 8),
(299, 9),
(299, 10),
(300, 0),
(300, 1),
(300, 2),
(300, 3),
(300, 4),
(300, 5),
(300, 6),
(300, 7),
(300, 8),
(300, 9),
(300, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_npc`
--

CREATE TABLE IF NOT EXISTS `tb_mun_npc` (
  `npc_id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `is_mar` int(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '0-false; 1-east; 2-north; 3-south; 4-west; 5-GL; 6-NW; 7-all blues; 8-todos',
  `coordenada` varchar(7) NOT NULL DEFAULT 'interno',
  `nome` varchar(250) NOT NULL,
  `img` int(4) NOT NULL,
  `background` int(2) unsigned NOT NULL,
  `texto` text NOT NULL,
  `is_compra` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_vende` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`npc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tb_mun_npc`
--

INSERT INTO `tb_mun_npc` (`npc_id`, `is_mar`, `coordenada`, `nome`, `img`, `background`, `texto`, `is_compra`, `is_vende`) VALUES
(0001, 8, 'interno', 'Estaleiro', 1, 0, 'Bem vindo ao Estaleiro da ilha!<br/>\nEu sou o dono deste lugar. Em que posso ajudar?', 0, 1),
(0002, 8, 'interno', 'Base da Marinha', 2, 1, 'Essa área é permitida somente a marinheiros autorizados!<br/>', 0, 0),
(0003, 8, 'interno', 'Bar', 3, 2, 'Bom dia meu jovem.<br>\nPuxe uma cadeira que irei lhe servir nosso melhor sakê!', 1, 0),
(0004, 8, 'interno', 'Mestre de Upgrades', 4, 0, 'Posso te ajudar a melhorar seus equipamentos, mas tudo tem um preço...', 0, 0),
(0005, 8, 'interno', 'Mestre do Dojô', 5, 0, 'Trabalho e dedicação são as chaves para o progresso!<br>\nFique a vontade para usar o local para o seu treinamento.', 0, 0),
(0006, 8, 'interno', 'Médico', 4, 0, 'Em que posso ajudar?', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_npc_equipamento`
--

CREATE TABLE IF NOT EXISTS `tb_mun_npc_equipamento` (
  `npc_id` int(4) unsigned zerofill NOT NULL,
  `equipamento_id` int(4) unsigned zerofill NOT NULL,
  KEY `npc_id` (`npc_id`),
  KEY `item_id` (`equipamento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_npc_funcao`
--

CREATE TABLE IF NOT EXISTS `tb_mun_npc_funcao` (
  `npc_id` int(4) unsigned zerofill NOT NULL,
  `funcao` varchar(200) NOT NULL,
  `tipo_link` varchar(150) NOT NULL DEFAULT 'link_content',
  `link` varchar(200) NOT NULL,
  KEY `npc_id` (`npc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mun_npc_funcao`
--

INSERT INTO `tb_mun_npc_funcao` (`npc_id`, `funcao`, `tipo_link`, `link`) VALUES
(0001, 'Comprar um navio', 'link_content', '?ses=estaleiroComprarNavio'),
(0001, 'Aprimorar/consertar meu navio', 'link_content', ''),
(0005, 'Escolher uma classe', 'link_content', '?ses=ctClasses'),
(0005, 'Aprender habilidades', 'link_content', '?ses=ctHabilidades'),
(0006, 'Tratar minha tripulação', 'link_content', '?ses=hospitalTratamento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_npc_ilha`
--

CREATE TABLE IF NOT EXISTS `tb_mun_npc_ilha` (
  `npc_id` int(4) unsigned zerofill NOT NULL,
  `ilha_id` int(3) unsigned zerofill NOT NULL,
  KEY `npc_id` (`npc_id`),
  KEY `ilha_id` (`ilha_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mun_npc_item`
--

CREATE TABLE IF NOT EXISTS `tb_mun_npc_item` (
  `npc_id` int(4) unsigned zerofill NOT NULL,
  `item_id` int(4) unsigned zerofill NOT NULL,
  KEY `npc_id` (`npc_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_habilidade`
--

CREATE TABLE IF NOT EXISTS `tb_per_habilidade` (
  `habilidade_id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `categoria` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-Classe, 2-Profissao, 3-Akuma',
  `tipo` int(1) unsigned NOT NULL COMMENT '0-passiva, 1-ataque, 2-buff',
  `requisito_pontos` int(1) unsigned NOT NULL DEFAULT '1',
  `requisito_classe` int(1) unsigned NOT NULL DEFAULT '0',
  `arvore` int(1) unsigned NOT NULL,
  `sequencia` int(2) unsigned NOT NULL,
  `consumo` int(3) unsigned NOT NULL DEFAULT '0',
  `espera` int(2) unsigned NOT NULL DEFAULT '0',
  `alcance` int(2) unsigned NOT NULL DEFAULT '1',
  `area` int(1) unsigned NOT NULL DEFAULT '1',
  `dano` int(4) unsigned NOT NULL DEFAULT '0',
  `bonus_attr` int(1) unsigned NOT NULL DEFAULT '0',
  `bonus_attr_quant` int(2) unsigned NOT NULL DEFAULT '0',
  `duracao` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`habilidade_id`),
  KEY `categoria` (`categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Extraindo dados da tabela `tb_per_habilidade`
--

INSERT INTO `tb_per_habilidade` (`habilidade_id`, `categoria`, `tipo`, `requisito_pontos`, `requisito_classe`, `arvore`, `sequencia`, `consumo`, `espera`, `alcance`, `area`, `dano`, `bonus_attr`, `bonus_attr_quant`, `duracao`) VALUES
(0001, 1, 1, 1, 1, 1, 1, 10, 1, 1, 1, 220, 0, 0, 0),
(0002, 1, 1, 1, 1, 1, 2, 20, 1, 1, 1, 450, 0, 0, 0),
(0003, 1, 1, 1, 1, 1, 3, 30, 1, 1, 1, 600, 0, 0, 0),
(0004, 1, 0, 1, 1, 1, 4, 0, 0, 0, 0, 0, 5, 5, 0),
(0005, 1, 1, 1, 1, 1, 5, 40, 2, 1, 1, 820, 0, 0, 0),
(0006, 1, 1, 1, 1, 1, 6, 50, 2, 1, 1, 970, 0, 0, 0),
(0007, 1, 0, 1, 1, 1, 7, 0, 0, 0, 0, 0, 5, 5, 0),
(0008, 1, 1, 2, 1, 1, 8, 70, 3, 1, 2, 600, 0, 0, 0),
(0009, 1, 1, 2, 1, 1, 9, 80, 3, 1, 3, 700, 0, 0, 0),
(0010, 1, 0, 3, 1, 1, 10, 0, 0, 0, 0, 0, 5, 10, 0),
(0011, 1, 1, 3, 1, 1, 11, 100, 3, 1, 1, 1400, 0, 0, 0),
(0012, 1, 1, 1, 1, 2, 1, 10, 1, 1, 1, 220, 0, 0, 0),
(0013, 1, 1, 1, 1, 2, 2, 20, 1, 1, 1, 450, 0, 0, 0),
(0014, 1, 1, 1, 1, 2, 3, 30, 1, 1, 1, 600, 0, 0, 0),
(0015, 1, 0, 1, 1, 2, 4, 0, 0, 0, 0, 0, 1, 5, 0),
(0016, 1, 1, 1, 1, 2, 5, 40, 2, 1, 1, 820, 0, 0, 0),
(0017, 1, 1, 1, 1, 2, 6, 50, 2, 1, 1, 970, 0, 0, 0),
(0018, 1, 0, 1, 1, 2, 7, 0, 0, 0, 0, 0, 1, 5, 0),
(0019, 1, 1, 2, 1, 2, 8, 70, 3, 2, 1, 1000, 0, 0, 0),
(0020, 1, 1, 2, 1, 2, 9, 80, 3, 3, 1, 1100, 0, 0, 0),
(0021, 1, 0, 3, 1, 2, 10, 0, 0, 0, 0, 0, 1, 10, 0),
(0022, 1, 1, 3, 1, 2, 11, 100, 3, 1, 1, 1400, 0, 0, 0),
(0023, 1, 1, 1, 1, 3, 1, 10, 1, 1, 1, 220, 0, 0, 0),
(0024, 1, 1, 1, 1, 3, 2, 20, 1, 1, 1, 450, 0, 0, 0),
(0025, 1, 1, 1, 1, 3, 3, 30, 1, 1, 1, 600, 0, 0, 0),
(0026, 1, 0, 1, 1, 3, 4, 0, 0, 0, 0, 0, 6, 5, 0),
(0027, 1, 1, 1, 1, 3, 5, 40, 2, 1, 1, 820, 0, 0, 0),
(0028, 1, 1, 1, 1, 3, 6, 50, 2, 1, 1, 970, 0, 0, 0),
(0029, 1, 0, 1, 1, 3, 7, 0, 0, 0, 0, 0, 6, 5, 0),
(0030, 1, 1, 2, 1, 3, 8, 70, 3, 3, 1, 1000, 0, 0, 0),
(0031, 1, 1, 2, 1, 3, 9, 80, 3, 1, 3, 700, 0, 0, 0),
(0032, 1, 0, 3, 1, 3, 10, 0, 0, 0, 0, 0, 6, 10, 0),
(0033, 1, 1, 3, 1, 3, 11, 100, 3, 1, 1, 1400, 0, 0, 0),
(0034, 1, 1, 1, 2, 1, 1, 20, 1, 1, 1, 220, 0, 0, 0),
(0035, 1, 1, 1, 2, 1, 2, 50, 1, 1, 1, 450, 0, 0, 0),
(0036, 1, 2, 1, 2, 1, 3, 60, 6, 1, 3, 0, 3, 50, 3),
(0037, 1, 0, 1, 2, 1, 4, 0, 0, 0, 0, 0, 3, 5, 0),
(0038, 1, 1, 1, 2, 1, 5, 80, 2, 1, 1, 820, 0, 0, 0),
(0039, 1, 1, 1, 2, 1, 6, 100, 2, 1, 1, 970, 0, 0, 0),
(0040, 1, 0, 1, 2, 1, 7, 0, 0, 0, 0, 0, 3, 5, 0),
(0041, 1, 2, 2, 2, 1, 8, 100, 6, 1, 3, 0, 4, 50, 4),
(0042, 1, 1, 2, 2, 1, 9, 100, 3, 1, 2, 700, 0, 0, 0),
(0043, 1, 0, 3, 2, 1, 10, 0, 0, 0, 0, 0, 3, 10, 0),
(0044, 1, 1, 3, 2, 1, 11, 100, 4, 1, 1, 1300, 0, 0, 0),
(0045, 1, 1, 1, 2, 2, 1, 20, 1, 1, 1, 220, 0, 0, 0),
(0046, 1, 2, 1, 2, 2, 2, 50, 6, 1, 3, 0, 4, 50, 3),
(0047, 1, 1, 1, 2, 2, 3, 60, 1, 1, 1, 600, 0, 0, 0),
(0048, 1, 0, 1, 2, 2, 4, 0, 0, 0, 0, 0, 7, 5, 0),
(0049, 1, 1, 1, 2, 2, 5, 80, 2, 1, 1, 820, 0, 0, 0),
(0050, 1, 2, 1, 2, 2, 6, 100, 6, 1, 3, 0, 6, 50, 4),
(0051, 1, 0, 1, 2, 2, 7, 0, 0, 0, 0, 0, 7, 5, 0),
(0052, 1, 1, 2, 2, 2, 8, 100, 3, 3, 1, 700, 0, 0, 0),
(0053, 1, 1, 2, 2, 2, 9, 100, 3, 3, 1, 800, 0, 0, 0),
(0054, 1, 0, 3, 2, 2, 10, 0, 0, 0, 0, 0, 7, 10, 0),
(0055, 1, 1, 3, 2, 2, 11, 100, 4, 1, 1, 1300, 0, 0, 0),
(0056, 1, 1, 1, 2, 3, 1, 20, 1, 1, 1, 220, 0, 0, 0),
(0057, 1, 1, 1, 2, 3, 2, 50, 1, 1, 1, 450, 0, 0, 0),
(0058, 1, 2, 1, 2, 3, 3, 60, 6, 1, 3, 0, 6, 50, 3),
(0059, 1, 0, 1, 2, 3, 4, 0, 0, 0, 0, 0, 6, 5, 0),
(0060, 1, 1, 1, 2, 3, 5, 80, 2, 1, 1, 820, 0, 0, 0),
(0061, 1, 1, 1, 2, 3, 6, 100, 2, 1, 1, 970, 0, 0, 0),
(0062, 1, 0, 1, 2, 3, 7, 0, 0, 0, 0, 0, 6, 5, 0),
(0063, 1, 2, 2, 2, 3, 8, 100, 6, 1, 3, 0, 3, 50, 4),
(0064, 1, 1, 2, 2, 3, 9, 100, 3, 1, 2, 700, 0, 0, 0),
(0065, 1, 0, 3, 2, 3, 10, 0, 0, 0, 0, 0, 6, 10, 0),
(0066, 1, 1, 3, 2, 3, 11, 100, 4, 1, 1, 1300, 0, 0, 0),
(0067, 1, 1, 1, 3, 1, 1, 20, 3, 7, 1, 200, 0, 0, 0),
(0068, 1, 1, 1, 3, 1, 2, 50, 3, 9, 1, 400, 0, 0, 0),
(0069, 1, 2, 1, 3, 1, 3, 60, 6, 1, 3, 0, 3, 50, 5),
(0070, 1, 0, 1, 3, 1, 4, 0, 0, 0, 0, 0, 4, 5, 0),
(0071, 1, 1, 1, 3, 1, 5, 80, 3, 1, 4, 600, 0, 0, 0),
(0072, 1, 1, 1, 3, 1, 6, 100, 4, 5, 2, 700, 0, 0, 0),
(0073, 1, 0, 1, 3, 1, 7, 0, 0, 0, 0, 0, 4, 5, 0),
(0074, 1, 2, 2, 3, 1, 8, 100, 6, 1, 3, 0, 4, 75, 6),
(0075, 1, 1, 2, 3, 1, 9, 100, 4, 10, 2, 700, 0, 0, 0),
(0076, 1, 0, 3, 3, 1, 10, 0, 0, 0, 0, 0, 4, 10, 0),
(0077, 1, 1, 3, 3, 1, 11, 100, 5, 20, 1, 1000, 0, 0, 0),
(0078, 1, 1, 1, 3, 2, 1, 20, 3, 3, 3, 200, 0, 0, 0),
(0079, 1, 2, 1, 3, 2, 2, 50, 6, 1, 3, 0, 4, 50, 5),
(0080, 1, 1, 1, 3, 2, 3, 60, 3, 9, 1, 600, 0, 0, 0),
(0081, 1, 0, 1, 3, 2, 4, 0, 0, 0, 0, 0, 5, 5, 0),
(0082, 1, 1, 1, 3, 2, 5, 80, 4, 1, 1, 820, 0, 0, 0),
(0083, 1, 2, 1, 3, 2, 6, 100, 6, 1, 3, 0, 6, 75, 6),
(0084, 1, 0, 1, 3, 2, 7, 0, 0, 0, 0, 0, 5, 5, 0),
(0085, 1, 1, 2, 3, 2, 8, 100, 4, 9, 1, 700, 0, 0, 0),
(0086, 1, 1, 2, 3, 2, 9, 100, 4, 9, 1, 800, 0, 0, 0),
(0087, 1, 0, 3, 3, 2, 10, 0, 0, 0, 0, 0, 5, 10, 0),
(0088, 1, 2, 3, 3, 2, 11, 100, 4, 1, 3, 0, 1, 90, 3),
(0089, 1, 1, 1, 3, 3, 1, 20, 3, 2, 3, 200, 0, 0, 0),
(0090, 1, 1, 1, 3, 3, 2, 50, 3, 2, 3, 300, 0, 0, 0),
(0091, 1, 2, 1, 3, 3, 3, 60, 6, 1, 3, 0, 6, 50, 5),
(0092, 1, 0, 1, 3, 3, 4, 0, 0, 0, 0, 0, 6, 5, 0),
(0093, 1, 1, 1, 3, 3, 5, 80, 3, 4, 4, 500, 0, 0, 0),
(0094, 1, 1, 1, 3, 3, 6, 100, 4, 4, 4, 600, 0, 0, 0),
(0095, 1, 0, 1, 3, 3, 7, 0, 0, 0, 0, 0, 6, 5, 0),
(0096, 1, 2, 2, 3, 3, 8, 100, 6, 1, 3, 0, 3, 75, 6),
(0097, 1, 1, 2, 3, 3, 9, 100, 4, 4, 4, 600, 0, 0, 0),
(0098, 1, 0, 3, 3, 3, 10, 0, 0, 0, 0, 0, 6, 10, 0),
(0099, 1, 1, 3, 3, 3, 11, 100, 5, 4, 6, 600, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_personagem`
--

CREATE TABLE IF NOT EXISTS `tb_per_personagem` (
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `personagem_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `imagem` int(4) unsigned zerofill NOT NULL,
  `skin_rosto` int(2) NOT NULL DEFAULT '0',
  `skin_corpo` int(2) NOT NULL DEFAULT '0',
  `hp` int(4) unsigned NOT NULL DEFAULT '1000',
  `mp` int(4) unsigned NOT NULL DEFAULT '100',
  `xp` int(6) NOT NULL DEFAULT '0',
  `lvl` int(2) unsigned NOT NULL DEFAULT '1',
  `nome` varchar(15) NOT NULL,
  `fama_ameaca` int(10) unsigned NOT NULL DEFAULT '0',
  `is_procurado` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `atributo_atk` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_def` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_agl` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_res` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_pre` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_des` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_per` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_vit` int(4) unsigned NOT NULL DEFAULT '1',
  `atributo_sem_distribuir` int(4) NOT NULL DEFAULT '20',
  `haki_lvl` int(3) NOT NULL DEFAULT '1',
  `haki_xp` int(5) NOT NULL DEFAULT '0',
  `haki_pontos_sem_distribuir` int(2) unsigned NOT NULL DEFAULT '0',
  `haki_pontos_mantra` int(3) NOT NULL DEFAULT '0',
  `haki_pontos_armamento` int(3) NOT NULL DEFAULT '0',
  `pontos_habilidade` int(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`personagem_id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `cod_trip` (`tripulacao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Extraindo dados da tabela `tb_per_personagem`
--

INSERT INTO `tb_per_personagem` (`tripulacao_id`, `personagem_id`, `imagem`, `skin_rosto`, `skin_corpo`, `hp`, `mp`, `xp`, `lvl`, `nome`, `fama_ameaca`, `is_procurado`, `atributo_atk`, `atributo_def`, `atributo_agl`, `atributo_res`, `atributo_pre`, `atributo_des`, `atributo_per`, `atributo_vit`, `atributo_sem_distribuir`, `haki_lvl`, `haki_xp`, `haki_pontos_sem_distribuir`, `haki_pontos_mantra`, `haki_pontos_armamento`, `pontos_habilidade`) VALUES
(0000000038, 0000000050, 0019, 0, 0, 910, 50, 12000, 5, 'Padawan', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 40, 1, 0, 0, 0, 0, 0),
(0000000038, 0000000051, 0050, 0, 0, 0, 100, 4000, 1, 'Trip2', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 20, 1, 0, 0, 0, 0, 1),
(0000000038, 0000000052, 0080, 0, 0, 400, 100, 4000, 1, 'Per2', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 20, 1, 0, 0, 0, 0, 1),
(0000000038, 0000000053, 0090, 0, 0, 0, 100, 4000, 1, 'Per3', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 20, 1, 0, 0, 0, 0, 1),
(0000000038, 0000000054, 0025, 0, 0, 0, 100, 4000, 1, 'Per4', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 20, 1, 0, 0, 0, 0, 1),
(0000000039, 0000000055, 0015, 0, 0, 0, 115, 0, 2, 'Bugado', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 25, 1, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_personagem_acessorio`
--

CREATE TABLE IF NOT EXISTS `tb_per_personagem_acessorio` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `item_id` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`personagem_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_per_personagem_acessorio`
--

INSERT INTO `tb_per_personagem_acessorio` (`personagem_id`, `item_id`) VALUES
(0000000050, 0001);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_personagem_classe`
--

CREATE TABLE IF NOT EXISTS `tb_per_personagem_classe` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `classe_id` int(1) unsigned zerofill NOT NULL,
  `score` float NOT NULL DEFAULT '1000',
  PRIMARY KEY (`personagem_id`),
  KEY `classe_id` (`classe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_per_personagem_classe`
--

INSERT INTO `tb_per_personagem_classe` (`personagem_id`, `classe_id`, `score`) VALUES
(0000000050, 1, 1000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_personagem_equipamento`
--

CREATE TABLE IF NOT EXISTS `tb_per_personagem_equipamento` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `slot` int(1) unsigned NOT NULL,
  `equipamento_id` int(4) unsigned zerofill NOT NULL,
  `evolucao` int(2) unsigned NOT NULL DEFAULT '0',
  `slot_1` int(1) unsigned NOT NULL DEFAULT '0',
  `slot_2` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`personagem_id`,`slot`),
  UNIQUE KEY `personagem_id_2` (`personagem_id`,`equipamento_id`),
  KEY `equipamento_id` (`equipamento_id`),
  KEY `personagem_id` (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_personagem_habilidade`
--

CREATE TABLE IF NOT EXISTS `tb_per_personagem_habilidade` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `habilidade_id` int(4) unsigned zerofill NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `img` int(3) unsigned NOT NULL,
  `lvl` int(2) unsigned NOT NULL DEFAULT '0',
  `xp` int(4) unsigned NOT NULL DEFAULT '0',
  `xp_max` int(4) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`personagem_id`,`habilidade_id`),
  KEY `personagem_id` (`personagem_id`),
  KEY `habilidade_id` (`habilidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_per_personagem_habilidade`
--

INSERT INTO `tb_per_personagem_habilidade` (`personagem_id`, `habilidade_id`, `nome`, `descricao`, `img`, `lvl`, `xp`, `xp_max`) VALUES
(0000000050, 0001, 'Corte #1', 'Estilo Ninja com espadas, Corte #1', 15, 0, 0, 100),
(0000000050, 0002, 'Corte #2', 'Estilo Ninja com espadas, Corte #2', 17, 0, 0, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_personagem_habilidade_ponto`
--

CREATE TABLE IF NOT EXISTS `tb_per_personagem_habilidade_ponto` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `habilidade_id` int(4) unsigned zerofill NOT NULL,
  `pontos` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`personagem_id`,`habilidade_id`),
  KEY `personagem_id` (`personagem_id`),
  KEY `habilidade_id` (`habilidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_per_personagem_habilidade_ponto`
--

INSERT INTO `tb_per_personagem_habilidade_ponto` (`personagem_id`, `habilidade_id`, `pontos`) VALUES
(0000000050, 0001, 1),
(0000000050, 0002, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_per_personagem_profissao`
--

CREATE TABLE IF NOT EXISTS `tb_per_personagem_profissao` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `profissao_id` int(2) unsigned zerofill NOT NULL,
  `lvl` int(2) unsigned NOT NULL DEFAULT '1',
  `xp` int(3) unsigned NOT NULL DEFAULT '0',
  `xp_max` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`personagem_id`),
  KEY `profissao_id` (`profissao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pve_mob`
--

CREATE TABLE IF NOT EXISTS `tb_pve_mob` (
  `mob_id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `lvl` int(2) NOT NULL DEFAULT '1',
  `img` int(3) unsigned NOT NULL,
  `hp` int(4) unsigned NOT NULL,
  `atk` int(3) unsigned NOT NULL,
  `def` int(3) unsigned NOT NULL,
  `agl` int(3) unsigned NOT NULL,
  `pre` int(3) unsigned NOT NULL,
  `res` int(3) unsigned NOT NULL,
  `des` int(3) unsigned NOT NULL,
  `per` int(3) unsigned NOT NULL,
  `dano` int(4) unsigned NOT NULL,
  `armadura` int(4) unsigned NOT NULL,
  `recompensa_xp` int(4) unsigned NOT NULL DEFAULT '0',
  `dano_habilidade` int(3) unsigned NOT NULL,
  `nome_habilidade` varchar(150) NOT NULL,
  `descricao_habilidade` text NOT NULL,
  `img_habilidade` int(3) unsigned NOT NULL,
  PRIMARY KEY (`mob_id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_pve_mob`
--

INSERT INTO `tb_pve_mob` (`mob_id`, `nome`, `lvl`, `img`, `hp`, `atk`, `def`, `agl`, `pre`, `res`, `des`, `per`, `dano`, `armadura`, `recompensa_xp`, `dano_habilidade`, `nome_habilidade`, `descricao_habilidade`, `img_habilidade`) VALUES
(001, 'Cocofox', 4, 2, 100, 5, 1, 5, 1, 5, 1, 1, 0, 0, 100, 30, 'Rajada de penas', 'Usa as afiadas penas do rabo para atacar os inimigos', 39),
(002, 'Batpanda', 6, 3, 110, 7, 1, 4, 5, 4, 6, 1, 3, 3, 100, 40, 'Zumbido estrondoso', 'Bate as asas em uma frequência muito alta que fere os ouvidos dos oponentes', 128);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pve_mob_drop_equipamento`
--

CREATE TABLE IF NOT EXISTS `tb_pve_mob_drop_equipamento` (
  `mob_id` int(3) unsigned zerofill NOT NULL,
  `equipamento_id` int(4) unsigned zerofill NOT NULL,
  `chance` int(3) NOT NULL DEFAULT '100',
  PRIMARY KEY (`mob_id`,`equipamento_id`),
  KEY `equipamento_id` (`equipamento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pve_mob_drop_item`
--

CREATE TABLE IF NOT EXISTS `tb_pve_mob_drop_item` (
  `mob_id` int(3) unsigned zerofill NOT NULL,
  `item_id` int(4) unsigned zerofill NOT NULL,
  `quant` int(2) unsigned NOT NULL DEFAULT '1',
  `chance` int(3) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`mob_id`,`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_pve_mob_drop_item`
--

INSERT INTO `tb_pve_mob_drop_item` (`mob_id`, `item_id`, `quant`, `chance`) VALUES
(002, 0003, 1, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_rnk_patente`
--

CREATE TABLE IF NOT EXISTS `tb_rnk_patente` (
  `patente_id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nome_0` varchar(50) NOT NULL,
  `nome_1` varchar(50) NOT NULL,
  `reputacao` int(6) NOT NULL DEFAULT '0',
  `ranking` int(10) NOT NULL DEFAULT '0',
  `lvl` int(2) NOT NULL DEFAULT '0',
  `reputacao_base` int(5) NOT NULL,
  PRIMARY KEY (`patente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `tb_rnk_patente`
--

INSERT INTO `tb_rnk_patente` (`patente_id`, `nome_0`, `nome_1`, `reputacao`, `ranking`, `lvl`, `reputacao_base`) VALUES
(0, 'Garoto de Pequena Tarefa', 'Garoto desconhecido', 0, 0, 0, 100),
(1, 'Recruta', 'Capitão de pequeno grupo', 1000, 0, 5, 200),
(2, 'Aprendiz de Marinheiro', 'Pirata', 2000, 0, 10, 300),
(3, 'Marinheiro', 'Pirata rank 9', 4000, 0, 15, 400),
(4, 'Suboficial de Terceira Classe', 'Pirata rank 8', 8000, 0, 20, 500),
(5, 'Suboficial de Segunda Classe', 'Pirata rank 7', 16000, 0, 20, 550),
(6, 'Suboficial de Primeira Classe', 'Pirata rank 6', 25000, 0, 20, 600),
(7, 'Oficial', 'Pirata rank 5', 34000, 0, 25, 700),
(8, 'Tenente de Classe Júnior', 'Pirata rank 4', 45000, 0, 30, 800),
(9, 'Tenente', 'Pirata rank 3', 57000, 0, 30, 900),
(10, 'Tenente Comandante', 'Pirata rank 2', 71000, 0, 35, 1000),
(11, 'Comandante', 'Pirata rank 1', 91000, 0, 40, 3000),
(12, 'Capitão', 'Supernova', 155000, 0, 45, 5000),
(13, 'Comodoro', 'Saidai reberu', 260000, 0, 50, 10000),
(14, 'Contra-Almirante', 'Akumeidakai', 510000, 20, 50, 15000),
(15, 'Vice-Almirante', 'Diu Sencho', 800000, 11, 50, 20000),
(16, 'Almirante', 'Yonkou', 1500000, 4, 50, 25000),
(17, 'Almirante de frota', 'Rei dos piratas', 0, 0, 0, 50000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sis_manutencao`
--

CREATE TABLE IF NOT EXISTS `tb_sis_manutencao` (
  `is_total` tinyint(1) NOT NULL DEFAULT '0',
  `permissao` int(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_sis_manutencao`
--

INSERT INTO `tb_sis_manutencao` (`is_total`, `permissao`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sis_restricao_pagina`
--

CREATE TABLE IF NOT EXISTS `tb_sis_restricao_pagina` (
  `pagina` varchar(100) NOT NULL,
  `logado` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `tripativa` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `combate` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `ilha` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `navio` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `missao` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `recrutamento` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `rota` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `derrotado` tinyint(1) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`pagina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_sis_restricao_pagina`
--

INSERT INTO `tb_sis_restricao_pagina` (`pagina`, `logado`, `tripativa`, `combate`, `ilha`, `navio`, `missao`, `recrutamento`, `rota`, `derrotado`) VALUES
('p_ativacao', 0, 2, 2, 2, 2, 2, 2, 2, 2),
('p_cadastro', 0, 2, 2, 2, 2, 2, 2, 2, 2),
('p_combate', 1, 1, 1, 2, 2, 2, 0, 0, 2),
('p_ctClasses', 1, 1, 0, 1, 2, 2, 0, 2, 2),
('p_ctHabilidades', 1, 1, 0, 1, 2, 2, 0, 2, 2),
('p_estaleiroComprarNavio', 1, 1, 0, 1, 2, 2, 0, 2, 2),
('p_hospitalTratamento', 1, 1, 0, 1, 2, 2, 0, 2, 2),
('p_ilhaGeral', 1, 1, 0, 1, 2, 2, 2, 2, 2),
('p_navio', 1, 1, 2, 2, 2, 2, 2, 2, 2),
('p_novaTripulacao', 1, 0, 2, 2, 2, 2, 2, 2, 2),
('p_npc', 1, 1, 2, 2, 2, 2, 2, 2, 2),
('p_p_triHabilidades', 1, 1, 0, 2, 2, 2, 2, 2, 2),
('p_sistemaAkumaCadastro', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaAkumaEdicao', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaAkumaListagem', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaEquipamentosCadastro', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaEquipamentosListagem', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaIlhas', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaIlhasExterno', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaItens', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaItensCadastro', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaItensListagem', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaMissoes', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaMissoesCadastro', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaMissoesListagem', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaMundi', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaNPCCadastro', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaNPCListagem', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_sistemaRestricoes', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('p_triEquipamentos', 1, 1, 0, 2, 2, 2, 2, 2, 2),
('p_tripulacaoStatus', 1, 1, 2, 2, 2, 2, 2, 2, 2),
('s_bauGetItens', 1, 1, 2, 2, 2, 2, 2, 2, 2),
('s_cbtAtacar', 1, 1, 1, 2, 2, 2, 0, 0, 0),
('s_cbtFinalizar', 1, 1, 2, 2, 2, 2, 2, 2, 2),
('s_cbtGetHabilidades', 1, 1, 1, 2, 2, 2, 2, 2, 0),
('s_cbtMover', 1, 1, 1, 2, 2, 2, 2, 2, 0),
('s_ctAddPonto', 1, 1, 0, 1, 2, 2, 0, 0, 2),
('s_ctAprenderClasse', 1, 1, 0, 1, 2, 2, 0, 0, 2),
('s_estComprarNavio', 1, 1, 0, 1, 0, 2, 0, 2, 2),
('s_fastGetMissaoAndamento', 1, 1, 2, 2, 2, 2, 2, 2, 2),
('s_geralCadastrar', 0, 2, 2, 2, 2, 2, 2, 2, 2),
('s_geralDeslogar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_geralLogar', 0, 2, 2, 2, 2, 2, 2, 2, 2),
('s_hosCancelar', 1, 1, 0, 1, 2, 2, 0, 2, 2),
('s_hosFinalizar', 1, 1, 0, 1, 2, 2, 0, 2, 2),
('s_hosTratar', 1, 1, 0, 1, 2, 2, 0, 2, 2),
('s_ilhaAndar', 1, 1, 0, 1, 2, 2, 0, 0, 0),
('s_ilhaExternoVisualizar', 1, 1, 0, 1, 2, 2, 2, 2, 0),
('s_ilhaExternoVisualizarJogadores', 1, 1, 0, 1, 2, 2, 2, 0, 0),
('s_ilhaSair', 1, 1, 0, 1, 2, 2, 0, 0, 0),
('s_ilhaUsarPortal', 1, 1, 0, 1, 2, 2, 2, 0, 2),
('s_itnDescartar', 1, 1, 0, 2, 2, 2, 2, 2, 2),
('s_itnItemInfo', 1, 1, 2, 2, 2, 2, 2, 2, 2),
('s_misAceitar', 1, 1, 0, 2, 2, 0, 0, 2, 0),
('s_misCancelar', 1, 1, 0, 2, 2, 1, 2, 2, 2),
('s_misConcluir', 1, 1, 0, 2, 2, 1, 2, 2, 0),
('s_perAddAtributo', 1, 1, 0, 2, 2, 0, 2, 2, 2),
('s_perAprenderHabilidade', 1, 1, 0, 1, 2, 2, 0, 0, 2),
('s_perEquiparAcessorio', 1, 1, 0, 2, 2, 2, 0, 2, 2),
('s_perEquiparEquipamento', 1, 1, 0, 2, 2, 2, 0, 2, 2),
('s_perEvoluir', 1, 1, 0, 2, 2, 2, 0, 2, 2),
('s_perRetirarAcessorio', 1, 1, 0, 2, 2, 2, 0, 2, 2),
('s_perRetirarEquipamento', 1, 1, 0, 2, 2, 2, 0, 2, 2),
('s_sisAkumaCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisAkumaEditar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisEdificioCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisEquipamentoCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisIlhaCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisIlhaEdificioCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisIlhaEdificioRemover', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisIlhaExternoAlterarCoordenada', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisIlhaExternoVisualizar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisItemCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisMapa', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisMapaSetNavegavel', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisMissaoCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisNPCCadastrar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisRestricoesAdicionar', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_sisRestricoesRemover', 1, 2, 2, 2, 2, 2, 2, 2, 2),
('s_usrTripulacaoCadastrar', 1, 0, 2, 2, 2, 2, 2, 2, 2),
('s_usrTripulacaoDesconectar', 1, 1, 0, 2, 2, 2, 2, 2, 2),
('s_usrTripulacaoSelecionar', 1, 0, 2, 2, 2, 2, 2, 2, 2),
('s_vipResetAtributos', 1, 1, 0, 2, 2, 2, 0, 2, 2),
('s_vipResetClasse', 1, 1, 0, 2, 2, 2, 0, 2, 2),
('s_vipResetHabilidades', 1, 1, 0, 2, 2, 2, 0, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_amigos`
--

CREATE TABLE IF NOT EXISTS `tb_usr_amigos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(10) unsigned zerofill NOT NULL,
  `toid` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fromid_2` (`fromid`,`toid`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_conta`
--

CREATE TABLE IF NOT EXISTS `tb_usr_conta` (
  `conta_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `faccao` tinyint(1) DEFAULT NULL,
  `is_ativado` varchar(8) NOT NULL DEFAULT '0',
  `ip` varchar(30) NOT NULL,
  `is_vip` tinyint(1) NOT NULL DEFAULT '0',
  `gold` int(6) NOT NULL DEFAULT '50',
  `permissao` int(1) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`conta_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_usr_conta`
--

INSERT INTO `tb_usr_conta` (`conta_id`, `email`, `senha`, `nome`, `data_cadastro`, `data_login`, `faccao`, `is_ativado`, `ip`, `is_vip`, `gold`, `permissao`) VALUES
(0000000001, 'ivan.i.n@hotmail.com', '3b018668e9b9e9e5ffce54251d659318', 'Ivan Miranda', '2013-12-07 16:23:03', '2014-02-17 14:18:54', 1, '0', '::1', 0, 48, 0),
(0000000002, 'teste@teste.com', '3b018668e9b9e9e5ffce54251d659318', 'Teste', '2013-12-12 11:05:40', '2014-02-17 14:18:55', 1, '0', '::1', 0, 50, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_conta_afilhado`
--

CREATE TABLE IF NOT EXISTS `tb_usr_conta_afilhado` (
  `conta_id` int(10) unsigned zerofill NOT NULL,
  `afilhado_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`afilhado_id`),
  KEY `id` (`conta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_conta_cookie`
--

CREATE TABLE IF NOT EXISTS `tb_usr_conta_cookie` (
  `conta_id` int(10) unsigned zerofill NOT NULL,
  `cookie_id` varchar(32) NOT NULL,
  PRIMARY KEY (`cookie_id`),
  UNIQUE KEY `id` (`conta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usr_conta_cookie`
--

INSERT INTO `tb_usr_conta_cookie` (`conta_id`, `cookie_id`) VALUES
(0000000001, '801fe5d4ef0fea90ee869814f010ff0b'),
(0000000002, 'edb197ed315d6ac8a5ee50de4d355551');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_conta_facebook`
--

CREATE TABLE IF NOT EXISTS `tb_usr_conta_facebook` (
  `conta_id` int(10) unsigned zerofill NOT NULL,
  `facebook_id` int(15) unsigned NOT NULL,
  PRIMARY KEY (`facebook_id`),
  UNIQUE KEY `id` (`conta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_conta_tripulacao`
--

CREATE TABLE IF NOT EXISTS `tb_usr_conta_tripulacao` (
  `conta_id` int(10) unsigned zerofill NOT NULL,
  `tripulacao_id` int(15) unsigned zerofill NOT NULL,
  UNIQUE KEY `id` (`conta_id`),
  UNIQUE KEY `tripulacao` (`tripulacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usr_conta_tripulacao`
--

INSERT INTO `tb_usr_conta_tripulacao` (`conta_id`, `tripulacao_id`) VALUES
(0000000001, 000000000000038),
(0000000002, 000000000000039);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_navio`
--

CREATE TABLE IF NOT EXISTS `tb_usr_navio` (
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `hp` int(4) unsigned NOT NULL DEFAULT '100',
  `skin` int(2) unsigned NOT NULL DEFAULT '0',
  `lvl_navio` int(2) unsigned NOT NULL DEFAULT '1',
  `lvl_conves` int(2) unsigned NOT NULL DEFAULT '1',
  `lvl_armazem` int(2) unsigned NOT NULL DEFAULT '1',
  `lvl_leme` int(2) unsigned NOT NULL DEFAULT '1',
  `lvl_casco` int(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`tripulacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usr_navio`
--

INSERT INTO `tb_usr_navio` (`tripulacao_id`, `hp`, `skin`, `lvl_navio`, `lvl_conves`, `lvl_armazem`, `lvl_leme`, `lvl_casco`) VALUES
(0000000038, 100, 1, 1, 8, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_tripulacao`
--

CREATE TABLE IF NOT EXISTS `tb_usr_tripulacao` (
  `conta_id` int(10) unsigned zerofill NOT NULL,
  `tripulacao_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `data_login` int(11) NOT NULL DEFAULT '0',
  `is_logado` tinyint(1) NOT NULL DEFAULT '0',
  `reputacao` int(6) NOT NULL DEFAULT '0',
  `berries` double unsigned NOT NULL DEFAULT '5000',
  `vitorias` int(6) NOT NULL DEFAULT '0',
  `bandeira` varchar(32) NOT NULL,
  `in_ilha` int(3) unsigned zerofill NOT NULL DEFAULT '000',
  `coordenada_atual` varchar(7) NOT NULL DEFAULT 'interno',
  `ilha_retorno` int(3) unsigned zerofill NOT NULL,
  `is_kairouseki` tinyint(1) NOT NULL DEFAULT '0',
  `realizacoes` int(9) NOT NULL DEFAULT '0',
  `disposicao` int(5) NOT NULL DEFAULT '10000',
  PRIMARY KEY (`tripulacao_id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `id` (`conta_id`),
  KEY `in_ilha` (`in_ilha`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Extraindo dados da tabela `tb_usr_tripulacao`
--

INSERT INTO `tb_usr_tripulacao` (`conta_id`, `tripulacao_id`, `nome`, `data_login`, `is_logado`, `reputacao`, `berries`, `vitorias`, `bandeira`, `in_ilha`, `coordenada_atual`, `ilha_retorno`, `is_kairouseki`, `realizacoes`, `disposicao`) VALUES
(0000000001, 0000000038, 'PiratasPadawan', 1392646734, 1, 0, 45000, 0, 'pirata', 001, '1_18_7', 015, 0, 0, 10000),
(0000000002, 0000000039, 'PiratasBugado', 1392646735, 1, 0, 15000, 0, 'pirata', 001, 'interno', 001, 0, 0, 10000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usr_tripulacao_capitao`
--

CREATE TABLE IF NOT EXISTS `tb_usr_tripulacao_capitao` (
  `tripulacao_id` int(10) unsigned zerofill NOT NULL,
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`tripulacao_id`),
  UNIQUE KEY `personagem_id` (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usr_tripulacao_capitao`
--

INSERT INTO `tb_usr_tripulacao_capitao` (`tripulacao_id`, `personagem_id`) VALUES
(0000000038, 0000000050),
(0000000039, 0000000055);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_vip_reset_atributos`
--

CREATE TABLE IF NOT EXISTS `tb_vip_reset_atributos` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `personagem_id` (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_vip_reset_atributos`
--

INSERT INTO `tb_vip_reset_atributos` (`personagem_id`, `data`) VALUES
(0000000050, '2013-12-07 18:36:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_vip_reset_classe`
--

CREATE TABLE IF NOT EXISTS `tb_vip_reset_classe` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `personagem_id` (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_vip_reset_habilidade`
--

CREATE TABLE IF NOT EXISTS `tb_vip_reset_habilidade` (
  `personagem_id` int(10) unsigned zerofill NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `personagem_id` (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `tb_cbt_combate_mob`
--
ALTER TABLE `tb_cbt_combate_mob`
  ADD CONSTRAINT `tb_cbt_combate_mob_ibfk_1` FOREIGN KEY (`combate_id`) REFERENCES `tb_cbt_combate` (`combate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cbt_combate_mob_ibfk_2` FOREIGN KEY (`mob_id`) REFERENCES `tb_pve_mob` (`mob_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_cbt_combate_personagem`
--
ALTER TABLE `tb_cbt_combate_personagem`
  ADD CONSTRAINT `tb_cbt_combate_personagem_ibfk_1` FOREIGN KEY (`combate_id`) REFERENCES `tb_cbt_combate` (`combate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cbt_combate_personagem_ibfk_2` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_cbt_combate_personagem_buff`
--
ALTER TABLE `tb_cbt_combate_personagem_buff`
  ADD CONSTRAINT `tb_cbt_combate_personagem_buff_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_cbt_combate_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cbt_combate_personagem_buff_ibfk_2` FOREIGN KEY (`combate_id`) REFERENCES `tb_cbt_combate` (`combate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_cbt_combate_personagem_espera`
--
ALTER TABLE `tb_cbt_combate_personagem_espera`
  ADD CONSTRAINT `tb_cbt_combate_personagem_espera_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_cbt_combate_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cbt_combate_personagem_espera_ibfk_2` FOREIGN KEY (`habilidade_id`) REFERENCES `tb_per_habilidade` (`habilidade_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cbt_combate_personagem_espera_ibfk_3` FOREIGN KEY (`combate_id`) REFERENCES `tb_cbt_combate` (`combate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_cbt_combate_tripulacao`
--
ALTER TABLE `tb_cbt_combate_tripulacao`
  ADD CONSTRAINT `tb_cbt_combate_tripulacao_ibfk_1` FOREIGN KEY (`combate_id`) REFERENCES `tb_cbt_combate` (`combate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cbt_combate_tripulacao_ibfk_2` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_cbt_combate_update`
--
ALTER TABLE `tb_cbt_combate_update`
  ADD CONSTRAINT `tb_cbt_combate_update_ibfk_1` FOREIGN KEY (`combate_id`) REFERENCES `tb_cbt_combate` (`combate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_hos_personagem`
--
ALTER TABLE `tb_hos_personagem`
  ADD CONSTRAINT `tb_hos_personagem_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_hos_personagem_ibfk_2` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_itn_tripulacao_equipamento`
--
ALTER TABLE `tb_itn_tripulacao_equipamento`
  ADD CONSTRAINT `tb_itn_tripulacao_equipamento_ibfk_1` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_itn_tripulacao_equipamento_ibfk_2` FOREIGN KEY (`equipamento_id`) REFERENCES `tb_itn_equipamento` (`equipamento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_itn_tripulacao_item`
--
ALTER TABLE `tb_itn_tripulacao_item`
  ADD CONSTRAINT `tb_itn_tripulacao_item_ibfk_1` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_itn_tripulacao_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tb_itn_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mis_missao_andamento`
--
ALTER TABLE `tb_mis_missao_andamento`
  ADD CONSTRAINT `tb_mis_missao_andamento_ibfk_1` FOREIGN KEY (`missao_id`) REFERENCES `tb_mis_missao` (`missao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mis_missao_andamento_ibfk_2` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mis_missao_concluida`
--
ALTER TABLE `tb_mis_missao_concluida`
  ADD CONSTRAINT `tb_mis_missao_concluida_ibfk_1` FOREIGN KEY (`missao_id`) REFERENCES `tb_mis_missao` (`missao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mis_missao_concluida_ibfk_2` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mis_missao_npc_conclusao`
--
ALTER TABLE `tb_mis_missao_npc_conclusao`
  ADD CONSTRAINT `tb_mis_missao_npc_conclusao_ibfk_1` FOREIGN KEY (`missao_id`) REFERENCES `tb_mis_missao` (`missao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mis_missao_npc_conclusao_ibfk_2` FOREIGN KEY (`npc_id`) REFERENCES `tb_mun_npc` (`npc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mis_missao_npc_inicio`
--
ALTER TABLE `tb_mis_missao_npc_inicio`
  ADD CONSTRAINT `tb_mis_missao_npc_inicio_ibfk_1` FOREIGN KEY (`missao_id`) REFERENCES `tb_mis_missao` (`missao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mis_missao_npc_inicio_ibfk_2` FOREIGN KEY (`npc_id`) REFERENCES `tb_mun_npc` (`npc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mis_missao_objetivo`
--
ALTER TABLE `tb_mis_missao_objetivo`
  ADD CONSTRAINT `tb_mis_missao_objetivo_ibfk_1` FOREIGN KEY (`missao_id`) REFERENCES `tb_mis_missao` (`missao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mis_missao_recompensa_equipamento`
--
ALTER TABLE `tb_mis_missao_recompensa_equipamento`
  ADD CONSTRAINT `tb_mis_missao_recompensa_equipamento_ibfk_1` FOREIGN KEY (`missao_id`) REFERENCES `tb_mis_missao` (`missao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mis_missao_recompensa_equipamento_ibfk_2` FOREIGN KEY (`equipamento_id`) REFERENCES `tb_itn_equipamento` (`equipamento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mis_missao_recompensa_item`
--
ALTER TABLE `tb_mis_missao_recompensa_item`
  ADD CONSTRAINT `tb_mis_missao_recompensa_item_ibfk_1` FOREIGN KEY (`missao_id`) REFERENCES `tb_mis_missao` (`missao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mis_missao_recompensa_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tb_itn_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_ilha_edificio`
--
ALTER TABLE `tb_mun_ilha_edificio`
  ADD CONSTRAINT `tb_mun_ilha_edificio_ibfk_1` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mun_ilha_edificio_ibfk_2` FOREIGN KEY (`edificio_id`) REFERENCES `tb_mun_edificio` (`edificio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_ilha_lider`
--
ALTER TABLE `tb_mun_ilha_lider`
  ADD CONSTRAINT `tb_mun_ilha_lider_ibfk_1` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_ilha_zona_coleta`
--
ALTER TABLE `tb_mun_ilha_zona_coleta`
  ADD CONSTRAINT `tb_mun_ilha_zona_coleta_ibfk_1` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mun_ilha_zona_coleta_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tb_itn_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_ilha_zona_mob`
--
ALTER TABLE `tb_mun_ilha_zona_mob`
  ADD CONSTRAINT `tb_mun_ilha_zona_mob_ibfk_1` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mun_ilha_zona_mob_ibfk_2` FOREIGN KEY (`mob_id`) REFERENCES `tb_pve_mob` (`mob_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_ilha_zona_portal`
--
ALTER TABLE `tb_mun_ilha_zona_portal`
  ADD CONSTRAINT `tb_mun_ilha_zona_portal_ibfk_1` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_ilha_zona_pvp`
--
ALTER TABLE `tb_mun_ilha_zona_pvp`
  ADD CONSTRAINT `tb_mun_ilha_zona_pvp_ibfk_1` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_ilha_zona_tripulacao`
--
ALTER TABLE `tb_mun_ilha_zona_tripulacao`
  ADD CONSTRAINT `tb_mun_ilha_zona_tripulacao_ibfk_1` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mun_ilha_zona_tripulacao_ibfk_2` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_npc_equipamento`
--
ALTER TABLE `tb_mun_npc_equipamento`
  ADD CONSTRAINT `tb_mun_npc_equipamento_ibfk_1` FOREIGN KEY (`npc_id`) REFERENCES `tb_mun_npc` (`npc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mun_npc_equipamento_ibfk_2` FOREIGN KEY (`equipamento_id`) REFERENCES `tb_itn_equipamento` (`equipamento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_npc_funcao`
--
ALTER TABLE `tb_mun_npc_funcao`
  ADD CONSTRAINT `tb_mun_npc_funcao_ibfk_1` FOREIGN KEY (`npc_id`) REFERENCES `tb_mun_npc` (`npc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_npc_ilha`
--
ALTER TABLE `tb_mun_npc_ilha`
  ADD CONSTRAINT `tb_mun_npc_ilha_ibfk_1` FOREIGN KEY (`npc_id`) REFERENCES `tb_mun_npc` (`npc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mun_npc_ilha_ibfk_2` FOREIGN KEY (`ilha_id`) REFERENCES `tb_mun_ilha` (`ilha_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_mun_npc_item`
--
ALTER TABLE `tb_mun_npc_item`
  ADD CONSTRAINT `tb_mun_npc_item_ibfk_1` FOREIGN KEY (`npc_id`) REFERENCES `tb_mun_npc` (`npc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mun_npc_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tb_itn_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_per_personagem`
--
ALTER TABLE `tb_per_personagem`
  ADD CONSTRAINT `tb_per_personagem_ibfk_1` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_per_personagem_acessorio`
--
ALTER TABLE `tb_per_personagem_acessorio`
  ADD CONSTRAINT `tb_per_personagem_acessorio_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_per_personagem_acessorio_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tb_itn_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_per_personagem_classe`
--
ALTER TABLE `tb_per_personagem_classe`
  ADD CONSTRAINT `tb_per_personagem_classe_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_per_personagem_equipamento`
--
ALTER TABLE `tb_per_personagem_equipamento`
  ADD CONSTRAINT `tb_per_personagem_equipamento_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_per_personagem_equipamento_ibfk_2` FOREIGN KEY (`equipamento_id`) REFERENCES `tb_itn_equipamento` (`equipamento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_per_personagem_habilidade`
--
ALTER TABLE `tb_per_personagem_habilidade`
  ADD CONSTRAINT `tb_per_personagem_habilidade_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_per_personagem_habilidade_ibfk_2` FOREIGN KEY (`habilidade_id`) REFERENCES `tb_per_habilidade` (`habilidade_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_per_personagem_habilidade_ponto`
--
ALTER TABLE `tb_per_personagem_habilidade_ponto`
  ADD CONSTRAINT `tb_per_personagem_habilidade_ponto_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_per_personagem_habilidade_ponto_ibfk_2` FOREIGN KEY (`habilidade_id`) REFERENCES `tb_per_habilidade` (`habilidade_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_per_personagem_profissao`
--
ALTER TABLE `tb_per_personagem_profissao`
  ADD CONSTRAINT `tb_per_personagem_profissao_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_pve_mob_drop_equipamento`
--
ALTER TABLE `tb_pve_mob_drop_equipamento`
  ADD CONSTRAINT `tb_pve_mob_drop_equipamento_ibfk_1` FOREIGN KEY (`mob_id`) REFERENCES `tb_pve_mob` (`mob_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pve_mob_drop_equipamento_ibfk_2` FOREIGN KEY (`equipamento_id`) REFERENCES `tb_itn_equipamento` (`equipamento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_pve_mob_drop_item`
--
ALTER TABLE `tb_pve_mob_drop_item`
  ADD CONSTRAINT `tb_pve_mob_drop_item_ibfk_1` FOREIGN KEY (`mob_id`) REFERENCES `tb_pve_mob` (`mob_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pve_mob_drop_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tb_itn_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_amigos`
--
ALTER TABLE `tb_usr_amigos`
  ADD CONSTRAINT `tb_usr_amigos_ibfk_1` FOREIGN KEY (`fromid`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_usr_amigos_ibfk_2` FOREIGN KEY (`toid`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_conta_afilhado`
--
ALTER TABLE `tb_usr_conta_afilhado`
  ADD CONSTRAINT `tb_usr_conta_afilhado_ibfk_1` FOREIGN KEY (`conta_id`) REFERENCES `tb_usr_conta` (`conta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_usr_conta_afilhado_ibfk_2` FOREIGN KEY (`afilhado_id`) REFERENCES `tb_usr_conta` (`conta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_conta_cookie`
--
ALTER TABLE `tb_usr_conta_cookie`
  ADD CONSTRAINT `tb_usr_conta_cookie_ibfk_1` FOREIGN KEY (`conta_id`) REFERENCES `tb_usr_conta` (`conta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_conta_facebook`
--
ALTER TABLE `tb_usr_conta_facebook`
  ADD CONSTRAINT `tb_usr_conta_facebook_ibfk_1` FOREIGN KEY (`conta_id`) REFERENCES `tb_usr_conta` (`conta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_conta_tripulacao`
--
ALTER TABLE `tb_usr_conta_tripulacao`
  ADD CONSTRAINT `tb_usr_conta_tripulacao_ibfk_1` FOREIGN KEY (`conta_id`) REFERENCES `tb_usr_conta` (`conta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_usr_conta_tripulacao_ibfk_2` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_navio`
--
ALTER TABLE `tb_usr_navio`
  ADD CONSTRAINT `tb_usr_navio_ibfk_1` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_tripulacao`
--
ALTER TABLE `tb_usr_tripulacao`
  ADD CONSTRAINT `tb_usr_tripulacao_ibfk_2` FOREIGN KEY (`conta_id`) REFERENCES `tb_usr_conta` (`conta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_usr_tripulacao_capitao`
--
ALTER TABLE `tb_usr_tripulacao_capitao`
  ADD CONSTRAINT `tb_usr_tripulacao_capitao_ibfk_1` FOREIGN KEY (`tripulacao_id`) REFERENCES `tb_usr_tripulacao` (`tripulacao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_usr_tripulacao_capitao_ibfk_3` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_vip_reset_atributos`
--
ALTER TABLE `tb_vip_reset_atributos`
  ADD CONSTRAINT `tb_vip_reset_atributos_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_vip_reset_classe`
--
ALTER TABLE `tb_vip_reset_classe`
  ADD CONSTRAINT `tb_vip_reset_classe_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `tb_vip_reset_habilidade`
--
ALTER TABLE `tb_vip_reset_habilidade`
  ADD CONSTRAINT `tb_vip_reset_habilidade_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `tb_per_personagem` (`personagem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
