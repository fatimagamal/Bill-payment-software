<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;


class AddInvoices extends Notification
{
    use Queueable;
    private $invoices;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(  $invoices)
    {
        $this->invoices=$invoices;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database'];
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
   

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    
    public function toDatabase($notifiable)
    {

        return [
           'id'=> $this->invoices,
           'user'=> Auth::user()->name,
           'title'=> ': تم اضافه الفاتوره بواسطه ',
               ];
    }

    public function toMail($notifiable)
    {
        $url="http://127.0.0.1:8000/invoicesDetails/". $this->invoices;
        return (New MailMessage)
        ->subject('  مرحبا عزيزي العميل')
            ->subject('اضافه فاتوره جديده')
            ->line( "اضافه فاتوره جديده")
            ->action('عرض الفاتوره',$url)
            ->line( "شكرا لاستخدامك موقعنا لتحصيل الفواتير")
              ;
    }

  
}
