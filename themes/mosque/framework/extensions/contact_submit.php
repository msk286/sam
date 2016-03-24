<?php

add_action('wp_ajax_cp_contact_submit', 'cp_contact_submit');
add_action( 'wp_ajax_nopriv_cp_contact_submit', 'cp_contact_submit' );	
function cp_contact_submit(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = $values;
	}

	if(isset($form_submitted) AND $form_submitted == 'form_submitted'){
		$subject = "Contact Form Received";
		$message = '
			<table width="100%" border="1">
			  <tr>
				<td width="100"><strong>Name:</strong></td>
				<td>'.esc_attr($name_contact).'</td>
			  </tr>
			  <tr>
				<td><strong>Email:</strong></td>
				<td>'.is_email($email_contact).'</td>
			  </tr>
			  <tr>
				<td><strong>Message:</strong></td>
				<td>'.esc_attr($message_comment).'</td>
			  </tr>
			  <tr>
				<td><strong>IP Address:</strong></td>
				<td>'.$_SERVER["REMOTE_ADDR"].'</td>
			  </tr>
			</table>
			';
		$headers = "From: " . $name_contact . "\r\n";
		$headers .= "Reply-To: " . $email_contact . "\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$attachments = '';
		if($name_contact <> '' AND is_email($email_contact)){
			wp_mail( $receiver, $subject, $message, $headers, $attachments );
			echo '<div class="alert success">';
			echo esc_attr($successful_msg_contact);
			echo '</div>';
		}else{
			echo '<div class="alert error">';
			echo esc_attr($un_successful_msg_contact);
			echo '</div>';
		}
	}else if(isset($form_reserve) AND $form_reserve == 'form_reservation'){
	$subject = "Contact Form Received";
		$message = '
			<table width="100%" border="1">
			  <tr>
				<td width="100"><strong>Name:</strong></td>
				<td>'.esc_attr($first_name).'</td>
			  </tr>
			  <tr>
				<td><strong>Phone Number:</strong></td>
				<td>'.esc_attr($phone_number).'</td>
			  </tr>
			  <tr>
				<td><strong>Date:</strong></td>
				<td>'.esc_html($date_reserve).'</td>
			  </tr>
			  <tr>
				<td><strong>Email:</strong></td>
				<td>'.is_email($email_reserve).'</td>
			  </tr>
			  <tr>
				<td><strong>People Arriving:</strong></td>
				<td>'.esc_attr($people_arriving).'</td>
			  </tr>
			  <tr>
				<td><strong>Ocassion:</strong></td>
				<td>'.esc_attr($ocassion_reserve).'</td>
			  </tr>
			  
			  <tr>
				<td><strong>IP Address:</strong></td>
				<td>'.$_SERVER["REMOTE_ADDR"].'</td>
			  </tr>
			</table>
			';
		$headers = "From: " . esc_attr($first_name) . "\r\n";
		$headers .= "Reply-To: " . is_email($email_reserve) . "\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$attachments = '';
		if($first_name <> '' AND is_email($email_reserve)){
			wp_mail( $receiver_email, $subject, $message, $headers, $attachments );
			echo '<div class="alert success">';
			echo esc_attr($successful_msg);
			echo '</div>';
		}else{
			echo '<div class="alert error">';
			echo esc_attr($un_successful_msg);
			echo '</div>';
		}
	}
	die();
}
?>