<?php
namespace JW3B\Helpful;

class Mail {
	/**
	 * Send an email.
	 *
	 * @param string $to The recipient's email address.
	 * @param string $from Senders email address.
	 * @param string $subject The subject of the email.
	 * @param string $message The email message.
	 * @param array $header Additional headers.
	 * @return bool True if the email was sent successfully, false otherwise.
	 */
	public static function send(string $to, string $from, string $subject, string $message, array $header = []): bool
	{
		$headers[] = 'Content-type: text/html; charset=UTF-8';
		$headers[] = 'From: '.$from;
		$headers[] = 'Reply-To: '.$from;
		$headers[] = 'X-Mailer: PHP/'.phpversion();
		$head = implode("\r\n", array_merge($headers, $header));
		return @mail($to, $subject, $message, $head, "-f ".$from);
	}
}