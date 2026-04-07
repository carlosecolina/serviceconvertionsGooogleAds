<?php

namespace App\Http\Responses;

use App\Helpers\EmailConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $role = Auth::user()->roles->pluck('name');
        $usuario = Auth::user();

        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        switch ($role[0]) {
            case 'Admin':
                return redirect()->intended(config('fortify.home'));
            case 'Customer':
                $this->envioCorreo($usuario);
                return redirect()->intended(config('fortify.home_public'));
            default:
                return redirect()->intended(config('fortify.home_public'));
        }
    }

    private function envioCorreo($data)
    {
        $name = $data['name'];
        $mail = EmailConfig::config();
        try {
            $mail->addAddress($data['email']);
            $mail->Body =
                '<html lang="en">
                <head>
                    <meta charset="UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <title>Mundo web</title>
                    <link rel="preconnect" href="https://fonts.googleapis.com" />
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
                    <link
                    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
                    rel="stylesheet"
                    />
                    <style>
                    * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }
                    </style>
                </head>
                <body>
                    <main>
                    <table
                        style="
                        width: 600px;
                        margin: 0 auto;
                        text-align: center;
                        background-image: url(./Fondo_600px.png);
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;
                        "
                    >
                        <thead>
                        <tr>
                            <th
                            style="
                                display: flex;
                                flex-direction: row;
                                justify-content: center;
                                align-items: center;
                                margin: 40px;
                            "
                            >
                            <img src="./Logodomine.png" alt="mundo web" />
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                            <p
                                style="
                                color: #ffffff;
                                font-weight: 500;
                                font-size: 18px;
                                text-align: center;
                                width: 500px;
                                margin: 0 auto;
                                padding: 20px 0;
                                font-family: Montserrat, sans-serif;
                                "
                            >
                                <span style="display: block">Hola</span>
                            </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <p
                                style="
                                color: #000000;
                                font-size: 40px;
                                line-height: 20px;
                                font-family: Montserrat, sans-serif;
                                "
                            >
                                <span style="display: block">' . $name .' </span>
                            </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <p
                                style="
                                color: #000000;
                                font-size: 40px;
                                line-height: 70px;
                                font-family: Montserrat, sans-serif;
                                font-weight: bold;
                                font-style: italic;
                                "
                            >
                                !Gracias
                                <span style="color: #ffffff">por escribirnos!</span>
                            </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <p
                                style="
                                color: #ffffff;
                                font-weight: 500;
                                font-size: 18px;
                                text-align: center;
                                width: 250px;
                                margin: 0 auto;
                                padding: 10px 0 20px 0;
                                font-family: Montserrat, sans-serif;
                                "
                            >
                                En breve estaremos comunicandonos contigo.
                            </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <a
                                href="https://mundoweb.pe/"
                                style="
                                text-decoration: none;
                                background-color: #000000;
                                color: white;
                                padding: 14px 25px;
                                display: inline-flex;
                                justify-content: center;
                                align-items: center;
                                gap: 10px;
                                font-weight: 600;
                                font-family: Montserrat, sans-serif;
                                font-size: 16px;
                                border-radius: 40px;
                                "
                            >
                                <span>Visita nuestra web</span>
                            </a>
                            </td>
                        </tr>
                        <tr>
                            <td
                            style="
                                text-align: right;
                                display: flex;
                                justify-content: end;
                                align-items: end;
                            "
                            >
                            <div
                                style="
                                margin-right: -60px;
                                padding: 40px 0;
                                display: flex;
                                gap: 15px;
                                z-index: 10;
                                "
                            >
                                <a href=""><img src="twitter.png" alt="twitter" /></a>
                                <a href=""><img src="facebook.png" alt="facebook" /></a>
                                <a href=""><img src="instagram.png" alt="instagram" /></a>
                            </div>
                            <img
                                src="foto_banner.png"
                                alt="mundo web"
                                style="width: 315px; height: 450px"
                            />
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </main>
                </body>
                </html>
            ';
            $mail->isHTML(true);
            $mail->send();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
