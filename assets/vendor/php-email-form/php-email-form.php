<?php
class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $ajax = false;
  public $smtp = false;
  private $messages = array();

  public function add_message($content, $label = '', $length = 0) {
    if ($length && strlen($content) < $length) return;
    $this->messages[] = "$label: $content";
  }

  public function send() {
    $headers  = "From: $this->from_name <$this->from_email>\r\n";
    $headers .= "Reply-To: $this->from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $message = implode("\n", $this->messages);

    if (mail($this->to, $this->subject, $message, $headers)) {
      return 'OK';
    } else {
      return 'ERROR: Gagal mengirim email.';
    }
  }
}
?>
