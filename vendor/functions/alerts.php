<?php

/**
 * Displays a general message with a customizable title.
 *
 * @param string $message The message content.
 * @param string $title (Optional) The title of the message box. Default is 'Message'.
 *
 * Usage:
 * alert_message("This is a general message.");
 * alert_message("Custom Message", "Notice");
 */
function alert_message($message, $title = ''){
    if ($title == '') {
        $title = 'Message';
    }
    $template = " <style type='text/css'> .message_box{width:75%; margin:50px auto; padding:0px; border: 1px solid #89bfca; background:#fff; border-radius:5px; line-height:24px;}.message_box .title{padding:15px; background:#d9edf7; color:#31708f; border-bottom: 1px solid #89bfca; border-radius: 5px 5px 0px 0px; font-size: 18px;word-break: break-word;}.message_box .body{padding:15px; color:#000;  font-size:16px; line-height:24px;word-break: break-word;}</style> <div class='message_box'> <div class='title'>$title</div><div class='body'>$message</div></div>";
    echo $template;
}

/**
 * Displays a success message with a customizable title.
 *
 * @param string $message The success message content.
 * @param string $title (Optional) The title of the success box. Default is 'Success'.
 *
 * Usage:
 * success_message("Operation completed successfully.");
 * success_message("Data saved successfully", "Great!");
 */
function success_message($message, $title = ''){
    if ($title == '') {
        $title = 'Success';
    }
    $template = " <style type='text/css'> .success_box{width:75%; margin:50px auto; padding:0px; border: 1px solid #9cc27e; background:#fff; border-radius:5px; line-height:24px;}.success_box .title{padding:15px; background:#dff0d8; color:#3c763d; border-bottom: 1px solid #9cc27e; border-radius: 5px 5px 0px 0px; font-size: 18px;word-break: break-word;}.success_box .body{padding:15px; color:#000;  font-size:16px; line-height:24px;word-break: break-word;}</style> <div class='success_box'> <div class='title'>$title</div><div class='body'>$message</div></div>";
    echo $template;
}

/**
 * Displays an error message with a customizable title.
 *
 * @param string $message The error message content.
 * @param string $title (Optional) The title of the error box. Default is 'Error'.
 *
 * Usage:
 * error_message("An error occurred while processing your request.");
 * error_message("Failed to connect to database", "Database Error");
 */
function error_message($message, $title = ''){
    if ($title == '') {
        $title = 'Error';
    }
    $template = " <style type='text/css'> .error_box{width:75%; margin:50px auto; padding:0px; border: 1px solid #d59aa4; background:#fff; border-radius:5px; line-height:24px;}.error_box .title{padding:15px; background:#f7dbdb; color:#a94442; border-bottom: 1px solid #d59aa4; border-radius: 5px 5px 0px 0px; font-size: 18px;word-break: break-word;}.error_box .body{padding:15px; color:#000;  font-size:16px; line-height:24px;word-break: break-word;}</style> <div class='error_box'> <div class='title'>$title</div><div class='body'>$message</div></div>";
    echo $template;
}

/**
 * Displays a warning message with a customizable title.
 *
 * @param string $message The warning message content.
 * @param string $title (Optional) The title of the warning box. Default is 'Warning'.
 *
 * Usage:
 * warning_message("This action may have unintended consequences.");
 * warning_message("Low disk space", "System Alert");
 */
function warning_message($message, $title = ''){
    if ($title == '') {
        $title = 'Warning';
    }
    $template = " <style type='text/css'> .warning_box{width:75%; margin:50px auto; padding:0px; border: 1px solid #dfc899; background:#fff; border-radius:5px; line-height:24px;}.warning_box .title{padding:15px; background:#f9f2d0; color:#8a6d3b; border-bottom: 1px solid #dfc899; border-radius: 5px 5px 0px 0px; font-size: 18px;word-break: break-word;}.warning_box .body{padding:15px; color:#000;  font-size:16px; line-height:24px;word-break: break-word;}</style> <div class='warning_box'> <div class='title'>$title</div><div class='body'>$message</div></div>";
    echo $template;
}

?>
