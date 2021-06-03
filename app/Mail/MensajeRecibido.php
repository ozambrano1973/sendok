<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Crypt;

class MensajeRecibido extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Envio de documento';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $nombre, String $contenido, Array $folletos, String $asunto)
    {
        $this->nombre = $nombre;
        $this->contenido = $contenido;
        $this->folletos = $folletos;
        $this->asunto = $asunto;
        $this->subject = $asunto; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $nombre = $this->nombre;
       $contenido = $this->contenido;
       $folletos = $this->folletos;       

       if($contenido==""){
            $contenido = "Estimado/a Cliente:
            Hacemos llegar a usted nuestra propuesta comercial.
            Saludos y gracias por su preferencia.";
       }
        $user_id = Auth::user()->id;
        if(file_exists('./firmas/html/firma_'.$user_id.'.html')){
            $firma = file_get_contents('./firmas/html/firma_'.$user_id.'.html');
        }else{
            $firma = "<html><body><p><b>".Auth::user()->name."</b><br>".Auth::user()->cargo."</p></body></html>";
        }

    
        if($firma=="" || $firma ==null){
            $firma =="";
        }
        $contenido = "<html><body><text>".$contenido."</text><br>--".$firma."</body></html>";

        $email = $this->view('emails.envio-documento')->with("contenido",$contenido);
        $email->attachData(file_get_contents('./documentos/'.$nombre),$nombre,[
            'mime' => 'application/pdf',
        ]);
        foreach($folletos as $folleto){
            $email->attachData(file_get_contents('./productos/'.$folleto),$folleto,[
                'mime' => 'application/pdf',
            ]);
        }
        
        return $this->from(Crypt::decryptString(Auth::user()->email_smtp));
    }
}
