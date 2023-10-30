<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $code;
    private $store;
    private $account;
    private $employee;

    /**
     * Create a new message instance.
     */
    public function __construct($code, $store, $employee, $account)
    {
        $this->code = $code;
        $this->store = $store;
        $this->account = $account;
        $this->employee = $employee;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác thực tài khoản người dùng',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'send_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->from('minhduong14499@gmail.com')
            ->view('emails.send_email')
            ->with([
                'code' => $this->code,
                'store' => $this->store,
                'account' => $this->account,
                'employee' => $this->employee,
            ]);
    }
}
