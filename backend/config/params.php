<?php
return [
    'adminEmail' => 'admin@example.com',
    'configGroup' => [
        1 => '基本配置',
        2 => '邮箱配置',
        3 => '附件配置',
    ],
    /* 图片上传插件webuploader*/
    // 图片服务器的域名设置，拼接保存在数据库中的相对地址，可通过web进行展示
	 'domain' => 'http://www.yiicms.com',       // 访问图片的域名拼接
    'imageUploadRelativePath' => './upload/images/', // 图片默认上传的目录
    'imageUploadSuccessPath' => '/upload/images/', // 图片上传成功后，路径前缀
	'webuploader' => [
	// 后端处理图片的地址，value 是相对的地址
	'uploadUrl' => 'upload/upload',
	// 多文件分隔符
	'delimiter' => ',',
	// 基本配置
	'baseConfig' => [
		'defaultImage' => '',
		'disableGlobalDnd' => true,
		'accept' => [
			'title' => 'Images',
			'extensions' => 'gif,jpg,jpeg,bmp,png',
			'mimeTypes' => 'image/*',
		],
		'pick' => [
			'multiple' => false,
		],
	],
	],
	 /* 图片上传插件webuploader*/
];
