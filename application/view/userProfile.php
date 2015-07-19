<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

 <form role="form" method="post" action="<?php echo $this->renderUrl("user",'userProfilEdit',$detail_user['id_user']); ?>">
                    
                    <table width="100%" border="0">
  <tr>
    <td>Nama User</td>
    <td><span class="form-group">
      <input type="text" name="nama_user" class="form-control" required value="<?php echo $detail_user['nama_user'] ?>">
    </span></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><span class="form-group">
      <input type="text" name="username" class="form-control" required value="<?php echo $detail_user['username'] ?>">
    </span></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><span class="form-group">
      <input type="password" name="password" class="form-control" required value="<?php echo $detail_user['password'] ?>">
      <input type="hidden" name="oldpassword" value="<?php echo $detail_user['password'] ?>">
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" class="btn btn-primary" value="Simpan"></td>
  </tr>
   </table>
</form>
</body>
</html>