<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

cuse PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
class MailerController extends Controller {
 
    // =============== [ Email ] ===================
    public function email() {
        return view("email");
    }
 
 
    // ========== [ Compose Email ] ================
    public function composeEmail(Request $request) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
 
        try {
 
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'info@foodroz.com';   //  sender username
            $mail->Password = 'FkbWlu@2020^qaz';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465
 
            $mail->setFrom('info@foodroz.com', 'FoodRoz');
            $mail->addAddress($request->emailRecipient);
            $mail->addCC($request->emailCc);
            $mail->addBCC($request->emailBcc);
 
            $mail->addReplyTo('info@foodroz.com', 'FoodRoz');
 
            if(isset($_FILES['emailAttachments'])) {
                for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                }
            }
 
 
            $mail->isHTML(true);                // Set email content format to HTML
 
            $mail->Subject = $request->emailSubject;
            $mail->Body    = $request->emailBody;
 
            // $mail->AltBody = plain text version of email body;
 
            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return back()->with("success", "Email has been sent.");
            }
 
        } catch (Exception $e) {
             return back()->with('error','Message could not be sent.');
        }
    }
}