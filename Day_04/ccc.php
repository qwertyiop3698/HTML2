<?php
    header('Content-Type:text/html; charset=utf-8');

    // 사용자가 file을 보내면 실제 파일 데이터들은 임시저장소에 잠시 저장되며
    // 이 php문서는 file의 정보만 전달됨. 그 정보를 $_FILES[]라는 배열에 저장함

    $file=$_FILES['img'];

    // $file은 배열, 전송된 파일의 메타정보를 가지고 있음.
    $file_name=$file['name'];   //원본 파일명, ㅏ확장자
    $file_size=$file['size'];   //파일 사이즈 byte
    $file_type=$file['type'];   //파일 타입 MIME type
    $error=$file['error'];      //에러 정보   
    $temp_name= $file['tmp_name']; //파일 실제 데이터가 있는 임시저장소 위치(경로)

    // 파일이 제대로 받아졌는지 확인
    echo "$file_name <br>";
    echo "$file_size <br>";
    echo "$file_type <br>";
    echo "$error <br>";
    echo "$temp_name <br>";
    // 정보가 출력 된다면 이 서버에 파일이 잘 전송되아 온 것임.
    // 하지만 실제 파일데이터는 임시저장소($temp_name)에 존재함.
    // 그 파일은 이 php코드가 끝나면 서버에서 삭제됨.
    // 임시저장소에 있는 파일을 사라지지 않는 본인의 영역(html폴더 영역)으로 옮겨야 함.
    // 그래서 옮길 곳의 위치와 파일명을 정해야 함.

    // 파일명이 중복되지 않도록 현재 날짜 이용.
    $a=date('YmdHis');
    $dst_name="./uploads/". $a . $file_name;

    // 임시저장소($temp_name)의 파일을 목적하는 위치($dst_name)로 이동
    
    $result = move_uploaded_file($temp_name, $dst_name); //실행 결과 여부(T/F)
    if($result){
        echo "upload success";
    }else{
        echo "upload fail";
    }
?>