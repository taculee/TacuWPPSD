<?php
/**
* Plugin Name: TacuWPPSD
* Plugin URI: https://www.taculee.com
* Description: None
* Author: Tacu Lee
* Author URI: https://www.taculee.com
* Version: 0.1.0
*/

function MBT_reset_password_message( $message, $key ) {
 if ( strpos($_POST['user_login'], '@') ) { //获取表单的数据，也就是忘记密码界面的输入框，可能是邮箱，也可能是用户名。
 $user_data = get_user_by('email', trim($_POST['user_login'])); //“trim”用于移除字符串两边的空格或是换行符。
 } else {
 $login = trim($_POST['user_login']);
 $user_data = get_user_by('login', $login);
 }
 $user_login = $user_data->user_login;
 $msg = __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
 $msg .= network_site_url() . "\r\n\r\n";
 $msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
 $msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
 $msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
 $msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
 return $msg;
}
add_filter('retrieve_password_message', MBT_reset_password_message, null, 2);
?>