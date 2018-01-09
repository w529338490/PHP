################# BBS ##################
#用户表
DROP TABLE IF EXISTS sc_user;
CREATE TABLE sc_user(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    name CHAR(16) NOT NULL UNIQUE NOT NULL DEFAULT '',              # 用户名
    true_name VARCHAR(45) NOT NULL DEFAULT '',                      # 真实姓名
	pass CHAR(32) NOT NULL DEFAULT '',								# 用户名密码
	email VARCHAR(100) UNIQUE NOT NULL DEFAULT '',					# 邮箱 
	stand ENUM('1','2','3') NOT NULL DEFAULT '3',					# 身份 1=管理员(前后台什么都可干) 2=版主(可以管理相应的版块及普通会员的所有操作) 3=普通会员(除了版块操作,后台操作,什么可以干)
    sex ENUM('0','1','2') NOT NULL DEFAULT '0',             		# 姓别 0=保密 1=男 2=女 
    birthday INT UNSIGNED NOT NULL DEFAULT '0',                     # 出生日期  unix 时间戳
    birth_add char(7) NOT NULL DEFAULT '1,1',		             	# 出生城市
    live_add char(7) NOT NULL DEFAULT '1,1',        		       	# 现居住城市
    hobby VARCHAR(300) NOT NULL DEFAULT '未知',                     # 爱好
    marriage ENUM('0','1','2') NOT NULL DEFAULT '0',        		# 婚姻状况 0=保密 1=未婚 2=已婚
    pal_aim VARCHAR(300) NOT NULL DEFAULT '未知',                   # 交友目的
    reg_time INT UNSIGNED NOT NULL DEFAULT '0',                     # 注册时间
    last_time INT UNSIGNED NOT NULL DEFAULT '0',                    # 最后登录时间
	last_ip INT UNSIGNED NOT NULL DEFAULT '0',						# 最后登陆IP
    grade_num INT UNSIGNED NOT NULL DEFAULT '0',            		# 积分  默认 0(根据积分而得到等级名称)
    face_path CHAR(22) NOT NULL DEFAULT 'default.gif',              # 用户头像
    sign VARCHAR(300) NOT NULL DEFAULT '这个家伙很懒，什么都没留下',# 用户签名
    state ENUM('0','1') NOT NULL DEFAULT '1',                       # 状态  0=禁用 1=正常
    KEY indexs(name,pass)                                   		# 创建 sign 索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#等级表
DROP TABLE IF EXISTS sc_level;
CREATE TABLE sc_level(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    name CHAR(30) NOT NULL UNIQUE DEFAULT '',                       # 等级名称
    mini INT UNSIGNED NOT NULL DEFAULT '0',                         # 最小积分
    maxi INT UNSIGNED NOT NULL DEFAULT '0'                          # 最大积分
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
INSERT INTO `sc_level` VALUES (1, 'P1', 0, 101);
INSERT INTO `sc_level` VALUES (2, 'P2', 102, 229);
INSERT INTO `sc_level` VALUES (3, 'P3', 400, 599);
INSERT INTO `sc_level` VALUES (4, 'P4', 230, 399);
INSERT INTO `sc_level` VALUES (5, 'P5', 600, 799);
INSERT INTO `sc_level` VALUES (6, 'P6', 1200, 1699);
INSERT INTO `sc_level` VALUES (7, 'P7', 800, 1199);
INSERT INTO `sc_level` VALUES (8, 'P8', 1700, 2499);
INSERT INTO `sc_level` VALUES (9, 'P9', 2500, 3499);
INSERT INTO `sc_level` VALUES (10, 'P10', 3500, 999999999);

#友情链接
DROP TABLE IF EXISTS sc_flink;
CREATE TABLE sc_flink(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    name CHAR(30) NOT NULL UNIQUE DEFAULT '',                       # 名称
    site VARCHAR(150) NOT NULL DEFAULT '',                          # 网址
    ptime INT UNSIGNED NOT NULL DEFAULT '0'                         # 添加时间
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#主题
DROP TABLE IF EXISTS sc_subject;
CREATE TABLE sc_subject(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                   		# 用户ID号
	bid INT UNSIGNED NOT NULL DEFAULT '0',							# 所属板块
    title VARCHAR(150) NOT NULL DEFAULT '',                 		# 标题 
    content TEXT,                                           		# 内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 发帖时间
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # 发帖IP地址
    state ENUM('1','2') NOT NULL DEFAULT '1',                   	# 状态 1=可回复 2=不可回复
    click_num INT UNSIGNED NOT NULL DEFAULT '0',           			# 点击数 
    yes_num MEDIUMINT UNSIGNED NOT NULL DEFAULT '0',        		# 支持数
    no_num MEDIUMINT UNSIGNED NOT NULL DEFAULT '0',         		# 反对数
    ptype ENUM('1','2','3','4','0') NOT NULL DEFAULT '4',           # 文章类型 1=置顶 2=精华 3=推荐 4=普通 0=关闭
    KEY indexs(title),		                                		# 给文章标题加索引
    FULLTEXT (content)                                      		# 给内容加超文本索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


#主题评论表
DROP TABLE IF EXISTS sc_comment;
CREATE TABLE sc_comment(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    sid INT UNSIGNED NOT NULL DEFAULT '0',                          # 主题ID号
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 评论者ID号
    content TEXT,                                           		# 评论内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 评论时间
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # 评论者IP地址
    FULLTEXT (content)                                      		# 给评论内容加超文本索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


#版块分类表
DROP TABLE IF EXISTS sc_board;
CREATE TABLE sc_board(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    name CHAR(30) UNIQUE DEFAULT '默认分区',                		# 版块名称
    parent_id INT UNSIGNED NOT NULL DEFAULT '0',                    # 父ID
    path VARCHAR(50) NOT NULL DEFAULT '0',                  		# 路径
    master INT UNSIGNED NOT NULL DEFAULT '1',                       # 版主
    display ENUM('0','1') NOT NULL DEFAULT '1',                     # 是否显示 0=隐藏 1=显示
    img_path CHAR(22) NOT NULL DEFAULT 'forum.gif',                 # 版块图标
    order_num tinyINT NOT NULL DEFAULT '0'                          # 排序越小排的越前
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
INSERT INTO sc_board(name,parent_id,path) VALUES('SourceCode','0','0,1');
INSERT INTO sc_board(name,parent_id,path) VALUES('默认版块','1','0,1,2');


#新闻
DROP TABLE IF EXISTS sc_news;
CREATE TABLE sc_news(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# 新闻id
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 发表新闻的管理员
    title VARCHAR(150) NOT NULL DEFAULT '',                         # 新闻标题
    content TEXT,                                           		# 新闻内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 发表时间
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # ip
    KEY title_index(title),                                 		# 为标题添加索引
    FULLTEXT(content)                                       		# 为内容创建超文本索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#公告表
DROP TABLE IF EXISTS sc_notice;
CREATE TABLE sc_notice(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                  		# 发表公告的管理员
	title VARCHAR(300) NOT NULL DEFAULT '无',						# 公告标题
    content TEXT,                                           		# 公告内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                		# 发表公告时间
	start_time INT UNSIGNED NOT NULL DEFAULT '0',					# 公告开始时间
	stop_time INT UNSIGNED NOT NULL DEFAULT '0',					# 公告结束时间
    FULLTEXT(content)                                       		# 为公告内容添加超文本索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;



################# 用户空间 ##################
#访客表
DROP TABLE IF EXISTS sc_guest;
CREATE TABLE sc_guest(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                  		# 用户ID号
    guest_id INT UNSIGNED NOT NULL DEFAULT '0',            			# 访客ID号
	vtime INT UNSIGNED NOT NULL DEFAULT '0'							# 访问时间
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#好友表
DROP TABLE IF EXISTS sc_friend;
CREATE TABLE sc_friend(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 用户ID号
    fid INT UNSIGNED NOT NULL DEFAULT '0',                          # 好友ID号
    status ENUM('0','1') NOT NULL DEFAULT '0',                      # 添加好友状态 0=等待同意 1=已同意 加入数据库时要双重插入
    ptime INT UNSIGNED NOT NULL DEFAULT '0'                        	# 两边都同意时就插入添加时间
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#留言表
DROP TABLE IF EXISTS sc_message;
CREATE TABLE sc_message(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 被留言的ID号
    mess_id INT UNSIGNED NOT NULL DEFAULT '0',                      # 留言人的ID号
    content TEXT,                                           		# 留言内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 留言时间
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # 留言者的IP
    FULLTEXT (content)                                      		# 给留言内容加超文本索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#日志表
DROP TABLE IF EXISTS sc_log;
CREATE TABLE sc_log(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 用户ID号
    title VARCHAR(150) NOT NULL DEFAULT '',                         # 日志标题
    content TEXT,                                           		# 日志内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 时间
    click_num MEDIUMINT UNSIGNED NOT NULL DEFAULT '0',              # 点击数
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # IP地址
    KEY title_index(title),                                 		# 给标题加索引
    FULLTEXT (content)                                      		# 给留言内容加超文本索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#日志评论表
DROP TABLE IF EXISTS sc_log_comm;
CREATE TABLE sc_log_comm(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    lid INT UNSIGNED NOT NULL DEFAULT '0',                          # 日志ID号
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 评论者ID号
    content VARCHAR(600) NOT NULL DEFAULT '',                       # 评论内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 评论时间
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # 评论IP
    KEY content_index(content)                              		# 给内容加索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#说说表
DROP TABLE IF EXISTS sc_speak;
CREATE TABLE sc_speak(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 用户ID号
    content VARCHAR(600) NOT NULL DEFAULT '',                       # 说说内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 发表说说的时间
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # 发表时的IP地址
    KEY content_index(content)                              		# 给内容加索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#说说回复表
DROP TABLE IF EXISTS sc_speak_comm;
CREATE TABLE sc_speak_comm(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    sid INT UNSIGNED NOT NULL DEFAULT '0',                          # 被评论的说说ID号
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 评论者ID号
    content VARCHAR(600) NOT NULL DEFAULT '',                       # 评论内容 
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 评论时间
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # 评论者的IP地址
    KEY content_index(content)                              		# 给内容加索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#短消息表
DROP TABLE IF EXISTS sc_sms;
CREATE TABLE sc_sms(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    dst_id INT UNSIGNED NOT NULL DEFAULT '0',                       # 收件人ID
    src_id INT UNSIGNED NOT NULL DEFAULT '0',                       # 发件人ID
    content VARCHAR(600) NOT NULL DEFAULT '',                       # 短信内容
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 发送短信时间
    dst_ope ENUM('save','del') NOT NULL DEFAULT 'save',             # 收件人操作
    src_ope ENUM('save','del') NOT NULL DEFAULT 'save',             # 发件人操作
    is_read ENUM('0','1') NOT NULL DEFAULT '0',                     # 是否已读  0=未读 1=已读
    ip INT UNSIGNED NOT NULL DEFAULT '0',                           # 发件人IP
	sms_sort TINYINT UNSIGNED NOT NULL DEFAULT '1',  				# 0=管理员短信  1=普通用户短信  2=好友请求验证  3=打招呼 4=系统信息
    KEY content_index(content)                              		# 给内容加索引
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#相册表
DROP TABLE IF EXISTS sc_album;
CREATE TABLE sc_album(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    uid INT UNSIGNED NOT NULL DEFAULT '0',                          # 用户ID
    name CHAR(30) NOT NULL DEFAULT '我的相册',                      # 相册名称
	cover_path VARCHAR(22) NOT NULL DEFAULT 'nophoto.gif',			# 封面
    authority ENUM('0','1','2') DEFAULT '1',                        # 权限 0=仅自己可见 1=公开 2=会员可查看
    ptime INT UNSIGNED NOT NULL DEFAULT '0'                         # 更新时间
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#照片表
DROP TABLE IF EXISTS sc_photo;
CREATE TABLE sc_photo(
    id INT UNSIGNED NOT NULL auto_increment PRIMARY KEY,    		# ID
    pa_id INT UNSIGNED NOT NULL DEFAULT '0',                        # 所属相册ID号
    name CHAR(60) NOT NULL DEFAULT '未命名',                        # 图片名称
    img_path CHAR(22) NOT NULL DEFAULT '',                          # 图片路径
    ptime INT UNSIGNED NOT NULL DEFAULT '0',                        # 上传时间
    desn VARCHAR(300) NOT NULL DEFAULT '暂无简介'                   # 简介
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#省
DROP TABLE IF EXISTS sc_province;
CREATE TABLE sc_province(
	id INT(10) UNSIGNED NOT NULL auto_increment PRIMARY KEY,		# 省id
	name varchar(90) NOT NULL DEFAULT '',							# 省名
	sort INT(10) UNSIGNED NOT NULL DEFAULT '0',						# 省排序
	remark varchar(50) NOT NULL DEFAULT ''							# 省类型
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#市
DROP TABLE IF EXISTS sc_city;
CREATE TABLE sc_city(
	id INT(10) UNSIGNED NOT NULL auto_increment PRIMARY KEY,		# 市id
	name varchar(60) NOT NULL DEFAULT '',							# 市名
	pid INT(10) UNSIGNED NOT NULL DEFAULT '0',						# 所属省ID
	sort INT(10) UNSIGNED NOT NULL DEFAULT '0'						# 市排序
)TYPE=myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


###############################数据初始化########################
					#省#
INSERT INTO `sc_province` VALUES (1, '北京市', 1, '直辖市');
INSERT INTO `sc_province` VALUES (2, '天津市', 2, '直辖市');
INSERT INTO `sc_province` VALUES (3, '河北省', 5, '省份');
INSERT INTO `sc_province` VALUES (4, '山西省', 6, '省份');
INSERT INTO `sc_province` VALUES (5, '内蒙古自治区', 32, '自治区');
INSERT INTO `sc_province` VALUES (6, '辽宁省', 8, '省份');
INSERT INTO `sc_province` VALUES (7, '吉林省', 9, '省份');
INSERT INTO `sc_province` VALUES (8, '黑龙江省', 10, '省份');
INSERT INTO `sc_province` VALUES (9, '上海市', 3, '直辖市');
INSERT INTO `sc_province` VALUES (10, '江苏省', 11, '省份');
INSERT INTO `sc_province` VALUES (11, '浙江省', 12, '省份');
INSERT INTO `sc_province` VALUES (12, '安徽省', 13, '省份');
INSERT INTO `sc_province` VALUES (13, '福建省', 14, '省份');
INSERT INTO `sc_province` VALUES (14, '江西省', 15, '省份');
INSERT INTO `sc_province` VALUES (15, '山东省', 16, '省份');
INSERT INTO `sc_province` VALUES (16, '河南省', 17, '省份');
INSERT INTO `sc_province` VALUES (17, '湖北省', 18, '省份');
INSERT INTO `sc_province` VALUES (18, '湖南省', 19, '省份');
INSERT INTO `sc_province` VALUES (19, '广东省', 20, '省份');
INSERT INTO `sc_province` VALUES (20, '海南省', 24, '省份');
INSERT INTO `sc_province` VALUES (21, '广西壮族自治区', 28, '自治区');
INSERT INTO `sc_province` VALUES (22, '甘肃省', 21, '省份');
INSERT INTO `sc_province` VALUES (23, '陕西省', 27, '省份');
INSERT INTO `sc_province` VALUES (24, '新疆维吾尔自治区', 31, '自治区');
INSERT INTO `sc_province` VALUES (25, '青海省', 26, '省份');
INSERT INTO `sc_province` VALUES (26, '宁夏回族自治区', 30, '自治区');
INSERT INTO `sc_province` VALUES (27, '重庆市', 4, '直辖市');
INSERT INTO `sc_province` VALUES (28, '四川省', 22, '省份');
INSERT INTO `sc_province` VALUES (29, '贵州省', 23, '省份');
INSERT INTO `sc_province` VALUES (30, '云南省', 25, '省份');
INSERT INTO `sc_province` VALUES (31, '西藏自治区', 29, '自治区');
INSERT INTO `sc_province` VALUES (32, '台湾省', 7, '省份');
INSERT INTO `sc_province` VALUES (33, '澳门特别行政区', 33, '特别行政区');
INSERT INTO `sc_province` VALUES (34, '香港特别行政区', 34, '特别行政区');


					#市#
INSERT INTO `sc_city` VALUES (1, '北京市', 1, 1);
INSERT INTO `sc_city` VALUES (2, '天津市', 2, 2);
INSERT INTO `sc_city` VALUES (3, '上海市', 9, 3);
INSERT INTO `sc_city` VALUES (4, '重庆市', 27, 4);
INSERT INTO `sc_city` VALUES (5, '邯郸市', 3, 5);
INSERT INTO `sc_city` VALUES (6, '石家庄市', 3, 6);
INSERT INTO `sc_city` VALUES (7, '保定市', 3, 7);
INSERT INTO `sc_city` VALUES (8, '张家口市', 3, 8);
INSERT INTO `sc_city` VALUES (9, '承德市', 3, 9);
INSERT INTO `sc_city` VALUES (10, '唐山市', 3, 10);
INSERT INTO `sc_city` VALUES (11, '廊坊市', 3, 11);
INSERT INTO `sc_city` VALUES (12, '沧州市', 3, 12);
INSERT INTO `sc_city` VALUES (13, '衡水市', 3, 13);
INSERT INTO `sc_city` VALUES (14, '邢台市', 3, 14);
INSERT INTO `sc_city` VALUES (15, '秦皇岛市', 3, 15);
INSERT INTO `sc_city` VALUES (16, '朔州市', 4, 16);
INSERT INTO `sc_city` VALUES (17, '忻州市', 4, 17);
INSERT INTO `sc_city` VALUES (18, '太原市', 4, 18);
INSERT INTO `sc_city` VALUES (19, '大同市', 4, 19);
INSERT INTO `sc_city` VALUES (20, '阳泉市', 4, 20);
INSERT INTO `sc_city` VALUES (21, '晋中市', 4, 21);
INSERT INTO `sc_city` VALUES (22, '长治市', 4, 22);
INSERT INTO `sc_city` VALUES (23, '晋城市', 4, 23);
INSERT INTO `sc_city` VALUES (24, '临汾市', 4, 24);
INSERT INTO `sc_city` VALUES (25, '吕梁市', 4, 25);
INSERT INTO `sc_city` VALUES (26, '运城市', 4, 26);
INSERT INTO `sc_city` VALUES (27, '沈阳市', 6, 27);
INSERT INTO `sc_city` VALUES (28, '铁岭市', 6, 28);
INSERT INTO `sc_city` VALUES (29, '大连市', 6, 29);
INSERT INTO `sc_city` VALUES (30, '鞍山市', 6, 30);
INSERT INTO `sc_city` VALUES (31, '抚顺市', 6, 31);
INSERT INTO `sc_city` VALUES (32, '本溪市', 6, 32);
INSERT INTO `sc_city` VALUES (33, '丹东市', 6, 33);
INSERT INTO `sc_city` VALUES (34, '锦州市', 6, 34);
INSERT INTO `sc_city` VALUES (35, '营口市', 6, 35);
INSERT INTO `sc_city` VALUES (36, '阜新市', 6, 36);
INSERT INTO `sc_city` VALUES (37, '辽阳市', 6, 37);
INSERT INTO `sc_city` VALUES (38, '朝阳市', 6, 38);
INSERT INTO `sc_city` VALUES (39, '盘锦市', 6, 39);
INSERT INTO `sc_city` VALUES (40, '葫芦岛市', 6, 40);
INSERT INTO `sc_city` VALUES (41, '长春市', 7, 41);
INSERT INTO `sc_city` VALUES (42, '吉林市', 7, 42);
INSERT INTO `sc_city` VALUES (43, '延边朝鲜族自治州', 7, 43);
INSERT INTO `sc_city` VALUES (44, '四平市', 7, 44);
INSERT INTO `sc_city` VALUES (45, '通化市', 7, 45);
INSERT INTO `sc_city` VALUES (46, '白城市', 7, 46);
INSERT INTO `sc_city` VALUES (47, '辽源市', 7, 47);
INSERT INTO `sc_city` VALUES (48, '松原市', 7, 48);
INSERT INTO `sc_city` VALUES (49, '白山市', 7, 49);
INSERT INTO `sc_city` VALUES (50, '哈尔滨市', 8, 50);
INSERT INTO `sc_city` VALUES (51, '齐齐哈尔市', 8, 51);
INSERT INTO `sc_city` VALUES (52, '鸡西市', 8, 52);
INSERT INTO `sc_city` VALUES (53, '牡丹江市', 8, 53);
INSERT INTO `sc_city` VALUES (54, '七台河市', 8, 54);
INSERT INTO `sc_city` VALUES (55, '佳木斯市', 8, 55);
INSERT INTO `sc_city` VALUES (56, '鹤岗市', 8, 56);
INSERT INTO `sc_city` VALUES (57, '双鸭山市', 8, 57);
INSERT INTO `sc_city` VALUES (58, '绥化市', 8, 58);
INSERT INTO `sc_city` VALUES (59, '黑河市', 8, 59);
INSERT INTO `sc_city` VALUES (60, '大兴安岭地区', 8, 60);
INSERT INTO `sc_city` VALUES (61, '伊春市', 8, 61);
INSERT INTO `sc_city` VALUES (62, '大庆市', 8, 62);
INSERT INTO `sc_city` VALUES (63, '南京市', 10, 63);
INSERT INTO `sc_city` VALUES (64, '无锡市', 10, 64);
INSERT INTO `sc_city` VALUES (65, '镇江市', 10, 65);
INSERT INTO `sc_city` VALUES (66, '苏州市', 10, 66);
INSERT INTO `sc_city` VALUES (67, '南通市', 10, 67);
INSERT INTO `sc_city` VALUES (68, '扬州市', 10, 68);
INSERT INTO `sc_city` VALUES (69, '盐城市', 10, 69);
INSERT INTO `sc_city` VALUES (70, '徐州市', 10, 70);
INSERT INTO `sc_city` VALUES (71, '淮安市', 10, 71);
INSERT INTO `sc_city` VALUES (72, '连云港市', 10, 72);
INSERT INTO `sc_city` VALUES (73, '常州市', 10, 73);
INSERT INTO `sc_city` VALUES (74, '泰州市', 10, 74);
INSERT INTO `sc_city` VALUES (75, '宿迁市', 10, 75);
INSERT INTO `sc_city` VALUES (76, '舟山市', 11, 76);
INSERT INTO `sc_city` VALUES (77, '衢州市', 11, 77);
INSERT INTO `sc_city` VALUES (78, '杭州市', 11, 78);
INSERT INTO `sc_city` VALUES (79, '湖州市', 11, 79);
INSERT INTO `sc_city` VALUES (80, '嘉兴市', 11, 80);
INSERT INTO `sc_city` VALUES (81, '宁波市', 11, 81);
INSERT INTO `sc_city` VALUES (82, '绍兴市', 11, 82);
INSERT INTO `sc_city` VALUES (83, '温州市', 11, 83);
INSERT INTO `sc_city` VALUES (84, '丽水市', 11, 84);
INSERT INTO `sc_city` VALUES (85, '金华市', 11, 85);
INSERT INTO `sc_city` VALUES (86, '台州市', 11, 86);
INSERT INTO `sc_city` VALUES (87, '合肥市', 12, 87);
INSERT INTO `sc_city` VALUES (88, '芜湖市', 12, 88);
INSERT INTO `sc_city` VALUES (89, '蚌埠市', 12, 89);
INSERT INTO `sc_city` VALUES (90, '淮南市', 12, 90);
INSERT INTO `sc_city` VALUES (91, '马鞍山市', 12, 91);
INSERT INTO `sc_city` VALUES (92, '淮北市', 12, 92);
INSERT INTO `sc_city` VALUES (93, '铜陵市', 12, 93);
INSERT INTO `sc_city` VALUES (94, '安庆市', 12, 94);
INSERT INTO `sc_city` VALUES (95, '黄山市', 12, 95);
INSERT INTO `sc_city` VALUES (96, '滁州市', 12, 96);
INSERT INTO `sc_city` VALUES (97, '阜阳市', 12, 97);
INSERT INTO `sc_city` VALUES (98, '宿州市', 12, 98);
INSERT INTO `sc_city` VALUES (99, '巢湖市', 12, 99);
INSERT INTO `sc_city` VALUES (100, '六安市', 12, 100);
INSERT INTO `sc_city` VALUES (101, '亳州市', 12, 101);
INSERT INTO `sc_city` VALUES (102, '池州市', 12, 102);
INSERT INTO `sc_city` VALUES (103, '宣城市', 12, 103);
INSERT INTO `sc_city` VALUES (104, '福州市', 13, 104);
INSERT INTO `sc_city` VALUES (105, '厦门市', 13, 105);
INSERT INTO `sc_city` VALUES (106, '宁德市', 13, 106);
INSERT INTO `sc_city` VALUES (107, '莆田市', 13, 107);
INSERT INTO `sc_city` VALUES (108, '泉州市', 13, 108);
INSERT INTO `sc_city` VALUES (109, '漳州市', 13, 109);
INSERT INTO `sc_city` VALUES (110, '龙岩市', 13, 110);
INSERT INTO `sc_city` VALUES (111, '三明市', 13, 111);
INSERT INTO `sc_city` VALUES (112, '南平市', 13, 112);
INSERT INTO `sc_city` VALUES (113, '鹰潭市', 14, 113);
INSERT INTO `sc_city` VALUES (114, '新余市', 14, 114);
INSERT INTO `sc_city` VALUES (115, '南昌市', 14, 115);
INSERT INTO `sc_city` VALUES (116, '九江市', 14, 116);
INSERT INTO `sc_city` VALUES (117, '上饶市', 14, 117);
INSERT INTO `sc_city` VALUES (118, '抚州市', 14, 118);
INSERT INTO `sc_city` VALUES (119, '宜春市', 14, 119);
INSERT INTO `sc_city` VALUES (120, '吉安市', 14, 120);
INSERT INTO `sc_city` VALUES (121, '赣州市', 14, 121);
INSERT INTO `sc_city` VALUES (122, '景德镇市', 14, 122);
INSERT INTO `sc_city` VALUES (123, '萍乡市', 14, 123);
INSERT INTO `sc_city` VALUES (124, '菏泽市', 15, 124);
INSERT INTO `sc_city` VALUES (125, '济南市', 15, 125);
INSERT INTO `sc_city` VALUES (126, '青岛市', 15, 126);
INSERT INTO `sc_city` VALUES (127, '淄博市', 15, 127);
INSERT INTO `sc_city` VALUES (128, '德州市', 15, 128);
INSERT INTO `sc_city` VALUES (129, '烟台市', 15, 129);
INSERT INTO `sc_city` VALUES (130, '潍坊市', 15, 130);
INSERT INTO `sc_city` VALUES (131, '济宁市', 15, 131);
INSERT INTO `sc_city` VALUES (132, '泰安市', 15, 132);
INSERT INTO `sc_city` VALUES (133, '临沂市', 15, 133);
INSERT INTO `sc_city` VALUES (134, '滨州市', 15, 134);
INSERT INTO `sc_city` VALUES (135, '东营市', 15, 135);
INSERT INTO `sc_city` VALUES (136, '威海市', 15, 136);
INSERT INTO `sc_city` VALUES (137, '枣庄市', 15, 137);
INSERT INTO `sc_city` VALUES (138, '日照市', 15, 138);
INSERT INTO `sc_city` VALUES (139, '莱芜市', 15, 139);
INSERT INTO `sc_city` VALUES (140, '聊城市', 15, 140);
INSERT INTO `sc_city` VALUES (141, '商丘市', 16, 141);
INSERT INTO `sc_city` VALUES (142, '郑州市', 16, 142);
INSERT INTO `sc_city` VALUES (143, '安阳市', 16, 143);
INSERT INTO `sc_city` VALUES (144, '新乡市', 16, 144);
INSERT INTO `sc_city` VALUES (145, '许昌市', 16, 145);
INSERT INTO `sc_city` VALUES (146, '平顶山市', 16, 146);
INSERT INTO `sc_city` VALUES (147, '信阳市', 16, 147);
INSERT INTO `sc_city` VALUES (148, '南阳市', 16, 148);
INSERT INTO `sc_city` VALUES (149, '开封市', 16, 149);
INSERT INTO `sc_city` VALUES (150, '洛阳市', 16, 150);
INSERT INTO `sc_city` VALUES (151, '济源市', 16, 151);
INSERT INTO `sc_city` VALUES (152, '焦作市', 16, 152);
INSERT INTO `sc_city` VALUES (153, '鹤壁市', 16, 153);
INSERT INTO `sc_city` VALUES (154, '濮阳市', 16, 154);
INSERT INTO `sc_city` VALUES (155, '周口市', 16, 155);
INSERT INTO `sc_city` VALUES (156, '漯河市', 16, 156);
INSERT INTO `sc_city` VALUES (157, '驻马店市', 16, 157);
INSERT INTO `sc_city` VALUES (158, '三门峡市', 16, 158);
INSERT INTO `sc_city` VALUES (159, '武汉市', 17, 159);
INSERT INTO `sc_city` VALUES (160, '襄樊市', 17, 160);
INSERT INTO `sc_city` VALUES (161, '鄂州市', 17, 161);
INSERT INTO `sc_city` VALUES (162, '孝感市', 17, 162);
INSERT INTO `sc_city` VALUES (163, '黄冈市', 17, 163);
INSERT INTO `sc_city` VALUES (164, '黄石市', 17, 164);
INSERT INTO `sc_city` VALUES (165, '咸宁市', 17, 165);
INSERT INTO `sc_city` VALUES (166, '荆州市', 17, 166);
INSERT INTO `sc_city` VALUES (167, '宜昌市', 17, 167);
INSERT INTO `sc_city` VALUES (168, '恩施土家族苗族自治州', 17, 168);
INSERT INTO `sc_city` VALUES (169, '神农架林区', 17, 169);
INSERT INTO `sc_city` VALUES (170, '十堰市', 17, 170);
INSERT INTO `sc_city` VALUES (171, '随州市', 17, 171);
INSERT INTO `sc_city` VALUES (172, '荆门市', 17, 172);
INSERT INTO `sc_city` VALUES (173, '仙桃市', 17, 173);
INSERT INTO `sc_city` VALUES (174, '天门市', 17, 174);
INSERT INTO `sc_city` VALUES (175, '潜江市', 17, 175);
INSERT INTO `sc_city` VALUES (176, '岳阳市', 18, 176);
INSERT INTO `sc_city` VALUES (177, '长沙市', 18, 177);
INSERT INTO `sc_city` VALUES (178, '湘潭市', 18, 178);
INSERT INTO `sc_city` VALUES (179, '株洲市', 18, 179);
INSERT INTO `sc_city` VALUES (180, '衡阳市', 18, 180);
INSERT INTO `sc_city` VALUES (181, '郴州市', 18, 181);
INSERT INTO `sc_city` VALUES (182, '常德市', 18, 182);
INSERT INTO `sc_city` VALUES (183, '益阳市', 18, 183);
INSERT INTO `sc_city` VALUES (184, '娄底市', 18, 184);
INSERT INTO `sc_city` VALUES (185, '邵阳市', 18, 185);
INSERT INTO `sc_city` VALUES (186, '湘西土家族苗族自治州', 18, 186);
INSERT INTO `sc_city` VALUES (187, '张家界市', 18, 187);
INSERT INTO `sc_city` VALUES (188, '怀化市', 18, 188);
INSERT INTO `sc_city` VALUES (189, '永州市', 18, 189);
INSERT INTO `sc_city` VALUES (190, '广州市', 19, 190);
INSERT INTO `sc_city` VALUES (191, '汕尾市', 19, 191);
INSERT INTO `sc_city` VALUES (192, '阳江市', 19, 192);
INSERT INTO `sc_city` VALUES (193, '揭阳市', 19, 193);
INSERT INTO `sc_city` VALUES (194, '茂名市', 19, 194);
INSERT INTO `sc_city` VALUES (195, '惠州市', 19, 195);
INSERT INTO `sc_city` VALUES (196, '江门市', 19, 196);
INSERT INTO `sc_city` VALUES (197, '韶关市', 19, 197);
INSERT INTO `sc_city` VALUES (198, '梅州市', 19, 198);
INSERT INTO `sc_city` VALUES (199, '汕头市', 19, 199);
INSERT INTO `sc_city` VALUES (200, '深圳市', 19, 200);
INSERT INTO `sc_city` VALUES (201, '珠海市', 19, 201);
INSERT INTO `sc_city` VALUES (202, '佛山市', 19, 202);
INSERT INTO `sc_city` VALUES (203, '肇庆市', 19, 203);
INSERT INTO `sc_city` VALUES (204, '湛江市', 19, 204);
INSERT INTO `sc_city` VALUES (205, '中山市', 19, 205);
INSERT INTO `sc_city` VALUES (206, '河源市', 19, 206);
INSERT INTO `sc_city` VALUES (207, '清远市', 19, 207);
INSERT INTO `sc_city` VALUES (208, '云浮市', 19, 208);
INSERT INTO `sc_city` VALUES (209, '潮州市', 19, 209);
INSERT INTO `sc_city` VALUES (210, '东莞市', 19, 210);
INSERT INTO `sc_city` VALUES (211, '兰州市', 22, 211);
INSERT INTO `sc_city` VALUES (212, '金昌市', 22, 212);
INSERT INTO `sc_city` VALUES (213, '白银市', 22, 213);
INSERT INTO `sc_city` VALUES (214, '天水市', 22, 214);
INSERT INTO `sc_city` VALUES (215, '嘉峪关市', 22, 215);
INSERT INTO `sc_city` VALUES (216, '武威市', 22, 216);
INSERT INTO `sc_city` VALUES (217, '张掖市', 22, 217);
INSERT INTO `sc_city` VALUES (218, '平凉市', 22, 218);
INSERT INTO `sc_city` VALUES (219, '酒泉市', 22, 219);
INSERT INTO `sc_city` VALUES (220, '庆阳市', 22, 220);
INSERT INTO `sc_city` VALUES (221, '定西市', 22, 221);
INSERT INTO `sc_city` VALUES (222, '陇南市', 22, 222);
INSERT INTO `sc_city` VALUES (223, '临夏回族自治州', 22, 223);
INSERT INTO `sc_city` VALUES (224, '甘南藏族自治州', 22, 224);
INSERT INTO `sc_city` VALUES (225, '成都市', 28, 225);
INSERT INTO `sc_city` VALUES (226, '攀枝花市', 28, 226);
INSERT INTO `sc_city` VALUES (227, '自贡市', 28, 227);
INSERT INTO `sc_city` VALUES (228, '绵阳市', 28, 228);
INSERT INTO `sc_city` VALUES (229, '南充市', 28, 229);
INSERT INTO `sc_city` VALUES (230, '达州市', 28, 230);
INSERT INTO `sc_city` VALUES (231, '遂宁市', 28, 231);
INSERT INTO `sc_city` VALUES (232, '广安市', 28, 232);
INSERT INTO `sc_city` VALUES (233, '巴中市', 28, 233);
INSERT INTO `sc_city` VALUES (234, '泸州市', 28, 234);
INSERT INTO `sc_city` VALUES (235, '宜宾市', 28, 235);
INSERT INTO `sc_city` VALUES (236, '资阳市', 28, 236);
INSERT INTO `sc_city` VALUES (237, '内江市', 28, 237);
INSERT INTO `sc_city` VALUES (238, '乐山市', 28, 238);
INSERT INTO `sc_city` VALUES (239, '眉山市', 28, 239);
INSERT INTO `sc_city` VALUES (240, '凉山彝族自治州', 28, 240);
INSERT INTO `sc_city` VALUES (241, '雅安市', 28, 241);
INSERT INTO `sc_city` VALUES (242, '甘孜藏族自治州', 28, 242);
INSERT INTO `sc_city` VALUES (243, '阿坝藏族羌族自治州', 28, 243);
INSERT INTO `sc_city` VALUES (244, '德阳市', 28, 244);
INSERT INTO `sc_city` VALUES (245, '广元市', 28, 245);
INSERT INTO `sc_city` VALUES (246, '贵阳市', 29, 246);
INSERT INTO `sc_city` VALUES (247, '遵义市', 29, 247);
INSERT INTO `sc_city` VALUES (248, '安顺市', 29, 248);
INSERT INTO `sc_city` VALUES (249, '黔南布依族苗族自治州', 29, 249);
INSERT INTO `sc_city` VALUES (250, '黔东南苗族侗族自治州', 29, 250);
INSERT INTO `sc_city` VALUES (251, '铜仁地区', 29, 251);
INSERT INTO `sc_city` VALUES (252, '毕节地区', 29, 252);
INSERT INTO `sc_city` VALUES (253, '六盘水市', 29, 253);
INSERT INTO `sc_city` VALUES (254, '黔西南布依族苗族自治州', 29, 254);
INSERT INTO `sc_city` VALUES (255, '海口市', 20, 255);
INSERT INTO `sc_city` VALUES (256, '三亚市', 20, 256);
INSERT INTO `sc_city` VALUES (257, '五指山市', 20, 257);
INSERT INTO `sc_city` VALUES (258, '琼海市', 20, 258);
INSERT INTO `sc_city` VALUES (259, '儋州市', 20, 259);
INSERT INTO `sc_city` VALUES (260, '文昌市', 20, 260);
INSERT INTO `sc_city` VALUES (261, '万宁市', 20, 261);
INSERT INTO `sc_city` VALUES (262, '东方市', 20, 262);
INSERT INTO `sc_city` VALUES (263, '澄迈县', 20, 263);
INSERT INTO `sc_city` VALUES (264, '定安县', 20, 264);
INSERT INTO `sc_city` VALUES (265, '屯昌县', 20, 265);
INSERT INTO `sc_city` VALUES (266, '临高县', 20, 266);
INSERT INTO `sc_city` VALUES (267, '白沙黎族自治县', 20, 267);
INSERT INTO `sc_city` VALUES (268, '昌江黎族自治县', 20, 268);
INSERT INTO `sc_city` VALUES (269, '乐东黎族自治县', 20, 269);
INSERT INTO `sc_city` VALUES (270, '陵水黎族自治县', 20, 270);
INSERT INTO `sc_city` VALUES (271, '保亭黎族苗族自治县', 20, 271);
INSERT INTO `sc_city` VALUES (272, '琼中黎族苗族自治县', 20, 272);
INSERT INTO `sc_city` VALUES (273, '西双版纳傣族自治州', 30, 273);
INSERT INTO `sc_city` VALUES (274, '德宏傣族景颇族自治州', 30, 274);
INSERT INTO `sc_city` VALUES (275, '昭通市', 30, 275);
INSERT INTO `sc_city` VALUES (276, '昆明市', 30, 276);
INSERT INTO `sc_city` VALUES (277, '大理白族自治州', 30, 277);
INSERT INTO `sc_city` VALUES (278, '红河哈尼族彝族自治州', 30, 278);
INSERT INTO `sc_city` VALUES (279, '曲靖市', 30, 279);
INSERT INTO `sc_city` VALUES (280, '保山市', 30, 280);
INSERT INTO `sc_city` VALUES (281, '文山壮族苗族自治州', 30, 281);
INSERT INTO `sc_city` VALUES (282, '玉溪市', 30, 282);
INSERT INTO `sc_city` VALUES (283, '楚雄彝族自治州', 30, 283);
INSERT INTO `sc_city` VALUES (284, '普洱市', 30, 284);
INSERT INTO `sc_city` VALUES (285, '临沧市', 30, 285);
INSERT INTO `sc_city` VALUES (286, '怒江傈傈族自治州', 30, 286);
INSERT INTO `sc_city` VALUES (287, '迪庆藏族自治州', 30, 287);
INSERT INTO `sc_city` VALUES (288, '丽江市', 30, 288);
INSERT INTO `sc_city` VALUES (289, '海北藏族自治州', 25, 289);
INSERT INTO `sc_city` VALUES (290, '西宁市', 25, 290);
INSERT INTO `sc_city` VALUES (291, '海东地区', 25, 291);
INSERT INTO `sc_city` VALUES (292, '黄南藏族自治州', 25, 292);
INSERT INTO `sc_city` VALUES (293, '海南藏族自治州', 25, 293);
INSERT INTO `sc_city` VALUES (294, '果洛藏族自治州', 25, 294);
INSERT INTO `sc_city` VALUES (295, '玉树藏族自治州', 25, 295);
INSERT INTO `sc_city` VALUES (296, '海西蒙古族藏族自治州', 25, 296);
INSERT INTO `sc_city` VALUES (297, '西安市', 23, 297);
INSERT INTO `sc_city` VALUES (298, '咸阳市', 23, 298);
INSERT INTO `sc_city` VALUES (299, '延安市', 23, 299);
INSERT INTO `sc_city` VALUES (300, '榆林市', 23, 300);
INSERT INTO `sc_city` VALUES (301, '渭南市', 23, 301);
INSERT INTO `sc_city` VALUES (302, '商洛市', 23, 302);
INSERT INTO `sc_city` VALUES (303, '安康市', 23, 303);
INSERT INTO `sc_city` VALUES (304, '汉中市', 23, 304);
INSERT INTO `sc_city` VALUES (305, '宝鸡市', 23, 305);
INSERT INTO `sc_city` VALUES (306, '铜川市', 23, 306);
INSERT INTO `sc_city` VALUES (307, '防城港市', 21, 307);
INSERT INTO `sc_city` VALUES (308, '南宁市', 21, 308);
INSERT INTO `sc_city` VALUES (309, '崇左市', 21, 309);
INSERT INTO `sc_city` VALUES (310, '来宾市', 21, 310);
INSERT INTO `sc_city` VALUES (311, '柳州市', 21, 311);
INSERT INTO `sc_city` VALUES (312, '桂林市', 21, 312);
INSERT INTO `sc_city` VALUES (313, '梧州市', 21, 313);
INSERT INTO `sc_city` VALUES (314, '贺州市', 21, 314);
INSERT INTO `sc_city` VALUES (315, '贵港市', 21, 315);
INSERT INTO `sc_city` VALUES (316, '玉林市', 21, 316);
INSERT INTO `sc_city` VALUES (317, '百色市', 21, 317);
INSERT INTO `sc_city` VALUES (318, '钦州市', 21, 318);
INSERT INTO `sc_city` VALUES (319, '河池市', 21, 319);
INSERT INTO `sc_city` VALUES (320, '北海市', 21, 320);
INSERT INTO `sc_city` VALUES (321, '拉萨市', 31, 321);
INSERT INTO `sc_city` VALUES (322, '日喀则地区', 31, 322);
INSERT INTO `sc_city` VALUES (323, '山南地区', 31, 323);
INSERT INTO `sc_city` VALUES (324, '林芝地区', 31, 324);
INSERT INTO `sc_city` VALUES (325, '昌都地区', 31, 325);
INSERT INTO `sc_city` VALUES (326, '那曲地区', 31, 326);
INSERT INTO `sc_city` VALUES (327, '阿里地区', 31, 327);
INSERT INTO `sc_city` VALUES (328, '银川市', 26, 328);
INSERT INTO `sc_city` VALUES (329, '石嘴山市', 26, 329);
INSERT INTO `sc_city` VALUES (330, '吴忠市', 26, 330);
INSERT INTO `sc_city` VALUES (331, '固原市', 26, 331);
INSERT INTO `sc_city` VALUES (332, '中卫市', 26, 332);
INSERT INTO `sc_city` VALUES (333, '塔城地区', 24, 333);
INSERT INTO `sc_city` VALUES (334, '哈密地区', 24, 334);
INSERT INTO `sc_city` VALUES (335, '和田地区', 24, 335);
INSERT INTO `sc_city` VALUES (336, '阿勒泰地区', 24, 336);
INSERT INTO `sc_city` VALUES (337, '克孜勒苏柯尔克孜自治州', 24, 337);
INSERT INTO `sc_city` VALUES (338, '博尔塔拉蒙古自治州', 24, 338);
INSERT INTO `sc_city` VALUES (339, '克拉玛依市', 24, 339);
INSERT INTO `sc_city` VALUES (340, '乌鲁木齐市', 24, 340);
INSERT INTO `sc_city` VALUES (341, '石河子市', 24, 341);
INSERT INTO `sc_city` VALUES (342, '昌吉回族自治州', 24, 342);
INSERT INTO `sc_city` VALUES (343, '五家渠市', 24, 343);
INSERT INTO `sc_city` VALUES (344, '吐鲁番地区', 24, 344);
INSERT INTO `sc_city` VALUES (345, '巴音郭楞蒙古自治州', 24, 345);
INSERT INTO `sc_city` VALUES (346, '阿克苏地区', 24, 346);
INSERT INTO `sc_city` VALUES (347, '阿拉尔市', 24, 347);
INSERT INTO `sc_city` VALUES (348, '喀什地区', 24, 348);
INSERT INTO `sc_city` VALUES (349, '图木舒克市', 24, 349);
INSERT INTO `sc_city` VALUES (350, '伊犁哈萨克自治州', 24, 350);
INSERT INTO `sc_city` VALUES (351, '呼伦贝尔市', 5, 351);
INSERT INTO `sc_city` VALUES (352, '呼和浩特市', 5, 352);
INSERT INTO `sc_city` VALUES (353, '包头市', 5, 353);
INSERT INTO `sc_city` VALUES (354, '乌海市', 5, 354);
INSERT INTO `sc_city` VALUES (355, '乌兰察布市', 5, 355);
INSERT INTO `sc_city` VALUES (356, '通辽市', 5, 356);
INSERT INTO `sc_city` VALUES (357, '赤峰市', 5, 357);
INSERT INTO `sc_city` VALUES (358, '鄂尔多斯市', 5, 358);
INSERT INTO `sc_city` VALUES (359, '巴彦淖尔市', 5, 359);
INSERT INTO `sc_city` VALUES (360, '锡林郭勒盟', 5, 360);
INSERT INTO `sc_city` VALUES (361, '兴安盟', 5, 361);
INSERT INTO `sc_city` VALUES (362, '阿拉善盟', 5, 362);
INSERT INTO `sc_city` VALUES (363, '台北市', 32, 363);
INSERT INTO `sc_city` VALUES (364, '高雄市', 32, 364);
INSERT INTO `sc_city` VALUES (365, '基隆市', 32, 365);
INSERT INTO `sc_city` VALUES (366, '台中市', 32, 366);
INSERT INTO `sc_city` VALUES (367, '台南市', 32, 367);
INSERT INTO `sc_city` VALUES (368, '新竹市', 32, 368);
INSERT INTO `sc_city` VALUES (369, '嘉义市', 32, 369);
INSERT INTO `sc_city` VALUES (370, '澳门特别行政区', 33, 370);
INSERT INTO `sc_city` VALUES (371, '香港特别行政区', 34, 371);