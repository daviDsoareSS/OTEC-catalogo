<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $nome;
    public $telefone;
    public $value;
    public $titulo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->value = array(
            $this->url = $data['url'],
            $this->nome = $data['nome'],
            $this->telefone = $data['telefone'],
            'data' => date('d/m/Y')
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.leadMail')->subject('Novo e-mail de lead')->with($this->value);
    }
}
