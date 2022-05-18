<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompleteNotification extends Notification
{
    use Queueable;

    public $address,$order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($address,$order)
    {
        $this->address = $address;
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                        ->greeting('Hello, '.$this->address->name)
                        ->subject('Order Successfully Complete')
                        ->line('Your order has sent to Admin. We will notify you very shortly')
                        ->line('Package Name: '.$this->order->price->title)
                        ->line('Your Order Id: '.$this->order->order_code)
                        ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
