-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2013 年 06 月 02 日 15:28
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `guest`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `add_dir`
-- 

CREATE TABLE `add_dir` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `name` varchar(20) NOT NULL COMMENT '//相册名字',
  `type` tinyint(1) NOT NULL COMMENT '//类型',
  `password` varchar(80) default NULL COMMENT '//密码',
  `content` varchar(200) default NULL COMMENT '//相册描述',
  `dir` varchar(20) NOT NULL COMMENT '//目录',
  `face` varchar(80) NOT NULL COMMENT '//封面',
  `date` datetime NOT NULL COMMENT '//建立时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- 
-- 导出表中的数据 `add_dir`
-- 

INSERT INTO `add_dir` VALUES (35, '个人细密', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '个人细密', 'photo/1355044599', 'uploads/1355044594.jpeg', '2012-12-09 17:16:39');
INSERT INTO `add_dir` VALUES (32, '校园风光', 0, '', '校园风光', 'photo/1355041792', 'uploads/1355041789.jpeg', '2012-12-09 16:29:52');
INSERT INTO `add_dir` VALUES (34, '动漫游戏', 0, '', '动漫游戏', 'photo/1355043970', 'uploads/1355043967.jpeg', '2012-12-09 17:06:10');

-- --------------------------------------------------------

-- 
-- 表的结构 `article`
-- 

CREATE TABLE `article` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `re_id` varchar(4) NOT NULL default '0' COMMENT '//回帖id',
  `username` varchar(20) NOT NULL COMMENT '//发帖人',
  `type` tinyint(2) unsigned NOT NULL COMMENT '//发帖类型',
  `title` varchar(40) NOT NULL COMMENT '//帖子标题',
  `content` text NOT NULL COMMENT '//帖子内容',
  `read_count` smallint(5) unsigned NOT NULL default '0' COMMENT '//阅读量',
  `comment_count` smallint(5) unsigned NOT NULL default '0' COMMENT '//评论量',
  `date` datetime NOT NULL COMMENT '//发帖时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

-- 
-- 导出表中的数据 `article`
-- 

INSERT INTO `article` VALUES (96, '87', '樱桃小丸子', 2, 'RE:毕业出售溜冰鞋', '过来看看，可惜我不会滑冰啊？？咋办？有谁可以教我？？？？[img]qpic/2/1.gif[/img]', 0, 0, '2013-05-19 17:35:42');
INSERT INTO `article` VALUES (97, '88', '樱桃小丸子', 3, 'RE:大学可以重来一次么？？？', '哎。。。。\r\n大学就这么过去了，时间过的好快，回收大一的时候仿佛还是昨天，哎。。。\r\n如果再来一次该有多好！！\r\n[img]qpic/2/2.gif[/img]', 0, 0, '2013-05-19 17:36:49');
INSERT INTO `article` VALUES (98, '89', '樱桃小丸子', 15, 'RE:致青春：抓住青春的尾巴', '时间过得好快，真的希望大学可以重新来一次！！\r\n[img]qpic/2/2.gif[/img]\r\n[img]qpic/2/5.gif[/img]\r\n[img]qpic/2/6.gif[/img]', 0, 0, '2013-05-19 17:37:31');
INSERT INTO `article` VALUES (100, '91', '樱桃小丸子', 13, 'RE:图文解析安卓系统手机登陆注册facebook', '好文章，值得看看，学习了，谢谢！！\r\n[img]qpic/3/10.gif[/img]\r\n[img]qpic/3/20.gif[/img]', 0, 0, '2013-05-19 17:38:30');
INSERT INTO `article` VALUES (101, '93', '樱桃小丸子', 1, 'RE:毕业了，卖一些不需要的东西', '咋啥也看不到呢？？？？\r\n[img]qpic/1/15.gif[/img]\r\n[img]qpic/1/41.gif[/img]', 0, 0, '2013-05-19 17:38:56');
INSERT INTO `article` VALUES (102, '86', '大茶杯', 1, 'RE:失物招领：只求身份证', '祈祷！！', 0, 0, '2013-05-19 17:39:50');
INSERT INTO `article` VALUES (103, '87', '大茶杯', 2, 'RE:毕业出售溜冰鞋', '过来随便看看！！可是我不需要，哈哈\r\n[img]qpic/3/9.gif[/img]', 0, 0, '2013-05-19 17:40:16');
INSERT INTO `article` VALUES (92, '0', 'admin', 1, '在考研和想考研的进！！', '为方便学子掌握考研信息，考研的我建立了个QQ群，里面有考研成功的学长学姐知道，欢迎大一、大二、大三、大四的立志考研者加入一起交流！群号：262194195[img]qpic/1/46.gif[/img]', 0, 0, '2013-05-19 17:28:41');
INSERT INTO `article` VALUES (93, '0', 'admin', 1, '毕业了，卖一些不需要的东西', '[img]images/1.jpeg[/img]\r\n[img]images/2.jpeg[/img]\r\n[img]images/3.jpeg[/img]\r\n[img]images/4.jpeg[/img]', 3, 1, '2013-05-19 17:32:23');
INSERT INTO `article` VALUES (94, '0', 'admin', 10, '面试：怎么更好的推销自己', '从某种意义上说，面试的整个过程是一个卖方(求职者)自我推销的过程，是一个买方(考官)选购产品的过程。\r\n　　\r\n　　 1.从从容容，过犹不及\r\n　　 销售人员对产品有自信，同时也要给顾客考虑的时间，过度的推销只会引起反感，让顾客想马上离开。求职者也是一样，一进入面试考场就马上自吹自擂，考官会觉得你动机太强，对你产生一种不信赖感，甚至觉得有种被逼迫的感觉，容易导致考官反感。应该让考官先提问题，学会倾听，听听他们怎么说，仔细考虑后不骄不躁，从容回答。\r\n　　\r\n　　 2.平等交流，友好互动\r\n　　 好的销售员通常都能探出买主的底细，所以求职者也可以观察面试官的肢体语言，探探他的脾气为何。走进一家公司，先放轻松，了解公司需要什么，自己拥有什么，探探考官怎么说，尽量营造成功的人际氛围。求职者要避免使用一些特殊语汇，例如顺口溜、歇后语、俚语以及流行于时髦青少年中的网络用语等，否则会让考官觉得不太庄重。\r\n　　 履历表上也要用词庄重，否则十分令人讨厌。最重要的是，面试官往往是有某种年纪和资历的人，求职者使用特殊的网络上时髦、轻佻语言，会使二人之间产生语言沟通的问题。如在面试时，求职者说自己是一位形象不错的人，比说自己“酷毙，帅呆”好很多。面试的重点是建立关系，一种和谐的交流与互动的氛围，而不是要把考官比下去。尽可能和未来的老板一唱一和，让未来的老板产生信赖感，以达到“成交”的目的。\r\n　　\r\n　　 职场面试时的六大忌\r\n　　\r\n　　 一忌缺乏自信\r\n　　 最明显的就是问“你们要几个？”对用人单位来讲，招一个是招，招十个也是招。问题不在于招几个，而是你有没有这百分之一或十分之一或独一无二的实力和竞争力。“你们要不要女的？”这样询问的女性，首先给自己打了“折扣”，是一种缺乏自信的表现。面对已露怯意的女性，用人单位刚好“顺水推舟”，予以回绝。\r\n　　\r\n　　 二忌急问待遇\r\n　　 “你们的待遇怎么样？”“你们管吃住吗？电话费、车费报不报销？”有些应聘者一见面就急着问这些，不但让对方反感，而且会让对方产生“工作还没干就先提条件，何况我还没说要你呢”这样不好的想法。谈论报酬待遇是你的权利，这无可厚非，关键要看准时机。一般在双方已有初步聘用意向时，再委婉地提出来。\r\n　　\r\n　　 三忌不合逻辑\r\n　　 面试的考官问：“请你告诉我你的一次失败的经历。”答曰：“我想不起我曾经失败过。”如果这样说，在逻辑上讲不通。又如考官问：“你有何优缺点？”答曰：“我可以胜任一切工作。”这也不符合实际。\r\n　　\r\n　　 四忌报有熟人\r\n　　 面试中急于套近乎，不顾场合地说“我认识你们单位的某某”、“我和某某是同学，关系很不错”等等。这种话主考官听了会反感。如果你说的那个人是他的顶头上司，主考官会觉得你在以势压人；如果主考官与你所说的那个人关系不怎么好，甚至有矛盾，那么你这样引出的结果很可能就是自我遭殃。\r\n　　\r\n　　 五忌超出范围\r\n　　 例如面试快要结束时，主考官问求职者：“请问你有什么问题要问我吗？”这位求职者欠了欠身子问道：“请问你们公司的规模有多大？中外方的比例各是多少？请问你们董事会成员里中外方各有几位？你们未来5年的发展规划如何？”诸如此类的问题。这是求职者没有把自己的位置摆正，提出的问题已经超出了求职者应当提问的范围，使主考官产生了厌烦。主考官甚至会想：哪有这么多的问题？你是来求职的呢还是来调查情况的呢？\r\n　　\r\n　　 六忌不当反问\r\n　　 例如主考官问：“关于工资，你的期望值是多少？”应聘者反问：“你们打算出多少？”\r\n　　 这样的反问就很不礼貌，好像是在谈判，很容易引起主考官的不快和敌视。   \r\n　　\r\n　　更多内容请登录\r\n　　http://zhuanti.dajie.com/subject/dalibao/index.html?reg_from=market001 查看！', 1, 0, '2013-05-19 17:33:55');
INSERT INTO `article` VALUES (104, '88', '大茶杯', 3, 'RE:大学可以重来一次么？？？', '哎。。。。\r\n不说了，越说越伤心，真的不想离开，不是舍不得这个大学，而是舍不得这里的人这里的事！！\r\n[img]qpic/2/2.gif[/img]', 0, 0, '2013-05-19 17:41:03');
INSERT INTO `article` VALUES (105, '89', '大茶杯', 15, 'RE:致青春：抓住青春的尾巴', '时间过得好快！！！', 0, 0, '2013-05-19 17:41:23');
INSERT INTO `article` VALUES (106, '90', '大茶杯', 10, 'RE:HR日记：有关面试（非群面）的事宜', '这是一篇有用的日志，值得学习！！\r\n收藏了！\r\n[img]qpic/1/46.gif[/img]', 0, 0, '2013-05-19 17:41:54');
INSERT INTO `article` VALUES (107, '0', '测试', 10, '测试发帖', '[img]qpic/1/20.gif[/img]', 1, 0, '2013-06-01 09:06:48');
INSERT INTO `article` VALUES (108, '0', 'admin', 10, '测试2', '[img]qpic/2/2.gif[/img]他妈的', 1, 0, '2013-06-01 09:08:16');
INSERT INTO `article` VALUES (99, '90', '樱桃小丸子', 10, 'RE:HR日记：有关面试（非群面）的事宜', '好文章，知道看看！！', 0, 0, '2013-05-19 17:37:55');
INSERT INTO `article` VALUES (91, '0', 'admin', 13, '图文解析安卓系统手机登陆注册facebook', '随着Android系统的手机手机越来越普遍，一些玩家通过手机浏览网页越来越多，这样设置的教程就应运而生。\r\nAndroid一词的本义指“机器人”，同时也是Google于2007年11月5日宣布的基于Linux平台的开源手机操作系统的名称，该平台由操作系统、中间件、用户界面和应用软件组成，号称是首个为移动终端打造的真正开放和完整的移动软件。目前，最新版本为Android 2.4 Gingerbread和Android 4.0 Honeycomb。\r\n第一步： 打开手机主菜单，选择“设置”，然后选择“无线和网络”\r\n第二步：选择“虚拟专用网设置”\r\n第三步：选择“添加虚拟专用网”\r\n第四步：选择“添加vp PPTP”\r\n第五步：进入PPTP连接设置界面\r\n第六步：点击输入虚拟专用网名称“pptp”（此名称可自己随便定义）\r\n第七步：点击填写您所登录的服务器地址（酷盛加速器联系方式QQ 15104478），点击“确定”\r\n第八步：DNS搜索范围可不填，也可选填如“8.8.8.8”，然后返回\r\n第九步：点击刚创建的VP连接登录，输入账号和密码.然后点击“连接 \r\n[img]qpic/2/6.gif[/img]', 3, 1, '2013-05-19 17:25:52');
INSERT INTO `article` VALUES (90, '0', 'admin', 10, 'HR日记：有关面试（非群面）的事宜', '所谓非群P面试通常指一对一或者多对一形式的非小组面试。同一时间考查一个应聘者，也是现在面试最主要的形式。一般用于招技术，行政，财会，服务性工作。一对一面试的时间通常会在15-30分钟，个别需要做性格测试的或者HR和部门经理同时面试的会超过1小时。今天来说说一对一面试需要注意的小TIPS，介于面试建议的帖子天花乱坠的很多，所以我就尽量不重复其他帖子了。\r\n\r\n--------------------------------------------------------------------------------------------------------\r\n\r\n吐个槽：校园面试尤其可怕，通常前一个人泛泛而谈，搞得你耳朵生茧。后一个又似挤牙膏惜字如金。一天的面试下来自己都不知道怎么说话了。有些人自己把自己吹得是比尔盖茨二代，还加上一句：不招聘我是贵公司的损失。又有些人谦虚的我感觉公司是花钱来给她进修的。希望各位初入职场的同学个性上不用太强，把握好度，适当的“小荷才露尖尖角”般侃一下自己的闪光点。\r\n\r\n-------------------------------------------------------------------------------------------------------\r\n1。有关面试前的准备\r\n\r\nA，纸制简历3份（给HR一份，相关经理一份，一份备用）\r\nB，清凉类口香糖（面试前保持口气清醒，本人给口臭熏过；而且也能保持语调宜人）\r\nC，笔，纸（可能需要记录二面或者体检的时间地点，不要当HR面拿手机记录）\r\nD，身份证（小型企业可能会当场绝对，大型企业也会安排体检用到）\r\nE，相关书籍一本（HR迟到不是摆架子，大多因为前一个面试拖时间了，看看书吧）\r\nF，矿泉水一瓶（不是每个前台MM都会好心给你倒水的，不要带花里胡哨的饮料）\r\n2。有关自我介绍\r\n  基本上必问的问题，通常HR都会建议在1-2分钟之内。各式各样的帖子对此点建议相当多，我总结下就是简单，明确，真实，有条理，有例证，有针对性。具体来说，好的自我介绍要简单概括简历中对应聘职位最有价值的一些点，然后加以辅证。千万不要把简历重新来背诵一遍，通常HR之前都看过了，大家都不是文盲。另外自我介绍的时候务必不要太小声，有结巴或者乱七八糟前后颠倒的条理。通常这1-2分钟就决定了HR是不是会雇佣你。如果你应聘话语，服务，客服等对声音有需要的职位，可以之前含一粒清凉型的糖果，面试前清清嗓。不要在开始自我介绍前咳嗽！\r\n\r\n3。有关在前台等候的时间\r\n  首先请善待前台MM，很多企业前台在行政或者HR部门，前台MM和招聘助理（专员）年龄也差不了太多，通常关系也不错。你对着前台找人借笔用吼的，只要前台事后给我捣鼓一句，你立刻会被OVER了。公司里连经理都要对前台MM礼貌三分，何况你来应聘的。\r\n  另外在前台的时候，不管你几个人，不要大声说话，讲电话，不要找前台MM唠嗑，更不要催前台MM一直电话HR。因为我们确实在忙，他们也很无奈。\r\n  一般来说前台MM都会给我们收买，面试后我们也会问问他们在之前等候的状态。所以，大家务必进门后就注意形象。\r\n\r\n4. 有关"你还有什么问题" 的问题\r\n  不要说没有!不要初面问工资!不要问会不会加班!更不要问什么老板好不好处!( 以上针对初入职场的),最最不要问HR的是" 你几岁?"这类近似于勾搭HR的问题 ( 我承认我看上去和实际都不大,但是不代表我面试的时候可以侃大山）。\r\n  可以问得有：公司提供什么培训？什么时候能确定录用/再次面试？成长及晋升制度？\r\n  如果最终面试：一定要乘这个机会把合同相关的福利条约，试用加薪等具体事情明确清楚。因为你或许只有这个时候最有主动权哦。\r\n\r\n5。有关家庭的问题\r\n  最近许多HR就流行问“你家庭是什么样的？”，通过问题主要看你对家庭的任何度以及侧面了解你的成长过程及推测性格。至于你怎么回答，当然往和谐美满的方向说，但是绝对不要背书一样说网络上教的那几句，比如“我们一家三口和谐美满，从小爸爸妈妈就注重我各方面的培养……相亲相爱……”反正我见过我上司直接打断这样的介绍。一定要有自己的特色，比如“孤独”=“从小独立”，“万般宠爱“=“尽心培养”……不是教大家骗人，确实就那么些小把戏，舒服多了。\r\n\r\n6。优点和缺点的问题\r\n  这个问题请慎重回答，有些有实习或者工作经验的我们可能之前已经联系过你的上家了解了你的优缺点，只是想看看你自我认识程度哦。我觉得大家可以不妨问问自己的父母优缺点是什么，然后找和这个岗位最相关的优点和最无关的缺点说。当然千万不要说自己的缺点是“过于追求完美”！这句话我每周都要听到好几次。缺点中最不能说的是没有责任心，学习成绩不好，太喜欢玩！！！因为在学生阶段你连唯一的任务都做不好，你让我怎么相信你之后能处理好纷杂的事物呢?\r\n\r\n7. 如果问到你没有准备的问题\r\n  如果你可以想到你回答会比较不流畅，请告诉HR“麻烦让我整理下/想一下”之类的。然后整理出一个顺序来，千万不要东拉西扯，也千万不能前后矛盾。比如你做过社团活动，HR会问你大概什么时候做什么职位？你回答后一般我们会跟进一个问题，比如“那年国庆活动你是如何组织的？”请你想好了回忆完整了，真实回答。比如国庆60周年有阅兵，国庆61周年国内大学有搞过统一的庆典之类。我们会之前有所收集材料，也情各位留心哦。\r\n更多精彩请见：\r\nhttp://zhuanti.dajie.com/subject/dalibao/index.html?reg_from=market001', 6, 2, '2013-05-19 17:25:06');
INSERT INTO `article` VALUES (89, '0', 'admin', 15, '致青春：抓住青春的尾巴', '时光荏苒、岁月匆匆，不禁感叹过去年少轻狂的模样！校园的生活十数载如一日，就那么一晃而过。学生时代是美好的，珍惜这个词用在校园的生活一点都不为过，不管你是怎样度过的学生时代，记得 要珍惜哦！！！[img]qpic/2/1.gif[/img]', 4, 2, '2013-05-19 17:23:59');
INSERT INTO `article` VALUES (88, '0', 'admin', 3, '大学可以重来一次么？？？', '生命就像午夜绽放在黑色苍穹的灿烂烟火，一个不经意的转瞬便会消逝。如果生命是一条长河，充其量不过是历史长流中的一汪清潭，一个不经意的转身便会错过。生命的璀璨，就像银河里的一颗流星，把最美的弧度向世人展现，却没有人在意是不是华丽舞台的最后一声再见。\r\n[img]qpic/2/3.gif[/img]', 6, 2, '2013-05-19 17:22:38');
INSERT INTO `article` VALUES (95, '86', '樱桃小丸子', 1, 'RE:失物招领：只求身份证', '真的替楼主担心，希望楼主早日找到，哈哈。\r\n[img]qpic/1/10.gif[/img]', 0, 0, '2013-05-19 17:34:57');
INSERT INTO `article` VALUES (87, '0', 'admin', 2, '毕业出售溜冰鞋', '毕业了，告别无忧奔驰的日子。现在甩卖溜冰鞋，50元。九成新。有护膝。电话：15279158146\r\n[img]qpic/1/14.gif[/img]\r\n[img]qpic/2/3.gif[/img]\r\n[img]qpic/3/20.gif[/img]', 5, 2, '2013-05-19 17:21:28');
INSERT INTO `article` VALUES (86, '0', 'admin', 1, '失物招领：只求身份证', '下午同学在北区食堂吃饭，不小心把钱包落桌上了，可能那位好心的同学帮忙捡起来了，里面有身份证等重要东西，失主姓孟，如果看到的请联系15070907798，必有重谢，谢谢\r\n[img]qpic/1/10.gif[/img]\r\n[img]qpic/1/46.gif[/img]', 6, 2, '2013-05-19 17:19:14');

-- --------------------------------------------------------

-- 
-- 表的结构 `flower`
-- 

CREATE TABLE `flower` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `touser` varchar(20) NOT NULL COMMENT '//接收人',
  `fromuser` varchar(20) NOT NULL COMMENT '//送花人',
  `count` mediumint(8) unsigned NOT NULL COMMENT '//送花数目',
  `content` varchar(200) NOT NULL COMMENT '//祝福语',
  `date` time NOT NULL COMMENT '//送花时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- 导出表中的数据 `flower`
-- 

INSERT INTO `flower` VALUES (8, 'admin', '卡尔', 8, '很喜欢你，给你送花啦', '21:15:55');
INSERT INTO `flower` VALUES (7, '朱正钱', '樱桃小丸子', 7, '很喜欢你，给你送花啦', '21:15:32');
INSERT INTO `flower` VALUES (6, '我是学生', '朱正钱', 10, '很喜欢你，给你送花啦', '21:06:38');
INSERT INTO `flower` VALUES (9, '我的目标是', '卡尔', 82, '很喜欢你，给你送花啦', '12:32:14');
INSERT INTO `flower` VALUES (10, 'admin', '樱桃小丸子', 1, '很喜欢你，给你送花啦', '21:58:27');

-- --------------------------------------------------------

-- 
-- 表的结构 `friend`
-- 

CREATE TABLE `friend` (
  `id` mediumint(20) unsigned NOT NULL auto_increment COMMENT '//id',
  `fromuser` varchar(10) NOT NULL COMMENT '//添加人',
  `touser` varchar(10) NOT NULL COMMENT '//被添加人',
  `content` varchar(200) NOT NULL COMMENT '//请求内容',
  `state` smallint(1) NOT NULL default '0' COMMENT '//是否同意',
  `date` time NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

-- 
-- 导出表中的数据 `friend`
-- 

INSERT INTO `friend` VALUES (39, '朱正钱', 'admin', '一路走好 我很想和你交朋友！', 0, '14:57:03');
INSERT INTO `friend` VALUES (40, '朱正钱', '都会过去', '都会过去 我很想和你交朋友！', 1, '14:57:05');
INSERT INTO `friend` VALUES (41, '朱正钱', '小鸡', '小鸡 我很想和你交朋友！', 0, '14:57:08');
INSERT INTO `friend` VALUES (43, '樱桃小丸子', 'admin', '蜡笔小新 我很想和你交朋友！', 1, '15:19:39');
INSERT INTO `friend` VALUES (45, '樱桃小丸子', '我是学生', '我是学生 我很想和你交朋友！', 0, '15:19:43');
INSERT INTO `friend` VALUES (46, '蜡笔小新', '我是小朋友', '我是小朋友 我很想和你交朋友！', 0, '15:20:07');
INSERT INTO `friend` VALUES (55, '太乙真人', '朱正钱', '朱正钱 我很想和你交朋友！', 1, '15:37:49');
INSERT INTO `friend` VALUES (48, '蜡笔小新', '丫头你好', '丫头你好 我很想和你交朋友！', 0, '15:20:20');
INSERT INTO `friend` VALUES (49, '卡尔', '我是谁啊谁', '我是谁啊谁 我很想和你交朋友！', 0, '15:20:39');
INSERT INTO `friend` VALUES (54, '灭绝师太', '朱正钱', '朱正钱 我很想和你交朋友！', 1, '15:37:25');
INSERT INTO `friend` VALUES (51, '卡尔', '太乙真人', '太乙真人 我很想和你交朋友！', 0, '15:20:43');

-- --------------------------------------------------------

-- 
-- 表的结构 `message`
-- 

CREATE TABLE `message` (
  `id` mediumint(4) unsigned NOT NULL auto_increment COMMENT '//id',
  `touser` varchar(10) NOT NULL COMMENT '//收件人',
  `fromuser` varchar(10) NOT NULL COMMENT '//发件人',
  `content` varchar(200) NOT NULL COMMENT '//发件内容',
  `date` datetime NOT NULL COMMENT '//发件时间',
  `state` mediumint(1) unsigned NOT NULL default '0' COMMENT '//是否已读',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- 
-- 导出表中的数据 `message`
-- 

INSERT INTO `message` VALUES (7, 'admin', '足球宝贝', '在干吗呢？？想你了！', '2012-09-18 00:00:00', 0);
INSERT INTO `message` VALUES (8, 'admin', '下雨天', '吃饭了么？？一起出来吃个饭吧', '2012-09-18 00:00:00', 0);
INSERT INTO `message` VALUES (9, 'admin', '孙悟空', '今天有空不？？', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (11, 'admin', '龟仙人', '生日快乐，happy birthday', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (12, '朱正钱', '大空翼', '哈哈哈哈哈。。。。开心么？？', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (14, '朱正钱', '樱木花道', '什么时候放假啊？？、还有考试考得怎么样啊？', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (15, '朱正钱', '西瓜太郎', '最近还好不？？', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (16, '朱正钱', '佐罗', '最近有没有想我啊？？还有那个 。。。', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (17, '朱正钱', '小鸭子', '考试考得怎么样啊？？', '2012-09-18 00:00:00', 0);
INSERT INTO `message` VALUES (18, '朱正钱', '小鸡', '我今天没课啊！', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (19, '朱正钱', '一路走好', '好好学习，天天向上！！我过几天就回家了', '2012-09-18 00:00:00', 1);
INSERT INTO `message` VALUES (20, '朱正钱', '心疼你', '有你在真好，暑假记得过来玩啊！', '2012-09-18 00:00:00', 0);
INSERT INTO `message` VALUES (21, '朱正钱', '猜不透', '最近干点啥好呢？？要不出去玩玩？', '2012-09-18 00:00:00', 0);
INSERT INTO `message` VALUES (22, '你好么', '朱正钱', '嘿嘿。。。。', '2012-10-06 10:30:18', 0);
INSERT INTO `message` VALUES (23, '灭绝师太', '朱正钱', '我在吃饭呢，你吃了么？？', '2012-10-15 20:23:44', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `photo`
-- 

CREATE TABLE `photo` (
  `id` smallint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `username` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '//图片名字',
  `url` varchar(80) NOT NULL COMMENT '//图片地址',
  `content` varchar(20) default NULL COMMENT '//图片描述',
  `dir_id` smallint(8) unsigned NOT NULL COMMENT '//目录id',
  `read_count` varchar(20) NOT NULL default '0' COMMENT '//阅读量',
  `comment_count` varchar(20) NOT NULL default '0' COMMENT '//评论量',
  `date` datetime NOT NULL COMMENT '//时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

-- 
-- 导出表中的数据 `photo`
-- 

INSERT INTO `photo` VALUES (44, '樱桃小丸子', '游戏1', 'photo/1352442996/1352720651.jpeg', '游戏1', 23, '266', '0', '2012-11-12 19:44:14');
INSERT INTO `photo` VALUES (43, '樱桃小丸子', '美眉10', 'photo/1352443011/1352720628.jpeg', '美眉10', 24, '266', '0', '2012-11-12 19:43:51');
INSERT INTO `photo` VALUES (42, '樱桃小丸子', '美眉9', 'photo/1352443011/1352720610.jpeg', '美眉9', 24, '266', '0', '2012-11-12 19:43:34');
INSERT INTO `photo` VALUES (39, '樱桃小丸子', '美眉7', 'photo/1352443011/1352720544.jpeg', '美眉7', 24, '266', '0', '2012-11-12 19:42:30');
INSERT INTO `photo` VALUES (38, '樱桃小丸子', '美眉6', 'photo/1352443011/1352720528.jpeg', '美眉6', 24, '266', '0', '2012-11-12 19:42:12');
INSERT INTO `photo` VALUES (35, '樱桃小丸子', '美眉3', 'photo/1352443011/1352720485.jpeg', '美眉3', 24, '266', '0', '2012-11-12 19:41:28');
INSERT INTO `photo` VALUES (36, '樱桃小丸子', '美眉4', 'photo/1352443011/1352720499.jpeg', '美眉4', 24, '266', '0', '2012-11-12 19:41:43');
INSERT INTO `photo` VALUES (33, '樱桃小丸子', '美眉1', 'photo/1352443011/1352720452.jpeg', '美眉1', 24, '266', '0', '2012-11-12 19:40:56');
INSERT INTO `photo` VALUES (34, '樱桃小丸子', '美眉2', 'photo/1352443011/1352720470.jpeg', '美眉2', 24, '266', '0', '2012-11-12 19:41:14');
INSERT INTO `photo` VALUES (45, '樱桃小丸子', '游戏2', 'photo/1352442996/1352720665.jpeg', '游戏2', 23, '266', '0', '2012-11-12 19:44:28');
INSERT INTO `photo` VALUES (46, '樱桃小丸子', '游戏3', 'photo/1352442996/1352720676.jpeg', '游戏3', 23, '266', '0', '2012-11-12 19:44:42');
INSERT INTO `photo` VALUES (47, '樱桃小丸子', '游戏4', 'photo/1352442996/1352720692.jpeg', '游戏4', 23, '266', '0', '2012-11-12 19:44:55');
INSERT INTO `photo` VALUES (48, '樱桃小丸子', '游戏5', 'photo/1352442996/1352720711.jpeg', '游戏5', 23, '266', '0', '2012-11-12 19:45:13');
INSERT INTO `photo` VALUES (49, '樱桃小丸子', '游戏6', 'photo/1352442996/1352720725.jpeg', '游戏6', 23, '266', '0', '2012-11-12 19:45:28');
INSERT INTO `photo` VALUES (53, '', '游戏1', 'photo/1352945366/1352945389.jpeg', '游戏1', 25, '115', '0', '2012-11-15 10:09:53');
INSERT INTO `photo` VALUES (54, 'admin', '校园绿色', 'photo/1355041109/1355041261.jpeg', '校园绿色', 31, '29', '0', '2012-12-09 16:22:06');
INSERT INTO `photo` VALUES (55, 'admin', '校园绿色', 'photo/1355041792/1355041804.jpeg', '校园绿色', 32, '28', '0', '2012-12-09 16:30:14');
INSERT INTO `photo` VALUES (56, 'admin', '校园夜色', 'photo/1355041792/1355041843.jpeg', '校园夜色', 32, '27', '0', '2012-12-09 16:30:51');
INSERT INTO `photo` VALUES (57, 'admin', '校园风光', 'photo/1355041792/1355041865.jpeg', '校园风光', 32, '27', '0', '2012-12-09 16:31:29');
INSERT INTO `photo` VALUES (58, 'admin', '校园公园', 'photo/1355041792/1355041900.jpeg', '校园公园', 32, '27', '0', '2012-12-09 16:31:47');
INSERT INTO `photo` VALUES (59, 'admin', '校园喷泉', 'photo/1355041792/1355041919.jpeg', '校园喷泉', 32, '27', '0', '2012-12-09 16:32:15');
INSERT INTO `photo` VALUES (60, 'admin', '校园秋色', 'photo/1355041792/1355041948.jpeg', '校园秋色', 32, '27', '0', '2012-12-09 16:32:41');
INSERT INTO `photo` VALUES (61, 'admin', '校园秋色', 'photo/1355041792/1355041976.jpeg', '校园秋色', 32, '27', '0', '2012-12-09 16:33:07');
INSERT INTO `photo` VALUES (62, 'admin', '学生公寓', 'photo/1355041792/1355042004.jpeg', '学生公寓', 32, '27', '0', '2012-12-09 16:33:38');
INSERT INTO `photo` VALUES (63, 'admin', '校园绿色', 'photo/1355041792/1355042028.jpeg', '校园绿色', 32, '27', '0', '2012-12-09 16:33:59');
INSERT INTO `photo` VALUES (64, 'admin', '文化楼', 'photo/1355041792/1355042061.jpeg', '文化楼', 32, '27', '0', '2012-12-09 16:34:35');
INSERT INTO `photo` VALUES (65, 'admin', '图书馆', 'photo/1355041792/1355042091.jpeg', '图书馆', 32, '27', '0', '2012-12-09 16:34:56');
INSERT INTO `photo` VALUES (66, 'admin', '校园夜色', 'photo/1355041792/1355042107.jpeg', '校园夜色', 32, '27', '0', '2012-12-09 16:35:15');
INSERT INTO `photo` VALUES (71, 'admin', '海贼王', 'photo/1355043126/1355043237.jpeg', '海贼王', 33, '12', '0', '2012-12-09 16:54:04');
INSERT INTO `photo` VALUES (72, 'admin', '海贼王', 'photo/1355043126/1355043253.jpeg', '海贼王', 33, '12', '0', '2012-12-09 16:54:16');
INSERT INTO `photo` VALUES (69, 'admin', '火影忍者', 'photo/1355043126/1355043182.jpeg', '火影忍者', 33, '12', '0', '2012-12-09 16:53:09');
INSERT INTO `photo` VALUES (70, 'admin', '火影忍者', 'photo/1355043126/1355043200.jpeg', '火影忍者', 33, '12', '0', '2012-12-09 16:53:23');
INSERT INTO `photo` VALUES (73, 'admin', '阿里阿里', 'photo/1355043126/1355043268.jpeg', '阿里阿里', 33, '12', '0', '2012-12-09 16:54:41');
INSERT INTO `photo` VALUES (74, 'admin', '维尼小熊', 'photo/1355043126/1355043291.jpeg', '维尼小熊', 33, '12', '0', '2012-12-09 16:54:58');
INSERT INTO `photo` VALUES (75, 'admin', '维尼小熊', 'photo/1355043126/1355043310.jpeg', '维尼小熊', 33, '12', '0', '2012-12-09 16:55:13');
INSERT INTO `photo` VALUES (81, 'admin', '动漫游戏', 'photo/1355043970/1355043980.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:06:23');
INSERT INTO `photo` VALUES (79, 'admin', '七龙珠', 'photo/1355043126/1355043367.jpeg', '七龙珠', 33, '12', '0', '2012-12-09 16:56:10');
INSERT INTO `photo` VALUES (78, 'admin', '七龙珠', 'photo/1355043126/1355043353.jpeg', '七龙珠', 33, '12', '0', '2012-12-09 16:55:55');
INSERT INTO `photo` VALUES (80, 'admin', '灌篮高手', 'photo/1355043126/1355043380.jpeg', '灌篮高手', 33, '12', '0', '2012-12-09 16:56:26');
INSERT INTO `photo` VALUES (82, 'admin', '动漫游戏', 'photo/1355043970/1355043992.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:06:35');
INSERT INTO `photo` VALUES (83, 'admin', '动漫游戏', 'photo/1355043970/1355044005.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:06:48');
INSERT INTO `photo` VALUES (84, 'admin', '动漫游戏', 'photo/1355043970/1355044018.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:07:01');
INSERT INTO `photo` VALUES (85, 'admin', '动漫游戏', 'photo/1355043970/1355044034.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:07:17');
INSERT INTO `photo` VALUES (86, 'admin', '动漫游戏', 'photo/1355043970/1355044049.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:07:31');
INSERT INTO `photo` VALUES (87, 'admin', '动漫游戏', 'photo/1355043970/1355044062.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:07:46');
INSERT INTO `photo` VALUES (88, 'admin', '动漫游戏', 'photo/1355043970/1355044078.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:08:01');
INSERT INTO `photo` VALUES (89, 'admin', '动漫游戏', 'photo/1355043970/1355044091.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:08:14');
INSERT INTO `photo` VALUES (90, 'admin', '动漫游戏', 'photo/1355043970/1355044105.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:08:28');
INSERT INTO `photo` VALUES (91, 'admin', '动漫游戏', 'photo/1355043970/1355044119.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:08:41');
INSERT INTO `photo` VALUES (92, 'admin', '动漫游戏', 'photo/1355043970/1355044133.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:08:57');
INSERT INTO `photo` VALUES (93, 'admin', '动漫游戏', 'photo/1355043970/1355044150.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:09:14');
INSERT INTO `photo` VALUES (94, 'admin', '动漫游戏', 'photo/1355043970/1355044165.jpeg', '动漫游戏', 34, '12', '0', '2012-12-09 17:09:28');

-- --------------------------------------------------------

-- 
-- 表的结构 `photo_face`
-- 

CREATE TABLE `photo_face` (
  `id` smallint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `url` varchar(40) NOT NULL COMMENT '//封面图片地址',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `photo_face`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `system`
-- 

CREATE TABLE `system` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `web_name` varchar(20) NOT NULL COMMENT '//网站名称',
  `article_page` tinyint(2) unsigned NOT NULL default '0' COMMENT '//文章分页数',
  `blog_page` tinyint(2) unsigned NOT NULL default '0' COMMENT '//博友分页数',
  `photo_page` tinyint(2) unsigned NOT NULL default '0' COMMENT '//相册分页数',
  `skin` tinyint(1) unsigned NOT NULL default '0' COMMENT '//网站皮肤',
  `no_string` varchar(200) NOT NULL COMMENT '//网站敏感字符串',
  `post_time` tinyint(3) unsigned NOT NULL default '0' COMMENT '//发帖限制',
  `re_time` tinyint(3) unsigned NOT NULL default '0' COMMENT '//回帖限制',
  `code` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否启用验证码',
  `register` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否开放会员',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `system`
-- 

INSERT INTO `system` VALUES (1, '学院论坛系统', 8, 15, 6, 1, '你妈的', 60, 30, 1, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `user`
-- 

CREATE TABLE `user` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//唯一标示',
  `active` char(40) NOT NULL COMMENT '//激活登入',
  `username` varchar(10) NOT NULL COMMENT '//用户名',
  `password` char(40) NOT NULL COMMENT '//密码',
  `question` varchar(20) NOT NULL COMMENT '//密码问题',
  `answer` char(40) NOT NULL COMMENT '//密码回答',
  `sex` char(1) NOT NULL COMMENT '//性别',
  `face` char(12) NOT NULL COMMENT '//头像',
  `email` varchar(20) default NULL COMMENT '//电子邮箱',
  `qq` varchar(11) default NULL COMMENT '//qq',
  `url` varchar(40) default NULL COMMENT '//网址',
  `level` tinyint(1) unsigned NOT NULL default '0' COMMENT '//身份',
  `reg_time` datetime NOT NULL COMMENT '//注册时间',
  `last_time` datetime NOT NULL COMMENT '//最后登入时间',
  `last_ip` varchar(20) NOT NULL COMMENT '//最后登入ip',
  `login_count` smallint(4) unsigned NOT NULL default '0' COMMENT '//登入次数',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

-- 
-- 导出表中的数据 `user`
-- 

INSERT INTO `user` VALUES (5, '', '樱桃小丸子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '她的名字', 'ecbcd60c1a1cae78acde92f8d1be0aba9e2599e6', '男', 'face/m05.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 1, '2012-06-08 18:33:27', '2013-05-19 17:34:20', '127.0.0.1', 85);
INSERT INTO `user` VALUES (6, '', '蜡笔小新', '7c4a8d09ca3762af61e59520943dc26494f8941b', '他的名字', 'c221d379f016e230aaf849fab531fcdbe536d52e', '男', 'face/m04.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-08 19:36:01', '2012-10-06 15:19:56', '127.0.0.1', 2);
INSERT INTO `user` VALUES (14, '', '我是小朋友', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', '男', 'face/m05.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-10 11:39:39', '2012-09-18 10:01:31', '127.0.0.1', 1);
INSERT INTO `user` VALUES (15, '', '我是学生', '7c4a8d09ca3762af61e59520943dc26494f8941b', '啊我是邪恶', '3eb0540aa5f20a752e20a44b0e7049c60297f32d', '男', 'face/m06.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-10 12:00:54', '2012-09-18 10:02:04', '127.0.0.1', 1);
INSERT INTO `user` VALUES (59, '', '大茶杯', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢什么', 'a5831a71cd3dfaec1fa9cbdae7b666a470fcabf1', '女', 'face/m01.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-18 20:26:25', '2013-05-19 17:39:37', '127.0.0.1', 5);
INSERT INTO `user` VALUES (17, '', '我是朱正钱', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是谁啊啊', 'cad57d414704c2c320aeaf1e22b12d2334a8cc6b', '男', 'face/m08.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-11 21:03:39', '2012-06-11 21:03:39', '127.0.0.1', 0);
INSERT INTO `user` VALUES (18, '', '我是谁啊谁', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是谁啊谁', 'cad57d414704c2c320aeaf1e22b12d2334a8cc6b', '男', 'face/m09.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-11 21:16:36', '2012-06-11 21:16:36', '127.0.0.1', 0);
INSERT INTO `user` VALUES (19, '', '我的目标是', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', 'cad57d414704c2c320aeaf1e22b12d2334a8cc6b', '男', 'face/m11.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-11 21:22:20', '2012-06-11 21:22:20', '127.0.0.1', 0);
INSERT INTO `user` VALUES (35, '', '灭绝师太', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么', '0a3e3d508c52fa6f157f1ab40ac5a00ce28fd0de', '男', 'face/m12.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 1, '2012-06-29 10:46:47', '2012-10-06 15:37:19', '127.0.0.1', 2);
INSERT INTO `user` VALUES (36, '', '太乙真人', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么', 'c8afed510fccc4437335b56f710ad5831f12cdf5', '男', 'face/m13.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:47:40', '2012-10-06 15:37:44', '127.0.0.1', 2);
INSERT INTO `user` VALUES (37, '', '足球宝贝', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我做什么工作', '2d8c7347c7eae0cfaa6939f2874a59dcb1135d9d', '男', 'face/m14.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:48:25', '2012-09-18 10:04:01', '127.0.0.1', 1);
INSERT INTO `user` VALUES (38, '', '下雨天', '7c4a8d09ca3762af61e59520943dc26494f8941b', '什么天气', '3124adb8a109fb2f14d29f20c2839e1a0ed9f8de', '男', 'face/m15.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:49:47', '2012-09-18 10:04:45', '127.0.0.1', 1);
INSERT INTO `user` VALUES (23, '', '我是大学生', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是谁aa', 'cad57d414704c2c320aeaf1e22b12d2334a8cc6b', '男', 'face/m16.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-11 22:36:52', '2012-06-11 22:36:52', '127.0.0.1', 0);
INSERT INTO `user` VALUES (25, '', '孙悟空', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', '38cb71aa7661b9731813c568a20a5308bc9250b3', '男', 'face/m17.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:20:02', '2012-09-18 10:05:22', '127.0.0.1', 1);
INSERT INTO `user` VALUES (26, '', '孙悟饭', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', '2b127279fb0157c83ecf0be0fe46e220242cef52', '男', 'face/m18.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:20:38', '2012-09-18 10:05:53', '127.0.0.1', 1);
INSERT INTO `user` VALUES (27, '', '龟仙人', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', 'f1a46fda897c683c26ee30dc358f7b778f43e64e', '男', 'face/m19.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:21:11', '2012-09-18 10:06:33', '127.0.0.1', 1);
INSERT INTO `user` VALUES (28, '', '大空翼', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', '2ffe4338104559af830454493546a6312e349189', '男', 'face/m21.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:21:41', '2012-09-18 10:07:00', '127.0.0.1', 1);
INSERT INTO `user` VALUES (29, '', '卡尔', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', '52aefc5b0b45602eeb913e3f196c4fb249700ddb', '女', 'face/m62.gif', 'wrwrw@128.com', '23435', 'http://www.sfsf.com', 0, '2012-06-29 10:22:08', '2012-10-24 20:49:49', '127.0.0.1', 5);
INSERT INTO `user` VALUES (30, '', '樱木花道', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', '44be6ba8ce86684da2e1f83bedbfec70f5e1cf43', '男', 'face/m23.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:23:32', '2012-09-18 10:08:04', '127.0.0.1', 1);
INSERT INTO `user` VALUES (31, '', '西瓜太郎', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', 'c5114c54d5159de4924a9bcc68103f5ade8afaa6', '男', 'face/m34.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:24:08', '2012-09-18 10:08:32', '127.0.0.1', 1);
INSERT INTO `user` VALUES (32, '', '佐罗', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', 'da2bcbe3da95c3a2477da41c7fbe2048db2938ae', '男', 'face/m24.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:24:55', '2012-09-18 10:29:12', '127.0.0.1', 1);
INSERT INTO `user` VALUES (33, '', '小鸭子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么', '90e4e1e6f19cb29e85c0fee64061e7612958cb8d', '男', 'face/m25.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:33:42', '2012-09-18 10:29:46', '127.0.0.1', 1);
INSERT INTO `user` VALUES (34, '', '小鸡', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么', '88b9eae481aed17b4f88555797c7fa7778b64127', '男', 'face/m26.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:34:25', '2012-09-18 10:30:15', '127.0.0.1', 1);
INSERT INTO `user` VALUES (39, '', '都会过去', '7c4a8d09ca3762af61e59520943dc26494f8941b', '都会过去', '53a146b5879bd21d730ff9f0390e0d5fe5ec06ba', '男', 'face/m27.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:50:50', '2012-06-29 10:50:50', '127.0.0.1', 0);
INSERT INTO `user` VALUES (40, '', '一路走好', '7c4a8d09ca3762af61e59520943dc26494f8941b', '祝福你要好好的', '5f9672405aa37c5f77d0087ae14793df73543dec', '男', 'face/m28.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 10:52:16', '2012-10-15 19:39:00', '127.0.0.1', 2);
INSERT INTO `user` VALUES (41, '', '心疼你', '7c4a8d09ca3762af61e59520943dc26494f8941b', '心疼你心疼你', '5ff20b8bd326ee5ec054c48dff65ef8535f77647', '男', 'face/m29.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 17:16:01', '2012-09-18 10:31:24', '127.0.0.1', 1);
INSERT INTO `user` VALUES (42, '', '雨终于停了', '7c4a8d09ca3762af61e59520943dc26494f8941b', '雨终于停了', 'f256faeb9570472877b5d9fa06733cf3f0215699', '男', 'face/m30.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 17:17:17', '2012-06-29 17:17:17', '127.0.0.1', 0);
INSERT INTO `user` VALUES (43, '', '只需要信任', '7c4a8d09ca3762af61e59520943dc26494f8941b', '情侣需要的是什么', '13fbe9df488187726c56101005c8c64726f7ce3a', '男', 'face/m31.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 17:19:04', '2012-06-29 17:19:04', '127.0.0.1', 0);
INSERT INTO `user` VALUES (44, '', '无条件为你', '7c4a8d09ca3762af61e59520943dc26494f8941b', '双子座的性格', '720ae9fdfbe66334fd5dcd98afaf5a51950edf94', '男', 'face/m32.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 17:21:24', '2012-06-29 17:21:24', '127.0.0.1', 0);
INSERT INTO `user` VALUES (45, '', '猜不透', '7c4a8d09ca3762af61e59520943dc26494f8941b', '双子座的性格', 'e453c58531e3431b76bac4039b7c346b387cd1ae', '男', 'face/m33.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-06-29 17:22:18', '2012-09-18 10:31:58', '127.0.0.1', 1);
INSERT INTO `user` VALUES (46, '', '学会珍惜', '7c4a8d09ca3762af61e59520943dc26494f8941b', '学会什么', '72b09628b883a905172ddbdc018c8a125a107e19', '男', 'face/m35.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 0, '2012-07-22 18:15:25', '2012-09-15 11:07:04', '127.0.0.1', 1);
INSERT INTO `user` VALUES (47, '', '朱正钱', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', 'cad57d414704c2c320aeaf1e22b12d2334a8cc6b', '男', 'face/m01.gif', 'wrwrw@128.com', '2345566', 'http://www.sfsf.com', 1, '2012-09-04 10:41:12', '2012-12-05 11:07:42', '127.0.0.1', 30);
INSERT INTO `user` VALUES (48, '', '夜不归宿', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么', '0e8b3df88e521d099d30dc903fb5497fa35f805d', '男', 'face/m39.gif', 'www@125.com', '23435', 'http://www.ocm.com', 0, '2012-09-12 09:15:55', '2012-09-15 11:06:27', '127.0.0.1', 1);
INSERT INTO `user` VALUES (49, '', '小丸子', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我叫什么', 'c238ef5cd2efccf9ade01aede62c3c5947363e7a', '男', 'face/m40.gif', 'www@125.com', '111111111', 'http://www.ocm.com', 0, '2012-09-12 09:20:05', '2012-09-17 17:38:39', '127.0.0.1', 5);
INSERT INTO `user` VALUES (50, 'c6a2d29653b03494df2df532bc166316a603c138', '卡哇伊', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么', '1d6b9a4f491f1d3669902f1cc3bbb0884c275c63', '男', 'face/m44.gif', 'www@125.com', '23435', 'http://www.ocm.com', 0, '2012-09-13 09:46:00', '2012-09-13 09:46:00', '127.0.0.1', 0);
INSERT INTO `user` VALUES (51, '', '苦丁茶', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么茶', 'd2037e03d348ee30ca48156ad17ba414a77aa6ce', '男', 'face/m41.gif', 'www321@12.com', '35308523', 'www.qq.com', 0, '2012-09-15 17:02:14', '2012-09-15 17:02:14', '127.0.0.1', 0);
INSERT INTO `user` VALUES (52, '', '丫头你好', '7c4a8d09ca3762af61e59520943dc26494f8941b', '哈哈哈nihao', '955b7fbe8ace81297c87ae89f0b2084ade5a2751', '男', 'face/m22.gif', 'www321www@126.com', '35308523', 'http://www.www.com', 0, '2012-10-03 22:55:42', '2012-10-03 22:55:42', '127.0.0.1', 0);
INSERT INTO `user` VALUES (53, '', '刀削面', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最爱吃什么', '6287d0f5268031874ac4f2dad2c5eb0acdef7e5a', '男', 'face/m01.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-16 17:53:56', '2012-10-16 17:53:56', '127.0.0.1', 0);
INSERT INTO `user` VALUES (54, '150e9355df7db630c9dd28d045ccf9f661aef054', '热干面', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最爱吃什么', '626a1fba7c343824b8d7d9a2ff49d508b8598c0b', '男', 'face/m01.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-16 17:56:12', '2012-10-16 17:56:12', '127.0.0.1', 0);
INSERT INTO `user` VALUES (55, '', '我是盐城人', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我最爱吃什么', '6287d0f5268031874ac4f2dad2c5eb0acdef7e5a', '男', 'face/m01.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-16 17:56:35', '2012-10-16 17:56:35', '127.0.0.1', 0);
INSERT INTO `user` VALUES (56, '', '我的宝贝', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是宝贝', '0bb6f40d2b3b44f7193f708c0aacf08080c5842a', '男', 'face/m01.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-16 17:57:55', '2012-10-16 17:57:55', '127.0.0.1', 0);
INSERT INTO `user` VALUES (57, '', '小爱', '7c4a8d09ca3762af61e59520943dc26494f8941b', '小爱爱aiai', 'e14adf1ff1e4e53c98c6c26d917bbd0644a233b7', '男', 'face/m01.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-16 19:02:23', '2012-10-16 19:02:23', '127.0.0.1', 0);
INSERT INTO `user` VALUES (58, '', '衡水学院', '7c4a8d09ca3762af61e59520943dc26494f8941b', '什么学校', 'bd9a725bf7cfe85af533f4a6db063b72697f585d', '男', 'face/m33.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-16 19:04:11', '2012-10-16 19:04:11', '127.0.0.1', 0);
INSERT INTO `user` VALUES (62, '', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么身份', 'ef84e765e027ce1984c2be0aabaea66afb9e66eb', '男', 'face/m01.gif', 'www321www@126.com', '42193477', 'www321.com', 1, '2012-11-03 21:16:36', '2013-06-02 19:38:13', '127.0.0.1', 17);
INSERT INTO `user` VALUES (61, '', '小茶杯', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢什么', '940d8aa14be916185f7767624bb7b15cef56c2a9', '男', 'face/m08.gif', 'www321@128.com', '42193777', 'http://www.123.com', 0, '2012-10-18 20:35:23', '2012-12-09 15:41:46', '127.0.0.1', 1);
INSERT INTO `user` VALUES (64, '', '测试', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是谁？', '0b5d7ed54bee16756a7579c6718ab01e3d1b75eb', '女', 'face/m40.gif', 'www321www@126.com', '232332444', 'http://www.126.com', 0, '2013-06-01 09:05:55', '2013-06-01 09:06:21', '127.0.0.1', 1);
