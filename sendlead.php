<?php
  #echo json_encode(sendDataToBitrix('profile', []), JSON_UNESCAPED_UNICODE);
  echo json_encode(addDeal(), JSON_UNESCAPED_UNICODE);


  function sendDataToBitrix($method, $data) {
    $queryUrl = 'https://ooosaga.bitrix24.ru/rest/1/rcc38kc7ojko3ipm/' . $method ;
    $queryData = http_build_query($data);

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_POST => 1,
      CURLOPT_HEADER => 0,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $queryUrl,
      CURLOPT_POSTFIELDS => $queryData
    ));

    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, 1);
  }

  function addDeal() {
    $dealData = sendDataToBitrix('crm.deal.add', [
      'fields' => [
        'TITLE' => 'Заявка пупки',
        'STAGE_ID' => 'NEW'
      ],
      'params' => [
        'REGISTER_SONET_EVENT' => 'Y'
      ]
    ]);

    return $dealData;
  }
?>
