<?php

$key = ''; // API KEY (ключ указанный на сайте liveopencart.ru в настройках автора)

include('liveopencart/api_msg.php');

$api_msg = new liveopencart\api_msg($key);
$data = $api_msg->getDecodedDataFromPost(); // получаем данные запроса

if ( $data ) {
	$answer = 'OK';
	
	// выполням все необходимые манипуляции (сохраняем информацию о заказе, генерируем ключи и т.п.)
	
	//$data->marketplace	//Идентификатор торговой площадки - liveopencart
	//$data->order_id		//Номер заказа
	//$data->order_status	//Статус заказа (текст)
	//$data->username		//Имя покупателя
	//$data->email			//email покупателя
	//$data->member_id		//id покупателя на торговой площадке
	//$data->date_added		//Дата покупки
	//$data->extension_id	//ID товара в торговой площадке
	//$data->extension		//Название дополнения
	//$data->quantity		//Количество
	//$data->total			//Доход без учета комиссии
	//$data->domain 		//Домен где будет установлено дополнение
	//$data->test_domain 	//Тестовый домен на этап разработки сайта 
	
} elseif ( $data === false ) {
	$answer = 'Wrong hash';
} else {
	$answer = 'Wrong request';
}

echo $api_msg->generateEncodedMsg($answer); // возвращаем ответ


// пример возможного сохранения статистики запросов API
//$log_file = 'api_client.txt';
//$f = fopen($log_file, 'a+');
//fwrite($f, '============== '.date('Y-m-d G:i:s').' =============='."\n");
//fwrite($f, print_r($_POST, true)."\n");
//fwrite($f, print_r($data, true)."\n");
//fwrite($f, $answer."\n");
//fclose($f);


