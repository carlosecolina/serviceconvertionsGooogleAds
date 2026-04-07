<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orden recibida</title>
  <style>
    * {
      font-family: system-ui, -apple-system, BlinkMacSystemFont,
        "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans",
        "Helvetica Neue", sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-weight: lighter;
    }
  </style>
</head>

<body
  style="
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
            background-color: #f9f9f9;
        ">
  <div
    style="
                background-color: #ffffff;
                padding: 40px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                width: 100%;
                margin: 0 auto;
            ">
    <header style="text-align: center; margin-bottom: 30px">
      <img src="https://{{ $domain }}/images/ux/headerLogo.png" alt="Logotipo Florería Las Doñas"
        style="max-width: 150px" />
    </header>

    <main>
      <h1
        style="
                        font-size: 24px;
                        color: #292929;
                        text-align: center;
                        margin-bottom: 30px;
                        font-weight: 600;
                    ">
        ¡Gracias , {{ $client->name }}!
      </h1>

      <p style="font-size: 16px; margin-bottom: 20px">
        Estamos emocionadas de contarte que tu
        <span style="font-weight: 600">
          pedido #{{ $sale->codigo_orden }}</span>
        ya ha sido emitido y estamos a la espera de la confirmación
        de tu pago para comenzar a trabajar en él. ¡Esperamos con
        ansias tu confirmación para crear algo especial para ti! 💐
      </p>

      <p style="font-size: 16px; margin-bottom: 20px">
        Además, al concretar tu compra, estarás acumulando
        {{ $sale->points }} Floripuntos que podrás canjear en futuros
        pedidos por complementos como globos, chocolates o peluches.
        ¡Es nuestra manera de agradecerte por elegirnos! 🎁
        <a href="https://{{ $domain }}/micuenta/puntos" style="color: #007bff; text-decoration: none">Conoce más
          sobre nuestras recompensas</a>.
      </p>

      <div
        style="
                        background-color: #f0f0f0;
                        padding: 20px;
                        border-radius: 6px;
                        margin-bottom: 30px;
                    ">
        <h2
          style="
                            font-size: 18px;
                            color: #292929;
                            margin-bottom: 15px;
                        ">
          Datos de pago
        </h2>
        <p style="font-size: 14px; margin-bottom: 10px">
          Para hacer tu pedido efectivo, por favor realiza la
          transferencia bancaria o el pago por YAPE/PLIN y
          envíanos el comprobante a :
        </p>
        <p style="font-size: 14px; margin-bottom: 5px">
          <a href="mailto:pedidos@florerialasdonas.com"
            style="color: #007bff; text-decoration: none">pedidos@florerialasdonas.com</a>
        </p>
        <p style="font-size: 14px; margin-bottom: 10px">Ó</p>
        <p style="font-size: 14px">
          <a href="https://api.whatsapp.com/send?phone= {{ $generals->whatsapp }}&text={{ $generals->mensaje_whatsapp }} N Orden: {{ $sale->codigo_orden }} "
            style="color: #007bff; text-decoration: none">WhatsApp: 987829046</a>
        </p>
      </div>

      <div
        style="
                        border-left: 4px solid #007bff;
                        padding-left: 15px;
                        margin-bottom: 30px;
                    ">
        <h2
          style="
                            font-size: 18px;
                            color: #292929;
                            margin-bottom: 15px;
                        ">
          Cuentas bancarias
        </h2>
        <p style="font-size: 14px; margin-bottom: 5px">
          Titular: Fabrizio Renato Valderrama Gonzaga
        </p>
        <p style="font-size: 14px; margin-bottom: 5px">
          YAPE/PLIN: 987829046
        </p>
        <p style="font-size: 14px; margin-bottom: 5px">
          BCP: 191-27695867-0-21
        </p>
        <p style="font-size: 14px; margin-bottom: 5px">
          INTERBANK: 200-3026726544
        </p>
        <p style="font-size: 14px; margin-bottom: 5px">
          BBVA: 0011-0175-0200359715
        </p>
        <p style="font-size: 14px">SCOTIABANK: 151-0020074</p>
      </div>
      <div>
        <h2
          style="
                            font-size: 18px;
                            color: #292929;
                            margin-bottom: 15px;
                        ">
          Detalles Pedido
        </h2>
        <div id="productos-lista">
          @foreach ($productos as $item)
            <p style="font-size: 14px; margin-bottom: 5px">
              <strong>{{ $item->nombre }}:</strong> {{ $item->precio }}
            </p>
          @endforeach
        </div>



      </div>

      <div
        style="
                        background-color: #e8f4ff;
                        padding: 20px;
                        border-radius: 6px;
                        margin-bottom: 30px;
                    ">
        <h2
          style="
                            font-size: 18px;
                            color: #292929;
                            margin-bottom: 15px;
                        ">
          Detalles de entrega
        </h2>
        <p style="font-size: 14px; margin-bottom: 5px">
          <strong>Fecha:</strong> {{ $sale->fechaenvio }} de
          {{ $horario->start_time }} - {{ $horario->end_time }}
        </p>
        <p style="font-size: 14px; margin-bottom: 5px">
          <strong>Nombre:</strong> {{ $sale->address_owner }}
        </p>
        <p style="font-size: 14px; margin-bottom: 5px">
          <strong>Teléfono:</strong> {{ $sale->consumer_phone }}
        </p>
        <p style="font-size: 14px">
          <strong>Dirección:</strong> {{ $sale->address_full }}
        </p>
      </div>

      <p style="font-size: 16px; margin-bottom: 20px">
        Si tienes alguna duda, comentario o inquietud, no dudes en
        contactarnos a través de nuestro WhatsApp , ¡Estamos aquí
        para ayudarte con lo que necesites! 🌷
      </p>
      <p style="font-size: 14px; margin-bottom: 5px">
        <a href="https://api.whatsapp.com/send?phone={{ $generals->whatsapp }}&text={{ $generals->mensaje_whatsapp }} N Orden: {{ $sale->codigo_orden }} "
          style="color: #007bff; text-decoration: none">WhatsApp: 987829046</a>
      </p>
      <p style="font-size: 14px">
        <a href="#" style="color: #007bff; text-decoration: none">Teléfono: (01) 597-8881</a>
      </p>

      <p
        style="
                        font-size: 16px;
                        text-align: center;
                        margin-top: 30px;
                    ">
        Gracias por elegirnos para hacer de este momento algo
        inolvidable. 🌷
      </p>
      <p
        style="
                        font-size: 16px;
                        text-align: center;
                        margin-top: 30px;
                    ">
        Con cariño,
        <span style="font-weight: 600">
          El equipo de Florería Las Doñas
        </span>
      </p>
    </main>

    <footer
      style="
                    margin-top: 40px;
                    text-align: center;
                    font-size: 12px;
                    color: #888;
                ">
      <p>© 2024 Florería Las Doñas. Todos los derechos reservados.</p>
    </footer>
  </div>
</body>

</html>
