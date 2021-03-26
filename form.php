<?php

function valid(array $post): array
{
    $validate = [
        'error' => false,
        'success' => false,
        'messages' => [],
    ];



    if (!empty($post['login']) && !empty($post['password']) && !empty($post['firstName']) && !empty($post['lastName'])) {
        $login = trim($post['login']); //trim - очищает строку
        $password = trim($post['password']);
        $firstName = trim($post['firstName']);
        $lastName = trim($post['lastName']);

        $constrains = [
            'login' => 6,
            'password' => 7,
            'firstName' => preg_match("/^[а-яА-Я ]*$/", $firstName),
            'lastName' => preg_match("/^[а-яА-Я ]*$/", $lastName)
        ];


        $validateForm = valigData($login, $password, $firstName, $lastName, $constrains);

        if (!$validateForm['login']) {
            $validate['error'] = true;
            array_push($validate['messages'],
                "логин должен быть длиной не менее чем {$constrains['login']} символов");
        }

        if (!$validateForm['password']) {
            $validate['error'] = true;
            array_push($validate['messages'],
                "пароль должен быть длиной не менее чем {$constrains['password']} символов");
        }

        if (!$validateForm['firstName']) {
            $validate['error'] = true;
            array_push($validate['messages'],
                "имя должно содержать русские только буквы и пробелы!");
        }

        if (!$validateForm['lastName']) {
            $validate['error'] = true;
            array_push($validate['messages'],
                "фамилия должна содержать только русские буквы и пробелы!");
        }
        if (!$validate['error']){
            $validate['success'] = true;
            array_push($validate['messages'],"Ваш логин:{$login}",
                "Ваш пароль:{$password}",
                "Ваше имя:{$firstName}",
                "Ваша фамилия:{$lastName}"
            );
        }
        return $validate;
    }
    return $validate;

}


function valigData(string $login, string $password,string $firstName,string $lastName,array $constrains): array{

    $validateForm = [
        'login' => true,
        'password' => true,
        'firstName' => true,
        'lastName' => true,
    ];

    if (strlen($login) < $constrains['login']) {
        $validateForm['login'] = false;
    }

    if (strlen($password) < $constrains['password']) {
        $validateForm['password'] = false;
    }

    if (!preg_match('/^[а-яё ]++$/ui',$firstName)) {
        $validateForm['firstName'] = false;
    }

    if (!preg_match('/^[а-яё ]++$/ui',$lastName)) {
        $validateForm['lastName'] = false;
    }

    return $validateForm;

}