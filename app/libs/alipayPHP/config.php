<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101300676944",

		//商户私钥
		'merchant_private_key' => "MIIEogIBAAKCAQEAuxCWrH2/5WzFEkZPx5DIYoWFO/VDMDx3zCyatqL0DhXd5FDE2UpZbYK3oJI9MURafgYbipi9+k5iHHCQHLzS2VVWHD7MYDhEu0Q8gAuvLrFBXcgokyukwar34dhmUGdrs9UopUpdwC8GfWqLBTM2OGgwaNaNDxLNnxfNlINpVpvT/lMubCyAfUxzvfGWT5ttaXjiouHKIHCU6kL3awHXPXjVi3Kb9VBku3H10v8rOsRG/rQHid913qaEAQfZTbzQ8gZjD/Vtfll15WOcM0PJwIfY85hc5AT+jH2JVus0op3a5Lt/iZkjBMTiHuhpoY/lgFaAKai8Cj0fSEJz5Ij7/QIDAQABAoIBAEQcOCA58QLh5adPvoCVMMDeiLJaDMqlWaEXpIVXM7FlONOGrQXI0mLTM3TdijZEAwbbxm9iSdm3bHWabn5oKgVD0wSZwORP2Iauw7CDkJdZpsk0tcFQJL73NyYeGrKv1UE3HYOBXj05Yg2MG24bRWSoWufxJo8Uc5W3nvyyFEqZ9sQSbsRMjQhy215mT3ryvgcDYdDiTrQoZVExskOFOU0SGDqvh5U5+aHzl4NKeiZhR2l9xoYjM3xyXFFWbMu89A1gdMMuwETjdphOfmngdBJ8yRvWN44vF1qPiiQ0pwd1NIrCSTPX52jPh2essqAsvo8XTvwEaoVFog3den7AG+kCgYEA5M6cpznMR2GyMc4OZRTDHfhC/1ZdzIAIRCeIgIbH0y5I0a1T6JgBlOy/OS7hyEgDd7mqJKMjh+ctZhXjP2xo6tzP5vgeXFjbREQwLbKf3zUtIM7ZpQcSyd1aaFsXDFgWLaB2nb1qlq3p0fsOBsdr055Xdcm/gWrSN8aVcbaNNlsCgYEA0Uv65tJMz9oYrrWHVmEfEGewp38F+tqLGjjbr2q5B+AeNqs0q1/drslMps9koPhsgirewhhNUwKW3n7oSOwaCEKGIWvDNDXpAsrLNWx2MUbrcvtcu2Cu8ag39K2nRzWFd38drlfPast2fj4zaCR+wm4sop4DYQMak9+pRWwolocCgYBIEt09v/MdOSUMkz/tj1C3DBDupaH+XQY9kcZp1grz9sxxYAviZJ967eh+dsogcK7G8/EogUsb8DJYyeQ/gkK6WLwUoWvO4x6OrnwOqQm7IeEJSJ8+YLAGbnegD7F+7fBuhvFWVuhQdpAE2PReJktM6b/bFqYAekml0CQbIcnxqQKBgC4Ley1gwslPf/KfuSCFyWHAjhqrVVN01Pl13M7guchDxCHe1H2HX6veWWCxa8AGJ0kTyWIGGqzSewKEBPJWDvwWNpAPtyg7XAHjP4WHURFSOuZW6nXGtXYwve60bYK7AZvieVMrulQSYwUvBfw5WzHHL0avYKrtFeHGaOT/AIbtAoGANf9Ag6i8qWCdEDfs63/ZdW+kuLddGe1DbLuIj0EMZoNbg2/KNlb+HnwQkOLdnIasFbFLooQ5ZwtQKHywpt/k9TOOCUahWYy9fWljDKWmuHzNw25alAN+Xps6R0gasu0b4h8iyAfUKV4UVu4hpFe9R2Ge9GOd/bD0BKk+Mnr67fQ=",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB",
);