<?php
include_once('lib/simple_html_dom.php');
include_once('lib/curl_querry.php');

file_put_contents('christ_iptv.m3u8', '#EXTM3U'. PHP_EOL);

//$christ_iptv_file = "christ_iptv.m3u8";
function get_live_href($dom, $num_str){
		$names = $dom->find('.yt-lockup-title');
		
		foreach($names as $name) {   ///выходит ровно 29 последних видео из канала
			$title = $name->find('a', 0);
			
			
			$a = $name->find('a', 0);
			
			
			$span = $name->find('span',0);  ///тривалость
			if( !($span->plaintext)){
				//$file_christ_iptv = file('./christ_iptv.m3u8');//преобразуем файл в массив
				echo $title->innertext . '<br>';
				echo 'https://www.youtube.com'. $a->href . '<br>';
				echo '<a href="'.'https://www.youtube.com'. $a->href.'">У прямому ефірі </a> <br><br>';
				//file_put_contents("youtube_live.m3u8", "#EXTINF:-1,".$title->innertext. PHP_EOL, FILE_APPEND);
				//file_put_contents("youtube_live.m3u8", 'https://www.youtube.com'. $a->href. PHP_EOL, FILE_APPEND);
				
				//$file_christ_iptv[$num_str] = 'https://www.youtube.com'. $a->href. PHP_EOL;
				
				file_put_contents('christ_iptv.m3u8','#EXTINF:-1,'.$title->innertext.' YouTube'. PHP_EOL, FILE_APPEND);
				file_put_contents('christ_iptv.m3u8','https://www.youtube.com'. $a->href. PHP_EOL, FILE_APPEND);
				break; ///убрать для поиска и вывода всех видео
			}
			//echo $span->plaintext . '<br>'; 
			//echo '<br>';
		}
		
	}
	

$file_iptv_world = file('http://iptv.slynet.tv/FreeWorldTV.m3u'); //преобразуем файл в массив
$file_iptv_ukr_rus = file('http://iptv.slynet.tv/FreeSlyNet.m3u'); //преобразуем файл в массив
$file_iptv_free_best = file('http://iptv.slynet.tv/FreeBestTV.m3u'); //преобразуем файл в массив

$arr_search_list = file('./ch/world_our.txt'); //преобразуем файл в массив
$arr_search_list_world = file('./ch/world.txt'); //преобразуем файл в массив
$arr_search_list_free = file('./ch/free.txt'); //преобразуем файл в массив
$arr_search_list_free_best = file('./ch/free_best.txt'); //преобразуем файл в массив

foreach($arr_search_list as $search_line){
	foreach($file_iptv_world as $key=>$line){
		if(stristr($line, rtrim($search_line))){
			echo stristr($line, rtrim($search_line)). '<br>';
			echo $file_iptv_world[$key+1].'<br>';
			file_put_contents('christ_iptv.m3u8', stristr($line, rtrim($search_line))	, FILE_APPEND);
			file_put_contents('christ_iptv.m3u8', $file_iptv_world[$key+1]					, FILE_APPEND);
		}   
	}
}
unset($search_line);
unset($line);

get_live_href(str_get_html(curl_get('https://www.youtube.com/user/vemmanuiltv/videos')), 37-1);
get_live_href(str_get_html(curl_get('https://www.youtube.com/channel/UCGdTwGYLQUuWkw-lWpzgOUQ/videos')), 39-1);
get_live_href(str_get_html(curl_get('https://www.youtube.com/user/cerkvaspasinnya/videos')), 41-1);

foreach($arr_search_list_free as $search_line){
	foreach($file_iptv_ukr_rus as $key=>$line){
		if(stristr($line, rtrim($search_line))){
			echo stristr($line, rtrim($search_line)). '<br>';
			echo $file_iptv_ukr_rus[$key+1].'<br>';
			file_put_contents('christ_iptv.m3u8', stristr($line, rtrim($search_line))	, FILE_APPEND);
			file_put_contents('christ_iptv.m3u8', $file_iptv_ukr_rus[$key+1]					, FILE_APPEND);
		}   
	}
}

foreach($arr_search_list_free_best as $search_line){
	foreach($file_iptv_free_best as $key=>$line){
		if(stristr($line, rtrim($search_line))){
			echo stristr($line, rtrim($search_line)). '<br>';
			echo $file_iptv_free_best[$key+1].'<br>';
			file_put_contents('christ_iptv.m3u8', stristr($line, rtrim($search_line))	, FILE_APPEND);
			file_put_contents('christ_iptv.m3u8', $file_iptv_free_best[$key+1]					, FILE_APPEND);
		}   
	}
}

file_put_contents('christ_iptv.m3u8','#EXTINF:-1,Life TV Estonia'. PHP_EOL, FILE_APPEND);
echo '#EXTINF:-1,Life TV Estonia'.'<br>';
file_put_contents('christ_iptv.m3u8','MMS://ONLINE.LIFETV.EE/1'. PHP_EOL, FILE_APPEND);
echo 'MMS://ONLINE.LIFETV.EE/1'.'<br>';


unset($search_line);
unset($line);
////last - потому что тут не-укр-рос каналы
foreach($arr_search_list_world as $search_line){
	foreach($file_iptv_world as $key=>$line){
		if(stristr($line, rtrim($search_line))){
			echo stristr($line, rtrim($search_line)). '<br>';
			echo $file_iptv_world[$key+1].'<br>';
			file_put_contents('christ_iptv.m3u8', stristr($line, rtrim($search_line))	, FILE_APPEND);
			file_put_contents('christ_iptv.m3u8', $file_iptv_world[$key+1]					, FILE_APPEND);
		}   
	}
}



?>