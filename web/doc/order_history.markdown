Работа с Заказами
=================

Получение истории по заказу
----------------------

> **GET** http://domain.com/orders/{id}/history

####Успешный ответ:

> HTTP CODE: 200

        [
            {
                "id": 1,
                "created_at": "2016-01-01T09:00:00+0400",
                "prev_status": "",
                "status": "new",
                "owner": {
                    "id": 1,
                    "full_name": "Иванов Иван Иванович",
                },
                "description": "Заказ создан"
            },
            {
                "id": 1,
                "created_at": "2016-01-01T09:00:00+0400",
                "prev_status": "new",
                "status": "progress",
                "owner": {
                    "id": 1,
                    "full_name": "Иванов Иван Иванович",
                },
                "description": "Заказ выполняется"
            },
        ]
     