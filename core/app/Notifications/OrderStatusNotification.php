<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
{
    use Queueable;
    protected $status;
    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($status,$order)
    {
        $this->status = $status;
        $this->order = Order::find($order->id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        $messages = [
            'approved' => "Your order has been approved!",
            'cancelled' => "Your order has been cancelled.",
            'completed' => "Your order has been Delivered successfully!",
            'refunded' => "Your order has been refunded.",
        ];




// dd($this->order->email);
        return (new MailMessage)
        ->subject('Order Status Update')
        ->greeting("Hello, {$this->order->orderDetails->first()->product->name}")
        ->line($messages[$this->status] ?? "Your order status has been updated.")
        ->action('SINQ MEAL', 'https://sinqmeal.com/') // Change the URL as needed
        ->line('Thank you for using our service!');
    }


    public function routeNotificationForMail($notifiable)
    {

        return $this->order->email; // Get email from the order model
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
