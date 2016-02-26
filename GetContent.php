<?php

/**
 * php有三种方法可以post数据,分别为Curl、socket、file_get_contents
 *1、Socket以流的方式去实现数据的输入输出
 *2、抓取页面不易实现处理，无法设置抓取参数，
 *3、curl函数切实模拟浏览器的数据传输，最详尽的处理方法（一般分四个步骤，初始化，设置参数，抓取，关闭资源）
 *
 */

//一个兴趣偶然想抓取一个网页的接口反馈数据，那么我采用curl代码如下：

		$code_box = "";
		$post_string = "";

		$post_string = '__VIEWSTATE=%2FwEPDwUJMzQ1OTM2MjY4ZGRHXhfY%2Bmx5rwVxsBTl13S3ZMfq%2B0Tm80d3u3cjIJAEEw%3D%3D&__VIEWSTATEGENERATOR=53579901&__EVENTVALIDATION=%2FwEdAAgn%2FckPqSTBOyN8IWuH2rvagG4%2FQ96yI2vClMUHwHbfZ%2FGAvZ%2F2bNpXUPdTcesnOAKx9blkKx6mEYBuT0kSdWXnD%2FHwDksZ%2BFIIFydjM61mCCMrMmVc%2FaFq%2FRd9qlmvjRguMCY5U84NCJfN58YXBJKYpA7D3VqgJhuNY%2F36bZPDZutCKAC75UbeeTXVGOhWjPR99xyY4lCql5qL7gAe5hii';
		$post_string = $post_string . '&dev_box=' . $dev_box . '&code_box=' . $code_box . '&button1=%E6%9F%A5%E8%AF%A2' . '&demo_box=' . '&jjff_box=';
		$data = request_by_curl ( 'http://wandaoa.f3322.org:7280/code/', $post_string );
	
	if ($data == null) {
		 echo "并没有数据返回";
		//return "并没有数据返回";
	} else {
		$pa = '%<textarea.*?>(.*?)</textarea>%si';
		preg_match_all ( $pa, $data, $match );
		if ($match == null) {
			// echo "未找到匹配项目";
			//return "未找到匹配项目";
		} else {
			echo '错误摘要：' . $match [1] [0] . "\n\n详细信息：" . $match [1] [1];
			//return '错误摘要：' . $match [1] [0] . "\n\n详细信息：" . $match [1] [1];
		}
	}
	function request_by_curl($remote_server, $post_string) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $remote_server );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_string );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt ( $ch, CURLOPT_USERAGENT, "352729464@qq.com" );
		$date = curl_exec ( $ch );
		curl_close ( $ch );
		return $date;
	}

?>