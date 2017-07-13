Шлюз для передачи заказов


POST http://infocdn.org/interface/api.php
Content-Type: application/json
Body:
{
    "orders": [
        {
            "country": "RU",
            "fio": "Test",
            "phone": "+79998887766",
            "user_ip": "195.33.22.11",
            "user_agent": "Mozilla\/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/54.0.2840.98 Safari\/537.36",
            "order_time": 1479732993
        }
    ],
    "system": {
        "network": "ad1",
        "thread": "thre",
        "subid": "",
        "site_key": "site_key"
    }
}




Успешный ответ:
{
  "status": "ok",
  "order_id": 1489733122,
  "additional_status": 0
}


additional_status:
0 - дефолтный статус при экспорте, все ОК
2 - модерация (проблема в настройке по офферу, обратитесь в поддержку)
4 - дубль (сработал фильтр, заказ не будет отображен в кабинете)
5 - дубль (сработал фильтр, заказ не будет отображен в кабинете)








Неуспешный ответ:
{
  "status": "error",
  "errors": [
    "error: wrong thread id"
  ]
}


