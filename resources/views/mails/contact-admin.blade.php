
<table cellpadding="10">
    <tr>
        <td>naam</td>
        <td>{!! $request['naam'] !!}</td>
    </tr>
    <tr>
        <td>bedrijfnaam</td>
        <td>{!! $request['bedrijfnaam'] !!}</td>
    </tr>
    <tr>
        <td>telefoonnummer</td>
        <td>{!! $request['telefoonnummer'] !!}</td>
    </tr>
    <tr>
        <td>email</td>
        <td>{!! $request['email'] !!}</td>
    </tr>
    <tr>
        <td>bericht</td>
        <td>{!! $request['bericht'] !!}</td>
    </tr>
</table>

<hr>

kopie bericht
{!! Editor('contact_email', false, false, "", ['mentions' => $request]) !!}

