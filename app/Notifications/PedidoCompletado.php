<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PedidoCompletado extends Notification
{
    use Queueable;

    public $pedido;
    /**
     * Create a new notification instance.
     */
    public function __construct($pedido)
    {
        $this->pedido = $pedido;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Pedido Completado')
                    ->greeting('¡Hola ' . $notifiable->name . '!')
                    ->line('Tu pedido con ID: ' . $this->pedido->orden_id . ' ha sido completado.')
                    ->action('Ver Pedido', url('/pedidos/' . $this->pedido->id))
                    ->line('Gracias por usar nuestra plataforma.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pedido_id' => $this->pedido->id,
            'estado' => $this->pedido->estado,
        ];
    }
}
