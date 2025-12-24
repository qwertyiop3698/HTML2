<?php
    header('Content-Type:text/html; charset=utf-8');

    // 사용자가 POST방식으로 보낸 글씨 데이터 (글제목,글내용) 취득
    $title=$_POST['title'];
    $message=$_POST['msg'];

    // 사용자가 보낸 파일은 별도로 받아야 함.
    // 실제 파일데이터 덩어리는 임시저장소에 저장되고
    // php 문서에는 파일에 대한 정보를 가진 배열이 전달됨.
    $file=$_FILES['img'];

    // 파일정보들(5개) 중에서 필요한 것만 변수로 받기
    $file_name=$file['name'];
    $file_size=$file['size'];
    $temp_name=$file['tmp_name'];

    // 데이터들이 온전히 서버에 도착했는지 확인해보기
    echo "$title <br>";
    echo "$message <br>";
    echo "$file_name <br>";
    echo "$file_size <br>";
    echo "$temp_name <br>";
    echo "<hr>";
    
    // 업로드된 실제 파일데이터는 임시저장소에 있기에 곧 사라짐.
    // 그래서 특정폴더 위치로 이동 해야함.
    // 이동시킬 위치를 먼저 만들기
    $dst_name="./file/".date('YmdHis') .$file_name;

    // 임시 저장소($temp_name) 의 파일을 원하는 위치에 이동
    $move_result=move_uploaded_file($temp_name, $dst_name); // 이동결과를 T/F로 리턴
    if($move_result){
        echo "<p>upload success</p>";
    }else{
        echo "<p>upload failed</p>";
    }

    echo "<hr>";

    // 글씨 데이터와 파일데이터가 온전히 온것을 확인.
    // 이제 데이터를 DB에 저장하기

    // 0.준비) Database에 [게시글 데이터]를 저장할 표(테이블{name: board})을 만들어 놓기
    // 0.준비) board 테이블에 저장할 데이터 확인($title, $message, $dst_name, $now)
    $now=date('Y-m-d H-i-s');

    // MY SQL DBMS을 사용한 데이터 저장 작업
    
    // 1. MY SQL 접속하기

    $db=mysqli_connect('localhost','toma2025','PUNX4fSx!H6d3c','toma2025'); // DB 서버주소,접속ID, 접속PW, DB이름

    // 2. MYSQL은 한글이 깨져서 문자셋을 utf-8로 설정해야 함
    mysqli_query($db,'set names utf8');

    
    // 3. 원하는 CRUD 작업에 대한 SQL 쿼리문을 작성하고 요청(실행)
    if($file_name){
        $sql="INSERT INTO board (title, msg, file_path, reg_date) VALUES ('$title','$message','$file_path','$dst_name','$now')";
    }else{
        $sql="INSERT INTO board (title, msg, file_path, reg_date) VALUES ('$title','$message','$dst_name','$now')";
    }
    $result=mysqli_query($db,$sql);  // 실행결과를 리턴해줌 

    if($result){
        echo "<h3> INSERT SUCCESS</h3>";
    }else{
        "<h3> INSERT SUCCESS</h3>";
    }

    // 4.DB와 연결 종료
    mysqli_close($db);




?>