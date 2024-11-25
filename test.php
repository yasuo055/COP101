<?php 

$password = '123pogi';

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$hashed = '$2y$10$VX/ZcJhRxUaMt.QAj2Plye/9R12PXA8rMqPBKhm82mhJnCod7pBU2';

if (password_verify($password, $hashed)) {
    echo "login success Hashed text:".$hashed;
} else{
    echo "invalid hashed TExt".$hashed;
}

?>