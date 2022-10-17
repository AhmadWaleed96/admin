@foreach ($order_transactions as $k => $ot)
    <tr scope="row">
        <td>{{ $k + 1 }}</td>
        <td><a href="{{ route('admin.order.details', $ot->order_id) }}">{{ $ot->order_id }}</a></td>
        <td>{{ $ot->order_amount }}</td>
        <td>{{ $ot->store_amount - $ot->tax }}</td>
        <td>{{ $ot->admin_commission }}</td>
        <td>{{ $ot->delivery_charge }}</td>
        <td>{{ $ot->tax }}</td>
        <td class="text-capitalize">{{ $ot->received_by }}</td>
        <td>{{ $ot->created_at->format('Y/m/d ' . config('timeformat')) }}</td>
    </tr>
@endforeach
