--  取消自动提交
SET @@session.autocommit = false;

USE flowerweb;
-- ----------------------------
-- 用户信息表
-- ----------------------------
CREATE TABLE IF NOT EXISTS `users`
(
    UserId       INT(11) AUTO_INCREMENT PRIMARY KEY COMMENT '用户id',
    UserName     VARCHAR(32)         NOT NULL COMMENT '用户名',
    TrueName     VARCHAR(32)         NOT NULL COMMENT '真实姓名',
    UserPassword VARCHAR(32)         NOT NULL COMMENT '密码',
    UserSex      VARCHAR(10)         NOT NULL COMMENT '用户性别',
    UserAge      TINYINT(3) UNSIGNED NOT NULL COMMENT '年龄',
    UserEmail    VARCHAR(64)         NULL COMMENT '邮箱',
    UserPhone    VARCHAR(16)         NOT NULL COMMENT '联系电话',
    UserAddress  VARCHAR(255)        NULL COMMENT '常用地址',
    UserImage    VARCHAR(255)        NULL COMMENT '用户头像图片访问路径',
    UserPower    VARCHAR(1)          NOT NULL COMMENT '用户权限 0-普通用户 1-管理员',
    RegisterTime DATETIME            NOT NULL COMMENT '注册时间',
    ConsumeNum   FLOAT UNSIGNED               DEFAULT '0.00' NULL COMMENT '消费金额',
    IsVIP        VARCHAR(1)          NOT NULL DEFAULT '0' COMMENT '是否为VIP'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8 COMMENT ='用户信息表';

-- 插入admin用户
INSERT INTO flowerweb.users (UserId, UserName, TrueName, UserPassword, UserSex, UserAge, UserEmail, UserPhone,
                             UserAddress, UserImage, UserPower, RegisterTime, IsVIP)
VALUES (1, 'admin', '管理员', '123456', '男', 24, '123123@qq.com', '18812345678', '北京林业大学', '', '1',
        '2018-04-02 11:49:19', '1');

COMMIT;
-- ----------------------------
-- 商品信息表
-- ----------------------------
CREATE TABLE IF NOT EXISTS `goods`
(
    GoodId      INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT '商品id',
    GoodName    VARCHAR(128)     NOT NULL COMMENT '商品名称',
    GoodSummary VARCHAR(255)     NOT NULL COMMENT '商品简介',
    GoodPrice1  FLOAT UNSIGNED   NOT NULL COMMENT '普通价格',
    GoodPrice2  FLOAT UNSIGNED   NOT NULL COMMENT 'VIP价格',
    GoodNumber  INT(11) UNSIGNED NOT NULL COMMENT '商品数量',
    SoldNumber  INT(11) UNSIGNED NOT NULL COMMENT '已售数量',
    GoodSize    INT(11) UNSIGNED NOT NULL COMMENT '商品规格id',
    GoodMessage VARCHAR(255)     NOT NULL COMMENT '详细信息',
    GoodImage   VARCHAR(255)     NULL COMMENT '商品图片路径',
    UpdateTime  DATETIME         NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8 COMMENT ='商品信息表';

-- todo 新增商品信息

COMMIT;

-- ----------------------------
-- 网站全局信息表
-- ----------------------------
CREATE TABLE IF NOT EXISTS `globaldescription`
(
    BrandStory        VARCHAR(255) NOT NULL COMMENT '品牌故事',
    CareDescription   VARCHAR(255) NOT NULL COMMENT '保养说明',
    TransDescription  VARCHAR(255) NOT NULL COMMENT '运输说明',
    ChangeDescription VARCHAR(255) NOT NULL COMMENT '退换货说明'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8 COMMENT ='网站全局信息表';

-- 新增网站全局信息
INSERT INTO globaldescription (BrandStory, CareDescription, TransDescription, ChangeDescription)
VALUES ('每一朵花都有自己的语言，能够传递出独特的情感和故事。因此，法兰沃不仅是一家花店，更是一个传递美好的使者。我们希望通过我们的努力，让更多人能够感受到花朵带来的幸福和满足。',
        '请将花朵放置在温度适宜（15-25℃）、湿度适中的室内环境中，避免阳光直射和空调直吹；请每天为花朵更换清洁的自来水，并剪掉花茎底部1-2厘米，以保持吸水通畅。',
        '1、在您下单后，我们会在最短时间内为您安排发货；2、您可通过物流单号随时查询订单状态；3、请您在收货后尽快检查花朵状态，如有问题请及时联系。',
        '如您在收到花朵后发现存在质量问题（如花朵枯萎、破损等），请在收到货物后24小时内联系我们，并提供相关照片作为凭证。我们将为您免费更换或退款。');

COMMIT;

-- ----------------------------
-- 订单信息表
-- ----------------------------
CREATE TABLE IF NOT EXISTS `orders`
(
    OrderId     INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT '订单id',
    OrderTime   DATETIME     NOT NULL COMMENT '订单时间',
    Goods       VARCHAR(255) NOT NULL COMMENT '包含商品，以 商品id,商品数量 形式存储，多个用|分隔',
    UserName    VARCHAR(32)  NOT NULL COMMENT '购买用户',
    ReceiveName VARCHAR(32)  NOT NULL COMMENT '收件人姓名',
    Phone       VARCHAR(16)  NOT NULL COMMENT '联系电话',
    Address     VARCHAR(255) NOT NULL COMMENT '收货地址',
    Words       VARCHAR(255) NULL COMMENT '用户留言',
    OrderPrice  FLOAT        NOT NULL COMMENT '订单金额',
    IsPaid      VARCHAR(1)   NOT NULL COMMENT '是否付款 0-未付款 1-已付款'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC COMMENT ='订单信息表';


COMMIT;

-- ----------------------------
-- 评论信息表
-- ----------------------------
CREATE TABLE IF NOT EXISTS `comments`
(
    CommentId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT '评论id',
    Time      DATETIME         NOT NULL COMMENT '评论时间',
    GoodId    INT(11) UNSIGNED NOT NULL COMMENT '商品id',
    UserName  VARCHAR(32)      NOT NULL COMMENT '评论用户名',
    Content   VARCHAR(255)     NOT NULL COMMENT '评论内容'
) ENGINE = InnoDB
  CHARACTER SET = utf8 COMMENT = '评论信息表';

-- ----------------------------
-- 鲜花信息表
-- ----------------------------
CREATE TABLE IF NOT EXISTS `flowers`
(
    FlowerName   VARCHAR(32) NOT NULL PRIMARY KEY COMMENT '鲜花名称',
    FLowerCost   FLOAT       NOT NULL COMMENT '鲜花成本',
    FlowerPrice  FLOAT       NOT NULL COMMENT '鲜花售价',
    FlowerNumber INT(11)     NOT NULL COMMENT '鲜花库存量',
    SoldNumber   INT(11)     NOT NULL COMMENT '鲜花销售量',
    SoldProfit   FLOAT       NOT NULL COMMENT '鲜花利润'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8 COMMENT ='鲜花信息表';

-- 新增鲜花信息

INSERT INTO flowers(FlowerName, FLowerCost, FlowerPrice, FlowerNumber, SoldNumber, SoldProfit)
VALUES ('红玫瑰', 1, 10, 10000, 0, 0),
       ('满天星', 2, 7, 10000, 0, 0),
       ('百合', 3, 8, 10000, 0, 0),
       ('紫玫瑰', 4, 6, 10000, 0, 0),
       ('蓝玫瑰', 5, 13, 10000, 0, 0),
       ('郁金香', 6, 20, 10000, 0, 0),
       ('白玫瑰', 7, 16, 10000, 0, 0),
       ('向日葵', 8, 15, 10000, 0, 0),
       ('康乃馨', 9, 18, 10000, 0, 0),
       ('玛利亚', 10, 30, 10000, 0, 0);

-- ----------------------------
-- 规格信息表
-- ----------------------------
CREATE TABLE IF NOT EXISTS `goodsizes`
(
    SizeId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT '规格id',
    红玫瑰 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '红玫瑰数量',
    满天星 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '满天星数量',
    百合   INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '百合数量',
    紫玫瑰 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '紫玫瑰数量',
    蓝玫瑰 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '蓝玫瑰数量',
    郁金香 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '郁金香数量',
    白玫瑰 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '白玫瑰数量',
    向日葵 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '向日葵数量',
    康乃馨 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '康乃馨数量',
    玛利亚 INT(11) UNSIGNED DEFAULT '0' NOT NULL COMMENT '玛利亚数量'
) ENGINE = InnoDB
  CHARACTER SET
      = utf8 COMMENT = '规格信息表';

-- todo 新增规格信息

COMMIT;
