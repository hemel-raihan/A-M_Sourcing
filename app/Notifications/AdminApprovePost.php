<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminApprovePost extends Notification implements ShouldQueue
{
    use Queueable;

    public $post,$admin_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post,$admin_name)
    {
        $this->post = $post;
        $this->admin_name = $admin_name;
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
                ->greeting('Hello, '.$this->post->admin->name)
                ->subject('Your Post Successfully Approved')
                ->line('Your Post has been successfully approved by '.$this->admin_name)
                ->line('Post Title :'. $this->post->title)
                ->action('View', url(route('admin.posts.show',$this->post->id)))
                ->line('Thank you for using our application!');
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
