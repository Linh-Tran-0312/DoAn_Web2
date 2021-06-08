<?php 
 require_once('./services/connectionSQL.php');  

 # Hàm xử lý đăng nhập nhận vào email và password trả về kết quả gồm tin nhắn và user
function Login($email, $password) {
    global $connection;
    $message = "";
    $user = "";
    
    $sql = "SELECT * FROM `nhanvien` WHERE `Email` = '$email' AND `Password`= '$password'";
    $data = mysqli_query($connection, $sql);
    $n = mysqli_num_rows($data);
    if($n == 0) {
        $message = "Email hoặc mật khẩu không chính xác vui lòng thử lại";
        $result = array('message' => $message, 'user' => $user);
        return $result;
    } else {  
        while($nhanvien=mysqli_fetch_assoc($data)) {
        #$sql = "SELECT * FROM `nhanvien` JOIN `phongban` ON `nhanvien`.`MaPhongBan` = `phongban`.`MaPhongBan` WHERE `nhanvien`.`MaNhanVien` = '".$nhanvien['MaNhanVien']."'";
        #$data = mysqli_query($connection, $sql);
            $user = $nhanvien;
            $message= "Successful";
            $result= array('message' => $message, 'user' => $user);
            return $result;
    }   
}
}
function Register($info) {
    global $connection;
    $message = "";
    $user = "";
    
    $Email = $info['email'];
    $Password = $info['password'];
    $Role = $info['role'];
    $FullName = $info['name'];
    $Position = $info['position'];
    $Department = $info['department'];

    $sql = "SELECT `nhanvien`.`Email` FROM `nhanvien` WHERE `nhanvien`.`Email`='$Email'";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);   
    if($num_rows == 0) {  
        $sql = "INSERT INTO `nhanvien`(`Email`, `Password`, `MaPhongBan`, `Role`, `TenNhanVien`, `ChucDanh` ) VALUES ('$Email','$Password', '$Department','$Role','$FullName','$Position')";
         $insert = mysqli_query($connection, $sql);
         if($insert == true) {
            $sql = "SELECT * FROM `nhanvien` WHERE `nhanvien`.`Email` = '$Email'";
            $data_nv = mysqli_query($connection, $sql);
            $num_rows = mysqli_num_rows($data_nv);   
            if($num_rows > 0) {
                while($nhanvien=mysqli_fetch_assoc($data_nv)) {                 
                    $user = $nhanvien;                   
                }
                $message = "Successful";
                $result = array(
                    'user' => $user,
                    'message' => $message
                );
                return $result;
            }
            else {
                $message = "Lỗi không thể tải thông tin người dùng !";
                $result = array(
                    'user' => $user,
                    'message' => $message
                );
                return $result;
            }

         }
         else {
            $message = "Lỗi kết nối với cơ sở dữ liệu !";
            $result = array(
                'user' => $user,
                'message' => $message
            );
            return $result;
        }
    } else {
        $message = "Email này đã được sử dụng, vui lòng thử lại với email khác !";
        $result = array(
            'user' => $user,
            'message' => $message
        );
        return $result;
    }
    
}
function getProfile($userId) {
    global $connection;
    $profile = "";
    $sql = "SELECT `n`.`MaNhanVien`, `n`.`Hinh`,`n`.`Email`, `n`.`MaPhongBan`, `n`.`Role`, `n`.`TenNhanVien`, `n`.`CongViec`, `n`.`ChucDanh`, `n`.`DiaChi`, `n`.`SoDienThoai`, `p`.`TenPhongBan` FROM `nhanvien` AS `n` JOIN `phongban` AS `p` ON `n`.`MaPhongBan`=`p`.`MaPhongBan` WHERE `n`.`MaNhanVien`= '$userId'";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
    while($nhanvien=mysqli_fetch_assoc($data)) {
        $profile = $nhanvien;
        }
    }

    return $profile;
}
function updateProfile($profile) {
    global $connection;
    $id = $profile['id'];
    $name = $profile['name'];
    $position = $profile['position'];
    $description = $profile['job_description'];
    $departmentId = $profile['department'];
    $phone = $profile['phone'];
    $email = $profile['email'];
    $address = $profile['address'];

    $sql = "UPDATE `nhanvien` SET `Email`= '$email', `MaPhongBan`='$departmentId',`TenNhanVien`='$name',`CongViec`= '$description',`ChucDanh`= '$position',`DiaChi`= '$address',`SoDienThoai`= '$phone' WHERE `MaNhanVien` = '$id'";
    mysqli_query($connection, $sql);
}

function uploadAvatar($userId, $imageContent) {
    global $connection;
    $sql = "UPDATE `nhanvien` SET `Hinh`='$imageContent' WHERE `MaNhanVien`='$userId'";

    mysqli_query($connection, $sql);

}
function getStaffList($departmentId) {
    global $connection;
    $list = [];
    $sql= "SELECT `nhanvien`.`TenNhanVien`,`nhanvien`.`Hinh`, `nhanvien`.`ChucDanh`,`nhanvien`.`MaNhanVien` from `nhanvien` WHERE `nhanvien`.`Role`='0' AND `nhanvien`.`MaPhongBan`='$departmentId'";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
      while($staff=mysqli_fetch_assoc($data)) {
      array_push($list, $staff);
      }
    }
    return $list;
}

?>