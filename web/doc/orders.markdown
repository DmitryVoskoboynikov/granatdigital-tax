Работа с Заказами
=================

Получение всех заказов
----------------------

> **GET** http://domain.com/orders

####Успешный ответ:

> HTTP CODE: 200

        [
            {
                "id": 1,
                "owner": {
                    "id": 1,
                    "full_name": "Иван Иванович", 
                    "company": {
                        "id":1, 
                        "name":"Такси Везёт"
                    }, 
                    "phone": "79876543210"
                },
                "client": {
                    "id:" 1,
                    "name": "Иван",
                    "phone": "79876543210"
                },
                "options": [
                    {
                        "id": 1,
                        "description": "Детское сиденье"
                    },
                    {
                        "id": 2,
                        "description": "Некурящий водитель"
                    },
                    {
                        "id": 3,
                        "description": "Пустой багажник"
                    }
                ],
                "order_start": "2016-01-01T10:00:00+0400",
                "car_class": 1,
                "status": "новый",
                "comment": "тектовый комментарий",
                "addresses" : [
                    {
                        "id": 1,
                        "address": "Адрес 1",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    },
                    {
                        "id": 2,
                        "address": "Адрес 2",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    },
                    {
                        "id": 3,
                        "address": "Адрес 2",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    }
                ],
                "distance": "12.3"
            },
            {
                "id": 2,
                "owner": {
                    "id": 1,
                    "full_name": "Иван Иванович", 
                    "company": {
                        "id":1, 
                        "name":"Такси Везёт"
                    }, 
                    "phone": "79876543210"
                },
                "client": {
                    "id:" 1,
                    "name": "Иван",
                    "phone": "79876543210"
                },
                "options": [
                    {
                        "id": 1,
                        "description": "Детское сиденье"
                    },
                    {
                        "id": 2,
                        "description": "Некурящий водитель"
                    },
                    {
                        "id": 3,
                        "description": "Пустой багажник"
                    }
                ],
                "order_start": "2016-01-01T10:00:00+0400",
                "car_class": 1,
                "status": "новый",
                "comment": "тектовый комментарий",
                "addresses" : [
                    {
                        "id": 1,
                        "address": "Адрес 1",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    },
                    {
                        "id": 2,
                        "address": "Адрес 2",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    },
                    {
                        "id": 3,
                        "address": "Адрес 2",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    }
                ],
                "distance": "12.3"
            },
        ]



Получение конкретного заказа
----------------------------

> **GET** http://domain.com/orders/{id}


####Успешный ответ:

> HTTP CODE: 200

        {
            "id": 1,
            "owner": {
                "id": 1,
                "full_name": "Иван Иванович", 
                "company": {
                    "id":1, 
                    "name":"Такси Везёт"
                }, 
                "phone": "79876543210"
            },
            "client": {
                "id:" 1,
                "name": "Иван",
                "phone": "79876543210"
            },
            "options": [
                {
                    "id": 1,
                    "description": "Детское сиденье"
                },
                {
                    "id": 2,
                    "description": "Некурящий водитель"
                },
                {
                    "id": 3,
                    "description": "Пустой багажник"
                }
            ],
            "order_start": "2016-01-01T10:00:00+0400",
            "car_class": 1,
            "status": "новый",
            "comment": "тектовый комментарий",
            "addresses" : [
                {
                    "id": 1,
                    "address": "Адрес 1",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634",
                },
                {
                    "id": 2,
                    "address": "Адрес 2",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634",
                },
                {
                    "id": 3,
                    "address": "Адрес 2",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634",
                }
            ],
            "distance": "12.3"
        }
        
        
Добавление заказа
-----------------

> **POST** http://domain.com/orders

####Ожидаемые параметры:

| Имя                 |	Тип    | Требуется | Описание 
|---------------------|--------|-----------|----------
| city                | int    | *         |          
| phone               | string | *         |          
| name                | string |           |         
| order_start         | string | *         |          
| car_class           | int    | *         |          
| address             | string | *         |          
| address_destination | string |           |          
| comment             | string |           |           
| options             | string |           | Опции заказа в сериализированном виде (формат JSON) 
| addresses           | string | *         | Адреса в сериализированном виде (формат JSON). Требуется хотя бы 1 адес
| distance            | float  |           | 

####Пример запроса:

> Raw POST Raw

            {
                "city": 1,
                "client": {
                    "name": "Иван",
                    "phone": "89876543210"
                },
                "options": [
                    {
                        "id": 1
                    },
                    {
                        "id": 2
                    },
                    {
                        "id": 3
                    }
                ],
                "order_start": "2016-01-01T10:00:00+0400",
                "car_class": 1,
                "comment": "текстовый комментарий",
                "addresses" : [
                    {
                        "address": "Адрес 1",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    },
                    {
                        "address": "Адрес 2",
                        "latitude": "51.5353298",
                        "longitude": "46.0223634"
                    },
                    {
                        "address": "Адрес 2",
                         "latitude": "51.5353298",
                         "longitude": "46.0223634"
                    }
                ],
                "distance": "12.3"
            }
        

####Успешный ответ:

> HTTP CODE: 201

        {
            "id": 1,
            "owner": {
                "id": 1,
                "full_name": "Иван Иванович", 
                "company": {
                    "id":1, 
                    "name":"Такси Везёт"
                }, 
                "phone": "79876543210"
            },
            "client": {
                "id": 1,
                "name": "Иван",
                "phone": "89876543210"
            },
            "options": [
                {
                    "id": 1,
                    "description": "Детское сиденье"
                },
                {
                    "id": 2,
                    "description": "Некурящий водитель"
                },
                {
                    "id": 3,
                    "description": "Пустой багажник"
                }
            ],
            "order_start": "2016-01-01T10:00:00+0400",
            "car_class": 1,
            "status": "новый",
            "comment": "текстовый комментарий",
            "addresses" : [
                {
                    "address": "Адрес 1",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634"
                },
                {
                    "address": "Адрес 2",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634"
                },
                {
                    "address": "Адрес 2",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634"
                }
            ],
            "distance": "12.3"
        }
        

Редактирование заказа
---------------------

> **PATCH** http://domain.com/orders/{id}

*При редактировании заказа, можно передавать один или несколько параметров доступных для редактирования*

####Редактируемые параметры:

| Имя |	Тип | Требуется | Описание |
|---|---|---|---|
| city | int |   |   |
| phone | string |   |   |
| name | string |   |   |
| order_start | string |   |   |
| car_class | int |   |   |
| addresses | string |   |   |
| options | string |   |   |
| distance | float |   |   |

####Пример запроса:

> Raw POST

            {
                "options": [
                    {
                        "id": 2
                    },
                    {
                        "id": 3
                    },
                    {
                        "id": 4
                    }
                ],
                "addresses": [
                    {
                        "id": 1
                    },
                    {
                        "id": 3
                    },
                    {
                        "address": "Адрес 4",
                        "latitude": "52.5353298",
                        "longitude": "42.0223634"
                    }
                ],
                "distance": "8.1",
                "order_start": "2016-02-01T12:30:00+0400",
                "car_class": 2
            }
        
####Успешный ответ:

> HTTP CODE: 200

        {
            "id": 1,
            "owner": {
                "id": 1,
                "full_name": "Иван Иванович", 
                "company": {
                    "id":1, 
                    "name":"Такси Везёт"
                }, 
                "phone": "79876543210"
            },
            "client": {
                "id:" 1,
                "name": "Иван",
                "phone": "89876543210"
            },
            "options": [
                {
                    "id": 2,
                    "description": "Некурящий водитель"
                },
                {
                    "id": 3,
                    "description": "Пустой багажник"
                },
                {
                    "id": 4,
                    "description": "зарядка для iphone"
                },
            ],
            "order_start": "2016-01-01T10:00:00+0400",
            "car_class": 2,
            "status": "новый",
            "comment": "текстовый комментарий",
            "addresses" : [
                {
                    "id": 1,
                    "address": "Адрес 1",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634"
                },
                {
                    "id": 3,
                    "address": "Адрес 2",
                    "latitude": "51.5353298",
                    "longitude": "46.0223634"
                },
                {
                    "id": 4,
                    "address": "Адрес 4",
                    "latitude": "52.5353298",
                    "longitude": "42.0223634"
                }
            ],
            "distance": "8.1"
        }
        
####Удаление заказа
> **DELETE** http://domain.com/orders/{id}

####Успешный ответ:

> HTTP CODE: 204

Переходы статуса заказа
-----------------------

> **POST** http://domain.com/orders/{id}/transition