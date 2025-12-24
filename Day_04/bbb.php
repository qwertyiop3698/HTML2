<?php
    header('Content-Type:text/html; charset=utf-8');

    // 사용자가 보낸 데이터를 받기.. POST방식으로 보낸 데이터는 $_POST[] 슈퍼 전역 변수에 저장되어 있음.
    $user_id= $_POST['user_id'];
    $user_pw= $_POST['user_pw'];

    // 사용자 [web browser]에게 출력 (응답: response)
    echo "아이디:" .$user_id ;<br>
    echo "비밀번호: " .$user_pw; //php에서는 '.'연산자가 문자열의 결합 연산자임





?>