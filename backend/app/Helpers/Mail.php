<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\User;

class Mail
{

    public function createMailContent(array $cart, User $user, Order $order): String
    {
        // Table content
        $tableRows = '';
        foreach ($cart as $key => $item) {

            $titulo = $item['product']['titulo'];
            $price = $item['product']['precios']['final_price'];
            $quantity = $item['quantity'];

            $tableRows .= "
                    <tr style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\">
                        <td style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\">$titulo</td>
                        <td style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\">$quantity</td>
                        <td style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\">$$price</td>
                    </tr>
                ";
        }

        $tableBody = "
            <tbody>
                $tableRows
            </tbody>
        ";

        $mailContent = "
            <div>
                <div>
                    <p style=\"text-align: center; font-family: Roboto,sans-serif;\">Se ha registrado un nuevo pedido por $user->name,</p>
                    <p style=\"text-align: center; font-family: Roboto,sans-serif;\">puedes contactarlo al $user->phone_call.</p>
                </div>
            </div>
            <div class=\"body\">
                <p style=\"text-align: center; font-family: Roboto,sans-serif;\" ><strong>Detalle de pedido N.º</strong> $order->id</p>
                <table style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\">
                    <thead>
                        <tr style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\">
                            <td style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\"><strong>Producto</strong></td>
                            <td style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\"><strong>Cantidad</strong></td>
                            <td style=\"border:1px solid black; border-collapse: collapse; padding: 5px;\"><strong>Precio</strong></td>
                        </tr>
                    </thead>
                    $tableBody
                </table>
            </div>
        ";

        return $mailContent;
    }
}
