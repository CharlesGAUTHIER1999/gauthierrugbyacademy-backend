<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(
        public Order $order,
        public string $status,
    ) {}

    public function via($notifiable): array {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $labels = [
            'shipped'   => 'expédiée 📦',
            'delivered' => 'livrée ✅',
            'canceled'  => 'annulée ❌',
        ];

        $label = $labels[$this->status] ?? $this->status;

        return (new MailMessage)
            ->subject("Commande #{$this->order->id} $label")
            ->replyTo(config('mail.support_address'))
            ->greeting("Bonjour $notifiable->firstname,")
            ->line("Le statut de votre commande a été mis à jour.")
            ->line("Commande : #{$this->order->id}")
            ->line("Nouveau statut : $label")
            ->action('Voir ma commande', config('app.front_url') . '/account/orders')
            ->salutation("— Gauthier Fitness");
    }
}