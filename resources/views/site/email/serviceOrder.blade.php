<table>
    <table style="width: 600px; margin: 0 auto; font-family: sans-serif; background: #003b95; color: #fff;">
        <tr>
            <td style="padding: 15px; text-align:center;"><img src="{{ asset('img/logo.png') }}" alt=""></td>
        </tr>
    </table>
    <table style="width: 600px; margin: 0 auto; padding: 25px; font-family: sans-serif; background: #003b95; color: #fff;">
        <tr>
            <td style="padding: 15px; font-weight:bold">Замовлення №{{ $servicesOrder->id }}</td>
        </tr>
        <tr>
            <td style="padding: 15px">Ім'я:</td>
            <td style="padding: 15px">{{ $servicesOrder->firstname }}</td>
        </tr>
        <tr>
            <td style="padding: 15px">Фамілія:</td>
            <td style="padding: 15px">{{ $servicesOrder->lastname }}</td>
        </tr>
        <tr>
            <td style="padding: 15px">Номер телефону:</td>
            <td style="padding: 15px">{{ $servicesOrder->phone }}</td>
        </tr>
    </table>
    <table style="width: 600px; padding: 25px; margin: 0 auto; font-family: sans-serif; background: #003b95; color: #fff;">
        <tr>
            <td style="padding: 15px">Що цікавить:</td>
        </tr>
        <tr style="col-span: 3; border: 1px solod black">
            <td style="padding: 15px; colum-span: 3;">{{ $servicesOrder->interes }}</td>
        </tr>
    </table>
    <table style="width: 600px; padding: 25px; margin: 0 auto; font-family: sans-serif; background: #003b95; color: #fff;">
        <tr>
            <td style="padding: 15px; text-align:center;"><a style="color: black; padding: 15px; background: #fff; text-decoration:none" href="{{ route('servicesOrder.index') }}">Відкрити в адмін-панелі</a></td>
        </tr>
    </table>

</table>
